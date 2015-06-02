<?php

return [
    'plugin' => [
        'name' => 'News and Newsletter',
        'description' => 'Simple news and newsletter plugin.',
        'author' => 'Gergő Szabó'
    ],
    'menu' => [
        'news' => 'News',
        'posts' => 'Posts',
        'subscribers' => 'Subscribers'
    ],
    'title' => [
        'posts' => 'post',
        'subscribers' => 'subscriber'
    ],
    'new' => [
        'posts' => 'New post',
        'subscribers' => 'New subscriber'
    ],
    'form' => [
        // General
        'statistics' => 'Statistics',
        'created' => 'Created at',
        'updated' => 'Updated at',
        // Posts
        'title' => 'Title',
        'slug' => 'Slug',
        'text' => 'Text',
        'image' => 'Image',
        'status' => 'Status',
        'view' => 'view',
        'send' => 'Send the e-mail to subscribers.',
        'online' => 'Show the post on public page.',
        // Subscribers
        'name' => 'Name',
        'email' => 'E-mail',
        'common' => 'Common'
    ],
    'button' => [
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'return' => 'Return'
    ],
    'flash' => [
        'activate' => 'Successfully activated those posts.',
        'deactivate' => 'Successfully deactivated those posts.',
        'delete' => 'Do you really want to delete this items?',
        'remove' => 'Successfully removed those items.'
    ],
    'widget' => [
        'show_total' => 'Show total',
        'show_active' => 'Show active',
        'show_inactive' => 'Show inactive',
        'total' => 'Total'
    ],
    'permission' => [
        'posts' => 'Manage posts',
        'subscribers' => 'Manage subscribers'
    ]
];
