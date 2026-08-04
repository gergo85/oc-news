<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Indikator\News\Models\Posts as NewsPost;
use Indikator\News\Models\Categories as NewsCategory;
use Indikator\News\Classes\CmsHelper;
use Lang;
use Redirect;

class Posts extends ComponentBase
{
    public $posts,
        $noPostsMessage,
        $postPage,
        $sortOrder,
        $category,
        $searchFilter,
        $nestedCategoryPosts,
        $pageParam,
        $categoryPage;

    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.posts',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title'       => 'indikator.news::lang.settings.pagination_title',
                'description' => 'indikator.news::lang.settings.pagination_description',
                'type'        => 'string',
                'default'     => ''
            ],
            'postsPerPage' => [
                'title'             => 'indikator.news::lang.settings.per_page_title',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'indikator.news::lang.settings.per_page_validation',
                'default'           => '10'
            ],
            'noPostsMessage' => [
                'title'             => 'indikator.news::lang.settings.no_posts_title',
                'description'       => 'indikator.news::lang.settings.no_posts_description',
                'type'              => 'string',
                'default'           => Lang::get('indikator.news::lang.settings.no_posts_found'),
                'showExternalParam' => false
            ],
            'sortOrder' => [
                'title'       => 'indikator.news::lang.settings.posts_order_title',
                'description' => 'indikator.news::lang.settings.posts_order_description',
                'type'        => 'dropdown',
                'default'     => 'published_at desc',
                'options'     => [
                    'title asc'         => Lang::get('indikator.news::lang.sorting.title_asc'),
                    'title desc'        => Lang::get('indikator.news::lang.sorting.title_desc'),
                    'created_at asc'    => Lang::get('indikator.news::lang.sorting.created_at_asc'),
                    'created_at desc'   => Lang::get('indikator.news::lang.sorting.created_at_desc'),
                    'updated_at asc'    => Lang::get('indikator.news::lang.sorting.updated_at_asc'),
                    'updated_at desc'   => Lang::get('indikator.news::lang.sorting.updated_at_desc'),
                    'published_at asc'  => Lang::get('indikator.news::lang.sorting.published_at_asc'),
                    'published_at desc' => Lang::get('indikator.news::lang.sorting.published_at_desc'),
                    'statistics asc'    => Lang::get('indikator.news::lang.sorting.statistics_asc'),
                    'statistics desc'   => Lang::get('indikator.news::lang.sorting.statistics_desc')
                ]
            ],
            'postFeatured' => [
                'title'       => 'indikator.news::lang.settings.featured_title',
                'description' => 'indikator.news::lang.settings.featured_description',
                'type'        => 'dropdown',
                'default'     => 0,
                'options'     => [
                    0 => Lang::get('indikator.news::lang.settings.list_all'),
                    1 => Lang::get('indikator.news::lang.settings.list_featured'),
                    2 => Lang::get('indikator.news::lang.settings.list_notfeatured')
                ]
            ],
            'postTranslated' => [
                'title'       => 'indikator.news::lang.settings.translated_title',
                'description' => 'indikator.news::lang.settings.translated_description',
                'default'     => false,
                'type'        => 'checkbox'
            ],
            'categoryFilter' => [
                'title'       => 'indikator.news::lang.settings.category_filter_title',
                'description' => 'indikator.news::lang.settings.category_filter_description',
                'type'        => 'string',
                'default'     => ''
            ],
            'nestedCategoryPosts' => [
                'title'       => 'indikator.news::lang.settings.nested_category_posts_title',
                'description' => 'indikator.news::lang.settings.nested_category_posts_description',
                'type'        => 'checkbox',
                'default'     => false
            ],
            'postPage' => [
                'title'       => 'indikator.news::lang.settings.post_title',
                'description' => 'indikator.news::lang.settings.post_description',
                'type'        => 'dropdown',
                'default'     => 'news/post',
                'group'       => 'indikator.news::lang.settings.links'
            ],
            'categoryPage' => [
                'title'       => 'indikator.news::lang.settings.category_page_title',
                'description' => 'indikator.news::lang.settings.category_page_description',
                'type'        => 'dropdown',
                'default'     => '',
                'group'       => 'indikator.news::lang.settings.links'
            ]
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getPostPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->prepareVars();

        $this->category = $this->page['category'] = $this->loadCategory();
        $this->page['currentCategorySlug'] = $this->category ? $this->category->slug : null;
        $this->posts = $this->page['posts'] = $this->listPosts();

        $currentPage = $this->currentPage();
        if ($currentPage > ($lastPage = $this->posts->lastPage()) && $currentPage > 1) {
            return Redirect::to($this->currentPageUrl([$this->pageParam => $lastPage]));
        }
    }

    protected function prepareVars()
    {
        // If no explicit URL param is configured, use the component alias so that
        // multiple instances on the same page each get their own pagination parameter
        // (e.g. ?newsPostsPage=2) and do not interfere with each other.
        $configured = $this->paramName('pageNumber');
        $this->pageParam = $this->page['pageParam'] = $configured ?: ($this->alias . 'Page');

        $this->noPostsMessage = $this->page['noPostsMessage'] = $this->property('noPostsMessage');
        $this->searchFilter = $this->page['searchFilter'] = trim(input('search'));

        // Page links
        $this->postPage = $this->page['postPage'] = $this->property('postPage');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');

        $this->nestedCategoryPosts = $this->property('nestedCategoryPosts');
    }

    protected function listPosts()
    {
        $category = $this->category ? $this->category->id : null;

        if ($this->nestedCategoryPosts && $this->category) {
            $category = $this->category->getAllChildrenAndSelf()->pluck('id')->all();
        }

        $posts = NewsPost::with('categories')->listFrontEnd([
            'page'     => $this->currentPage(),
            'pageName' => $this->pageParam,
            'sort'     => $this->property('sortOrder'),
            'perPage'  => $this->property('postsPerPage'),
            'featured' => $this->property('postFeatured'),
            'search'   => $this->searchFilter,
            'isTrans'  => $this->property('postTranslated'),
            'category' => $category
        ]);

        $posts->each(function($post) use ($category) {

            if (is_array($category)) {
                $activeCategory = $post->categories->whereIn('id', $category)->first();
            } else {
                $activeCategory = $this->category ?? $post->categories->first();
            }

            $post->setUrl($this->postPage, $this->controller, $activeCategory);
            $post->categories->each(function($category) {
                $category->setUrl($this->categoryPage, $this->controller);
            });

            $post->tags = explode(',', $post->tags);
        });

        return $posts;
    }

    protected function currentPage()
    {
        // When an explicit URL param is configured ({{ :param }}), use the
        // property value (handles both route segments and query strings).
        // Otherwise fall back to the query string using the alias-based param name.
        return $this->paramName('pageNumber')
            ? (int) $this->property('pageNumber')
            : (int) input($this->pageParam, 1);
    }

    protected function loadCategory()
    {
        if (!$slug = $this->property('categoryFilter')) {
            return null;
        }

        $category = new NewsCategory;
        $category = $category->isClassExtendedWith(CmsHelper::getTranslateBehavior(''))
            ? $category->transWhere('slug', $slug)
            : $category->where('slug', $slug);
        $category = $category->first();

        return $category ?: null;
    }
}
