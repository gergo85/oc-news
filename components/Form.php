<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Indikator\News\Models\Subscribers;
use Validator;
use ValidationException;

class Form extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.form',
            'description' => ''
        ];
    }

    public function onSubscription()
    {
        $data = post();

        // Validate input data
        $rules = [
            'name'  => 'required|between:2,64',
            'email' => 'required|email|between:8,64'
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        // look for unsubscribed subscribers
        $subscriberResult = Subscribers::email($data['email']);

        if ($subscriberResult->count() > 0)
        {
            $subscriber = $subscriberResult->first();
            if(!$subscriber->isActive())
            {
                $subscriber->name = $data['name'];
                $subscriber->activate();
            }

            return ;
        }

        // register new one
        Subscribers::insertGetId([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'common'     => '',
            'created'    => 2,
            'statistics' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
