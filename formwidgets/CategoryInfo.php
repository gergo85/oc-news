<?php namespace Indikator\News\FormWidgets;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use Request;
use App;
use Indikator\News\Models\Categories;
use Indikator\News\Models\Posts;
use Db;

class CategoryInfo extends FormWidgetBase
{
    protected $defaultAlias = 'categoryinfo';

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('categoryinfo');
    }

    protected function prepareVars()
    {
        $uriList  = explode('/', Request::path());
        $category = Categories::whereId(end($uriList))->first();

        $this->vars['posts']       = Posts::inCategory($uriList[5])->count();
        $this->vars['subscribers'] = Db::table('indikator_news_relations')->where('categories_id', $category->id)->count();
        $this->vars['sort_order']  = $category->sort_order;
        $this->vars['updated_at']  = $category->updated_at
            ? $category->updated_at->locale(App::getLocale())->isoFormat('LLL')
            : null;
    }

    public function getSaveValue($value)
    {
        return \Backend\Classes\FormField::NO_SAVE_DATA;
    }
}
