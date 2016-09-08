<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Lang;

class Subscribers extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['indikator.news.subscribers'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.News', 'news', 'subscribers');
    }

    public function onRemoveSubscribers()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Subscribers::find($itemId)) {
                    continue;
                }

                $item->delete();
            }

            Flash::success(Lang::get('indikator.news::lang.flash.remove'));
        }

        return $this->listRefresh();
    }
}
