<?php namespace Indikator\News;

use System\Classes\PluginBase;
use Backend;
use BackendAuth;
use Event;
use Db;
use Indikator\News\Models\Posts;
use Indikator\News\Models\Categories;
use Indikator\News\Models\Subscribers;
use Indikator\News\Models\Settings;
use Indikator\News\Controllers\Posts as PostsController;
use Indikator\News\Controllers\Subscribers as SubscribersController;
use Backend\Models\User;
use Config;

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
                'order'       => 320,

                'sideMenu' => [
                    'posts' => [
                        'label'       => 'indikator.news::lang.menu.posts',
                        'url'         => Backend::url('indikator/news/posts'),
                        'icon'        => 'icon-file-text',
                        'permissions' => ['indikator.news.posts'],
                        'order'       => 100
                    ],
                    'categories' => [
                        'label'       => 'indikator.news::lang.menu.categories',
                        'url'         => Backend::url('indikator/news/categories'),
                        'icon'        => 'icon-tags',
                        'permissions' => ['indikator.news.categories'],
                        'order'       => 200
                    ],
                    'subscribers' => [
                        'label'       => 'indikator.news::lang.menu.subscribers',
                        'url'         => Backend::url('indikator/news/subscribers'),
                        'icon'        => 'icon-user',
                        'permissions' => ['indikator.news.subscribers'],
                        'order'       => 300
                    ],
                    'statistics' => [
                        'label'       => 'indikator.news::lang.menu.statistics',
                        'url'         => Backend::url('indikator/news/statistics'),
                        'icon'        => 'icon-area-chart',
                        'permissions' => ['indikator.news.statistics'],
                        'order'       => 400
                    ],
                    'logs' => [
                        'label'       => 'indikator.news::lang.menu.logs',
                        'url'         => Backend::url('indikator/news/logs'),
                        'icon'        => 'icon-bar-chart',
                        'permissions' => ['indikator.news.logs'],
                        'order'       => 500
                    ],
                    'settings' => [
                        'label'       => 'indikator.news::lang.menu.settings',
                        'url'         => Backend::url('system/settings/update/indikator/news/settings'),
                        'icon'        => 'icon-cogs',
                        'permissions' => ['indikator.news.settings'],
                        'order'       => 600
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
                'label'       => 'indikator.news::lang.widget.posts',
                'context'     => 'dashboard',
                'permissions' => ['indikator.news.posts']
            ],
            'Indikator\News\ReportWidgets\NewPosts' => [
                'label'       => 'indikator.news::lang.widget.newposts',
                'context    ' => 'dashboard',
                'permissions' => ['indikator.news.posts']
            ],
            'Indikator\News\ReportWidgets\TopPosts' => [
                'label'       => 'indikator.news::lang.widget.topposts',
                'context'     => 'dashboard',
                'permissions' => ['indikator.news.posts']
            ],
            'Indikator\News\ReportWidgets\Subscribers' => [
                'label'       => 'indikator.news::lang.widget.subscribers',
                'context'     => 'dashboard',
                'permissions' => ['indikator.news.subscribers']
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            'Indikator\News\Components\Posts'       => 'newsPosts',
            'Indikator\News\Components\Post'        => 'newsPost',
            'Indikator\News\Components\Categories'  => 'newsCategories',
            'Indikator\News\Components\Tags'        => 'newsTags',
            'Indikator\News\Components\Subscribe'   => 'newsSubscribe',
            'Indikator\News\Components\Unsubscribe' => 'newsUnsubscribe'
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Indikator\News\FormWidgets\PostInfo' => [
                'label' => 'PostInfo',
                'code'  => 'postinfo'
            ],
            'Indikator\News\FormWidgets\CategoryInfo' => [
                'label' => 'CategoryInfo',
                'code'  => 'categoryinfo'
            ],
            'Indikator\News\FormWidgets\SubscriberInfo' => [
                'label' => 'SubscriberInfo',
                'code'  => 'subscriberinfo'
            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'indikator.news::mail.email_en' => 'E-mail',
            'indikator.news::mail.email_hu' => 'E-mail',
            'indikator.news::mail.confirmation_hu' => 'E-mail',
            'indikator.news::mail.confirmation_en' => 'E-mail'
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
        $memory = (int)Config::get('indikator.news::memory_limit');
        $schedule->command('queue:work --daemon --queue=newsletter --memory=' . $memory)->everyMinute()->withoutOverlapping();
    }

    public function boot()
    {
        /*
         * Hide unused form fields
         */
        PostsController::extendFormFields(function($form, $model, $context)
        {
            if (!$model instanceof Posts) {
                return;
            }

            $settings = json_decode(Db::table('system_settings')->where('item', 'indikator_news_settings')->value('value'));

            if (isset($settings->fields_slug) && !$settings->fields_slug) {
                $form->removeField('slug');
            }

            if ((isset($settings->fields_category) && !$settings->fields_category) || Categories::count() == 0) {
                $form->removeField('categories');
            }

            if (isset($settings->fields_tags) && !$settings->fields_tags) {
                $form->removeField('tags');
            }

            if (!isset($settings->fields_author) || (isset($settings->fields_author) && !$settings->fields_author)) {
                $form->removeField('user');
            }

            if (!isset($settings->fields_seo) || (isset($settings->fields_seo) && !$settings->fields_seo)) {
                $form->removeField('seo_title');
                $form->removeField('seo_keywords');
                $form->removeField('seo_desc');
                $form->removeField('seo_image');
            }
        });

        SubscribersController::extendFormFields(function($form, $model, $context)
        {
            if (!$model instanceof Subscribers) {
                return;
            }

            $settings = json_decode(Db::table('system_settings')->where('item', 'indikator_news_settings')->value('value'));

            if ((isset($settings->fields_category) && !$settings->fields_category) || Categories::count() == 0) {
                $form->removeField('categories');
            }
        });

        /*
         * Hide unused list columns
         */
        PostsController::extendListColumns(function($list, $model)
        {
            if (!$model instanceof Posts) {
                return;
            }

            $settings = json_decode(Db::table('system_settings')->where('item', 'indikator_news_settings')->value('value'));

            if (isset($settings->fields_slug) && !$settings->fields_slug) {
                $list->removeColumn('slug');
            }

            if ((isset($settings->fields_category) && !$settings->fields_category) || Categories::count() == 0) {
                $list->removeColumn('category');
            }

            if (isset($settings->fields_tags) && !$settings->fields_tags) {
                $list->removeColumn('tags');
            }

            if (!isset($settings->fields_author) || (isset($settings->fields_author) && !$settings->fields_author)) {
                $list->removeColumn('user');
            }

            if (Posts::where('tags', '!=', '')->count() == 0) {
                $list->removeColumn('tags');
            }
        });

        SubscribersController::extendListColumns(function($list, $model)
        {
            if (!$model instanceof Subscribers) {
                return;
            }

            $settings = json_decode(Db::table('system_settings')->where('item', 'indikator_news_settings')->value('value'));

            if ((isset($settings->fields_category) && !$settings->fields_category) || Categories::count() == 0) {
                $list->removeColumn('categories');
            }

            if (Subscribers::where('name', '!=', '')->count() == 0) {
                $list->removeColumn('tags');
            }

            if (Subscribers::where('comment', '!=', '')->count() == 0) {
                $list->removeColumn('comment');
            }
        });

        /*
         * Hide unused list filters
         */
        PostsController::extendListFilterScopes(function($filter)
        {
            if (Categories::count() == 0) {
                $filter->removeScope('categories');
            }
        });

        SubscribersController::extendListFilterScopes(function($filter)
        {
            if (Categories::count() == 0) {
                $filter->removeScope('categories');
            }
        });

        /*
         * Extensions for Sitemap
         */
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

        /*
         * Attach posts relationship to backend user model as extension
         */
        User::extend(function($model)
        {
            $model->hasMany['posts'] = [
                'Indikator\News\Models\Posts',
                'key' => 'user_id'
            ];
        });
    }
}
