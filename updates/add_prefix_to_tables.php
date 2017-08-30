<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddPrefixToTables extends Migration
{
    public function up()
    {
        Schema::rename('news_posts', 'indikator_news_posts');
        Schema::rename('news_subscribers', 'indikator_news_subscribers');
    }

    public function down()
    {
        Schema::rename('indikator_news_posts', 'news_posts');
        Schema::rename('indikator_news_subscribers', 'news_subscribers');
    }
}
