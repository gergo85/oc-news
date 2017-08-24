<?php namespace Indikator\News\Classes;


use Indikator\News\Models\NewsletterLog;
use Jenssegers\Date\Date;

class NewsletterLogger
{

    static public function queued($newsletterId, $subscriberId) {

        return NewsletterLog::create([
            'news_id' => $newsletterId,
            'subscriber_id' => $subscriberId,
            'queued_at' => Date::now(),
            'status' => 'Queued'
        ]);
    }

    static public function sending($id) {

        $log = NewsletterLog::findOrFail($id);
        $log->status = "Sending";
        $log->send_at = Date::now();
        $log->save();
    }

    static public function sent($id) {
        $log = NewsletterLog::findOrFail($id);
        $log->status = "Sent";
        $log->send_at = Date::now();
        $log->save();
    }

    static public function sendingFailed($id) {
        $log = NewsletterLog::findOrFail($id);
        $log->status = "Sending Failed";
        $log->send_at = null;
        $log->save();
    }

    static public function viewed($id) {
        $log = NewsletterLog::find($id);
        if($log && !$log->viewed_at) {
            if(!$log->clicked_at) {
                $log->status = "Viewed";
            }
            $log->viewed_at = Date::now();
            $log->save();
        }
    }

    static public function clicked($id) {
        $log = NewsletterLog::find($id);
        if($log && !$log->clicked_at) {
            $log->status = "Clicked";
            $log->clicked_at = Date::now();
            $log->save();
        }
    }


}