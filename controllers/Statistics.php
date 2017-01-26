<?php namespace Indikator\News\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Statistics extends Controller
{
    public $requiredPermissions = ['indikator.news.statistics'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Indikator.News', 'news', 'statistics');

        $this->pageTitle = trans('indikator.news::lang.menu.statistics');
    }

    public function index()
    {
        // ...
    }
}
