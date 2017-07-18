<?php namespace Indikator\News\Classes;

use App;
use File;
use Mail;
use System\Classes\PluginManager;
use Illuminate\Support\Collection;
use Indikator\News\Models\Posts;

class NewsSender
{
    /**
     * @var Post
     */
    protected $news;

    /**
     * @var string of the used locale
     */
    protected $locale = false;

    /**
     * @var string replaced content
     */
    protected $replacedContent = null;

    /**
     * @var string namespace of the template
     */
    protected $templateNamespace = 'indikator.news::mail.email_';

    /**
     * NewsSender constructor
     *
     * @param $news Posts should be send.
     */
    public function __construct($news)
    {
        $this->news = $news;

        $pluginManager = PluginManager::instance()->findByIdentifier('RainLab.Translate');
        if ($pluginManager && !$pluginManager->disabled) {
            $this->locale = true;
        }
    }

    /**
     * Get the current template name
     *
     * @param $locale string
     * @return string template name or bool
     */
    protected function template($locale)
    {
        $langs = [$locale, App::getLocale(), 'en'];

        foreach ($langs as $lang) {
            if (File::exists(base_path().'/plugins/indikator/news/views/mail/email_'.$lang.'.htm')) {
                return $this->templateNamespace.$lang;
            }
        }

        return false;
    }

    /**
     * Sends the news to one or multiple receivers
     *
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
     *
     * @param $receiver object of the news with name and email attribute
     * @return void
     */
    protected function send($receiver)
    {
        // Locale
        if ($receiver->locale != '' && $this->locale) {
            $content = $this->news->lang($receiver->locale)->content;
        }
        else {
            $content = $this->news->content;
        }

        // Replace
        if ($this->replacedContent === null) {
            // Replace all relative URL of images to absolute URL's
            $url = url('/');
            $this->replacedContent = preg_replace( '/src="\/([^"]*)"/i', 'src="'.$url.'/$1"', $this->news->content);

            // Bugfix while displaying images in Microsoft Outlook
            // height/width must be set as img attribute and not as style
            $this->replacedContent = preg_replace('/<img (.+)?style="width: (.+)px; height: (.+)px;"/i', '<img $1 width="$2" height="$3"', $this->replacedContent);
        }

        // Parameters
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

        // Template file
        $template = $this->template($receiver->locale);
        if (!$template) {
            return;
        }

        // Send email
        Mail::send($template, $params, function($message) use ($receiver)
        {
            $message->to($receiver->email, $receiver->name)->subject($this->news->title);
        });
    }
}
