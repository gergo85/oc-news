<?php namespace Indikator\News\Models;

use Model;

class Settings extends Model
{
    public $implement = ['@System.Behaviors.SettingsModel'];

    public $settingsCode = 'indikator_news_settings';

    public $settingsFields = 'fields.yaml';
}
