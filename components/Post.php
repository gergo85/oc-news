<?php namespace Indikator\News\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Indikator\News\Models\Post as NewsPost;

class Post extends ComponentBase
{
    public $post;

    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.settings.post_title',
            'description' => 'indikator.news::lang.settings.post_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'indikator.news::lang.settings.post_slug',
                'description' => 'indikator.news::lang.settings.post_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->post = $this->page['post'] = $this->loadPost();
    }

    protected function loadPost()
    {
        $slug = $this->property('slug');
        $post = NewsPost::isPublished()->where('slug', $slug)->first();

        return $post;
    }
}
