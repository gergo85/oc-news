<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddingCustomNewsletterContentFieldsToPosts extends Migration
{
    public function up()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->boolean('enable_newsletter_content')->default(false);
            $table->text('newsletter_content')->nullable();
        });
    }

    public function down()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->dropColumn('newsletter_content');
            $table->dropColumn('enable_newsletter_content');
        });
    }
}
