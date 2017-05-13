<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Indikator\News\Models\Subscribers;
use Validator;
use ValidationException;
use Response;
use Flash;
use October\Rain\Exception\AjaxException;

class Unsubscribe extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.unsubscribe',
            'description' => ''
        ];
    }

    public function onUnsubscribe()
    {
        $data = post();

        $subscriber = Subscribers::email($data['email'])->first();

        if($subscriber === null || !$subscriber->isActive())
        {
            return Response::make(trans('indikator.news::lang.ajax.messages.not_subscribed'), 400);
        }

        $subscriber->unsubscribe();

    }
}
