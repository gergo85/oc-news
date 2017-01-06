<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class ChangeColumnsType extends Migration
{
    public function up()
    {
        Schema::table('news_posts', function($table)
        {
            $table->integer('statistics')->change();
        });

        Schema::table('news_subscribers', function($table)
        {
            $table->integer('statistics')->change();
        });
    }

    public function down()
    {
        Schema::table('news_posts', function($table)
        {
            $table->string('statistics')->change();
        });

        Schema::table('news_subscribers', function($table)
        {
            $table->string('statistics')->change();
        });
    }
}
