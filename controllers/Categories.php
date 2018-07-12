<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Indikator\News\Models\Categories as Item;
use Indikator\News\Models\Posts;
use Db;
use Flash;
use Lang;

class Categories extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\ReorderController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = ['indikator.news.categories'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.News', 'news', 'categories');
    }

    public function onDeactivate()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$item = Item::where('hidden', 1)->whereId($itemId)) {
                    continue;
                }

                $item->update(['hidden' => 2]);
            }

            Flash::success(Lang::get('indikator.news::lang.flash.deactivate'));
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

                Posts::where('category_id', $itemId)->update(['category_id' => 0]);
                Db::table('indikator_news_relations')->where('categories_id', $itemId)->delete();
            }

            Flash::success(Lang::get('indikator.news::lang.flash.remove'));
        }

        return $this->listRefresh();
    }

    public function onShowImage()
    {
        return '
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="popup">×</button>
                <h4 class="modal-title">'.Item::where('image', post('image'))->value('name').'</h4>
            </div>
            <div class="modal-body">
                <img src="/storage/app/media'.post('image').'" alt="" class="img-responsive"><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="popup">'.Lang::get('backend::lang.form.close').'</button>
            </div>
        ';
    }
}
