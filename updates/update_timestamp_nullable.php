<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use DbDongle;

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
