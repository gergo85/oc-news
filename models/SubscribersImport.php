<?php namespace Indikator\News\Models;

use Backend\Models\ImportModel;
use Indikator\News\Models\Subscribers as Item;
use Indikator\News\Models\Categories;
use Exception;

class SubscribersImport extends ImportModel
{
    public $table = 'indikator_news_subscribers';

    public $rules = [
        'email' => 'required|email'
    ];



    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data) {
            try {
                if (!array_get($data, 'email')) {
                    $this->logSkipped($row, 'Missing email');
                    continue;
                }

                $item = $this->findDuplicateItem($data) ?: Item::make();
                $itemExists = $item->exists;

                $except = ['id', 'categories'];
                foreach (array_except($data, $except) as $attribute => $value) {
                    $item->{$attribute} = $value ?: null;
                }

                $item->forceSave();

                if ($categoryIds = $this->resolveCategories(array_get($data, 'categories', ''))) {
                    $item->categories()->syncWithoutDetaching($categoryIds);
                }

                if ($itemExists) {
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

    protected function resolveCategories($value)
    {
        if (!$value) {
            return [];
        }

        $ids = [];
        foreach (explode(',', $value) as $token) {
            $token = trim($token);
            if (!$token) {
                continue;
            }

            if (is_numeric($token)) {
                $ids[] = (int) $token;
            } else {
                $category = Categories::where('slug', $token)->first();
                if ($category) {
                    $ids[] = $category->id;
                }
            }
        }

        return $ids;
    }

    protected function findDuplicateItem($data)
    {
        if ($id = array_get($data, 'id')) {
            return Item::find($id);
        }

        $email = array_get($data, 'email');
        $item = Item::where('email', $email);

        return $item->first();
    }
}
