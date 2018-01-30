<?php

return [
    'plugin' => [
        'name' => 'News and Newsletter',
        'description' => 'Simple news and newsletter plugin.',
        'author' => 'Gergő Szabó',
    ],
    'menu' => [
        'news' => 'News',
        'posts' => 'Posts',
        'categories' => 'Categories',
        'subscribers' => 'Subscribers',
        'statistics' => 'Statistics',
        'import' => 'Import',
        'export' => 'Export',
        'logs' => 'Logs',
        'settings' => 'Settings'
    ],
    'title' => [
        'posts' => 'post',
        'categories' => 'category',
        'subscribers' => 'subscriber'
    ],
    'new' => [
        'posts' => 'New post',
        'categories' => 'New category',
        'subscribers' => 'New subscriber'
    ],
    'stat' => [
        'posts' => 'Post|Posts',
        'view' => 'View',
        'mail' => 'Sent',
        'loss' => 'Loss',
        'top' => 'TOP',
        'longest' => 'Longest',
        'shortest' => 'Shortest',
        'queued' => 'In queue',
        'send' => 'Send',
        'sent' => 'Sent',
        'viewed' => 'Viewed',
        'click' => 'Clicks',
        'clicked' => 'Clicked',
        'failed' => 'Failed',
        'log' => [
            'events' => 'Events',
            'summary' => 'Summary'
        ]
    ],
    'form' => [
        // General
        'id' => 'ID',
        'created' => 'Created at',
        'updated' => 'Updated at',
        // Posts
        'title' => 'Title',
        'slug' => 'Slug',
        'introductory' => 'Introductory',
        'content' => 'Content',
        'image' => 'Image',
        'category' => 'Category',
        'status' => 'Status',
        'status_published' => 'Published',
        'status_hide' => 'Hidden',
        'status_draft' => 'Draft',
        'status_active' => 'Active',
        'status_inactive' => 'Inactive',
        'status_unsubscribed' => 'Unsubscribed',
        'featured' => 'Featured',
        'hidden' => 'Is hidden?',
        'yes' => 'Yes',
        'no' => 'No',
        'view' => 'view',
        'published' => 'Published at',
        'last_send_at' => 'Last send at',
        'last_send' => 'Last send',
        'length' => 'Length',
        // Subscribers
        'name' => 'Name',
        'email' => 'E-mail',
        'categories_comment' => 'If no category is selected then the subscriber will receive the all newsletters.',
        'comment' => 'Comment',
        'locale' => 'Locale',
        'lang' => 'en',
        'mail' => 'mail',
        // Logs
        'news' => 'Post',
        'subscriber_name' => 'Subscriber name',
        'subscriber_email' => 'Subscriber email',
        'queued_at' => 'In queue',
        'send_at' => 'Sent',
        'viewed_at' => 'Viewed',
        'clicked_at' => 'Clicked',
        'logs_count' => 'Logs entries'
    ],
    'button' => [
        'activate' => 'Activate',
        'deactivate' => 'Hide',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'reorder' => 'Reorder',
        'import' => 'Import',
        'export' => 'Export',
        'unsubscribe' => 'Unsubscribe',
        'subscribe' => 'Subscription',
        'test' => 'Send test mail',
        'send' => 'Send newsletter',
        'send_confirmation' => 'Do you want to send the newsletter?',
        'resend' => 'Resend newsletter',
        'resend_confirmation' => 'Do you want to resend the newsletter?',
        'return' => 'Return'
    ],
    'flash' => [
        'activate' => 'Successfully activated those posts.',
        'deactivate' => 'Successfully deactivated those posts.',
        'subscribe' => 'Successfully subscribed those users.',
        'unsubscribe' => 'Successfully unsubscribed those users.',
        'delete' => 'Do you want to delete this items?',
        'remove' => 'Successfully removed those items.',
        'newsletter_test_error' => 'An error occurred during sending the test newsletter.',
        'newsletter_send_success' => 'Newsletter was successfully send.',
        'newsletter_send_error' => 'An error occurred during sending the newsletter. Before resending again, take a look in the log to get more information about the current status!',
        'newsletter_resend_success' => 'Newsletter was successfully resend.',
        'newsletter_resend_error' => 'An error occurred during resending the newsletter. Before resending again, take a look in the log to get more information about the current status.'
    ],
    'backend_settings' => [
        'description' => 'Settings about sending newsletters and statistics view.',
        'main_section' => 'Settings about sending and handling newsletters',
        'main_section_comment' => 'Tracking settings can be changed of newsletter mails.',
        'click_tracking' => 'Track clicks',
        'click_tracking_comment' => 'Tracks when a person clicks on a link the newsletter.',
        'email_view_tracking' => 'Track newsletter views',
        'email_view_tracking_comment' => 'Tracks when a person looks at the newsletter.',
        'email_view_tracking_warning' => [
            'heading' => 'Be careful about using this feature',
            'subheading' => 'It is not allowed in every country!',
            'text' => 'When you use this function, you should be sure what you are doing! Make sure that you do not break any laws.'
        ],
        'statistic_section' => 'Statistics settings',
        'statistic_show_posts' => 'Show posts',
        'statistic_show_mails' => 'Show mail logs',
        'statistic_show_longest_posts' => 'Show longest posts',
        'statistic_show_shortest_posts' => 'Show shortest posts'
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
        'categories' => 'Manage categories',
        'subscribers' => 'Manage subscribers',
        'statistics' => 'View statistics',
        'import_export' => 'Import and Export',
        'settings' => 'Change settings',
        'logs' => 'Detailed views for logs'
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
        'list_notfeatured' => 'Not featured',
        'translated_title' => 'Show only translated posts',
        'translated_description' => 'Hide the post, if the language of current post is not equal the website language.'
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
