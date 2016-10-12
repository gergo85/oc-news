<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Indikator\News\Models\Posts as NewsPost;

class Stat extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.stat',
            'description' => ''
        ];
    }

    public function onRun()
    {
        NewsPost::where('slug', $this->param('slug'))->increment('statistics');
    }
}
