<?php namespace Indikator\News\Classes;

use App;
use Illuminate\Support\Collection;
use Indikator\News\Models\Posts;
use Mail;
use File;

class NewsSender
{
    /**
     * @var Posts
     */
    protected $news;

    /**
     * @var string of the used locale
     */
    protected $locale;

    /**
     * @var string replaced content
     */
    protected $replacedContent = null;

    /**
     * @var string namespace of the template
     */
    protected $templateNamespace = 'indikator.news::mail.email';

    /**
     * @param $locale string
     * @return string path of the template file with respect to $locale
     */
    protected function templateFile($locale)
    {
        return base_path().'/plugins/indikator/news/views/mail/email_'.$locale.'.htm';
    }

    /**
     * @return string template name with current locale
     */
    protected function template()
    {
        return 'indikator.news::mail.email_'.$this->locale;
    }

    /**
     * NewsSender constructor.
     * @param $news Posts should be send.
     * @param $locale string of the locale, default App::getLocale()
     */
    public function __construct($news, $locale = null)
    {
        $this->news = $news;
        $locale = App::getLocale();

        if (File::exists($this->templateFile($locale))) {
            $this->locale = $locale;
        }
        else {
            $this->locale = config('app.fallback_locale');
        }
    }

    /**
     * Sends the news to one or multiple receivers
     * @param $receivers array or single user with attribute name and email
     * @return void
     */
    public function sendNewsletter($receivers)
    {
        if (is_array($receivers) || $receivers instanceof Collection) {
            foreach ($receivers as $receiver) {
                $this->sendNewsletter($receiver);
            }
        }
        else {
            $this->send($receivers);
        }
    }

    /**
     * Sends the news to a receiver
     * @param $receiver object of the news with name and email attribute
     * @return void
     */
    protected function send($receiver)
    {
        // Replace all relative URL src attributes to absolute URL's
        if ($this->replacedContent === null) {
            $url = url('/');
            $this->replacedContent = preg_replace( '/src="\/([^"]*)"/i', 'src="'.$url.'/$1"', $this->news->content);
        }

        $params = [
            'name'         => $receiver->name,
            'email'        => $receiver->email,
            'title'        => $this->news->title,
            'slug'         => $this->news->slug,
            'introductory' => $this->news->introductory,
            'summary'      => $this->news->introductory,
            'content'      => $this->replacedContent,
            'image'        => $this->news->image
        ];

        Mail::send($this->template(), $params, function($message) use ($receiver)
        {
            $message->to($receiver->email, $receiver->name)->subject($this->news->title);
        });
    }
}
