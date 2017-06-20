<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddLocaleFieldToTable extends Migration
{
    public function up()
    {
        Schema::table('news_subscribers', function($table)
        {
            $table->string('locale', 5)->nullable();
        });
    }

    public function down()
    {
        Schema::table('news_subscribers', function($table)
        {
            $table->dropColumn('locale');
        });
    }
}
