<?php namespace Indikator\News\Models;

use Model;
use File;
use App;
use Mail;
use Cms\Classes\Page as CmsPage;
use Url;

class Posts extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $table = 'news_posts';

    public $rules = [
        'title'    => 'required',
        'slug'     => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:news_posts'],
        'status'   => 'required|between:1,3|numeric',
        'featured' => 'required|between:1,2|numeric'
    ];

    protected $slugs = [
        'slug' => 'title'
    ];

    public $translatable = [
        'title',
        ['slug', 'index' => true],
        'introductory',
        'content'
    ];

    protected $dates = [
        'published_at'
    ];

    public static $allowedSorting = [
        'title asc',
        'title desc',
        'created_at asc',
        'created_at desc',
        'updated_at asc',
        'updated_at desc',
        'published_at asc',
        'published_at desc'
    ];

    public function beforeCreate()
    {
        if ($this->statistics == '') {
            $this->statistics = 0;
        }

        if ($this->published_at == '') {
            $this->published_at = date('Y-m-d H:i:00');
        }
    }

    public function beforeSave()
    {
        if ($this->send && $this->send != '') {
            $locale = App::getLocale();

            if (!File::exists(base_path().'/plugins/indikator/news/views/mail/email_'.$locale.'.htm')) {
                $locale = 'en';
            }

            $users = Subscribers::where('status', 1)->get();

            foreach ($users as $user) {
                $params = [
                    'name'         => $user->name,
                    'email'        => $user->email,
                    'title'        => $this->title,
                    'slug'         => $this->slug,
                    'introductory' => $this->introductory,
                    'content'      => $this->content,
                    'image'        => $this->image
                ];

                $this->email = $user->email;
                $this->name = $user->name;

                Mail::send('indikator.news::mail.email_'.$locale, $params, function($message)
                {
                    $message->to($this->email, $this->name)->subject($this->title);
                });

                Subscribers::whereId($user->id)->increment('statistics');
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
            'status'  => 1,
            'featured' => 0
        ], $options));

        $searchableFields = [
            'title',
            'slug',
            'introductory',
            'content'
        ];

        if ($status) {
            $query->isPublished();
        }

        if ($featured != 0) {
            $query->isFeatured($featured);
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

                list($sortField, $sortDirection) = $parts;

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
        return $query->where('status', 1)->where('published_at', '>', time());
    }

    public function scopeIsFeatured($query, $value = 1)
    {
        return $query->where('featured', $value);
    }
    
    public static function getMenuTypeInfo($type)
    {
        if ($type == 'post-page') {
            $references = [];
            $items = self::orderBy('title')->get();

            foreach ($items as $item) {
                $references[$item->id] = $item->title;
            }

            $result = [
                'references'   => $references,
                'nesting'      => false,
                'dynamicItems' => false
            ];
        }

        else if ($type == 'post-list') {
            $result = [
                'dynamicItems' => true
            ];
        }

        if ($result) {
            $pages = CmsPage::sortBy('baseFileName')->all();
            $result['cmsPages'] = $pages;
        }

        return $result;
    }

    public static function resolveMenuItem($item, $url, $theme)
    {
        if ($item->type == 'post-page') {
            if (!$item->reference || !$item->cmsPage) {
                return;
            }

            $element = self::find($item->reference);
            if (!$element) {
                return;
            }

            $pageUrl = self::getItemUrl($item->cmsPage, $element, $theme);
            if (!$pageUrl) {
                return;
            }

            $pageUrl = Url::to($pageUrl);
            $result = [];
            $result['url'] = $pageUrl;
            $result['isActive'] = $pageUrl == $url;
            $result['mtime'] = $element->updated_at;
        }

        else if ($item->type == 'post-list') {
            $result = [
                'items' => []
            ];

            $elements = self::where('status', 1)->where('published_at', '<', date('Y-m-d H:i:s'))->orderBy('title')->get();
            foreach ($elements as $element) {
                $listItem = [
                    'title' => $element->title,
                    'url'   => Url::to(self::getItemUrl($item->cmsPage, $element, $theme)),
                    'mtime' => $element->updated_at
                ];

                $listItem['isActive'] = $listItem['url'] == $url;
                $result['items'][] = $listItem;
            }
        }

        return $result;
    }

    protected static function getItemUrl($pageCode, $item, $theme)
    {
        $page = CmsPage::loadCached($theme, $pageCode);
        if (!$page) {
            return;
        }

        $properties = $page->getComponentProperties('newsPost');
        if (!preg_match('/^\{\{([^\}]+)\}\}$/', $properties['slug'], $matches)) {
            return;
        }

        $paramName = substr(trim($matches[1]), 1);
        return CmsPage::url($page->getBaseFileName(), [$paramName => $item->slug]);
    }
}
