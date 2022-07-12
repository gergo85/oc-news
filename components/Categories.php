<?php namespace Indikator\News\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Illuminate\Database\Eloquent\Collection;
use Indikator\News\Models\Categories as NewsCategories;
use Lang;

class Categories extends ComponentBase
{
    public $categories,
        $noPostsMessage,
        $categoryPage,
        $currentCategorySlug,
        $root;

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
            'slug' => [
                'title'       => 'indikator.news::lang.settings.category_slug_title',
                'description' => 'indikator.news::lang.settings.category_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
            'noCategoryMessage' => [
                'title'             => 'indikator.news::lang.settings.no_category_title',
                'description'       => 'indikator.news::lang.settings.no_category_description',
                'type'              => 'string',
                'default'           => Lang::get('indikator.news::lang.settings.no_category_found'),
                'showExternalParam' => false
            ],
            'categoryFilter' => [
                'title'       => 'indikator.news::lang.settings.category_filter_title',
                'description' => 'indikator.news::lang.settings.category_filter_description',
                'type'        => 'dropdown',
                'default'     => ''
            ],
            'onlyNestedCategories' => [
                'title'       => 'indikator.news::lang.settings.only_nested_categories_title',
                'description' => 'indikator.news::lang.settings.only_nested_categories_description',
                'type'        => 'checkbox',
                'default'     => false
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

    public function getCategoryFilterOptions()
    {
        return NewsCategories::listsNested('name', 'id');
    }

    public function onRun()
    {
        $categoryFilter = $this->property('categoryFilter');
        if ($categoryFilter) {
            $this->root = NewsCategories::find($categoryFilter);
        }

        $this->currentCategorySlug = $this->page['currentCategorySlug'] = $this->property('slug');
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->page['noCategoryMessage'] = $this->property('noCategoryMessage');
        $this->categories = $this->page['categories'] = $this->listCategories();
    }

    protected function listCategories()
    {
        if ($this->root) {
            $categories = $this->root->allChildren(true)->with('posts_count')->isActive()->getNested();
            if (count($categories) > 0 ) {
                $categories = $categories->first()->children;
            }
        }
        else
        {
            $categories = NewsCategories::with('posts_count')->isActive()->getNested();
        }

        $categories = $categories->filter(function($cat) {
            return $cat->getNestedPostCount() > 0;
        });
        return $this->linkCategories($categories);
    }

    /**
     * Sets the URL on each category according to the defined category page
     * @return Collection
     */
    protected function linkCategories($categories)
    {
        return $categories->each(function ($category) {
            $category->setUrl($this->categoryPage, $this->controller);

            if ($category->children) {
                $this->linkCategories($category->children);
            }
        });
    }
}
