<?php namespace Indikator\News\FormWidgets;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use Request;
use Indikator\News\Models\Subscribers;

class SubscriberInfo extends FormWidgetBase
{
    protected $defaultAlias = 'subscriberinfo';

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('subscriberinfo');
    }

    protected function prepareVars()
    {
        $uriList    = explode('/', Request::path());
        $subscriber = Subscribers::whereId(end($uriList))->first();
        $noData     = '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';

        if ($subscriber->registered_at == null) {
            $this->vars['registered_at'] = substr($subscriber->created_at, 0, -3);
            $this->vars['registered_ip'] = $noData;
        }
        else {
            $this->vars['registered_at'] = substr($subscriber->registered_at, 0, -3);
            $this->vars['registered_ip'] = $subscriber->registered_ip;
        }

        if ($subscriber->confirmed_at == null) {
            $this->vars['confirmed_at'] = $this->vars['confirmed_ip'] = $noData;
        }
        else {
            $this->vars['confirmed_at'] = substr($subscriber->confirmed_at, 0, -3);
            $this->vars['confirmed_ip'] = $subscriber->confirmed_ip;
        }

        if ($subscriber->unsubscribed_at == null) {
            $this->vars['unsubscribed_at'] = $this->vars['unsubscribed_ip'] = $noData;
        }
        else {
            $this->vars['unsubscribed_at'] = substr($subscriber->unsubscribed_at, 0, -3);
            $this->vars['unsubscribed_ip'] = $subscriber->unsubscribed_ip;
        }
    }

    public function getSaveValue($value)
    {
        return \Backend\Classes\FormField::NO_SAVE_DATA;
    }
}
