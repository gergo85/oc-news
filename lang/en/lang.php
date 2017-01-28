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
        'subscribers' => 'Subscribers',
        'statistics' => 'Statistics',
        'import' => 'Import',
        'export' => 'Export'
    ],
    'title' => [
        'posts' => 'post',
        'subscribers' => 'subscriber'
    ],
    'new' => [
        'posts' => 'New post',
        'subscribers' => 'New subscriber'
    ],
    'stat' => [
        'posts' => 'Post|Posts',
        'view' => 'View',
        'mail' => 'Sent',
        'top' => 'TOP',
        'longest' => 'Longest',
        'shortest' => 'Shortest'
    ],
    'form' => [
        // General
        'created' => 'Created at',
        'updated' => 'Updated at',
        // Posts
        'id' => 'ID',
        'title' => 'Title',
        'slug' => 'Slug',
        'introductory' => 'Introductory',
        'content' => 'Content',
        'image' => 'Image',
        'status' => 'Status',
        'status_published' => 'Published',
        'status_hide' => 'Hidden',
        'status_draft' => 'Draft',
        'status_active' => 'Active',
        'status_unsubscribed' => 'Unsubscribed',
        'featured' => 'Featured',
        'yes' => 'Yes',
        'no' => 'No',
        'view' => 'view',
        'published' => 'Published at',
        'send' => 'Send the e-mail to subscribers.',
        'length' => 'Length',
        // Subscribers
        'name' => 'Name',
        'email' => 'E-mail',
        'common' => 'Common',
        'mail' => 'mail'
    ],
    'button' => [
        'activate' => 'Activate',
        'deactivate' => 'Hide',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'import' => 'Import',
        'export' => 'Export',
        'return' => 'Return'
    ],
    'flash' => [
        'activate' => 'Successfully activated those posts.',
        'deactivate' => 'Successfully deactivated those posts.',
        'delete' => 'Do you want to delete this items?',
        'remove' => 'Successfully removed those items.'
    ],
    'widget' => [
        'posts' => 'News - Posts',
        'subscribers' => 'News - Subscribers',
        'show_total' => 'Show total',
        'show_active' => 'Show active',
        'show_inactive' => 'Show inactive',
        'show_draft' => 'Show draft',
        'total' => 'Total'
    ],
    'component' => [
        'posts' => 'Display posts',
        'post' => 'Show post content',
        'form' => 'Subscriber form',
        'stat' => 'Count visitors'
    ],
    'permission' => [
        'posts' => 'Manage posts',
        'subscribers' => 'Manage subscribers',
        'statistics' => 'View statistics',
        'import_export' => 'Import and Export'
    ],
    'settings' => [
        'post_title' => 'Post',
        'post_description' => 'Displays a post on the page.',
        'post_slug_title' => 'Post slug',
        'post_slug_description' => "Look up the post using the supplied slug value.",
        'posts_title' => 'Post List',
        'posts_description' => 'Displays a list of latest posts on the page.',
        'posts_pagination_title' => 'Page number',
        'posts_pagination_description' => 'This value is used to determine what page the user is on.',
        'posts_per_page_title' => 'Posts per page',
        'posts_per_page_validation' => 'Invalid format of the posts per page value',
        'posts_no_posts_title' => 'No posts message',
        'posts_no_posts_description' => 'Message to display in the post list in case if there are no posts. This property is used by the default component partial.',
        'posts_no_posts_found' => 'No posts found',
        'posts_order_title' => 'Post order',
        'posts_order_description' => 'Attribute on which the posts should be ordered',
        'posts_post_title' => 'Post page',
        'posts_post_description' => 'Name of the post page file for the "Learn more" links. This property is used by the default component partial.',
        'posts_featured_title' => 'Featured Listing',
        'posts_featured_description' => 'Choose which Posts to show',
        'posts_list_all' => 'All',
        'posts_list_featured' => 'Only Featured',
        'posts_list_notfeatured' => 'Not featured'
    ],
    'sorting' => [
        'title_asc' => 'Title (ascending)',
        'title_desc' => 'Title (descending)',
        'created_at_asc' => 'Created (ascending)',
        'created_at_desc' => 'Created (descending)',
        'updated_at_asc' => 'Updated (ascending)',
        'updated_at_desc' => 'Updated (descending)',
        'published_at_asc' => 'Published (ascending)',
        'published_at_desc' => 'Published (descending)'
    ],
    'sitemap' => [
        'post_list' => 'Post list',
        'post_page' => 'Post page'
    ]
];
