<?php namespace Indikator\News\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Exception;
use Indikator\News\Models\Subscribers as Subscriber;

class Subscribers extends ReportWidgetBase
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
                'default'           => 'indikator.news::lang.widget.subscribers',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error'
            ],
            'total' => [
                'title'   => 'indikator.news::lang.widget.show_total',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'active' => [
                'title'   => 'indikator.news::lang.widget.show_active',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'unsub' => [
                'title'   => 'indikator.news::lang.widget.show_unsub',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'pending' => [
                'title'   => 'indikator.news::lang.widget.show_pending',
                'default' => true,
                'type'    => 'checkbox'
            ]
        ];
    }

    protected function loadData()
    {
        $this->vars['active']  = Subscriber::where('status', 1)->count();
        $this->vars['unsub']   = Subscriber::where('status', 2)->count();
        $this->vars['pending'] = Subscriber::where('status', 3)->count();
        $this->vars['total']   = $this->vars['active'] + $this->vars['unsub'] + $this->vars['pending'];
    }
}
