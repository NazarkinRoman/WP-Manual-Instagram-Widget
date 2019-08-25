# WP Manual Instagram Widget

This plugin is built as a replacement for [WP Instagram Widget](https://github.com/scottsweb/wp-instagram-widget/blob/master/readme.md) plugin by @scottsweb.
Scott did a great work on this, but latest Instagram markup changes frequently break functionality of his solution and also Instagram plans to close their public API in early 2020
so after that we won't have any possible way to scrape data from there.

This plugin provides all the same filters and actions that [original one](https://github.com/scottsweb/wp-instagram-widget/blob/master/readme.md) do:

```php
add_filter( 'wpiw_list_class', 'my_instagram_class' );

add_filter( 'wpiw_item_class', 'my_instagram_class' );
add_filter( 'wpiw_a_class', 'my_instagram_class' );
add_filter( 'wpiw_img_class', 'my_instagram_class' );
add_filter( 'wpiw_linka_class', 'my_instagram_class' );

function my_instagram_class( $classes ) {
	$classes = "instagram-image";
	return $classes;
}

// also it supports actions
add_action( 'wpiw_before_widget', 'my_before_widget_cb' );
add_action( 'wpiw_after_widget', 'my_after_widget_cb' );

function wpiw_before_widget( $instance ) {
    // do some stuff here
}
```

This makes you able to use it just as a drop-in replacement for [WP Instagram Widget](https://github.com/scottsweb/wp-instagram-widget/blob/master/readme.md). Very useful for theme developers who wants to maintain their demo in a working state without being attached to the Instagram markup or API policy changes.

## How it looks inside

![WP Manual Instagram Widget](screenshot.png)

## Installation

To install this plugin:

* Upload the `wp-manual-instagram-widget` folder to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress
* That's it!

Alternatively you can search for the plugin from your WordPress dashboard and install from there.

Visit [WordPress.org for a comprehensive guide](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation) on in how to install WordPress plugins.
