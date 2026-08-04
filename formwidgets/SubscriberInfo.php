<?php namespace Indikator\News\FormWidgets;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use Request;
use App;
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

        $locale = App::getLocale();

        if ($subscriber->registered_at == null) {
            $this->vars['registered_at'] = $subscriber->created_at
                ? $subscriber->created_at->locale($locale)->isoFormat('LLL')
                : $noData;
            $this->vars['registered_ip'] = $noData;
        }
        else {
            $this->vars['registered_at'] = $subscriber->registered_at->locale($locale)->isoFormat('LLL');
            $this->vars['registered_ip'] = $subscriber->registered_ip;
        }

        if ($subscriber->confirmed_at == null) {
            $this->vars['confirmed_at'] = $this->vars['confirmed_ip'] = $noData;
        }
        else {
            $this->vars['confirmed_at'] = $subscriber->confirmed_at->locale($locale)->isoFormat('LLL');
            $this->vars['confirmed_ip'] = $subscriber->confirmed_ip;
        }

        if ($subscriber->unsubscribed_at == null) {
            $this->vars['unsubscribed_at'] = $this->vars['unsubscribed_ip'] = $noData;
        }
        else {
            $this->vars['unsubscribed_at'] = $subscriber->unsubscribed_at->locale($locale)->isoFormat('LLL');
            $this->vars['unsubscribed_ip'] = $subscriber->unsubscribed_ip;
        }
    }

    public function getSaveValue($value)
    {
        return \Backend\Classes\FormField::NO_SAVE_DATA;
    }
}
