<?php

return [
    'plugin' => [
        'name' => 'Hírek és hírlevél',
        'description' => 'Egyszerű kezelése a hírek közzétételének.',
        'author' => 'Szabó Gergő'
    ],
    'menu' => [
        'news' => 'Hírek',
        'posts' => 'Bejegyzések',
        'subscribers' => 'Feliratkozók',
        'statistics' => 'Statisztika',
        'import' => 'Importálás',
        'export' => 'Exportálás'
    ],
    'title' => [
        'posts' => 'bejegyzés',
        'subscribers' => 'feliratkozó'
    ],
    'new' => [
        'posts' => 'Új bejegyzés',
        'subscribers' => 'Új feliratkozó'
    ],
    'stat' => [
        'posts' => 'Bejegyzés|Bejegyzés',
        'view' => ' Megtekintés',
        'mail' => 'Elküldve',
        'top' => 'TOP',
        'longest' => 'Leghosszabb',
        'shortest' => 'Legrövidebb'
    ],
    'form' => [
        // Általános
        'created' => 'Létrehozva',
        'updated' => 'Módosítva',
        // Bejegyzések
        'id' => 'ID',
        'title' => 'Cím',
        'slug' => 'Webcím',
        'introductory' => 'Bevezető',
        'content' => 'Tartalom',
        'image' => 'Kép',
        'status' => 'Státusz',
        'status_published' => 'Közzétéve',
        'status_hide' => 'Rejtett',
        'status_draft' => 'Piszkozat',
        'status_active' => 'Aktív',
        'status_unsubscribed' => 'Leiratkozott',
        'featured' => 'Kiemelt',
        'yes' => 'Igen',
        'no' => 'Nem',
        'view' => 'megtekintés',
        'published' => 'Közzétéve',
        'send' => 'Levél küldése a feliratkozottak számára.',
        'length' => 'Hossz',
        // Feliratkozók
        'name' => 'Név',
        'email' => 'E-mail',
        'common' => 'Megjegyzés',
        'mail' => 'levél'
    ],
    'button' => [
        'activate' => 'Közzétesz',
        'deactivate' => 'Rejtés',
        'active' => 'Aktív',
        'inactive' => 'Inaktív',
        'import' => 'Importálás',
        'export' => 'Exportálás',
        'return' => 'Vissza'
    ],
    'flash' => [
        'activate' => 'A bejegyzések sikeresen aktiválva lettek.',
        'deactivate' => 'A bejegyzések sikeresen deaktiválva lettek.',
        'delete' => 'Valóban törölni akarja?',
        'remove' => 'Az eltávolítás sikeres volt.'
    ],
    'widget' => [
        'posts' => 'Hírek - Bejegyzések',
        'subscribers' => 'Hírek - Feliratkozók',
        'show_total' => 'Összes mutatása',
        'show_active' => 'Aktívak mutatása',
        'show_inactive' => 'Inaktívak mutatása',
        'show_draft' => 'Piszkozatok mutatása',
        'total' => 'Összes'
    ],
    'component' => [
        'posts' => 'Hírek listázása',
        'post' => 'Bejegyzés mutatása',
        'form' => 'Feliratkozó űrlap',
        'stat' => 'Megtekintési statisztika'
    ],
    'permission' => [
        'posts' => 'Bejegyzések kezelése',
        'subscribers' => 'Feliratkozók kezelése',
        'statistics' => 'Statisztika megtekintése',
        'import_export' => 'Importálás és exportálás'
    ],
    'settings' => [
        'post_title' => 'Bejegyzés',
        'post_description' => 'Megjelenítése a lapon.',
        'post_slug_title' => 'Keresőbarát cím',
        'post_slug_description' => 'A webcím paramétere a bejegyzés keresőbarát címe alapján való kereséséhez.',
        'posts_title' => 'Bejegyzések',
        'posts_description' => 'Listázása a lapon.',
        'posts_pagination_title' => 'Lapozósáv paraméter neve',
        'posts_pagination_description' => 'A lapozósáv lapjai által használt, várt paraméter neve.',
        'posts_per_page_title' => 'Bejegyzések oldalanként',
        'posts_per_page_validation' => 'A laponkénti bejegyzések értéke érvénytelen formátumú',
        'posts_no_posts_title' => 'Nincsenek bejegyzések',
        'posts_no_posts_description' => 'A bejegyzés listában megjelenő üzenet abban az esetben, ha nincsenek bejegyzések. Az alapértelmezett komponensrész használja ezt a tulajdonságot.',
        'posts_no_posts_found' => 'Nincsenek bejegyzések',
        'posts_order_title' => 'Bejegyzések sorrendje',
        'posts_order_description' => 'Ez alapján rendeződnek a bejegyzések.',
        'posts_post_title' => 'Bejegyzés lapja',
        'posts_post_description' => 'A "Tovább olvasom" hivatkozások bejegyzés lap fájljának neve. Az alapértelmezett komponensrész használja ezt a tulajdonságot.',
        'posts_featured_title' => 'Bejegyzések megjelenítése',
        'posts_featured_description' => 'A kiválasztott típusú bejegyzések listázása.',
        'posts_list_all' => 'Összes',
        'posts_list_featured' => 'Csak a kiemeltek',
        'posts_list_notfeatured' => 'Csak a nem kiemeltek'
    ],
    'sorting' => [
        'title_asc' => 'Név (növekvő)',
        'title_desc' => 'Név (csökkenő)',
        'created_at_asc' => 'Létrehozva (növekvő)',
        'created_at_desc' => 'Létrehozva (csökkenő)',
        'updated_at_asc' => 'Frissítve (növekvő)',
        'updated_at_desc' => 'Frissítve (csökkenő)',
        'published_at_asc' => 'Publikálva (növekvő)',
        'published_at_desc' => 'Publikálva (csökkenő)'
    ],
    'sitemap' => [
        'post_list' => 'Bejegyzés lista',
        'post_page' => 'Bejegyzés oldal'
    ]
];
