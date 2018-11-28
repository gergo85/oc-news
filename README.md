# News & Newsletter plugin
Plugin can be used for publishing news simply on the website. In contrary of blog, writing comments is not possible, but visitors can subscribe on a newsletter system. During publishing news posts are available not just on the website but you can send them via email to subscribed users.

Plugin is same like put together a blog and a newsletter plugin. The main difference is that it is simpler and contains only the most necessary functions. So this makes easier uploading new contents and inform visitors.

- [Main features](#main_features)
- [Statistics and graphs](#statistics)
- [Automatic statistics](#autostat)
- [Preview feature](#preview)
- [Available widgets](#available_widgets)
- [Available components](#available_components)
- [HTML template variables](#html_template)
- [Mail template variables](#mail_template)
- [Useful extensions](#eseful_extensions)
- [Supported plugins](#supported_plugins)
- [Available languages](#available_languages)
- [Requirements](#requirements)
- [Installation](#installation)
- [Add back-end widgets](#backend_widgets)
- [Credits](#credits)

<a name="main_features"></a>
## Main features
* Managing posts
* Managing categories
* Managing subscribers
* Support the GDPR
* Export & Import data
* Statistics and graphs
* Send newsletter
* Detailed mail logs
* Front-end forms
* Back-end widgets
* Available extensions
* Innovative solutions
* Regular updates

<a name="statistics"></a>
## Statistics and graphs
* Graph - Posts in this year
* Graph - Posts in last year
* List - TOP 20 view posts
* List - TOP 10 longest posts
* List - TOP 10 shortest posts
* Graph - Mail events
* Graph - Mail summary

<a name="autostat"></a>
## Automatic statistics
You just add the "Post content" front-end component to the page, where the post appears. If you are logged in as administrator, the counter will not grow. It works any cases, when the visitors open the post details.

<a name="preview"></a>
## Preview feature
You just add the "Post content" front-end component to the current page. If you modify a news, the "Preview" link appears along the left of the delete icon. If you are logged in as administrator, you can read the hidden and draft news too.

<a name="available_widgets"></a>
## Available widgets
You can use the following widgets on the back-end Dashboard:
* Post statistics
* Subscriber statistics
* List of TOP posts
* List of new posts

<a name="available_components"></a>
## Available components
Use the __Components > News__ panel in CMS menu. At this moment there are the following components:
* Display posts
* Post content
* List categories
* Subscriber form
* Unsubscribe form

<a name="html_template"></a>
## HTML template variables
__For post__
* {{ posts }} - List of posts in array
* {{ posts.render|raw }} - Build-in pagination
* {{ post.title }} - Title of post
* {{ post.slug }} - Slug of post
* {{ post.image|media }} - Full url of post image
* {{ post.introductory|raw }} - Summary of post
* {{ post.content|raw }} - Content of post
* {{ post.published_at }} - Published date of post
* {{ post.category }} - ID of category (0: no category selected)
* {{ post.tags }} - List of tags in array
* {{ post.status }} - Status of post (1: published, 2: hide, 3: draft)
* {{ post.featured }} - Is post featured? (1: yes, 2: no)
* {{ post.next() }} -  First post after current post
* {{ post.prev() }} - Last post before current post

__For category__
* {{ categories }} - List of categories in array
* {{ category.name }} - Name of category
* {{ category.slug }} - Slug of category
* {{ category.image|media }} - Full url of category image
* {{ category.content|raw }} - Content of category
* {{ category.status }} - Status of post (1: published, 2: hide)
* {{ category.hidden }} - Is category hidden? (1: yes, 2: no)

__For user (Backend User)__
All attributes and methods available in `Backend\Models\User` are accesible via {{ post.user }}. Examples:

* {{ post.user.first_name }} - Post author first name (attribute)
* {{ post.user.email }} - Post author email (attribute)
* {{ post.user.getFullNameAttribute }} - Post author full name (method)
* {{ post.user.getAvatarThumb }} - Public path to author avatar (method)

Checkout the `Backend\Models\User` interface and attributes for all possibilities.

<a name="mail_template"></a>
## Mail template variables
* {{ name }} - Name of subscriber
* {{ email }} - E-mail of subscriber
* {{ title }} - Title of post
* {{ slug }} - Slug of post
* {{ introductory }} - Introductory of post
* {{ summary }} - Alias of introductory
* {{ plaintext }} - Introductory without HTML elements
* {{ content }} - Content of post
* {{ image }} - Relative path of post image

You can customize the layout of emails in the __Settings > Mail > Mail templates__ page.

<a name="eseful_extensions"></a>
## Useful extensions
* [FennCS Page Views](https://octobercms.com/plugin/fenncs-newspageviews)
* [TimFoerster NewsPdf](http://octobercms.com/plugin/timfoerster-newspdf)

<a name="supported_plugins"></a>
## Supported plugins
* [RainLab Translate](http://octobercms.com/plugin/rainlab-translate)
* [RainLab Sitemap](http://octobercms.com/plugin/rainlab-sitemap)
* [Offline SiteSearch](http://octobercms.com/plugin/offline-sitesearch)
* [Indikator Popup](http://octobercms.com/plugin/indikator-popup)

<a name="available_languages"></a>
## Available languages
* en - English
* de - Deutsch
* ru - Pу́сский
* hu - Magyar
* pl - Polski
* pt - Português

<a name="requirements"></a>
## Requirements
* OctoberCMS build 420 or newer version.
* [AJAX Framework](https://octobercms.com/docs/ajax) is needed for the subscription form to work.

<a name="installation"></a>
## Installation
1. Go to the __Settings > Updates & Plugins__ page in the Backend.
1. Click on the __Install plugins__ button.
1. Type the __News & Newsletter__ text in the search field.

<a name="backend_widgets"></a>
## Add back-end widgets
1. Go to the __Dashboard__ page in the Backend.
1. Click on the __Manage widgets > Add widget__ button.
1. Select the any __News widgets__ from the list.

<a name="credits"></a>
## Credits
* Special thanks to [TimFoerster](https://github.com/TimFoerster)
* Good-looking chart: [Morris.js](http://morrisjs.github.io/morris.js)
* Graphics library: [Raphaël JS](http://dmitrybaranovskiy.github.io/raphael)
