<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Indikator\News\Models\Categories as NewsCategories;
use Lang;

class Categories extends ComponentBase
{
    public $categories;

    public $noPostsMessage;

    public $categoryPage;

    public function componentDetails()
    {
        return [
            'name'        => 'indikator.news::lang.component.categories',
            'description' => ''
        ];
    }

    public function defineProperties()
    {
        return [
            'noPostsMessage' => [
                'title'             => 'indikator.news::lang.settings.no_posts_title',
                'description'       => 'indikator.news::lang.settings.no_posts_description',
                'type'              => 'string',
                'default'           => Lang::get('indikator.news::lang.settings.no_posts_found'),
                'showExternalParam' => false
            ],
            'categoryPage' => [
                'title'       => 'indikator.news::lang.settings.category_page_title',
                'description' => 'indikator.news::lang.settings.category_page_description',
                'type'        => 'dropdown',
                'default'     => ''
            ]
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->page['noPostsMessage'] = $this->property('noPostsMessage');
        $this->categories = $this->page['categories'] = $this->listCategories();
    }

    protected function listCategories()
    {
        $categories = NewsCategories::all();

        $categories->each(function($category) {
            $category->setUrl($this->categoryPage, $this->controller);
        });

        return $categories;
    }
}
