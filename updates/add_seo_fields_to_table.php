<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddSeoFieldsToTable extends Migration
{
    public function up()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->string('seo_title', 100)->nullable();
            $table->string('seo_keywords', 100)->nullable();
            $table->string('seo_desc', 191)->nullable();
            $table->string('seo_image', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_keywords');
            $table->dropColumn('seo_desc');
            $table->dropColumn('seo_image');
        });
    }
}
