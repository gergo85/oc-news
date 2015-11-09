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
        'subscribers' => 'Feliratkozók'
    ],
    'title' => [
        'posts' => 'bejegyzés',
        'subscribers' => 'feliratkozó'
    ],
    'new' => [
        'posts' => 'Új bejegyzés',
        'subscribers' => 'Új feliratkozó'
    ],
    'form' => [
        // Általános
        'statistics' => 'Statisztika',
        'created' => 'Létrehozva',
        'updated' => 'Módosítva',
        // Bejegyzések
        'title' => 'Cím',
        'slug' => 'Webcím',
        'introductory' => 'Bevezető',
        'content' => 'Tartalom',
        'image' => 'Kép',
        'status' => 'Státusz',
        'status_published' => 'Publikálva',
        'status_hide' => 'Rejtve',
        'status_draft' => 'Piszkozat',
        'view' => 'megtekintés',
        'published' => 'Publikálva',
        'send' => 'Levél küldése a feliratkozottak számára.',
        // Feliratkozók
        'name' => 'Név',
        'email' => 'E-mail',
        'common' => 'Megjegyzés',
        'mail' => 'levél'
    ],
    'button' => [
        'activate' => 'Aktíválás',
        'deactivate' => 'Deaktiválás',
        'active' => 'Aktív',
        'inactive' => 'Inaktív',
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
        'subscribers' => 'Feliratkozók kezelése'
    ],
    'settings' => [
        'post_title' => 'Bejegyzés',
        'post_description' => 'Egy bejegyzést jelez ki a lapon.',
        'post_slug' => 'Keresőbarát cím paraméter neve',
        'post_slug_description' => 'A webcím útvonal paramétere a bejegyzés keresőbarát címe alapján való kereséséhez.',
        'posts_title' => 'Bejegyzések',
        'posts_description' => 'A legújabb bejegyzéseket listázza ki a lapon.',
        'posts_pagination' => 'Lapozósáv paraméter neve',
        'posts_pagination_description' => 'A lapozósáv lapjai által használt, várt paraméter neve.',
        'posts_per_page' => 'Bejegyzések laponként',
        'posts_per_page_validation' => 'A laponkénti bejegyzések értéke érvénytelen formátumú',
        'posts_no_posts' => 'Nincsenek bejegyzések üzenet ',
        'posts_no_posts_description' => 'A bejegyzés listában kijelezendő üzenet abban az esetben, ha nincsenek bejegyzések. Az alapértelmezett komponensrész használja ezt a tulajdonságot.',
        'posts_no_posts_found' => 'Nincsenek bejegyzések',
        'posts_order' => 'Bejegyzések sorrendje',
        'posts_order_decription' => 'Attribútum, mely alapján rendezni kell a bejegyzéseket',
        'posts_post' => 'Bejegyzéslap',
        'posts_post_description' => 'A "Tovább olvasom" hivatkozások bejegyzés lap fájljának neve. Az alapértelmezett komponensrész használja ezt a tulajdonságot.'
    ],
    'sorting' => [
        'title_asc' => 'Név (emelkedő)',
        'title_desc' => 'Név (csökkenő)',
        'created_at_asc' => 'Létrehozva (emelkedő)',
        'created_at_desc' => 'Létrehozva (csökkenő)',
        'updated_at_asc' => 'Frissítve (emelkedő)',
        'updated_at_desc' => 'Frissítve (csökkenő)',
        'published_at_asc' => 'Publikálva (emelkedő)',
        'published_at_desc' => 'Publikálva (csökkenő)'
    ]
];
