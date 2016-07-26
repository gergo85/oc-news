<?php namespace Indikator\News\Updates;

use Schema;
use DbDongle;
use October\Rain\Database\Updates\Migration;

class UpdateTimestampsNullable extends Migration
{
    public function up()
    {
        DbDongle::disableStrictMode();

        DbDongle::convertTimestamps('news_posts');
        DbDongle::convertTimestamps('news_subscribers');
    }

    public function down()
    {
        // ...
    }
}
