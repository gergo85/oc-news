<?php namespace indikator\news\classes;


use October\Rain\Mail\Mailable;

class ConfirmationMail extends Mailable
{

    public $receiver;

    public function __construct($receiver)
    {
        $this->receiver = $receiver;
    }

    public function build() {
        return $this->view('')
    }

}