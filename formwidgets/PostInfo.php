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
        $uriList  = explode('/', Request::path());
        $newsInfo = Posts::whereId(end($uriList))->first();

        $this->vars['statistics'] = $newsInfo->statistics;
        $this->vars['updated_at'] = substr($newsInfo->updated_at, 0, -3);
    }

    public function getSaveValue($value)
    {
        return \Backend\Classes\FormField::NO_SAVE_DATA;
    }
}
