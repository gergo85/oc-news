<?php namespace Indikator\News\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateIndikatorNewsPostsLastSendAtAndSend extends Migration
{
    public function up()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->dateTime('last_send_at')->nullable();
            $table->boolean('send')->default(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('indikator_news_posts', function($table)
        {
            $table->dropColumn('last_send_at');
            $table->string('send', 1)->default('1')->change();
        });
    }
}
