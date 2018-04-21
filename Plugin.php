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
                'iconSvg'     => 'plugins/indikator/news/assets/images/news-icon.svg',
                'permissions' => ['indikator.news.*'],
                'order'       => 201,

                'sideMenu' => [
                    'posts' => [
                        'label'       => 'indikator.news::lang.menu.posts',
                        'url'         => Backend::url('indikator/news/posts'),
                        'icon'        => 'icon-file-text',
                        'permissions' => ['indikator.news.posts']
                    ],
                    'categories' => [
                        'label'       => 'indikator.news::lang.menu.categories',
                        'url'         => Backend::url('indikator/news/categories'),
                        'icon'        => 'icon-tags',
                        'permissions' => ['indikator.news.categories']
                    ],
                    'subscribers' => [
                        'label'        => 'indikator.news::lang.menu.subscribers',
                        'url'         => Backend::url('indikator/news/subscribers'),
                        'icon'        => 'icon-user',
                        'permissions' => ['indikator.news.subscribers']
                    ],
                    'statistics' => [
                        'label'       => 'indikator.news::lang.menu.statistics',
                        'url'         => Backend::url('indikator/news/statistics'),
                        'icon'        => 'icon-area-chart',
                        'permissions' => ['indikator.news.statistics']
                    ],
                    'logs' => [
                        'label'       => 'indikator.news::lang.menu.logs',
                        'url'         => Backend::url('indikator/news/logs'),
                        'icon'        => 'icon-bar-chart',
                        'permissions' => ['indikator.news.logs']
                    ],
                    'settings' => [
                        'label'       => 'indikator.news::lang.menu.settings',
                        'url'         => Backend::url('system/settings/update/indikator/news/settings'),
                        'icon'        => 'icon-cogs',
                        'permissions' => ['indikator.news.settings']
                    ]
                ]
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'indikator.news::lang.plugin.name',
                'description' => 'indikator.news::lang.backend_settings.description',
                'category'    => 'system::lang.system.categories.cms',
                'icon'        => 'icon-newspaper-o',
                'class'       => 'Indikator\News\Models\Settings',
                'order'       => 500,
                'keywords'    => 'news newsletter email statistics',
                'permissions' => ['indikator.news.settings']
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
            'Indikator\News\ReportWidgets\NewPosts' => [
                'label'   => 'indikator.news::lang.widget.newposts',
                'context' => 'dashboard'
            ],
            'Indikator\News\ReportWidgets\TopPosts' => [
                'label'   => 'indikator.news::lang.widget.topposts',
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
            'Indikator\News\Components\Posts'       => 'newsPosts',
            'Indikator\News\Components\Post'        => 'newsPost',
            'Indikator\News\Components\Subscribe'   => 'newsSubscribe',
            'Indikator\News\Components\Unsubscribe' => 'newsUnsubscribe'
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
                'label' => 'indikator.news::lang.permission.posts',
                'order' => 100,
                'roles' => ['publisher']
            ],
            'indikator.news.categories' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.categories',
                'order' => 200,
                'roles' => ['publisher']
            ],
            'indikator.news.subscribers' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.subscribers',
                'order' => 300,
                'roles' => ['publisher']
            ],
            'indikator.news.statistics' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.statistics',
                'order' => 400,
                'roles' => ['publisher']
            ],
            'indikator.news.import_export' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.import_export',
                'order' => 500,
                'roles' => ['publisher']
            ],
            'indikator.news.logs' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.logs',
                'order' => 600,
                'roles' => ['publisher']
            ],
            'indikator.news.settings' => [
                'tab'   => 'indikator.news::lang.menu.news',
                'label' => 'indikator.news::lang.permission.settings',
                'order' => 700,
                'roles' => ['publisher']
            ]
        ];
    }

    public function registerSchedule($schedule)
    {
        $schedule->command('queue:work --daemon --queue=newsletter')->everyMinute()->withoutOverlapping();
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
