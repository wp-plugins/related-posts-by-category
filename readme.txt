=== Related Posts by Category ===
Contributors: stalkerX
Tags: similar posts, related posts, similar, related, posts, category
Requires at least: 2.3
Tested up to: 2.8.6
Stable tag: trunk

The WordPress Plugin for Similar Posts. It's small. It's fast. Really!


== Description ==
*Related Posts by Category* lists similar posts within any post. As a search string the plugin does not use the title of the article nor weighs the content. In fact the category, which was assigned to the post, serves as the source of accordance.

= Features =
* Very fast execution
* No user interface required
* Quick query in only one sql statement
* Quantity of results and further options are adjustable
* Foolproven implementing of this plugin

= Mode of operation =
Just put `<?php related_posts_by_category(params) ?>` in your *single.php* template for display a list of similar posts.

= Example =
`
<ul>
  <?php
  related_posts_by_category(
    array(
      'orderby' => 'RAND',
      'order' => 'DESC',
      'limit' => 5,
      'echo' => true,
      'before' => '<li>',
      'inside' => '&raquo; ',
      'outside' => '',
      'after' => '</li>',
      'rel' => 'nofollow',
      'type' => 'post',
      'message' => 'no matches'
    )
  );
  ?>
</ul>
`
Please adjust the parameters accordingly.


= Documentation =
* [*Related Posts by Category* documentation in English](http://playground.ebiene.de/400/related-posts-by-category-the-wordpress-plugin-for-similar-posts/ "Related Posts by Category")
* [*Related Posts by Category* documentation in German](http://playground.ebiene.de/356/related-posts-by-category-wp-plugin-fur-verwandte-beitrage-einer-kategorie/ "Related Posts by Category")
* [Follow us on Twitter for updates](http://twitter.com/wpSEO "wpSEO on Twitter")


== Changelog ==
= 0.4 =
* Increase the security of the database query

= 0.3 =
* By chance generated display of results with *orderby* => *RAND*

= 0.2 =
* *post* or *page* as a parameter for type value

= 0.1 =
* *Related Posts by Category* goes online


== Installation ==
1. Download plugin
1. Unzip the archive
1. Upload the file *related_posts.php* into *../wp-content/plugins/*
1. Go to tab *Plugins*
1. Activate *Related Posts by Category*
1. Ready


== Frequently Asked Questions ==
= Documentation =
* [*Related Posts by Category* documentation in English](http://playground.ebiene.de/400/related-posts-by-category-the-wordpress-plugin-for-similar-posts/ "Related Posts by Category")
* [*Related Posts by Category* documentation in German](http://playground.ebiene.de/356/related-posts-by-category-wp-plugin-fur-verwandte-beitrage-einer-kategorie/ "Related Posts by Category")
* [Follow us on Twitter for updates](http://twitter.com/wpSEO "wpSEO on Twitter")