<?php namespace Indikator\News\Models;

use Backend\Models\ExportModel;

class PostsExport extends ExportModel
{
    public $table = 'news_posts';

    public function exportData($columns, $sessionKey = null)
    {
        return self::make()->get()->toArray();
    }
}
