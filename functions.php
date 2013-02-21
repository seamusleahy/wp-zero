<?php

// Keep this to pull ZEROTHEME features
require_once dirname( __FILE__ ).'/inc/bootstrap.php';

define( 'ZEROTHEME_VERSION_NUMBER', '0.0.1' );


/**
 * General configuration for the theme
 */
add_action( 'after_setup_theme', 'ZEROTHEME_setup' );
function ZEROTHEME_setup() {

	// Set the X-UA-Compatible for IE because the issue with the conditional comments and the meta element
	if( !is_admin() ) {
		header("X-UA-Compatible: IE=edge,chrome=1");
	}

	// Add default posts and comments RSS feed links to head
	// add_theme_support( 'automatic-feed-links' );


	// ———————————————————————————————-
	// Set image sizes
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	// ———————————————————————————————-
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 150, true ); // Default thumbnail size
	// add_image_size( 'my-custom-image-size', 220, 185, true );


	// ———————————————————————————————-
	// Register widget regions
	// http://codex.wordpress.org/Function_Reference/register_sidebar
	// ———————————————————————————————-
	register_sidebar( array(
			'id' => 'primary-sidebar',
			'name' => __( 'Primary Sidebar', 'ZEROTHEME' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
		) );


	// ———————————————————————————————-
	// Register menu location
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	// ———————————————————————————————-
	add_theme_support( 'menus' );
	register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'ZEROTHEME' )
			//, 'footer' => __('Footer Navigation'), 'ZEROTHEME' )
			//, 'utility' => __('Utility Navigation'), 'ZEROTHEME')
		) );
}



/**
 * Enqueue theme stylesheet files
 *
 * http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
add_action( 'wp_enqueue_scripts', 'ZEROTHEME_enqueue_styles' );
function ZEROTHEME_enqueue_styles() {
	wp_register_style( 'print', get_template_directory_uri().'/css/print.css', array(), ZEROTHEME_VERSION_NUMBER, 'print' );
	wp_enqueue_style( 'print' );

	wp_register_style( 'screen', get_template_directory_uri().'/css/screen.css', array(), ZEROTHEME_VERSION_NUMBER, 'screen' );
	wp_enqueue_style( 'screen' );
}



/**
 * Enqueue theme Javascript files
 *
 * http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 */
add_action( 'wp_enqueue_scripts', 'ZEROTHEME_enqueue_scripts' );
function ZEROTHEME_enqueue_scripts() {
	// Don't load our scripts in the admin section
	wp_register_script( 'modernizr', get_template_directory_uri().'/js/vendor/modernizr.js', array(), '2.6.2' );
	wp_enqueue_script( 'modernizr' );

	// wp_register_script( 'plugins', get_template_directory_uri().'/js/plugins.js', array('jquery'), ZEROTHEME_VERSION_NUMBER);
	// wp_enqueue_script( 'plugins' );

	// The custom script kickoff for your theme. It is placed in the footer, remove the `true` parameter to place in head.
	wp_register_script( 'script', get_template_directory_uri().'/js/script.js', array( 'jquery' ), ZEROTHEME_VERSION_NUMBER, true );
	wp_enqueue_script( 'script' );
}


/**
 * Custom elements in the head for iPhone and iPad configuration.
 */
add_action( 'wp_head', 'ZEROTHEME_head' );
function ZEROTHEME_head() {
	// http://justinavery.me/blog/developing-ipad-web-application/
?>

	<?php
	// Sets the page width to that of the device width instead of 1020px and zooming out.
	// https://developer.mozilla.org/en-US/docs/Mobile/Viewport_meta_tag ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php
	// Add the following code to make the iPad web application go full screen.
?>
	<?php // <meta name="apple-mobile-web-app-capable" content="yes" > ?>

	<?php
	// The color of the Apple status bar when in full screen (default, black, black-translucent)
?>
	<?php //<meta name="apple-mobile-web-app-status-bar-style" content="black"> ?>
	<?php
}
