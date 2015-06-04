<?php namespace Indikator\News\Models;

use Model;
use File;
use Str;
use Backend\Models\UserPreferences;
use DB;
use Mail;

class Posts extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $table = 'news_posts';

    public $rules = [
        'title' => 'required|between:1,100',
        'slug' => ['regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i'],
        'text' => 'required',
        'status' => 'between:1,2|numeric'
    ];

    public $attachOne = [
        'image' => ['System\Models\File']
    ];

    public function beforeCreate()
    {
        $this->slug = Str::slug($this->slug);
        $this->statistics = 0;
    }

    public function beforeUpdate()
    {
        unset($this->statistics);
    }

    public function beforeSave()
    {
        if ($this->send && $this->send != '')
        {
            $preferences = UserPreferences::forUser()->get('backend::backend.preferences');
            if (!File::exists('plugins/indikator/news/views/mail/email_'.$preferences['locale'].'.htm')) $preferences['locale'] = 'en';

            $users = DB::table('news_subscribers')->get();

            foreach ($users as $user)
            {
                $params = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'subject' => $this->title,
                    'post' => $this->text
                ];

                $this->email = $user->email;
                $this->name = $user->name;

                Mail::send('indikator.news::mail.email_'.$preferences['locale'], $params, function($message)
                {
                    $message->to($this->email, $this->name)->subject($this->title);
                });

                DB::table('news_subscribers')->where('id', $user->id)->update(array('statistics' => $user->statistics++));
            }
        }

        if ($this->status) $this->status = 1;
        else $this->status = 2;

        if ($this->send) $this->send = 1;
        else $this->send = 2;
    }
}
