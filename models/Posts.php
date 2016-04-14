<?php namespace Indikator\News\Models;

use Model;
use File;
use App;
use DB;
use Mail;

class Posts extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $table = 'news_posts';

    public $rules = [
        'title'   => 'required|between:1,100',
        'slug'    => ['between:1,100', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:news_posts'],
        'content' => 'required',
        'status'  => 'required|between:1,3|numeric'
    ];

    protected $slugs = ['slug' => 'title'];

    public $translatable = ['title', 'introductory', 'content'];

    protected $dates = ['published_at'];

    public static $allowedSorting = ['title asc', 'title desc', 'created_at asc', 'created_at desc', 'updated_at asc', 'updated_at desc', 'published_at asc', 'published_at desc'];

    public function beforeCreate()
    {
        $this->statistics = 0;

        if ($this->published_at == '') {
            $this->published_at = date('Y-m-d H:i:00');
        }
    }

    public function beforeUpdate()
    {
        unset($this->statistics);
    }

    public function beforeSave()
    {
        if ($this->send && $this->send != '') {
            $locale = App::getLocale();

            if (!File::exists('plugins/indikator/news/views/mail/email_'.$locale.'.htm')) {
                $locale = 'en';
            }

            $users = DB::table('news_subscribers')->get();

            foreach ($users as $user) {
                $params = [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'title' => $this->title,
                    'slug'  => $this->slug,
                    'introductory' => $this->introductory,
                    'content' => $this->content,
                    'image'   => $this->image
                ];

                $this->email = $user->email;
                $this->name = $user->name;

                Mail::send('indikator.news::mail.email_'.$locale, $params, function($message) {
                    $message->to($this->email, $this->name)->subject($this->title);
                });

                DB::table('news_subscribers')->where('id', $user->id)->update(['statistics' => ($user->statistics + 1)]);
            }

            unset($this->email, $this->name);
        }

        if ($this->send) {
            $this->send = 1;
        }
        else {
            $this->send = 2;
        }
    }

    public $preview = null;

    public function scopeListFrontEnd($query, $options)
    {
        extract(array_merge([
            'page'    => 1,
            'perPage' => 10,
            'sort'    => 'created_at',
            'search'  => '',
            'status'  => 1
        ], $options));

        $searchableFields = ['title', 'slug', 'introductory', 'content'];

        if ($status) {
            $query->isPublished();
        }

        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {
            if (in_array($_sort, array_keys(self::$allowedSorting))) {
                $parts = explode(' ', $_sort);

                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }

                list ($sortField, $sortDirection) = $parts;

                $query->orderBy($sortField, $sortDirection);
            }
        }

        $search = trim($search);

        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

        return $query->paginate($perPage, $page);
    }

    public function scopeIsPublished($query)
    {
        return $query->where('status', 1);
    }
}
