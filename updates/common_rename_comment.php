<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CommonRenameComment extends Migration
{
    public function up()
    {
        Schema::table('indikator_news_subscribers', function($table)
        {
            $table->renameColumn('common', 'comment');
        });
    }

    public function down()
    {
        // Nothing
    }
}
