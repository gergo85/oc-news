<?php namespace Indikator\News\Classes;

use Mail;

class SendNews
{
    /**
     * Sending news to a receiver
     */
    public function fire($job, $data)
    {

        // Process the job...
        $template = $data['template'];
        $params = $data['params'];
        $receiver = $data['receiver'];
        $subject = $data['subject'];

        Mail::send($template, $params, function($message) use ($receiver, $subject)
        {
            $message->to($receiver->email, $receiver->name)->subject($subject);
        });
        $job->delete();
    }

    public function failed()
    {
        // Called when the job is failing...
    }

}