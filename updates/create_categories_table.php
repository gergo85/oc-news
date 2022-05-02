<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_news_categories', function($table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->longText('content')->nullable();
            $table->string('image', 191)->nullable();
            $table->string('hidden', 1)->default(2);
            $table->string('status', 1)->default(1);
            $table->string('sort_order', 3)->default(1);
            $table->timestamps();
        });

        Schema::create('indikator_news_relations', function($table)
        {
            $table->integer('subscriber_id')->unsigned();
            $table->integer('categories_id')->unsigned();
            $table->primary(['subscriber_id', 'categories_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_news_categories');
        Schema::dropIfExists('indikator_news_relations');
    }
}
