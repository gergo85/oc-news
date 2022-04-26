<?php namespace Indikator\News\Models;

use ApplicationException;
use Backend\Models\ImportModel;
use Backend\Models\User as AuthorModel;
use Exception;

class PostsImport extends ImportModel
{
    public $table = 'indikator_news_posts';

    public $rules = [
        'title' => 'required',
        'slug'  => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:indikator_news_posts']
    ];

    protected $categoryNameCache = [];


    public function getDefaultAuthorOptions()
    {
        return AuthorModel::all()->lists('full_name', 'email');
    }

    public function getCategoriesOptions()
    {
        return Categories::lists('slug', 'id');
    }

    public function importData($results, $sessionKey = null)
    {
        $firstRow = reset($results);

        if ($this->auto_create_categories && !array_key_exists('categories', $firstRow)) {
            throw new ApplicationException('Please specify a match for the Categories column.');
        }

        foreach ($results as $row => $data) {
            try {
                if (!array_get($data, 'title')) {
                    $this->logSkipped($row, 'Missing title');
                    continue;
                }

                /*
                 * Find or create
                 */
                $post = Posts::make();

                if ($this->update_existing) {
                    $post = $this->findDuplicatePost($data) ?: $post;
                }

                $postExists = $post->exists;

                /*
                 * Set attributes
                 */
                $except = ['id', 'categories'];

                foreach (array_except($data, $except) as $attribute => $value) {
                    if (in_array($attribute, $post->getDates()) && empty($value)) {
                        continue;
                    }
                    $post->{$attribute} = isset($value) ? $value : null;
                }

                $post->forceSave();

                if ($categoryIds = $this->getCategoryIdsForPost($data)) {
                    $post->categories()->sync($categoryIds, false);
                }

                /*
                * Log results
                */
                if ($postExists) {
                    $this->logUpdated();
                }
                else {
                    $this->logCreated();
                }
            }
            catch (Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    protected function findDuplicatePost($data)
    {
        if ($id = array_get($data, 'id')) {
            return Posts::find($id);
        }

        $slug = array_get($data, 'slug');
        $post = Posts::where('slug', $slug);

        return $post->first();
    }

    protected function getCategoryIdsForPost($data)
    {
        $ids = [];

        if ($this->auto_create_categories) {
            $categorySlugs = $this->decodeArrayValue(array_get($data, 'categories'));

            foreach ($categorySlugs as $slug) {
                if (!$slug = trim($slug)) {
                    continue;
                }

                if (isset($this->categoryNameCache[$slug])) {
                    $ids[] = $this->categoryNameCache[$slug];
                }
                else {
                    $newCategory = Categories::firstOrCreate(['slug' => $slug]);
                    $ids[] = $this->categoryNameCache[$slug] = $newCategory->id;
                }
            }
        }
        elseif ($this->categories) {
            $ids = (array) $this->categories;
        }

        return $ids;
    }
}
