<?php namespace Indikator\News\Models;

use Lang;
use Model;
use ValidationException;
use Backend\Models\User;

class Post extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'news_posts';

    public $rules = [
        'title'   => 'required|between:1,100',
        'slug'    => ['between:1,100', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i'],
        'content' => 'required',
        'status'  => 'required|between:1,3|numeric'
    ];

    protected $dates = ['published_at'];

    public static $allowedSortingOptions = [
        'title asc'  => 'Title (ascending)',
        'title desc' => 'Title (descending)',
        'created_at asc'  => 'Created (ascending)',
        'created_at desc' => 'Created (descending)',
        'updated_at asc'  => 'Updated (ascending)',
        'updated_at desc' => 'Updated (descending)',
        'published_at asc'  => 'Published (ascending)',
        'published_at desc' => 'Published (descending)'
    ];

    public $preview = null;

    public function scopeListFrontEnd($query, $options)
    {
        extract(array_merge([
            'page'    => 1,
            'perPage' => 10,
            'sort'    => 'created_at',
            'search'  => '',
            'status'  => 1
        ], $options));

        $searchableFields = ['title', 'slug', 'introductory', 'content'];

        if ($status) {
            $query->isPublished();
        }

        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {
            if (in_array($_sort, array_keys(self::$allowedSortingOptions))) {
                $parts = explode(' ', $_sort);

                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }

                list ($sortField, $sortDirection) = $parts;

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
        return $query->where('status', 1);
    }
}
