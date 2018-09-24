<?php namespace Indikator\News\FormWidgets;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use Request;
use Indikator\News\Models\Posts;

class PostInfo extends FormWidgetBase
{
    protected $defaultAlias = 'postinfo';

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('postinfo');
    }

    protected function prepareVars()
    {
        $uri = explode('/', Request::path());
        $news = Posts::whereId(end($uri))->first();

        $this->vars['statistics'] = $news->statistics;
        $this->vars['updated_at'] = substr($news->updated_at, 0, -3);
    }

    public function getSaveValue($value)
    {
        return \Backend\Classes\FormField::NO_SAVE_DATA;
    }
}
