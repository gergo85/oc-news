<?php namespace Indikator\News\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Exception;
use DB;

class Posts extends ReportWidgetBase
{
    public function render()
    {
        try {
            $this->loadData();
        }
        catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'indikator.news::lang.menu.news',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error'
            ],
            'total' => [
                'title'             => 'indikator.news::lang.widgets.show_total',
                'default'           => true,
                'type'              => 'checkbox'
            ],
            'active' => [
                'title'             => 'indikator.news::lang.widgets.show_active',
                'default'           => true,
                'type'              => 'checkbox'
            ],
            'inactive' => [
                'title'             => 'indikator.news::lang.widgets.show_inactive',
                'default'           => true,
                'type'              => 'checkbox'
            ],
            'draft' => [
                'title'             => 'indikator.news::lang.widgets.show_draft',
                'default'           => true,
                'type'              => 'checkbox'
            ]
        ];
    }

    protected function loadData()
    {
        $this->vars['active'] = DB::table('news_posts')->where('status', 1)->count();
        $this->vars['inactive'] = DB::table('news_posts')->where('status', 2)->count();
        $this->vars['draft'] = DB::table('news_posts')->where('status', 3)->count();
        $this->vars['total'] = $this->vars['active'] + $this->vars['inactive'] + $this->vars['draft'];
    }
}
