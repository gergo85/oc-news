<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Indikator\News\Models\Categories as NewsCategory;
use Indikator\News\Models\Posts as NewsPost;
use Redirect;
use BackendAuth;

class Post extends ComponentBase
{
    public $post,
        $postPage,
        $categoryPage,
        $category;

    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.post',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'indikator.news::lang.settings.slug_title',
                'description' => 'indikator.news::lang.settings.slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'categorySlug' => [
                'title'       => 'indikator.news::lang.settings.category_slug_title',
                'description' => 'indikator.news::lang.settings.category_slug_description',
                'default'     => '{{ :category }}',
                'type'        => 'string'
            ],
            'postPage' => [
                'title'       => 'indikator.news::lang.settings.post_title',
                'description' => 'indikator.news::lang.settings.post_description',
                'type'        => 'dropdown',
                'default'     => '',
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

    public function getPostPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }
    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {

        $this->prepareVars();

        $this->category = $this->page['category'] = $this->loadCategory();

        $post = $this->loadPost();

        if (!$post) {
            return Redirect::to('404');
        }

        if (!BackendAuth::check()) {
            NewsPost::find($post->id)->increment('statistics');
        }

        $this->post = $this->page['post'] = $post;

        $post->categories->each(function($category) {
            $category->setUrl($this->categoryPage, $this->controller);
        });
    }

    protected function prepareVars()
    {
        // Page links
        $this->postPage = $this->page['postPage'] = $this->property('postPage');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
    }


    protected function loadCategory()
    {
        if (!$slug = $this->property('categorySlug')) {
            return null;
        }

        $category = new NewsCategory;
        $category = $category->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
            ? $category->transWhere('slug', $slug)
            : $category->where('slug', $slug);
        $category = $category->first();

        return $category ?: null;
    }

    protected function loadPost()
    {
        $slug = $this->property('slug');

        $post = new NewsPost;

        $post = $post->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
            ? $post->transWhere('slug', $slug)
            : $post->where('slug', $slug);

        $post = $post->isPublished()->first();

        if (!$post) {
            return $post;
        }
        $post->tags = explode(',', $post->tags);

        $meta_description = strip_tags($post->introductory);
        if (strlen($meta_description) > 252) {
            $meta_description = substr($meta_description, 0, 252).'...';
        }

        $post->setUrl($this->postPage, $this->controller);

        // General SEO Tags
        $this->page->title = $post->title;
        $this->page->meta_title = $post->title;
        $this->page->meta_description = $meta_description;
        $this->page->meta_canonical = $post->url;
        $this->page->meta_image_src = $post->image;

        // Create keyword list, from category name and tag list.
        $post_keywords = "";
        foreach ($post->categories as $category) {
            if (isset($category->name)) {
                $post_keywords .= $category->name .', ';
            }
        }
        foreach ($post->tags as $key => $tag) {
            $post_keywords .= $tag;
            if ($key != (count($post->tags) - 1)) {
                $post_keywords .= ', ';
            }
        }
        $this->page->meta_keywords = $post_keywords;

        return $post;
    }

    protected $nextPost;

    public function next($respectingGroup = true) {

        if ($this->nextPost) {
            return $this->nextPost;
        }

        if (!$this->post)
            return null;

        $post = $this->post->next($respectingGroup && $this->category ? $this->category->id : null);

        if ($post) {
            $post->setUrl(
                $this->postPage,
                $this->controller,
                $respectingGroup && $this->category ?
                    $this->category :
                    $post->categories->first());
        }

        return $post;
    }

    protected $prevPost;

    public function prev($respectingGroup = true) {

        if ($this->prevPost) {
            return $this->prevPost;
        }

        if (!$this->post)
            return null;

        $post = $this->post->prev($respectingGroup && $this->category ? $this->category->id : null);

        if ($post) {
            $post->setUrl(
                $this->postPage,
                $this->controller,
                $respectingGroup && $this->category ?
                    $this->category :
                    $post->categories->first());
        }

        return $post;
    }
}
