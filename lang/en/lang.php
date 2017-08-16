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
        'loss' => 'Loss',
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
        'locale' => 'Locale',
        'lang' => 'en',
        'mail' => 'mail'
    ],
    'button' => [
        'activate' => 'Activate',
        'deactivate' => 'Hide',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'import' => 'Import',
        'export' => 'Export',
        'unsubscribe' => 'Unsubscribe',
        'subscribe' => 'Subscription',
        'return' => 'Return'
    ],
    'flash' => [
        'activate' => 'Successfully activated those posts.',
        'deactivate' => 'Successfully deactivated those posts.',
        'subscribe' => 'Successfully subscribed those users.',
        'unsubscribe' => 'Successfully unsubscribed those users.',
        'delete' => 'Do you want to delete this items?',
        'remove' => 'Successfully removed those items.'
    ],
    'widget' => [
        'posts' => 'News - Posts',
        'newposts' => 'News - New posts',
        'topposts' => 'News - Top posts',
        'subscribers' => 'News - Subscribers',
        'show_total' => 'Show total',
        'show_active' => 'Show active',
        'show_inactive' => 'Show inactive',
        'show_draft' => 'Show draft',
        'show_piece' => 'Number of posts',
        'show_date' => 'Show date',
        'show_unsub' => 'Show unsubscribed',
        'total' => 'Total'
    ],
    'component' => [
        'posts' => 'Display posts',
        'post' => 'Post content',
        'subscribe' => 'Subscriber form',
        'unsubscribe' => 'Unsubscribe form'
    ],
    'permission' => [
        'posts' => 'Manage posts',
        'subscribers' => 'Manage subscribers',
        'statistics' => 'View statistics',
        'import_export' => 'Import and Export'
    ],
    'settings' => [
        'slug_title' => 'Post slug',
        'slug_description' => 'Look up the post using the supplied slug value.',
        'pagination_title' => 'Page number',
        'pagination_description' => 'This value is used to determine what page the user is on.',
        'per_page_title' => 'Posts per page',
        'per_page_validation' => 'Invalid format of the posts per page value',
        'no_posts_title' => 'No posts message',
        'no_posts_description' => 'Message to display in the post list in case if there are no posts. This property is used by the default component partial.',
        'no_posts_found' => 'No posts found',
        'posts_order_title' => 'Post order',
        'posts_order_description' => 'Attribute on which the posts should be ordered',
        'post_title' => 'Post page',
        'post_description' => 'Name of the post page file for the "Learn more" links. This property is used by the default component partial.',
        'featured_title' => 'Featured Listing',
        'featured_description' => 'Choose which Posts to show',
        'list_all' => 'All',
        'list_featured' => 'Only Featured',
        'list_notfeatured' => 'Not featured'
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
    ],
    'messages' => [
        'unsubscribed' => 'We successfully unsubscribed you from our newsletter.',
        'not_subscribed' => 'Already subscribed to our newsletter.',
        'subscribed' => 'Thank you for your subscription to our newsletter!'
    ]
];
