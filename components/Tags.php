<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Indikator\News\Models\Posts;
use Lang;

class Tags extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.tags',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'indikator.news::lang.settings.tags_slug_title',
                'description' => 'indikator.news::lang.settings.tags_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
            'noTagsMessage' => [
                'title'             => 'indikator.news::lang.settings.no_tags_title',
                'description'       => 'indikator.news::lang.settings.no_tags_description',
                'type'              => 'string',
                'default'           => Lang::get('indikator.news::lang.settings.no_tags_found'),
                'showExternalParam' => false
            ],
            'tagPage' => [
                'title'       => 'indikator.news::lang.settings.tags_page_title',
                'description' => 'indikator.news::lang.settings.tags_page_description',
                'type'        => 'dropdown',
                'default'     => ''
            ]
        ];
    }

    public function getTagPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $tags = [];
        $news = Posts::where('status', 1)->where('published_at', '<=', date('Y-m-d H:i:00'))->get()->all();

        foreach ($news as $post) {
	    if ($post['tags'] !== null) {
            	$post['tags'] = explode(',', $post['tags']);
            	foreach ($post['tags'] as $tag) {
                    if (! in_array($tag, $tags)) {
                        $tags[] = $tag;
                    }
            	}
	    }
        }

        usort($tags, function($item1, $item2) {
            return $item1 <=> $item2;
        });

        $this->page['tags'] = $tags;
        $this->page['noTagsMessage'] = $this->property('noTagsMessage');
        $this->page['tagPage'] = $this->property('tagPage');
    }
}
