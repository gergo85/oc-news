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
        'subscribers' => 'Subskrybenci'
    ],
    'title' => [
        'posts' => 'post',
        'subscribers' => 'Subskrybent'
    ],
    'new' => [
        'posts' => 'Nowy post',
        'subscribers' => 'Nowy subskrybent'
    ],
    'form' => [
        // General
        'statistics' => 'Statystyki',
        'created' => 'Stworzony',
        'updated' => 'Zaktualizowany',
        // Posts
        'title' => 'Tytuł',
        'slug' => 'Slug',
        'introductory' => 'Skrót/wstęp',
        'content' => 'Treść',
        'image' => 'Obrazek',
        'status' => 'Status',
        'status_published' => 'Opublikowany',
        'status_hide' => 'Ukryty',
        'status_draft' => 'Szkic',
        'view' => 'widok',
        'published' => 'Opublikowany',
        'send' => 'Wyślij e-mail do subskrybentów.',
        // Subscribers
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
        'form' => 'Formularz subskrybentów',
        'stat' => 'Pokaż statystyki'
    ],
    'permission' => [
        'posts' => 'Zarządzań postami',
        'subscribers' => 'Zarządzaj subskrybentami'
    ],
    'settings' => [
        'post_title' => 'Post',
        'post_description' => 'Pokaż post na stronie.',
        'post_slug' => 'Slug posta',
        'post_slug_description' => "Pokaż posta używając sluga.",
        'posts_title' => 'Lista postów',
        'posts_description' => 'Pokazuje listę ostatnich postów na stronie.',
        'posts_pagination' => 'Numer strony',
        'posts_pagination_description' => 'Ta wartość służy do przetrzymywania strony na której obecnie znajduje się użytkownik.',
        'posts_per_page' => 'Postów na stronie',
        'posts_per_page_validation' => 'Niepoprawny format liczby postów na stronie',
        'posts_no_posts' => 'Brak wiadomości do postów',
        'posts_no_posts_description' => 'Wiadomość do wyświetlenia w liście postów w przypadku braku postów. Ta własność jest używana przez domyślny fragment komponentu.',
        'posts_no_posts_found' => 'Nie znaleziono postów',
        'posts_order' => 'Kolejność postów',
        'posts_order_decription' => 'Atrybut po którym powinno się odbyć sortowanie',
        'posts_post' => 'Strona postów',
        'posts_post_description' => 'Nazwa pliku strony postu dla linków "Więcej szczegółów". Ta własność jest używana przez domyślny fragment komponentu.',
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
    ]
];
