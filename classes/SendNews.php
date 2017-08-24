<?php namespace Indikator\News\Classes;

use Indikator\News\Models\NewsletterLog;
use Mail;
use Event;
use Backend;
use Log;
use Indikator\News\Models\Settings;

class SendNews
{
    /**
     * Sending news to a receiver
     */
    public function fire($job, $data)
    {
        $logEntry = NewsletterLog::findOrFail($data['log_id']);
        $jobId = $job->getJobId();
        if($jobId) {
            $logEntry->job_id = $jobId;
            $logEntry->save();
        }
        $logEntryId = $logEntry->id;

        Event::listen('mailer.sending', function ($message) use ($logEntryId) {
            NewsletterLogger::sent($logEntryId);
        });

        Event::listen('mailer.prepareSend', function($self, $view, $message) use ($logEntry) {
            $swift = $message->getSwiftMessage();

            $body = $swift->getBody();

            if(Settings::get('click_tracking', true)) {
                $body = preg_replace_callback('/href="(.*?)"/i', function ($r) use ($logEntry) {
                    return 'href="'
                        . Backend::url('indikator/news/newsletter/open', [
                            'id' => $logEntry->id,
                            'hash' => $logEntry->hash
                        ])
                        . '?url=' . urlencode($r[1]) . '"';
                }, $body);
            }

            if(Settings::get('email_view_tracking', false)) {
                $url = Backend::url('indikator/news/newsletter/image', [
                    'id'   => $logEntry->id,
                    'hash' => $logEntry->hash . '.png'
                ]);

                $body.= '<img src="'. $url .'" style="display:none;width:0;height:0;" />';
            }

            $swift->setBody($body);
        });

        // Process the job...
        $template = $data['template'];
        $params = $data['params'];
        $receiver = $data['receiver'];
        $subject = $data['subject'];

        Mail::send($template, $params, function($message) use ($receiver, $subject)
        {
            $message->to($receiver->email, $receiver->name)->subject($subject);
        });

        // check for failures
        if (Mail::failures()) {
            Log::error("Newsletter sending failed for address ".Mail::failures()[0]);
            NewsletterLogger::sendingFailed($logEntryId);
            $job->release();
        } else {
            NewsletterLogger::sent($logEntryId);
            $job->delete();
        }
    }

}