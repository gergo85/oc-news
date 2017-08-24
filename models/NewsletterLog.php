<?php namespace Indikator\News\Models;

use Illuminate\Queue\Jobs\Job;
use Model;

/**
 * Model
 */
class NewsletterLog extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /*
     * Validation
     */
    public $rules = [
    ];

    protected $fillable = ['news_id', 'subscriber_id', 'queued_at', 'status', 'job_id'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'indikator_news_newsletter_logs';

    public $belongsTo = [
        'news' => ['Indikator\News\Models\Posts', 'key' => 'news_id'],
        'subscriber' => ['Indikator\News\Models\Subscribers', 'key' => 'subscriber_id'],
        'job' => ['Illuminate\Queue\Jobs\DatabaseJob', 'key' => 'job_id']
    ];

    public function beforeCreate()
    {
        $this->hash = md5(time().rand(1, 100000));
    }


}