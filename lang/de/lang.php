<?php

return [
    'plugin' => [
        'name' => 'News und Newsletters',
        'description' => 'Einfaches News und Newsletter plugin.',
        'author' => 'Gergő Szabó',
    ],
    'backend_settings' => [
        'description' => 'Einstellungen verwalten',
        'main_section' => 'Einstellung über das versenden von Newslettern',
        'main_section_comment' => 'Es können Einstellungen über das Tracking der Abonnenten eingestellt werden',
        'click_tracking' => 'Klicken verfolgen',
        'click_tracking_comment' =>  'Trackt wenn eine Person auf einen Link in der Email klickt.',
        'email_view_tracking' => 'Emailbetrachtung verfolgen',
        'email_view_tracking_comment' => 'Trackt wenn eine Person eine Email öffnet.',
        'email_view_tracking_warning' => [
            'heading' => 'Vorsicht beim verwenden von Email-Tracking' ,
            'subheading' => 'Dies ist nicht in allen Ländern erlaubt!',
            'text' => 'Wenn Sie diese Funktion verwenden stellen Sie bitte sicher, dass es in Ihren Land erlaubt ist. Eventuell müssen Sie Ihre Abonneten darüber informieren.'
        ]
    ],
    'menu' => [
        'news' => 'News',
        'posts' => 'Nachrichten',
        'subscribers' => 'Abonnenten',
        'statistics' => 'Statistik',
        'import' => 'Import',
        'export' => 'Export',
        'logs' => 'Logs'
    ],
    'title' => [
        'posts' => 'Nachrichten',
        'subscribers' => 'Abonnenten'
    ],
    'new' => [
        'posts' => 'Neue Nachricht',
        'subscribers' => 'Neuen Abonnenten'
    ],
    'stat' => [
        'posts' => 'Nachricht|Nachrichten',
        'view' => 'Gesehen',
        'mail' => 'Gesendet',
        'loss' => 'Verlust',
        'top' => 'Am besten besucht',
        'longest' => 'Längste Einträge',
        'shortest' => 'Kürzeste Eingträge',
        'queued' => 'In Warteschlange',
        'send' => 'Gesendet',
        'sent' => 'Gesendet',
        'viewed' => 'Betrachtet',
        'click' => 'Klicks',
        'clicked' => 'Geklickt',
        'log' => [
            'events' => 'Ereignisse',
            'overall' => 'Gesamt'
        ]
    ],
    'form' => [
        // General
        'created' => 'Erstellt am',
        'updated' => 'Aktualisiert am',
        // Posts
        'id' => 'ID',
        'title' => 'Titel',
        'slug' => 'Slug',
        'introductory' => 'Einleitung',
        'content' => 'Inhalt',
        'image' => 'Bild',
        'status' => 'Status',
        'status_published' => 'Veröffentlicht',
        'status_hide' => 'Versteckt',
        'status_draft' => 'Entwurf',
        'status_active' => 'Aktiv',
        'status_unsubscribed' => 'Deabonniert',
        'featured' => 'Hervorgehoben',
        'yes' => 'Ja',
        'no' => 'Nein',
        'view' => 'Gesehen',
        'published' => 'Veröffentlicht am',
        'send' => 'Sende die Nachricht an Abonneten.',
        'sent' => 'Nachricht an Abonneten versendet',
        'last_send_at' => 'Zuletzt versendet am',
        'last_send' => 'Zuletzt versendet',
        'length' => 'Länge',
        // Subscribers
        'name' => 'Name',
        'email' => 'Email',
        'common' => 'Common',
        'locale' => 'Sprache',
        'lang' => 'de',
        'mail' => 'Mail',
        'news' => 'Nachricht',
        'subscriber_name' => 'Abonnent Name',
        'subscriber_email' => 'Abonnent Email',
        'queued_at' => 'In Warteschlange',
        'send_at' => 'Gesendet',
        'viewed_at' => 'Betrachtet',
        'clicked_at' => 'Geklickt',
        'logs_count' => 'Logeinträge'
    ],
    'button' => [
        'activate' => 'Aktivieren',
        'deactivate' => 'Deaktivieren',
        'active' => 'Aktiv',
        'inactive' => 'Inaktiv',
        'import' => 'Import',
        'export' => 'Export',
        'unsubscribe' => 'Deabonnieren',
        'subscribe' => 'Abonnieren',
        'return' => 'Zurück',
        'newsletter_resend' => 'Newsletter erneut versenden',
        'newsletter_resend_confirmation' => 'Sind Sie sich sicher, dass Sie den Newsletter erneut versenden möchten?'
    ],
    'flash' => [
        'activate' => 'Nachrichten erfolgreich aktiviert.',
        'deactivate' => 'Nachrichten erfolgreich deaktiviert.',
        'subscribe' => 'Diese Benutzer erfolgreich abonniert.',
        'unsubscribe' => 'Diese Benutzer wurden erfolgreich abgemeldet.',
        'delete' => 'Möchten Sie wirklich diese Einträge löschen?',
        'remove' => 'Einträge erfolgreich gelöscht.',
        'newsletter_resend_success' => 'Newsletter wurde erfolgreich erneut versendet.',
        'newsletter_resend_error' => 'Ein Fehler trat beim erneuten versenden auf, es könnten trotzdem einige die Nachricht empfangen!'
    ],
    'widget' => [
        'posts' => 'News - Nachrichten',
        'newposts' => 'News - Neue Nachrichten',
        'topposts' => 'News - Top Nachrichten',
        'subscribers' => 'News - Abonneten',
        'show_total' => 'Zeige alle',
        'show_active' => 'Zeige aktive',
        'show_inactive' => 'Zeige inaktive',
        'show_draft' => 'Zeige Entwurf',
        'show_piece' => 'Anzahl der Beiträge',
        'show_date' => 'Zeige Datum',
        'show_unsub' => 'Zeige Deabonniert',
        'total' => 'Alle'
    ],
    'component' => [
        'posts' => 'Nachrichten',
        'post' => 'Nachricht',
        'subscribe' => 'Abonnentenform',
        'unsubscribe' => 'Deabonnieren'
    ],
    'permission' => [
        'posts' => 'Nachrichten verwalten',
        'subscribers' => 'Abonnenten verwalten',
        'statistics' => 'Zeige Statistik',
        'import_export' => 'Import und Export',
        'settings' => 'Einstellungen verwalten',
        'logs' => 'Detailierte Logeinsicht',
    ],
    'settings' => [
        'slug_title' => 'Nachrichten slug',
        'slug_description' => 'Slug parameter nach dem die Nachricht gesucht wird.',
        'pagination_title' => 'Seitennummer',
        'pagination_description' => 'Parameter für die Seitennummer.',
        'per_page_title' => 'Nachrichten pro Seite',
        'per_page_validation' => 'Ungültiges Format der Nachrichten pro Seite',
        'no_posts_title' => 'Keine Nachrichten Benachrichtigung',
        'no_posts_description' => 'Benachrichtigung die angezeigt wird, wenn keine Nachrichten vorhanden sind.',
        'no_posts_found' => 'Keine Nachrichten gefunden',
        'posts_order_title' => 'Sortierungsattribut',
        'posts_order_description' => 'Attribut nachdem die Nachrichten sortiert werden sollen.',
        'post_title' => 'Seite der einzelnen Nachricht',
        'post_description' => 'Name der Seite, auf dennen die einzelne Nachricht verlinkt werden soll.',
        'featured_title' => 'Nachrichtenart',
        'featured_description' => 'Wählen Sie welche Nachrichten angezeigt werden sollen',
        'list_all' => 'Alle',
        'list_featured' => 'Nur hervorgehobene',
        'list_notfeatured' => 'Keine hervorgehobene'
    ],
    'sorting' => [
        'title_asc' => 'Titel (aufsteigend)',
        'title_desc' => 'Titel (absteigend)',
        'created_at_asc' => 'Erstellt (aufsteigend)',
        'created_at_desc' => 'Erstellt (absteigend)',
        'updated_at_asc' => 'Aktualisiert (aufsteigend)',
        'updated_at_desc' => 'Aktualisiert (absteigend)',
        'published_at_asc' => 'Veröffentlicht (aufsteigend)',
        'published_at_desc' => 'Veröffentlicht (absteigend)'
    ],
    'sitemap' => [
        'post_list' => 'Nachrichten',
        'post_page' => 'Nachricht'
    ],
    'messages' => [
        'unsubscribed' => 'Wir haben Sie erfolgreich aus den Newsletter ausgetragen.',
        'not_subscribed' => 'Sie haben hier keinen Newsletter abonniert.',
        'subscribed' => 'Danke, dass Sie unseren Newsletter abonniert haben.'
    ]
];
