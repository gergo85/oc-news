<?php namespace Indikator\News\Classes;

use October\Rain\Mail\Mailable;
use App;
use File;

class ConfirmationMail extends Mailable
{
    public $subscriber;

    public $confirmationLink;

    const templateNamespace = 'indikator.news::mail.confirmation_';

    public function __construct($subscriber, $confirmationLink)
    {
        $this->subscriber = $subscriber;
        $this->confirmationLink = $confirmationLink;
    }

    public function build()
    {
        return $this->view(
            $this->getTemplate($this->subscriber->locale),
            [
                'subscriber'        => $this->subscriber,
                'confirmation_link' => $this->confirmationLink
            ]
        )->to($this->subscriber['email'], $this->subscriber['name']);
    }

    /**
     * Get the current template name
     *
     * @param $locale string
     * @return string template name or bool
     */
    protected function getTemplate($locale)
    {
        $langs = [$locale, App::getLocale(), 'en'];

        foreach ($langs as $lang) {
            if (File::exists(base_path().'/plugins/indikator/news/views/mail/confirmation_'.$lang.'.htm')) {
                return self::templateNamespace.$lang;
            }
        }

        return false;
    }
}
