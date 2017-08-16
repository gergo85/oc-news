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
        'subscribers' => 'Подписчики',
        'statistics' => 'Статистика',
        'import' => 'Импортировать',
        'export' => 'экспорт'
    ],
    'title' => [
        'posts' => 'пост',
        'subscribers' => 'подписчик'
    ],
    'new' => [
        'posts' => 'Новый пост',
        'subscribers' => 'Новый подписчик'
    ],
    'stat' => [
        'posts' => '{0} Записей|{1} Запись|[2,4] Записи|[5,Inf] Записей',
        'view' => 'Посмотреть',
        'mail' => 'Сохранено',
        'loss' => 'потеря',
        'top' => 'TOP',
        'longest' => 'Cамый длинный',
        'shortest' => 'Cамый короткий'
    ],
    'form' => [
        // Генеральная
        'created' => 'Дата создания',
        'updated' => 'Дата обновления',
        // Сообщений
        'id' => 'ID',
        'title' => 'Заголовок',
        'slug' => 'URL записи',
        'introductory' => 'Введение',
        'content' => 'Содержимое',
        'image' => 'Изображение',
        'status' => 'Статус',
        'status_published' => 'Опубликовано',
        'status_hide' => 'Скрыто',
        'status_draft' => 'Черновик',
        'status_active' => 'Aктивный',
        'status_unsubscribed' => 'Oтписались',
        'featured' => 'Рекомендуемые',
        'yes' => 'да',
        'no' => 'Нет',
        'view' => 'просмотр',
        'published' => 'Дата публикации',
        'send' => 'Отправить почту подписчикам.',
        'length' => 'длина',
        // Подписчики
        'name' => 'Имя',
        'email' => 'Почта',
        'common' => 'Общее',
        'locale' => 'язык',
        'lang' => 'ru',
        'mail' => 'почта'
    ],
    'button' => [
        'activate' => 'Активировать',
        'deactivate' => 'Деактивировать',
        'active' => 'Активных',
        'inactive' => 'Неактивных',
        'import' => 'Импортировать',
        'export' => 'экспорт',
        'unsubscribe' => 'Отказаться',
        'subscribe' => 'Подписка',
        'return' => 'Вернуть'
    ],
    'flash' => [
        'activate' => 'Этот пост успешно активирован.',
        'deactivate' => 'Этот пост успешно деактивирован.',
        'subscribe' => 'Успешно подписали эти пользователи.',
        'unsubscribe' => 'Успешно отменили подписку на этих пользователей.',
        'delete' => 'Вы действительно хотите удалить эту запись?',
        'remove' => 'Запись успешно удалена.'
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
        'subscribe' => 'Форма подписки',
        'unsubscribe' => 'Отменить подписку'
    ],
    'permission' => [
        'posts' => 'Управление постами',
        'subscribers' => 'Управление подписками',
        'statistics' => 'Просмотр статистики',
        'import_export' => 'Импортировать & экспорт'
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
        'list_notfeatured' => 'Не указано'
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
