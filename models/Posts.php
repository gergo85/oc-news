<?php namespace Indikator\News\Models;

use Model;
use BackendAuth;
use Carbon\Carbon;
use Cms\Classes\Page as CmsPage;
use Url;
use App;
use Db;

class Posts extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $table = 'indikator_news_posts';

    public $rules = [
        'title'    => 'required',
        'slug'     => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_news_posts'],
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
        'published_at',
        'last_send_at'
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

    public $belongsTo = [
        'category' => [
            'Indikator\News\Models\Categories',
            'order' => 'name'
        ]
    ];

    public $hasMany = [
        'logs' => [
            'Indikator\News\Models\Logs',
            'key' => 'news_id'
        ],
        'logs_queued_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'news_id',
            'scope' => 'isQueued',
            'count' => true
        ],
        'logs_send_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'news_id',
            'scope' => 'isSend',
            'count' => true
        ],
        'logs_viewed_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'news_id',
            'scope' => 'isViewed',
            'count' => true
        ],
        'logs_clicked_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'news_id',
            'scope' => 'isClicked',
            'count' => true
        ],
        'logs_failed_count' => [
            'Indikator\News\Models\Logs',
            'key'   => 'news_id',
            'scope' => 'isFailed',
            'count' => true
        ]
    ];

    public $preview = null;

    public function getSendAttribute() {
        return $this->last_send_at != null;
    }

    /**
     * Check the ID of category
     */
    public function beforeSave()
    {
        if (!isset($this->category_id) || empty($this->category_id)) {
            $this->category_id = 0;
        }
    }

    /**
     * Keep the original send and last_send_at attribute because they are read only
     */
    public function beforeUpdate()
    {
        if (($lastSend = $this->getOriginal('last_send_at')) != null) {
            $this->last_send_at = $lastSend;
        }
    }

    public function scopeListFrontEnd($query, $options)
    {
        extract(array_merge([
            'page'     => 1,
            'perPage'  => 10,
            'sort'     => 'created_at',
            'search'   => '',
            'status'   => 1,
            'featured' => 0,
            'isTrans'  => false
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

        if ($isTrans) {
            $current_locale = App::getLocale();
            $default_locale = Db::table('rainlab_translate_locales')->where('is_default', 1)->value('code');

            if ($current_locale != $default_locale) {
                $ids = Db::table('rainlab_translate_attributes')->where('model_type', 'Indikator\News\Models\Posts')->where('locale', $current_locale)->where('attribute_data', 'not like', '%"title":""%')->pluck('model_id')->toArray();
                $query->whereIn('id', $ids);
            }
        }

        return $query->paginate($perPage, $page);
    }

    public function scopeIsPublished($query)
    {
        if (BackendAuth::check()) {
            return $query;
        }

        return $query
            ->where('status', 1)
            ->whereNotNull('published_at')
            ->where('published_at', '<', Carbon::now())
        ;
    }

    public function scopeIsFeatured($query, $value = 1)
    {
        return $query->where('featured', $value);
    }

    public static function getMenuTypeInfo($type)
    {
        if ($type == 'post-page') {
            $references = [];
            $items = self::orderBy('title')->get()->all();

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

            $elements = self::where('status', 1)->where('published_at', '<', date('Y-m-d H:i:s'))->orderBy('title')->get()->all();
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
