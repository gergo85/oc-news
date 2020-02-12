<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class ChangeVarcharLength extends Migration
{
    public function up()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->string('image', 191)->change();
        });

        Schema::table('indikator_news_categories', function($table)
        {
            $table->string('image', 191)->change();
        });

        Schema::table('indikator_news_subscribers', function($table)
        {
            $table->string('registered_ip', 191)->change();
            $table->string('confirmed_ip', 191)->change();
            $table->string('confirmation_hash', 191)->change();
            $table->string('unsubscribed_ip', 191)->change();
        });

        Schema::table('indikator_news_newsletter_logs', function($table)
        {
            $table->string('status', 191)->change();
            $table->string('hash', 191)->change();
        });
    }

    public function down()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->string('image', 200)->change();
        });

        Schema::table('indikator_news_categories', function($table)
        {
            $table->string('image', 200)->change();
        });

        Schema::table('indikator_news_subscribers', function($table)
        {
            $table->string('registered_ip', 255)->change();
            $table->string('confirmed_ip', 255)->change();
            $table->string('confirmation_hash', 255)->change();
            $table->string('unsubscribed_ip', 255)->change();
        });

        Schema::table('indikator_news_newsletter_logs', function($table)
        {
            $table->string('status', 255)->change();
            $table->string('hash', 255)->change();
        });
    }
}
