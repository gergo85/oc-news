<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddImageFieldToTable extends Migration
{
    public function up()
    {
        Schema::table('news_posts', function($table)
        {
            $table->string('image', 200)->nullable();
        });
    }

    public function down()
    {
        Schema::table('news_posts', function($table)
        {
            $table->dropColumn('image');
        });
    }
}
