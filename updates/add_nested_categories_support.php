<?php namespace Indikator\News\Updates;

use Indikator\News\Models\Categories;
use October\Rain\Database\Updates\Migration;
use Schema;

class AddNestedCategoriesSupport extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('indikator_news_categories', 'parent_id')) {
            Schema::table('indikator_news_categories', function ($table) {
                $table->integer('parent_id')->unsigned()->index()->nullable()->after('status');
                $table->integer('nest_left')->unsigned()->index()->nullable()->after('parent_id');
                $table->integer('nest_right')->unsigned()->index()->nullable()->after('nest_left');
                $table->integer('nest_depth')->unsigned()->index()->nullable()->after('nest_right');
            });
        }

        // use orderby instead of sorting trait, since it is not available anymore
        $categories = (new Categories)->newQueryWithoutScopes()
            ->orderBy('sort_order')
            ->get();

        for ($i = 0; $i < count($categories); $i++) {
            $category = $categories[$i];

            $category->parent_id = null;
            $category->nest_depth = 0;
            $category->nest_left = $i * 2 + 1;
            $category->nest_right = $i * 2 + 2;
            $category->save();
        }

        Schema::table('indikator_news_categories', function ($table) {
            $table->dropColumn('sort_order');
        });

    }

    public function down()
    {
        if (!Schema::hasColumn('indikator_news_categories', 'sort_order')) {
            Schema::table('indikator_news_categories', function ($table) {
                $table->integer('sort_order')->default(1)->index()->after('status');
            });
        }

        // keep previous order
        $categories = Categories::all();
        foreach ($categories as $index => $category) {
            $category->sort_order = $index + 1;
            $category->save();
        }

        // Drop nested columns
        Schema::table('indikator_news_categories', function ($table) {
            $table->dropColumn([
                'parent_id', 'nest_left', 'nest_right', 'nest_depth'
            ]);
        });
    }
}
