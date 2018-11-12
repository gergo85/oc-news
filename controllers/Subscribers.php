<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\News\Models\Subscribers as Item;
use Indikator\News\Models\Logs;
use Db;
use Flash;
use Jenssegers\Date\Date;
use Lang;
use Request;
use Redirect;

class Subscribers extends Controller
{
    /**
     * @var array Defines a collection of actions available without authentication.
     */
    protected $publicActions = ['confirm'];

    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ImportExportController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = ['indikator.news.subscribers'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.News', 'news', 'subscribers');
    }

    public function onSubscribe()
    {
        if ($this->isSelected()) {
            $this->changeStatus(post('checked'), 2, 1);
            $this->setMessage('subscribe');
        }

        return $this->listRefresh();
    }

    public function onUnsubscribe()
    {
        if ($this->isSelected()) {
            $this->changeStatus(post('checked'), 1, 2);
            $this->setMessage('unsubscribe');
        }

        return $this->listRefresh();
    }

    public function onRemove()
    {
        if ($this->isSelected()) {
            foreach (post('checked') as $itemId) {
                if (!$item = Item::whereId($itemId)) {
                    continue;
                }

                $item->delete();

                Db::table('indikator_news_relations')->where('subscriber_id', $itemId)->delete();
                Logs::where('subscriber_id', $itemId)->delete();
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
     * @param $from
     * @param $to
     */
    private function changeStatus($post, $from, $to)
    {
        foreach ($post as $itemId) {
            if (!$item = Item::where('status', $from)->whereId($itemId)) {
                continue;
            }

            $item->update(['status' => $to]);
        }
    }

    /**
     * @param $id
     * @param $hash
     */
    public function confirm($id = null, $hash = null)
    {
        $subscriber = Item::find($id);

        if ($subscriber == null) {
            Flash::failed(Lang::get('indikator.news::lang.flash.subscriber_confirmation_token_invalid'));
            return Redirect::to('/');
        }

        if ($subscriber->status == 3 && $subscriber->confirmation_hash == $hash) {
            if ($subscriber->registered_at < Date::now()->subDay()) {
                Flash::error(Lang::get('indikator.news::lang.flash.subscriber_confirmation_token_expired'));
                return Redirect::to('/');
            }

            $subscriber->confirmed_ip = Request::ip();
            $subscriber->confirmed_at = Date::now();
            $subscriber->activate();

            Flash::success(Lang::get('indikator.news::lang.flash.subscriber_confirmation'));
        }
        else if ($subscriber->status == 1) {
            Flash::success(Lang::get('indikator.news::lang.flash.subscriber_already_confirmed'));
        }
        else {
            Flash::error(Lang::get('indikator.news::lang.flash.subscriber_confirmation_token_invalid'));
        }

        return Redirect::to('/');
    }

    public function onShowStat()
    {
        $this->vars['subscriber']      = $subscriber = Item::whereId(post('id'))->first();
        $this->vars['registered_at']   = ($subscriber->registered_at) ? $subscriber->registered_at : $subscriber->created_at;
        $this->vars['confirmed_at']    = ($subscriber->confirmed_at) ? $subscriber->confirmed_at : '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';
        $this->vars['unsubscribed_at'] = ($subscriber->unsubscribed_at) ? $subscriber->unsubscribed_at : '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';

        return $this->makePartial('show_stat');
    }

    public function onShowEmails()
    {
        $this->vars['subscriber'] = Item::whereId(post('id'))->first();
        $this->vars['emails']     = Logs::where('subscriber_id', post('id'))->orderBy('send_at', 'desc')->get()->all();
        $this->vars['class'] = [
            'Queued'  => 'text-warning',
            'Sent'    => 'text-info',
            'Viewed'  => 'text-success',
            'Clicked' => 'text-success',
            'Failed'  => 'text-danger'
        ];

        return $this->makePartial('show_emails');
    }
}
