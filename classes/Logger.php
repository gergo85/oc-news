<?php namespace Indikator\News\Classes;

use Indikator\News\Models\Logs;
use Indikator\News\Models\Settings;
use Jenssegers\Date\Date;

class Logger
{
    static public function queued($newsletterId, $subscriberId)
    {
        return Logs::create([
            'news_id'       => $newsletterId,
            'subscriber_id' => $subscriberId,
            'queued_at'     => Date::now(),
            'status'        => 'Queued'
        ]);
    }

    static public function sending($id)
    {
        $log = Logs::findOrFail($id);
        $log->status = 'Sending';
        $log->send_at = Date::now();
        $log->save();
    }

    static public function sent($id)
    {
        $log = Logs::findOrFail($id);
        $log->status = 'Sent';
        $log->send_at = Date::now();
        $log->save();
    }

    static public function sendingFailed($id)
    {
        $log = Logs::findOrFail($id);
        $log->status = 'Failed';
        $log->send_at = null;
        $log->save();
    }

    static public function viewed($id)
    {
        if (Settings::get('email_view_tracking', false)) {
            $log = Logs::find($id);
            if ($log && !$log->viewed_at) {
                if (!$log->clicked_at) {
                    $log->status = 'Viewed';
                }
                $log->viewed_at = Date::now();
                $log->save();
            }
        }
    }

    static public function clicked($id)
    {
        if (Settings::get('click_tracking', true)) {
            $log = Logs::find($id);
            if ($log && !$log->clicked_at) {
                $log->status = 'Clicked';
                $log->clicked_at = Date::now();
                $log->save();
            }
        }
    }
}
