<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddNewFieldsToTable extends Migration
{
    public function up()
    {
        Schema::table('news_posts', function($table)
        {
            $table->string('featured', 1)->default(2);
        });

        Schema::table('news_subscribers', function($table)
        {
            $table->string('status', 1)->default(1);
        });
    }

    public function down()
    {
        Schema::table('news_posts', function($table)
        {
            $table->dropColumn('featured');
        });

        Schema::table('news_subscribers', function($table)
        {
            $table->dropColumn('status');
        });
    }
}
