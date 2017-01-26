<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;
use App;
use Request;
use File;
use Mail;
use Indikator\News\Models\Posts as Item;
use Flash;
use Lang;

class Posts extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = ['indikator.news.posts'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.News', 'news', 'posts');
    }

    public function onTest()
    {
        $locale = App::getLocale();
        $uri = explode('/', Request::path());
        $news = Item::whereId($uri[count($uri) - 1])->first();

        if (!File::exists(base_path().'/plugins/indikator/news/views/mail/email_'.$locale.'.htm')) {
            $locale = 'en';
        }

        $user = BackendAuth::getUser();

        $params = [
            'name'         => $user->login,
            'email'        => $user->email,
            'title'        => $news->title,
            'slug'         => $news->slug,
            'introductory' => $news->introductory,
            'content'      => $news->content,
            'image'        => $news->image
        ];

        Mail::send('indikator.news::mail.email_'.$locale, $params, function($message)
        {
            $user = BackendAuth::getUser();
            $message->to($user->email, $user->login);
        });

        Flash::success(trans('system::lang.mail_templates.test_success'));
    }

    public function onActivatePosts()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', '!=', 1)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 1]);
            }

            Flash::success(Lang::get('indikator.news::lang.flash.activate'));
        }

        return $this->listRefresh();
    }

    public function onDeactivatePosts()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', '!=', 2)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 2]);
            }

            Flash::success(Lang::get('indikator.news::lang.flash.deactivate'));
        }

        return $this->listRefresh();
    }

    public function onDraftPosts()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', '!=', 3)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 3]);
            }

            Flash::success(Lang::get('indikator.news::lang.flash.activate'));
        }

        return $this->listRefresh();
    }

    public function onRemovePosts()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::whereId($itemId)) {
                    continue;
                }

                $item->delete();
            }

            Flash::success(Lang::get('indikator.news::lang.flash.remove'));
        }

        return $this->listRefresh();
    }
}
