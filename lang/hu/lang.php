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
        'text' => 'Szöveg',
        'image' => 'Kép',
        'status' => 'Státusz',
        'view' => 'megtekintve',
        'send' => 'Levél küldése a feliratkozottak számára.',
        'online' => 'Bejegyzés megjelenítése a publikus oldalon.',
        // Feliratkozók
        'name' => 'Név',
        'email' => 'E-mail',
        'common' => 'Megjegyzés'
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
        'delete' => 'Valóban törölni akarja a tételeket?',
        'remove' => 'A tételek sikeresen eltávolításra kerültek.'
    ],
    'widget' => [
        'show_total' => 'Összes mutatása',
        'show_active' => 'Aktívak mutatása',
        'show_inactive' => 'Inaktívak mutatása',
        'total' => 'Összes'
    ],
    'permission' => [
        'posts' => 'Bejegyzések kezelése',
        'subscribers' => 'Feliratkozók kezelése'
    ]
];
