<?php namespace Indikator\News\Models;

use Backend\Models\ExportModel;

class PostsExport extends ExportModel
{
    public $table = 'indikator_news_posts';

    public $belongsToMany = [
        'post_categories' => [
            'Indikator\News\Models\Categories',
            'table' => 'indikator_news_posts_categories',
            'key'      => 'post_id',
            'otherKey' => 'category_id',
            'order' => 'name'
        ],
    ];

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = [
        'categories',
    ];

    public function exportData($columns, $sessionKey = null)
    {
        $result = self::make()
            ->with([
                'post_categories'
            ])
            ->get()
            ->toArray()
        ;

        return $result;
    }

    public function getCategoriesAttribute()
    {
        if (!$this->post_categories) {
            return '';
        }

        return $this->encodeArrayValue($this->post_categories->lists('slug'));
    }
}
