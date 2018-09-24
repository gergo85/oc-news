<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddingGdprFieldsForSubscribers extends Migration
{
    public function up()
    {
        Schema::table('indikator_news_subscribers', function($table)
        {
            $table->dateTime('registered_at')->nullable();
            $table->string('registered_ip')->nullable();

            $table->dateTime('confirmed_at')->nullable();
            $table->string('confirmed_ip')->nullable();
            $table->string('confirmation_hash')->nullable();

            $table->dateTime('unsubscribed_at')->nullable();
            $table->string('unsubscribed_ip')->nullable();
        });
    }

    public function down()
    {
        Schema::table('indikator_news_subscribers', function($table)
        {
            $table->dropColumn('registered_at');
            $table->dropColumn('registered_ip');

            $table->dropColumn('confirmed_at');
            $table->dropColumn('confirmed_ip');
            $table->dropColumn('confirmation_hash');

            $table->dropColumn('unsubscribed_at');
            $table->dropColumn('unsubscribed_ip');
        });
    }
}
