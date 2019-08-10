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
        'categories' => 'Kategorie',
        'subscribers' => 'Subskrybenci',
        'statistics' => 'Statystyka',
        'import' => 'Import',
        'export' => 'Eksport',
        'logs' => 'Logi',
        'settings' => 'Ustawienia'
    ],
    'title' => [
        'posts' => 'post',
        'categories' => 'kategoria',
        'subscribers' => 'subskrybent'
    ],
    'new' => [
        'posts' => 'Nowy post',
        'categories' => 'Nowa kategoria',
        'subscribers' => 'Nowy subskrybent'
    ],
    'stat' => [
        'posts' => 'blogach',
        'view' => 'widok',
        'mail' => 'Zapisane',
        'loss' => 'Utrata',
        'top' => 'TOP',
        'longest' => 'Najdłuższy',
        'shortest' => 'Najkrótsza',
        'queued' => 'W kolejce',
        'send' => 'Wysłać',
        'sent' => 'Wysłano',
        'viewed' => 'Oglądane',
        'click' => 'Kliknięcia',
        'clicked' => 'Kliknij',
        'failed' => 'Nie udało się',
        'log' => [
            'events' => 'Wydarzenia',
            'summary' => 'Podsumowanie'
        ]
    ],
    'form' => [
        // Geral
        'id' => 'ID',
        'created_at' => 'Stworzony',
        'updated_at' => 'Zaktualizowany',
        // Postagens
        'title' => 'Tytuł',
        'slug' => 'Slug',
        'introductory' => 'Skrót/wstęp',
        'content' => 'Treść',
        'image' => 'Obrazek',
        'category' => 'Kategoria',
        'author' => 'Autor',
        'status' => 'Status',
        'status_published' => 'Opublikowany',
        'status_hide' => 'Ukryty',
        'status_draft' => 'Szkic',
        'status_active' => 'Aktywny',
        'status_inactive' => 'Nieaktywny',
        'status_unsubscribed' => 'Wypisać',
        'featured' => 'Opisany',
        'hidden' => 'Ukryty',
        'yes' => 'Tak',
        'no' => 'Nie',
        'view' => 'widok',
        'published_at' => 'Opublikowany',
        'send' => 'Wyślij e-mail do subskrybentów.',
        'length' => 'Długość',
        'seo_tab' => 'SEO ustawienia',
        'seo_title' => 'Tytuł',
        'seo_keywords' => 'Słowa kluczowe',
        'seo_desc' => 'Opis',
        'seo_image' => 'OG obraz',
        // Inscritos
        'name' => 'Imię',
        'email' => 'E-mail',
        'comment' => 'Komentarz',
        'locale' => 'Idioma',
        'lang' => 'pl',
        'mail' => 'mail',
        // Dzienniki
        'news' => 'Stanowisko',
        'subscriber_name' => 'Nazwa subskrybenta',
        'subscriber_email' => 'E-mail subskrybenta',
        'queued_at' => 'W kolejce',
        'send_at' => 'Wysłano',
        'viewed_at' => 'Oglądane',
        'clicked_at' => 'Kliknij',
        'logs_count' => 'Wpisy dzienników'
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
        'test' => 'Wyślij pocztę testową',
        'resend' => 'Wyślij ponownie biuletyn',
        'resend_confirmation' => 'Czy na pewno chcesz wysłać biuletyn?',
        'return' => 'Powrót'
    ],
    'flash' => [
        'activate' => 'Pomyślnie aktywowano zaznaczone posty.',
        'deactivate' => 'Pomyślnie zdezaktywowano zaznaczone posty.',
        'subscribe' => 'Pomyślnie subskrypcję tych użytkowników.',
        'unsubscribe' => 'Pomyślnie anulowano subskrypcję tych użytkowników.',
        'delete' => 'Czy na pewno chcesz usunąć zaznaczone elementy?',
        'remove' => 'Pomyślnie usunięto zaznaczone posty.',
        'newsletter_resend_success' => 'Newsletter został z powodzeniem wysłany.',
        'newsletter_resend_error' => 'Podczas wysyłania biuletynu wystąpił błąd. Przed ponownym wysyłaniem zapoznaj się z logu, aby uzyskać więcej informacji na temat aktualnego stanu.'
    ],
    'backend_settings' => [
        'description' => 'Ustawienia sterowania',
        'main_section' => 'Ustawienia dotyczące wysyłania i obsługi biuletynów',
        'click_tracking' => 'Śledzenie kliknięć',
        'click_tracking_comment' => 'Śledź, gdy osoba kliknie link biuletynu.',
        'email_view_tracking' => 'Śledzenie wyświetleń biuletynów',
        'email_view_tracking_comment' => 'Śledź, gdy osoba przegląda biuletyn.',
        'email_view_tracking_warning' => [
            'heading' => 'Будьте осторожны при использовании этой функции',
            'subheading' => 'Nie jest dozwolone w każdym kraju!',
            'text' => 'Podczas korzystania z tej funkcji należy mieć pewność, co robisz! Upewnij się, że nie złamasz żadnych praw.'
        ],
        'statistic_show_posts' => 'Pokaż posty',
        'statistic_show_mails' => 'Pokaż dzienniki poczty',
        'statistic_show_longest_posts' => 'Pokaż najdłuższe posty',
        'statistic_show_shortest_posts' => 'Pokaż krótkie posty'
    ],
    'widget' => [
        'posts' => 'Aktualności - Posty',
        'newposts' => 'Aktualności - Nowe posty',
        'topposts' => 'Aktualności - Popularny posty',
        'subscribers' => 'Aktualności - Subskrybenci',
        'show_total' => 'Pokaż wszystkie',
        'show_active' => 'Pokaż aktywne',
        'show_inactive' => 'Pokaż nieaktywne',
        'show_draft' => 'Pokaż szkice',
        'show_piece' => 'Liczba stanowisk',
        'show_date' => 'Pokaż data',
        'show_unsub' => 'Pokaż wypisać',
        'total' => 'Razem'
    ],
    'component' => [
        'posts' => 'Pokaż posty',
        'post' => 'Pokaż zawartość postów',
        'categories' => 'Kategorie',
        'subscribe' => 'Formularz subskrybentów',
        'unsubscribe' => 'Formularz wyrejestrowuj'
    ],
    'permission' => [
        'posts' => 'Zarządzań postami',
        'subscribers' => 'Zarządzaj subskrybentami',
        'statistics' => 'Zobacz statystyki',
        'import_export' => 'Import & eksport',
        'logs' => 'Szczegółowe widoki dzienników'
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
        'list_notfeatured' => 'Nie jest opisywany',
        'links' => 'Spinki do mankietów'
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
