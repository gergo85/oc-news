# News & Newsletter plugin
Plugin can be used for publishing news simply on the website. In contrary of blog, writing comments is not possible, but visitors can subscribe on a newsletter system. During publishing news posts are available not just on the website but you can send them via email to subscribed users.

Plugin is same like put together a blog and a newsletter plugin. The main difference is that it is simpler and contains only the most necessary functions. So this makes easier uploading new contents and inform visitors.

- [Main features](#main_features)
- [Statistics and graphs](#statistics)
- [Advanced SEO support](#seo_support)
- [Automatic statistics](#autostat)
- [Preview feature](#preview)
- [Quick navigation](#quick_navigation)
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
* Managing nested categories
* Managing subscribers
* Support the SEO
* Support the GDPR
* Export & Import data
* Statistics and graphs
* Send newsletter
* Detailed mail logs
* Front-end forms
* Back-end widgets
* Available extensions
* Innovative solutions

<a name="statistics"></a>
## Statistics and graphs
* Graph - Posts in this year
* Graph - Posts in last year
* List - TOP 20 view posts
* List - TOP 10 longest posts
* List - TOP 10 shortest posts
* Graph - Mail events
* Graph - Mail summary

<a name="seo_support"></a>
## Advanced SEO support
You can enable this feature on the __Settings > CMS > News & Newsletter__ page. If you use it, you should replace the title and meta description tags with the following lines:
```
<title>{% if post.seo_title %}{{ post.seo_title }}{% elseif this.page.meta_title %}{{ this.page.meta_title }}{% else %}{{ this.page.title }}{% endif %}</title>
<meta name="description" content="{% if post.seo_desc %}{{ post.seo_desc }}{% elseif this.page.meta_description %}{{ this.page.meta_description }}{% else %}{{ this.page.description }}{% endif %}">
{% if post.seo_image %}<meta property="og:image" content="{{ post.seo_image|media }}">{% endif %}
```

### Additional SEO Configuration

Additionally, the following has been introduced for better SEO
- A canonical URL specification tag
- The use of the default post image as the seo image
- A list of meta keywords made up of from post category and tags, the user adds to their post.

Along side the snippet above, you can add the following code the head of your theme files.

```
 <link rel="canonical" href="{{ this.page.meta_canonical }}">
 <link rel="image_src" href="{{ this.page.meta_image_src|media }}">
 <meta name="keywords" content="{{ this.page.meta_keywords }}"> 
```

You should include the `meta_image_src` only you don't use the post seo image to avoid confusion.

<a name="autostat"></a>
## Automatic statistics
You just add the "Post content" front-end component to the page, where the post appears. If you are logged in as administrator, the counter will not grow. It works any cases, when the visitors open the post details.

<a name="preview"></a>
## Preview feature
You just add the "Post content" front-end component to the current page. If you modify a news, the "Preview" link appears along the left of the delete icon. If you are logged in as administrator, you can read the hidden and draft news too.

<a name="quick_navigation"></a>
## Quick navigation
If you modify any content, one or two arrows appear along the right of the delete icon. There are the navigation links. You can simply go to the previous or next content.

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
* {{ post.categories }} - Categories of post
* {{ post.tags }} - List of tags in array
* {{ post.seo_title }} - SEO title
* {{ post.seo_keywords }} - SEO keywords
* {{ post.seo_desc }} - SEO description
* {{ post.seo_image|media }} - Full url of image
* {{ post.status }} - Status of post (1: published, 2: hide, 3: draft)
* {{ post.featured }} - Is post featured? (1: yes, 2: no)
* {{ post.next() }} - First post after current post
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
* [TimFoerster NewsPdf](https://octobercms.com/plugin/timfoerster-newspdf)
* [ReaZzon Gutenberg](https://octobercms.com/plugin/reazzon-gutenberg)

<a name="supported_plugins"></a>
## Supported plugins
* [RainLab Translate](https://octobercms.com/plugin/rainlab-translate)
* [RainLab Sitemap](https://octobercms.com/plugin/rainlab-sitemap)
* [Offline SiteSearch](https://octobercms.com/plugin/offline-sitesearch)
* [Indikator Popup](https://octobercms.com/plugin/indikator-popup)

<a name="available_languages"></a>
## Available languages
* en - English
* de - Deutsch
* ru - Pу́сский
* hu - Magyar
* pl - Polski
* pt - Português
* zh-TW - Taiwanese, Traditional Chinese

<a name="requirements"></a>
## Requirements
* October CMS v1.0.420 or newer version.
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
