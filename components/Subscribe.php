<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Indikator\News\Models\Categories;
use Indikator\News\Models\Subscribers;
use Lang;
use Db;
use App;
use Validator;
use ValidationException;

class Subscribe extends ComponentBase
{
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
            'name'  => 'required|between:2,64',
            'email' => 'required|email|between:8,64'
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        // look for unsubscribed subscribers
        $subscriberResult = Subscribers::email($data['email']);

        if ($subscriberResult->count() > 0) {
            $subscriber = $subscriberResult->first();

            if (!$subscriber->isActive()) {
                $subscriber->name = $data['name'];
                $subscriber->activate();
            }

            // Check category
            if (!isset($data['category']) || !is_array($data['category'])) {
                return;
            }

            // Register category
            foreach ($data['category'] as $category) {
                if (is_numeric($category) && Categories::where(['id' => $category, 'hidden' => 2])->count() == 1 && Db::table('indikator_news_relations')->where(['subscriber_id' => $subscriber->id, 'categories_id' => $data['category']])->count() == 0) {
                    Db::table('indikator_news_relations')->insertGetId([
                        'subscriber_id' => $subscriber->id,
                        'categories_id' => $category
                    ]);
                }
            }

            return;
        }

        // Register new one
        $id = Subscribers::insertGetId([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'common'     => '',
            'locale'     => App::getLocale(),
            'created'    => 2,
            'statistics' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Check category
        if (!isset($data['category']) || !is_array($data['category'])) {
            return;
        }

        // Register category
        foreach ($data['category'] as $category) {
            if (is_numeric($category) && Categories::where(['id' => $category, 'hidden' => 2])->count() == 1) {
                Db::table('indikator_news_relations')->insertGetId([
                    'subscriber_id' => $id,
                    'categories_id' => $category
                ]);
            }
        }
    }
}
