<?php namespace Indikator\News\Models;

use Model;

class Subscribers extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'indikator_news_subscribers';

    public $rules = [
        'email'  => 'required|email',
        'status' => 'required|between:1,3|numeric'
    ];

    protected $dates = [
        'registered_at',
        'confirmed_at',
        'unsubscribed_at',
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'confirmed_at',
        'confirmed_ip',
        'unsubscribed_at',
        'unsubscribed_ip',
        'confirmation_hash'
    ];

    public $belongsToMany = [
        'categories' => [
            'Indikator\News\Models\Categories',
            'table' => 'indikator_news_relations',
            'key'   => 'subscriber_id',
            'order' => 'name'
        ]
    ];

    public $hasMany = [
        'logs' => [
            'Indikator\News\Models\Logs',
            'key' => 'subscriber_id'
        ],
        'logs_queued_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'subscriber_id',
            'scope' => 'isQueued',
            'count' => true
        ],
        'logs_send_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'subscriber_id',
            'scope' => 'isSend',
            'count' => true
        ],
        'logs_viewed_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'subscriber_id',
            'scope' => 'isViewed',
            'count' => true
        ],
        'logs_clicked_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'subscriber_id',
            'scope' => 'isClicked',
            'count' => true
        ],
        'logs_failed_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'subscriber_id',
            'scope' => 'isFailed',
            'count' => true
        ]
    ];

    public function beforeCreate()
    {
        $this->created = 1;
        $this->statistics = 0;
    }

    public function beforeUpdate()
    {
        unset($this->created, $this->statistics);
    }

    public function isActive()
    {
        return $this->status == 1;
    }

    public function isUnsubscribed()
    {
        return $this->status == 2;
    }

    public function isRegistered()
    {
        return $this->status == 3;
    }

    public function activate()
    {
        $this->status = 1;
        $this->confirmation_hash = null;
        $this->save();
    }

    public function unsubscribe()
    {
        $this->status = 2;
        $this->save();
    }

    public function register()
    {
        $this->status = 3;
        $this->save();
    }

    public function scopeFilterCategories($query, $categories)
    {
        return $query->whereHas('categories', function($q) use ($categories) {
            $q->whereIn('id', $categories);
        });
    }

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeIsSubscribed($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsUnsubscribed($query)
    {
        return $query->where('status', 2);
    }
}
