<?php

return [
    'plugin' => [
        'name' => 'Aktualności i newsletter',
        'description' => 'Plugin do zarządzania aktualnościami i newsletterem.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'news' => 'Subskrypcja',
        'posts' => 'Posty',
        'subscribers' => 'Subskrybenci',
        'statistics' => 'Statystyka',
        'import' => 'Import',
        'export' => 'Eksport'
    ],
    'title' => [
        'posts' => 'post',
        'subscribers' => 'Subskrybent'
    ],
    'new' => [
        'posts' => 'Nowy post',
        'subscribers' => 'Nowy subskrybent'
    ],
    'stat' => [
        'posts' => 'post|blogach',
        'view' => 'widok',
        'mail' => 'Zapisane',
        'top' => 'TOP',
        'longest' => 'Najdłuższy',
        'shortest' => 'Najkrótsza'
    ],
    'form' => [
        // Geral
        'created' => 'Stworzony',
        'updated' => 'Zaktualizowany',
        // Postagens
        'id' => 'ID',
        'title' => 'Tytuł',
        'slug' => 'Slug',
        'introductory' => 'Skrót/wstęp',
        'content' => 'Treść',
        'image' => 'Obrazek',
        'status' => 'Status',
        'status_published' => 'Opublikowany',
        'status_hide' => 'Ukryty',
        'status_draft' => 'Szkic',
        'status_active' => 'Aktywny',
        'status_unsubscribed' => 'Wypisać',
        'featured' => 'Opisany',
        'yes' => 'Tak',
        'no' => 'Nie',
        'view' => 'widok',
        'published' => 'Opublikowany',
        'send' => 'Wyślij e-mail do subskrybentów.',
        'length' => 'Długość',
        // Inscritos
        'name' => 'Imię',
        'email' => 'E-mail',
        'common' => 'Nazwa',
        'mail' => 'mail'
    ],
    'button' => [
        'activate' => 'Aktywuj',
        'deactivate' => 'Dezaktywuj',
        'active' => 'Aktywny',
        'inactive' => 'Nieaktywny',
        'import' => 'Import',
        'export' => 'Eksport',
        'unsubscribe' => 'Anuluj subskrypcję',
        'subscribe' => 'Subskrypcja',
        'return' => 'Powrót'
    ],
    'flash' => [
        'activate' => 'Pomyślnie aktywowano zaznaczone posty.',
        'deactivate' => 'Pomyślnie zdezaktywowano zaznaczone posty.',
        'delete' => 'Czy na pewno chcesz usunąć zaznaczone elementy?',
        'remove' => 'Pomyślnie usunięto zaznaczone posty.'
    ],
    'widget' => [
        'posts' => 'Aktualności - Posty',
        'subscribers' => 'Aktualności - Subskrybenci',
        'show_total' => 'Pokaż wszystkie',
        'show_active' => 'Pokaż aktywne',
        'show_inactive' => 'Pokaż nieaktywne',
        'show_draft' => 'Pokaż szkice',
        'total' => 'Razem'
    ],
    'component' => [
        'posts' => 'Pokaż posty',
        'post' => 'Pokaż zawartość postów',
        'subscribe' => 'Formularz subskrybentów',
        'unsubscribe' => 'Formularz wyrejestrowuj'
    ],
    'permission' => [
        'posts' => 'Zarządzań postami',
        'subscribers' => 'Zarządzaj subskrybentami',
        'statistics' => 'Zobacz statystyki',
        'import_export' => 'Import & eksport'
    ],
    'settings' => [
        'slug_title' => 'Slug posta',
        'slug_description' => 'Pokaż posta używając sluga.',
        'pagination_title' => 'Numer strony',
        'pagination_description' => 'Ta wartość służy do przetrzymywania strony na której obecnie znajduje się użytkownik.',
        'per_page_title' => 'Postów na stronie',
        'per_page_validation' => 'Niepoprawny format liczby postów na stronie',
        'no_posts_title' => 'Brak wiadomości do postów',
        'no_posts_description' => 'Wiadomość do wyświetlenia w liście postów w przypadku braku postów. Ta własność jest używana przez domyślny fragment komponentu.',
        'no_posts_found' => 'Nie znaleziono postów',
        'posts_order_title' => 'Kolejność postów',
        'posts_order_decription' => 'Atrybut po którym powinno się odbyć sortowanie',
        'post_title' => 'Strona postów',
        'post_description' => 'Nazwa pliku strony postu dla linków "Więcej szczegółów". Ta własność jest używana przez domyślny fragment komponentu.',
        'featured_title' => 'Featured Listing',
        'featured_description' => 'Choose which Posts to show',
        'list_all' => 'Wszystko',
        'list_featured' => 'Tylko wyróżnione',
        'list_notfeatured' => 'Nie jest opisywany'
    ],
    'sorting' => [
        'title_asc' => 'Tytuł (rosnąco)',
        'title_desc' => 'Tytuł (malejąco)',
        'created_at_asc' => 'Stworzony (rosnąco)',
        'created_at_desc' => 'Stworzony (malejąco)',
        'updated_at_asc' => 'Zaktualizowany (rosnąco)',
        'updated_at_desc' => 'Zaktualizowany (malejąco)',
        'published_at_asc' => 'Opublikowany (rosnąco)',
        'published_at_desc' => 'Opublikowany (malejąco)'
    ],
    'sitemap' => [
        'post_list' => 'Post lista',
        'post_page' => 'Post página'
    ],
    'messages' => [
        'unsubscribed' => 'We successfully unsubscribed you from our newsletter.',
        'not_subscribed' => 'You do not have subscribed account.',
        'subscribed' => 'Thank you for your subscription to our newsletter!'
    ]
];
