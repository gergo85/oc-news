<?php namespace Indikator\News\Models;

use Model;
use BackendAuth;
use Carbon\Carbon;
use Cms\Classes\Page as CmsPage;
use Indikator\News\Models\Categories as NewsCategories;
use Db;
use App;
use Str;
use Url;

class Posts extends Model
{
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    protected $table = 'indikator_news_posts';

    public $rules = [
        'title'    => 'required',
        'slug'     => ['regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_news_posts'],
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
        'content',
        'newsletter_content'
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
        ],
        'user' => ['Backend\Models\User']
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
     * List of administrators
     */
    public function getUserOptions()
    {
        $result = [0 => 'indikator.news::lang.form.select_user'];
        $users = Db::table('backend_users')->orderBy('login', 'asc')->get()->all();

        foreach ($users as $user) {
            $name = trim($user->first_name.' '.$user->last_name);
            $name = ($name != '') ? ' ('.$name.')' : '';
            $result[$user->id] = $user->login.$name;
        }

        return $result;
    }

    /**
     * Check value of some fields
     */
    public function beforeSave()
    {
        if (!isset($this->category_id) || empty($this->category_id)) {
            $this->slug = Str::slug($this->title);
        }

        if (!isset($this->user_id) || empty($this->user_id)) {
            $this->user_id = 0;
        }

        if ($this->status == 1 && empty($this->published_at)) {
            $this->published_at = Carbon::now();
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

    // Next / Previous

    /**
     * Apply a constraint to the query to find the nearest sibling
     *
     * @param       $query
     * @param array $options
     */
    public function scopeApplySibling($query, $options = [])
    {
        if (!is_array($options)) {
            $options = ['direction' => $options];
        }

        extract(array_merge([
            'direction' => 'next',
            'attribute' => 'published_at'
        ], $options));

        $isPrevious = in_array($direction, ['previous', -1]);
        $directionOrder = $isPrevious ? 'asc' : 'desc';
        $directionOperator = $isPrevious ? '>' : '<';

        return $query
        ->where('id', '<>', $this->id)
        ->whereDate($attribute, $directionOperator, $this->$attribute)
        ->orderBy($attribute, $directionOrder)
        ;
    }

    /**
     * Returns the next post, if available.
     *
     * @return self
     */
    public function next()
    {
        return self::isPublished()->applySibling(-1)->first();
    }

    /**
     * Returns the previous post, if available.
     *
     * @return self
     */
    public function prev()
    {
        return self::isPublished()->applySibling()->first();
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
            'isTrans'  => false,
            'category' => null
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

        /*
         * Category filter
         */
        if ($category !== null) {
            $category = NewsCategories::find($category);
            $query->whereHas('category', function($q) use ($category) {
                $q->whereId($category->id);
            });
        }

        $search = trim($search);

        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

        if ($isTrans) {
            $current_locale = App::getLocale();
            $default_locale = Db::table('rainlab_translate_locales')->where('is_default', 1)->value('code');

            if ($current_locale != $default_locale) {
                $ids = Db::table('rainlab_translate_attributes')->where('model_type', 'Indikator\News\Models\Posts')->where('locale', $current_locale)->where('attribute_data', 'not like', '%"title":""%')->pluck('model_id');
                $query->whereIn('id', $ids);
            }
        }

        return $query->paginate($perPage, $page);
    }

    public function scopeIsPublished($query)
    {
        if (BackendAuth::check()) {
            $status = Settings::get('show_posts', false);

            if (!$status) {
                $status = [1, 3];
            }

            return $query->whereIn('status', $status);
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

    public function duplicate($post)
    {
        $clone = new Posts();
        $clone->title = \Lang::get('indikator.news::lang.form.clone_of').' '.$post->title;
        $clone->slug = $post->slug.'-'.now()->format('Y-m-d-h-i-s');
        $clone->status = 3;
        $clone->introductory = $post->introductory;
        $clone->content = $post->content;
        $clone->image = $post->image;
        $clone->category_id = $post->category_id;
        $clone->featured = $post->featured;
        $clone->save();

        \Event::fire('indikator.news.posts.duplicate', [&$clone, $post]);

        return $clone;
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

    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id'   => $this->id,
            'slug' => $this->slug
        ];

        if (array_key_exists('category', $this->getRelations())) {
            $params['category'] = $this->category->count() ? $this->category->first()->slug : null;
        }

        // Expose published year, month and day as URL parameters
        if ($this->published) {
            $params['year']  = $this->published_at->format('Y');
            $params['month'] = $this->published_at->format('m');
            $params['day']   = $this->published_at->format('d');
        }

        return $this->url = $controller->pageUrl($pageName, $params);
    }

    private $_category = null;

    public function getCategory()
    {
        if ($this->_category === null) {
            $category = Categories::whereId($this->category_id)->first();

            if ($category->status == 1) {
                $this->_category = [
                    'id'      => $category->id,
                    'name'    => $category->name,
                    'slug'    => $category->slug,
                    'content' => $category->content,
                    'image'   => $category->image
                ];
            }

            else {
                $this->_category = [
                    'id'      => 0,
                    'name'    => '',
                    'slug'    => '',
                    'content' => '',
                    'image'   => ''
                ];
            }
        }

        return $this->_category;
    }
}
