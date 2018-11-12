<?php namespace Indikator\News\Classes;

use October\Rain\Mail\Mailable;

class NewsletterMail extends Mailable
{
    public $template, $params, $receiver;

    public function __construct($template, $params, $receiver, $subject)
    {
        $this->template = $template;
        $this->params   = $params;
        $this->receiver = $receiver;
        $this->subject  = $subject;
    }

    public function build()
    {
        return $this->view($this->template, $this->params)->to($this->receiver['email'], $this->receiver['name']);
    }
}
