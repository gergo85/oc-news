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
use Carbon\Carbon;
use Flash;
use Lang;
use Redirect;

class Posts extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ImportExportController::class,
        \Backend\Behaviors\RelationController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';
    public $relationConfig = 'config_relation.yaml';

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

        return Item::findOrFail(end($uri));
    }

    /**
     * Sends a test newsletter to the logged user.
     */
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
     *
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
     *
     * @return mixed
     */
    public function onNewsResend()
    {
        $news   = $this->getNewsByPathOrFail();
        $sender = new NewsSender($news);

        if ($sender->resendNewsletter()) {
            Item::where('id', $news->id)->update(['last_send_at' => now()]);

            Flash::success(trans('indikator.news::lang.flash.newsletter_resend_success'));
        }
        else {
            Flash::error(trans('indikator.news::lang.flash.newsletter_resend_error'));
        }

        return Redirect::refresh();
    }

    public function onActivatePosts()
    {
        if ($this->isSelected()) {
            $this->changeStatus(post('checked'), 1);
            $this->setMessage('activate');
        }

        return $this->listRefresh();
    }

    public function onDeactivatePosts()
    {
        if ($this->isSelected()) {
            $this->changeStatus(post('checked'), 2);
            $this->setMessage('deactivate');
        }

        return $this->listRefresh();
    }

    public function onDraftPosts()
    {
        if ($this->isSelected()) {
            $this->changeStatus(post('checked'), 3);
            $this->setMessage('draft');
        }

        return $this->listRefresh();
    }

    public function onRemovePosts()
    {
        if ($this->isSelected()) {
            foreach (post('checked') as $itemId) {
                if (!$item = Item::whereId($itemId)) {
                    continue;
                }

                $item->delete();
            }

            $this->setMessage('remove');
        }

        return $this->listRefresh();
    }

    /**
     * @return bool
     */
    private function isSelected()
    {
        return ($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds);
    }

    /**
     * @param $action
     */
    private function setMessage($action)
    {
        Flash::success(Lang::get('indikator.news::lang.flash.'.$action));
    }

    /**
     * @param $post
     * @param $id
     */
    private function changeStatus($post, $id)
    {
        foreach ($post as $itemId) {
            if (!$item = Item::where('status', '!=', $id)->whereId($itemId)) {
                continue;
            }

            if ($id == 1) {
                $update['status'] = 1;

                if (Item::whereId($itemId)->value('published_at') == null) {
                    $update['published_at'] = Carbon::now();
                }
            }
            else {
                $update = ['status' => $id];
            }

            $item->update($update);
        }
    }

    /**
     * @param $id
     */
    public function onClonePosts($id)
    {
        $post    = Item::find($id);
        $newPost = $post->duplicate($post);
        $path    = Request::path();

        return Redirect::to(substr($path, 0, strrpos($path, '/', -1) + 1).$newPost->id);
    }

    public function onShowImage()
    {
        $this->vars['title'] = Item::where('image', post('image'))->value('title');
        $this->vars['image'] = '/storage/app/media'.post('image');

        return $this->makePartial('show_image');
    }

    public function onShowStat()
    {
        $this->vars['post'] = $post = Item::whereId(post('id'))->first();
        $this->vars['last_send_at'] = ($post->last_send_at) ? $post->last_send_at : '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';
        $this->vars['published_at'] = ($post->published_at) ? $post->published_at : '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';

        return $this->makePartial('show_stat');
    }

    /**
     * Add user_id for user relationship before save
     *
     * @param $model
     */
    public function formBeforeCreate($model)
    {
        $model->user_id = $this->user->id;
    }
}
