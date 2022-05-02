<?php namespace Indikator\News\Updates;

use Indikator\News\Models\Posts;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreatePostsCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('indikator_news_posts_categories', function($table)
        {
            $table->integer('post_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['post_id', 'category_id']);
        });

        $posts = (new Posts)->newQueryWithoutScopes()
            ->get();

        foreach ($posts as $post) {
            if ($post->category_id > 0) {
                $post->categories()->attach($post->category_id);
            }
        }

        Schema::table('indikator_news_posts', function ($table) {
            $table->dropColumn('category_id');
        });
    }

    public function down()
    {
        if (!Schema::hasColumn('indikator_news_posts', 'category_id')) {
            Schema::table('indikator_news_posts', function ($table) {
                $table->integer('category_id')->nullable()->after('last_send_at');
            });
        }

        $posts = (new Posts)->newQueryWithoutScopes()
            ->get();

        foreach ($posts as $post) {
            if ($cat = $post->categories->first()) {
                $post->category_id = $cat->id;
                $post->save();
            }
        }

        Schema::dropIfExists('indikator_news_posts_categories');
    }
}
