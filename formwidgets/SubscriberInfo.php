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
        $uri = explode('/', Request::path());
        $subscriber = Subscribers::whereId(end($uri))->first();

        if ($subscriber->registered_at == null) {
            $this->vars['registered_at'] = $subscriber->created_at;
            $this->vars['registered_ip'] = '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';
        }
        else {
            $this->vars['registered_at'] = '<strong>'.substr($subscriber->registered_at, 0, -3).'</strong>';
            $this->vars['registered_ip'] = '<strong>'.$subscriber->registered_ip.'</strong>';
        }

        if ($subscriber->confirmed_at == null) {
            $this->vars['confirmed_at'] = $this->vars['confirmed_ip'] = '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';
        }
        else {
            $this->vars['confirmed_at'] = '<strong>'.substr($subscriber->confirmed_at, 0, -3).'</strong>';
            $this->vars['confirmed_ip'] = '<strong>'.$subscriber->confirmed_ip.'</strong>';
        }

        if ($subscriber->unsubscribed_at == null) {
            $this->vars['unsubscribed_at'] = $this->vars['unsubscribed_ip'] = '<em>'.e(trans('indikator.news::lang.form.no_data')).'</em>';
        }
        else {
            $this->vars['unsubscribed_at'] = '<strong>'.substr($subscriber->unsubscribed_at, 0, -3).'</strong>';
            $this->vars['unsubscribed_ip'] = '<strong>'.$subscriber->unsubscribed_ip.'</strong>';
        }
    }

    public function getSaveValue($value)
    {
        return \Backend\Classes\FormField::NO_SAVE_DATA;
    }
}
