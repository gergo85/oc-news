<?php namespace Indikator\News\Models;

use Illuminate\Queue\Jobs\Job;
use Model;

class Logs extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $timestamps = false;

    public $rules = [];

    protected $fillable = [
        'news_id',
        'subscriber_id',
        'queued_at',
        'status',
        'job_id'
    ];

    public $table = 'indikator_news_newsletter_logs';

    public $belongsTo = [
        'news' => [
            'Indikator\News\Models\Posts',
            'key' => 'news_id'
        ],
        'subscriber' => [
            'Indikator\News\Models\Subscribers',
            'key' => 'subscriber_id'
        ],
        'job' => [
            'Illuminate\Queue\Jobs\DatabaseJob',
            'key' => 'job_id'
        ]
    ];

    public function beforeCreate()
    {
        $this->hash = md5(time().rand(1, 100000));
    }

    public function scopeIsQueued($query)
    {
        return $query->whereNull('send_at')->where('status', '!=', 'Failed');
    }

    public function scopeIsSend($query)
    {
        return $query->whereNotNull('send_at');
    }

    public function scopeIsViewed($query)
    {
        return $query->whereNotNull('viewed_at');
    }

    public function scopeIsClicked($query)
    {
        return $query->whereNotNull('clicked_at');
    }

    public function scopeIsFailed($query)
    {
        return $query->where('status', 'Failed');
    }
}
