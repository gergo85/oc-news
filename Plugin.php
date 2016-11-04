<?php namespace Indikator\News;

use System\Classes\PluginBase;
use Backend;
use Event;
use Indikator\News\Models\Posts;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'indikator.news::lang.plugin.name',
            'description' => 'indikator.news::lang.plugin.description',
            'author'      => 'indikator.news::lang.plugin.author',
            'icon'        => 'icon-newspaper-o',
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
                        'label'       => 'indikator.news::lang.menu.posts',
                        'url'         => Backend::url('indikator/news/posts'),
                        'icon'        => 'icon-file-text',
                        'permissions' => ['indikator.news.posts']
                    ],
                    'subscribers' => [
                        'label'       => 'indikator.news::lang.menu.subscribers',
                        'url'         => Backend::url('indikator/news/subscribers'),
                        'icon'        => 'icon-user',
                        'permissions' => ['indikator.news.subscribers']
                    ],
                    'statistics' => [
                        'label'       => 'indikator.news::lang.menu.statistics',
                        'url'         => Backend::url('indikator/news/statistics'),
                        'icon'        => 'icon-area-chart',
                        'permissions' => ['indikator.news.statistics']
                    ]
                ]
            ]
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Indikator\News\ReportWidgets\Posts' => [
                'label'   => 'indikator.news::lang.widget.posts',
                'context' => 'dashboard'
            ],
            'Indikator\News\ReportWidgets\Subscribers' => [
                'label'   => 'indikator.news::lang.widget.subscribers',
                'context' => 'dashboard'
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            'Indikator\News\Components\Posts' => 'newsPosts',
            'Indikator\News\Components\Post'  => 'newsPost',
            'Indikator\News\Components\Form'  => 'newsForm',
            'Indikator\News\Components\Stat'  => 'newsStat'
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
            'indikator.news.posts' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.posts'
            ],
            'indikator.news.subscribers' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.subscribers'
            ],
            'indikator.news.statistics' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.statistics'
            ],
            'indikator.news.import_export' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.import_export'
            ]
        ];
    }

    public function boot()
    {
        Event::listen('pages.menuitem.listTypes', function()
        {
            return [
                'post-list' => 'indikator.news::lang.sitemap.post_list',
                'post-page' => 'indikator.news::lang.sitemap.post_page'
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type)
        {
            if ($type == 'post-list' || $type == 'post-page') {
                return Posts::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme)
        {
            if ($type == 'post-list' || $type == 'post-page') {
                return Posts::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}
