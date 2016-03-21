<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddImageFieldToTable extends Migration
{
    public function up()
    {
        Schema::table('news_posts', function($table)
        {
            $table->timestamp('news_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('news_posts', function($table)
        {
            $table->dropColumn('news_date');
        });
    }
}



