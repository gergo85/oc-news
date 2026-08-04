<?php namespace Indikator\News\FormWidgets;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use Request;
use App;
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
        $this->vars['updated_at'] = $newsInfo->updated_at
            ? $newsInfo->updated_at->locale(App::getLocale())->isoFormat('LLL')
            : null;
    }

    public function getSaveValue($value)
    {
        return \Backend\Classes\FormField::NO_SAVE_DATA;
    }
}
