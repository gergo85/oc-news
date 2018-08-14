<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\News\Models\Subscribers as Item;
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
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', 2)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 1]);
            }

            Flash::success(Lang::get('indikator.content::lang.flash.subscribe'));
        }

        return $this->listRefresh();
    }

    public function onUnsubscribe()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('status', 1)->whereId($itemId)) {
                    continue;
                }

                $item->update(['status' => 2]);
            }

            Flash::success(Lang::get('indikator.content::lang.flash.unsubscribe'));
        }

        return $this->listRefresh();
    }

    public function onRemove()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::whereId($itemId)) {
                    continue;
                }

                $item->delete();

                Db::table('indikator_news_relations')->where('subscriber_id', $itemId)->delete();
            }

            Flash::success(Lang::get('indikator.news::lang.flash.remove'));
        }

        return $this->listRefresh();
    }

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
        $this->vars['user'] = $user = Item::whereId(post('id'))->first();
        $this->vars['registered_at']   = ($user->registered_at) ? $user->registered_at : $user->created_at;
        $this->vars['confirmed_at']    = ($user->confirmed_at) ? $user->confirmed_at : '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';
        $this->vars['unsubscribed_at'] = ($user->unsubscribed_at) ? $user->unsubscribed_at : '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';

        return $this->makePartial('show_stat');
    }
}
