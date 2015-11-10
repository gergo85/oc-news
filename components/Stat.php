<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use DB;

class Stat extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'indikator.news::lang.component.stat'
        ];
    }

    public function onRun()
    {
        $stat = DB::table('news_posts')->where('slug', $this->param('slug'))->pluck('statistics');
        DB::table('news_posts')->where('slug', $this->param('slug'))->update(array('statistics' => ++$stat));
    }
}
