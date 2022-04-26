<?php

return [
    'plugin' => [
        'name' => 'Новости и подписчики',
        'description' => 'Управление новостями и подписками.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'news' => 'Новости',
        'posts' => 'Посты',
        'categories' => 'Категории',
        'subscribers' => 'Подписчики',
        'statistics' => 'Статистика',
        'import' => 'Импортировать',
        'export' => 'Экспортировать',
        'logs' => 'Логи',
        'settings' => 'Настройки'
    ],
    'title' => [
        'posts' => 'пост',
        'categories' => 'категория',
        'subscribers' => 'подписчик'
    ],
    'new' => [
        'posts' => 'Новый пост',
        'categories' => 'Новая категория',
        'subscribers' => 'Новый подписчик'
    ],
    'stat' => [
        'posts' => '{0} Записей|{1} Запись|[2,4] Записи|[5,Inf] Записей',
        'view' => 'Посмотреть',
        'mail' => 'Сохранено',
        'loss' => 'потеря',
        'top' => 'TOP',
        'longest' => 'Cамый длинный',
        'shortest' => 'Cамый короткий',
        'queued' => 'В очереди',
        'send' => 'Послано',
        'sent' => 'Отправлено',
        'viewed' => 'Просмотрено',
        'click' => 'щелчки',
        'clicked' => 'Нажал',
        'failed' => 'Не отправлено',
        'log' => [
            'events' => 'События',
            'summary' => 'Резюме'
        ]
    ],
    'form' => [
        // Генеральная
        'id' => 'ID',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата обновления',
        // Сообщений
        'title' => 'Заголовок',
        'slug' => 'URL записи',
        'introductory' => 'Введение',
        'content' => 'Содержимое',
        'image' => 'Изображение',
        'category' => 'Категория',
        'categories' => 'Категории',
        'author' => 'Aвтор',
        'status' => 'Статус',
        'status_published' => 'Опубликовано',
        'status_hide' => 'Скрыто',
        'status_draft' => 'Черновик',
        'status_active' => 'Aктивный',
        'status_inactive' => 'Неактивный',
        'status_unsubscribed' => 'Oтписались',
        'featured' => 'Рекомендуемые',
        'hidden' => 'Cкрытый',
        'yes' => 'Да',
        'no' => 'Нет',
        'view' => 'просмотр',
        'published_at' => 'Дата публикации',
        'send' => 'Отправить почту подписчикам.',
        'length' => 'Длина',
        'seo_tab' => 'SEO настройки',
        'seo_title' => 'заглавие',
        'seo_keywords' => 'Ключевые слова',
        'seo_desc' => 'Описание',
        'seo_image' => 'OG образ',
        // Подписчики
        'name' => 'Имя',
        'email' => 'Почта',
        'comment' => 'Kомментарий',
        'locale' => 'Язык',
        'lang' => 'ru',
        'mail' => 'Почта',
        // каротаж
        'news' => 'После',
        'subscriber_name' => 'Имя подписчика',
        'subscriber_email' => 'Email подписчика',
        'queued_at' => 'В очереди',
        'send_at' => 'Отправлено',
        'viewed_at' => 'Рассматриваемый',
        'clicked_at' => 'Нажал',
        'logs_count' => 'Записи журналов'
    ],
    'button' => [
        'activate' => 'Активировать',
        'deactivate' => 'Деактивировать',
        'active' => 'Активные',
        'inactive' => 'Неактивные',
        'import' => 'Импортировать',
        'export' => 'Экспортировать',
        'unsubscribe' => 'Отказаться',
        'subscribe' => 'Подписаться',
        'test' => 'Отправить тестовую почту',
        'resend' => 'Переслать новостную рассылку',
        'resend_confirmation' => 'Вы уверены, что хотите отправить рассылку?',
        'return' => 'Вернуть'
    ],
    'flash' => [
        'activate' => 'Этот пост успешно активирован.',
        'deactivate' => 'Этот пост успешно деактивирован.',
        'subscribe' => 'Успешно подписали эти пользователи.',
        'unsubscribe' => 'Успешно отменили подписку на этих пользователей.',
        'delete' => 'Вы действительно хотите удалить эту запись?',
        'remove' => 'Запись успешно удалена.',
        'newsletter_resend_success' => 'Письмо успешно отправлено повторно.',
        'newsletter_resend_error' => 'При отправке письма произошла ошибка. Перед повторной отправкой повторно загляните в журнал, чтобы получить дополнительную информацию о текущем состоянии.'
    ],
    'backend_settings' => [
        'description' => 'Настройки управления',
        'main_section' => 'Настройки отправки и обработки информационных бюллетеней',
        'click_tracking' => 'Следить за кликами',
        'click_tracking_comment' => 'Треки, когда человек нажимает на ссылку в информационном бюллетене.',
        'email_view_tracking' => 'Отслеживать рассылку новостей',
        'email_view_tracking_comment' => 'Треки, когда человек смотрит на информационный бюллетень.',
        'email_view_tracking_warning' => [
            'heading' => 'Будьте осторожны при использовании этой функции',
            'subheading' => 'Это запрещено в каждой стране!',
            'text' => 'Когда вы используете эту функцию, вы должны быть уверены, что делаете! Убедитесь, что вы не нарушаете никаких законов.'
        ],
        'statistic_show_posts' => 'Показать сообщения',
        'statistic_show_mails' => 'Показывать почтовые журналы',
        'statistic_show_longest_posts' => 'Показать самые длинные сообщения',
        'statistic_show_shortest_posts' => 'Показать последние сообщения'
    ],
    'widget' => [
        'posts' => 'Новости - Посты',
        'newposts' => 'Новости - Лучшие Посты',
        'topposts' => 'Новости - Новые Посты',
        'subscribers' => 'Новости - Подписки',
        'show_total' => 'Показать все',
        'show_active' => 'Показать активные',
        'show_inactive' => 'Показать неактивные',
        'show_draft' => 'Показать проект',
        'show_piece' => 'Количество Посты',
        'show_date' => 'Показать Дата',
        'show_unsub' => 'Показать Oтписались',
        'total' => 'Всего'
    ],
    'component' => [
        'posts' => 'Отображение постов',
        'post' => 'Показать содержание поста',
        'categories' => 'Категории',
        'subscribe' => 'Форма подписки',
        'unsubscribe' => 'Отменить подписку'
    ],
    'permission' => [
        'posts' => 'Управление постами',
        'subscribers' => 'Управление подписками',
        'statistics' => 'Просмотр статистики',
        'import_export' => 'Импортировать & экспорт',
        'logs' => 'Подробные виды журналов'
    ],
    'settings' => [
        'slug_title' => 'Параметр URL',
        'slug_description' => 'Параметр маршрута, необходимый для выбора конкретного поста.',
        'pagination_title' => 'Параметр постраничной навигации',
        'pagination_description' => 'Параметр, необходимый для постраничной навигации.',
        'per_page_title' => 'Постов на странице',
        'per_page_validation' => 'Недопустимый Формат. Ожидаемый тип данных - действительное число.',
        'no_posts_title' => 'Отсутсвие постов',
        'no_posts_description' => 'Сообщение, отображаемое в случае, если нет никаких постов. Это свойство используется по умолчанию компонентом.',
        'no_posts_found' => 'Отсутсвие постов',
        'posts_order_title' => 'Сортировка',
        'posts_order_description' => 'Атрибут, по которому будут сортироваться посты.',
        'post_title' => 'Страница поста',
        'post_description' => 'Название страницы для ссылки "подробнее". Это свойство используется по умолчанию компонентом.',
        'featured_title' => 'Featured Listing',
        'featured_description' => 'Choose which Posts to show',
        'list_all' => 'Все',
        'list_featured' => 'Только Избранные',
        'list_notfeatured' => 'Не указано',
        'links' => 'связи'
    ],
    'sorting' => [
        'title_asc' => 'Заголовок (по возрастанию)',
        'title_desc' => 'Заголовок (по убыванию)',
        'created_at_asc' => 'Дата создания (по возрастанию)',
        'created_at_desc' => 'Дата создания (по убыванию)',
        'updated_at_asc' => 'Дата обновления (по возрастанию)',
        'updated_at_desc' => 'Дата обновления (по убыванию)',
        'published_at_asc' => 'Дата публикации (по возрастанию)',
        'published_at_desc' => 'Дата публикации (по убыванию)'
    ],
    'sitemap' => [
        'post_list' => 'пост список',
        'post_page' => 'пост страница'
    ],
    'messages' => [
        'unsubscribed' => 'We successfully unsubscribed you from our newsletter.',
        'not_subscribed' => 'You do not have subscribed account.',
        'subscribed' => 'Thank you for your subscription to our newsletter!'
    ]
];
