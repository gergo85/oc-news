<?php namespace Indikator\News;

use System\Classes\PluginBase;
use Backend;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'indikator.news::lang.plugin.name',
            'description' => 'indikator.news::lang.plugin.description',
            'author'      => 'indikator.news::lang.plugin.author',
            'homepage'    => 'https://github.com/gergo85/oc-news'
        ];
    }

    public function registerNavigation()
    {
        return [
            'news' => [
                'label'       => 'indikator.news::lang.menu.news',
                'url'         => Backend::url('indikator/news/posts'),
                'icon'        => 'icon-newspaper-o',
                'permissions' => ['indikator.news.*'],
                'order'       => 500,

                'sideMenu' => [
                    'posts' => [
                        'label' => 'indikator.news::lang.menu.posts',
                        'url'   => Backend::url('indikator/news/posts'),
                        'icon'  => 'icon-file-text'
                    ],
                    'subscribers' => [
                        'label' => 'indikator.news::lang.menu.subscribers',
                        'url'   => Backend::url('indikator/news/subscribers'),
                        'icon'  => 'icon-user'
                    ]
                ]
            ]
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Indikator\News\ReportWidgets\Posts' => [
                'label'   => 'indikator.news::lang.menu.posts',
                'context' => 'dashboard'
            ],
            'Indikator\News\ReportWidgets\Subscribers' => [
                'label'   => 'indikator.news::lang.menu.subscribers',
                'context' => 'dashboard'
            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'indikator.news::mail.email_en' => 'E-mail',
            'indikator.news::mail.email_hu' => 'E-mail'
        ];
    }

    public function registerPermissions()
    {
        return [
            'indikator.news.posts'       => ['tab' => 'indikator.news::lang.menu.news', 'label' => 'indikator.news::lang.permission.posts'],
            'indikator.news.subscribers' => ['tab' => 'indikator.news::lang.menu.news', 'label' => 'indikator.news::lang.permission.subscribers']
       ];
    }
}
