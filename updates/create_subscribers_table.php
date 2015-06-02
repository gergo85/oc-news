<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('news_subscribers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->text('common');
            $table->string('created', 1)->default(1);
            $table->string('statistics', 4)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_subscribers');
    }
}
