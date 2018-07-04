<?php namespace indikator\news\classes;

use Hash;
use Backend;
use Mail;


class ConfirmationHandler
{

    public static function generateNewTokenForSubscriber($subscriber)
    {
        $subscriber->confirmation_hash = str_random("255");
        $subscriber->save();
    }

    public static function sendConfirmationEmailToSubscriber($subscriber)
    {

        self::generateNewTokenForSubscriber($subscriber);

        $confirmationLink = Backend::url('indikator/news/subscribers/confirm', [
            'id'   => $subscriber->id,
            'hash' => $subscriber->confirmation_hash
        ]);

        Mail::send(new ConfirmationMail($subscriber, $confirmationLink));
    }

}