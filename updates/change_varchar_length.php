<?php namespace Indikator\News\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;
use Db;

class ChangeVarcharLength extends Migration
{
    public function up()
    {
        $this->resize(191, 191);
    }

    public function down()
    {
        $this->resize(200, 255);
    }

    /**
     * Resize the affected VARCHAR columns.
     *
     * These lengths only matter on MySQL/MariaDB (the 191 limit keeps utf8mb4
     * indexes under the 767 byte prefix limit). Raw MODIFY statements are used
     * on purpose: Doctrine DBAL's ->change() misreads a nullable column's NULL
     * default as the string 'NULL' on MariaDB and emits invalid
     * "DEFAULT ''NULL''" SQL, which aborts the whole plugin update.
     *
     * @param int $imageLength length for the image columns
     * @param int $textLength   length for the subscriber/log string columns
     */
    protected function resize($imageLength, $textLength)
    {
        $driver = Db::connection()->getDriverName();

        if (!in_array($driver, ['mysql', 'mariadb'])) {
            return;
        }

        $this->modify('indikator_news_posts', 'image', $imageLength, true);
        $this->modify('indikator_news_categories', 'image', $imageLength, true);

        $this->modify('indikator_news_subscribers', 'registered_ip', $textLength, true);
        $this->modify('indikator_news_subscribers', 'confirmed_ip', $textLength, true);
        $this->modify('indikator_news_subscribers', 'confirmation_hash', $textLength, true);
        $this->modify('indikator_news_subscribers', 'unsubscribed_ip', $textLength, true);

        $this->modify('indikator_news_newsletter_logs', 'status', $textLength, false);
        $this->modify('indikator_news_newsletter_logs', 'hash', $textLength, true);
    }

    /**
     * Change a column to VARCHAR($length) while preserving its nullability.
     *
     * @param string $table
     * @param string $column
     * @param int    $length
     * @param bool   $nullable
     */
    protected function modify($table, $column, $length, $nullable)
    {
        if (!Schema::hasColumn($table, $column)) {
            return;
        }

        $null = $nullable ? 'NULL DEFAULT NULL' : 'NOT NULL';

        Db::statement("ALTER TABLE `{$table}` MODIFY `{$column}` VARCHAR({$length}) {$null}");
    }
}
