<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Indikator\News\Classes\SubscriberService;
use Indikator\News\Models\Categories;
use Indikator\News\Models\Subscribers;
use Lang;
use App;
use Validator;
use ValidationException;
use Request;

class Subscribe extends ComponentBase
{
    use SubscriberService;

    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.subscribe',
            'description' => ''
        ];
    }

    public function onRun()
    {
        $category = Categories::where(['status' => 1, 'hidden' => 2]);
        $this->page['category_list']  = $category->get()->all();
        $this->page['category_count'] = $category->count();

        $this->page['text_messages'] = Lang::get('indikator.news::lang.messages.subscribed');
        $this->page['text_name']     = Lang::get('indikator.news::lang.form.name');
        $this->page['text_email']    = Lang::get('indikator.news::lang.form.email');
        $this->page['text_category'] = Lang::get('indikator.news::lang.form.category');
        $this->page['text_button']   = Lang::get('indikator.news::lang.button.subscribe');
    }

    public function onSubscription()
    {
        // Get data from form
        $data = post();

        // Validate input data
        $rules = [
            'name'     => 'required|between:2,64',
            'email'    => 'required|email|between:8,64',
            'category' => 'array'
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $email = post('email');
        $name  = post('name');
        $categories = post('category', []);

        // looking for existing subscriber
        $subscriberResult = Subscribers::email($email);

        if ($subscriberResult->count() > 0) {
            $subscriber = $subscriberResult->first();
            // Update the name
            $subscriber->name = $name;
        }
        else {
            // Register new one
            $subscriber = Subscribers::create([
                'name'          => $name,
                'email'         => $email,
                'common'        => '',
                'locale'        => App::getLocale(),
                'created'       => 2,
                'statistics'    => 0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
                'registered_at' => now(),
                'registered_ip' => Request::ip(),
                'status'        => 3
            ]);
        }

        $this->onSubscriberRegister($subscriber, $categories);
    }
}
