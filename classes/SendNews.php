<?php namespace Indikator\News\Classes;

use Indikator\News\Models\Logs;
use Indikator\News\Models\Subscribers;
use Indikator\News\Models\Settings;
use Mail;
use Event;
use Backend;
use Log;

class SendNews
{
    /**
     * Sending news to a receiver
     * 
     * @param $job
     * @param $data
     * @return void
     */
    public function fire($job, $data)
    {
        $logEntry = Logs::findOrFail($data['log_id']);
        $jobId = $job->getJobId();

        if ($jobId) {
            $logEntry->job_id = $jobId;
            $logEntry->save();
        }

        $template = $data['template'];
        $params   = $data['params'];
        $receiver = $data['receiver'];
        $subject  = $data['subject'];

        $sendingSuccess = self::sendWithLogger($template, $params, $receiver, $subject, $logEntry);

        if ($sendingSuccess) {
            $job->delete();
        }
        else {
            $job->release();
        }
    }

    /**
     * Adds logger for click and view tracking when they are
     * enabled in the settings to the given $logEntry
     * 
     * @param $logEntry
     * @return void
     */
    protected static function addNewsletterLogger($logEntry)
    {
        // Enable tracking when one is enabled
        if (Settings::get('click_tracking', true) || Settings::get('email_view_tracking', false)) {
            // Listen to the next send message
            Event::listen('mailer.prepareSend', function ($self, $view, $message) use ($logEntry)
            {
                $swift = $message->getSwiftMessage();
                $body  = $swift->getBody();

                // Redirect links to our newsletter logging controller
                if (Settings::get('click_tracking', true)) {
                    $body = preg_replace_callback('/href="(.*?)"/i', function ($r) use ($logEntry) {
                        return 'href="'
                            .Backend::url('indikator/news/newsletter/open', [
                                'id'   => $logEntry->id,
                                'hash' => $logEntry->hash
                            ])
                            .'?url='.urlencode($r[1]).'"';
                    }, $body);
                }

                // Add a image at the end of a message
                if (Settings::get('email_view_tracking', false)) {
                    $url = Backend::url('indikator/news/newsletter/image', [
                        'id'   => $logEntry->id,
                        'hash' => $logEntry->hash.'.png'
                    ]);

                    $body .= '<img src="'.$url.'" style="display:none;width:0;height:0;">';
                }

                $swift->setBody($body);
            });
        }
    }

    /**
     * Sends an email by the given parameters and attaches loggers for it.
     *
     * @param $template
     * @param $params
     * @param $receiver
     * @param $subject
     * @param Logs $logEntry
     * @return bool result of the sending email
     */
    static function sendWithLogger($template, $params, $receiver, $subject, $logEntry = null)
    {
        if ($logEntry !== null) {
            self::addNewsletterLogger($logEntry);
        }

        $sendResult = self::send($template, $params, $receiver, $subject);

        if ($sendResult === true) {
            Subscribers::find($receiver['id'])->increment('statistics');

            if ($logEntry !== null) {
                Logger::sent($logEntry->id);
            }
        }

        if ($sendResult === false && $logEntry !== null) {
            Logger::sendingFailed($logEntry['id']);
        }

        return $sendResult;
    }

    /**
     * Sends an email by the given parameters.
     *
     * @param $template
     * @param $params
     * @param $receiver
     * @param $subject
     * @return bool result of the sending email
     */
    static function send($template, $params, $receiver, $subject)
    {
        Mail::send(new NewsletterMail($template, $params, $receiver, $subject));

        // Check for failures
        if (Mail::failures()) {
            Log::error('Newsletter sending failed for address '.Mail::failures()[0]);

            return false;
        }

        return true;
    }
}
