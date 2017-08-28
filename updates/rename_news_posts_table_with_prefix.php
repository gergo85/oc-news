<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class RenameNewsPostsTableWithPrefix extends Migration {

    public function up()
    {
        Schema::rename("news_posts", "indikator_news_posts");
    }

    public function down()
    {
        Schema::rename("indikator_news_posts", "news_posts");
    }
}
