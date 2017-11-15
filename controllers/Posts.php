<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;
use App;
use File;
use Mail;
use Request;
use Indikator\News\Models\Posts as Item;
use Indikator\News\Classes\NewsSender;
use Jenssegers\Date\Date;
use Flash;
use Lang;
use Redirect;

class Posts extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ImportExportController::class
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

    protected function getNewsByPathOrFail()
    {
        $uri = explode('/', Request::path());

        return Item::findOrFail($uri[count($uri) - 1]);
    }

    public function onTest()
    {
        $news   = $this->getNewsByPathOrFail();
        $sender = new NewsSender($news);

        if ($sender->sendTestNewsletter()) {
            Flash::success(trans('system::lang.mail_templates.test_success'));
        }
        else {
            Flash::error(trans('indikator.news::lang.flash.newsletter_test_error'));
        }
    }

    /**
     * Sends a newsletter the first time if last_send_at is null.
     * Flash message will be attached.
     * @return mixed
     */
    public function onNewsSend()
    {
        $news = $this->getNewsByPathOrFail();

        if ($news->last_send_at === null) {
            $sender = new NewsSender($news);

            if ($sender->sendNewsletter()) {
                Flash::success(trans('indikator.news::lang.flash.newsletter_send_success'));
            }
            else {
                Flash::error(trans('indikator.news::lang.flash.newsletter_send_error'));
            }
        }
        else {
            Flash::error(trans('indikator.news::lang.flash.newsletter_send_error'));
        }

        return Redirect::refresh();
    }

    /**
     * Sends a newsletter again to the subscribers.
     * Returns a refresh with attached Flash message.
     * @return mixed
     */
    public function onNewsResend()
    {
        $news = $this->getNewsByPathOrFail();
        $sender = new NewsSender($news);

        if ($sender->resendNewsletter()) {
            Item::where('id', $news->id)->update(['last_send_at' => Date::now()]);

            Flash::success(trans('indikator.news::lang.flash.newsletter_resend_success'));
        }
        else {
            Flash::error(trans('indikator.news::lang.flash.newsletter_resend_error'));
        }

        return Redirect::refresh();
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
