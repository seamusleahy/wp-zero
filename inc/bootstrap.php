<?php
// Include anything that is needed for theme here

/*
 * WP.com VIP setup
 */

//Init WP.com VIP environment
if ( file_exists( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' ) ) {
	require_once WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php';


	if ( defined( 'WPCOM_IS_VIP_ENV' ) && true === WPCOM_IS_VIP_ENV ) {
		// Include resouces only on WordPress.com VIP

	} else {
		// Include resource only for sandbox enviroment
	}

	// Include resources for all enviroments

	// Multiple authors per post
	// http://wordpress.org/extend/plugins/co-authors-plus/
	wpcom_vip_load_plugin( 'co-authors-plus' );

	// Edit Flow empowers you to collaborate with your editorial team inside WordPress.
	// Calendar, define key stages to your workflow, editorial comments, editorial metadata, notifications, story budget, user groups
	// http://wordpress.org/extend/plugins/edit-flow/
	wpcom_vip_load_plugin( 'edit-flow' );

	// The Editorial Calendar makes it possible to see all your posts and drag and drop them to manage your blog. 
	// http://wordpress.org/extend/plugins/editorial-calendar/
	wpcom_vip_load_plugin( 'editorial-calendar' );

	// Associate images from your media library to categories, tags and custom taxonomies.
	// http://wordpress.org/extend/plugins/taxonomy-images/
	wpcom_vip_load_plugin( 'taxonomy-images' );

	// Displays post and comment date and times in the visitor’s timezone using Javascript. 
	// http://wordpress.org/extend/plugins/localtime/
	wpcom_vip_load_plugin( 'localtime' );

	// SEO meta tags
	// Original: http://wordpress.org/extend/plugins/add-meta-tags/
	wpcom_vip_load_plugin( 'add-meta-tags-mod' );

	// Automatically adds alt and title attributes to all your images.
	// Original: http://wordpress.org/extend/plugins/seo-image/
	wpcom_vip_load_plugin( 'seo-friendly-images-mod' );


	// Allows for greater control over automatically generated excerpts. The size of the excerpt can be limited using character or word count, and certain HTML tags can be allowed.
	// http://wordpress.org/extend/plugins/advanced-excerpt/
	wpcom_vip_load_plugin( 'advanced-excerpt' );

	// WordPress.com Thumbnail Editor provides the ability to control what portion of an image is used for each of the image’s thumbnail sizes.
	wpcom_vip_load_plugin( 'wpcom-thumbnail-editor' );

	// Global custom settings
	// https://github.com/cheezburger/cheezcap
	wpcom_vip_load_plugin( 'cheezcap' );
	
	// Google Analytics
	// http://wordpress.org/extend/plugins/wp-google-analytics/
	wpcom_vip_load_plugin( 'wp-google-analytics' );

	// Modify the_excerpt() template code during search to return snippets containing the search phrase.
	// http://scott.yang.id.au/code/search-excerpt/
	wpcom_vip_load_plugin( 'search-excerpt' );

}



/**
 * Start loading up theme helper features
 */
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/template-loaders.php';

add_action( 'after_setup_theme', 'rare_load_features' );
function ZEROTHEME_load_features() {
	$path = __DIR__ . '/features/';
	;

	$features = array(
		// Configures the WYSIWYG editor to add .prose class to content
		'css-editor',

		// Use the thread comments script to move the comment field below where replying
		'thread-comments-script',

		// Provided better class names on the menu items
		'menu-class-names',

		// Auto-linking images/favicon.ico as the favicon
		'favicon',

		// Auto-link images/apple-touch-icon[-<X>x<Y>][-precomposed].png as the Apple touch icons
		'apple-touch-icon',

		// Adds css/login.less to the login screen and changes the WordPress logo to link to the homepage and read your name
		'login-theme',

		// Adds the function ZEROMTHEME_paginate_index_links() which wraps WP's paginate_links to work for index pages instead of just paginated posts
		'pager',

		// Make the wp_page_menu function follow the args betters passed from wp_nav_menu
		'wp-page-menu',

		// Removes the embed style element for the gallery printed with shortcode
		'remove-gallery-css',

		// Clean up the comment output
		'comments',

		// Add customization of page title
		'page-title',

		// Will set images/apple-touch-startup-image.png as the web-app start up image (320x460px)
		'apple-touch-startup-image',

		// Add the nav element to acceptable elements for the menu
		'nav-menu-container',

		// Give you helper functions to work with the nav menus
		'nav-menu-helpers',

		// Give you helper functions to work with posts
		'posts-helpers',

		// Easy Ajax callbacks
		'ZEROMTHEME_themeajax',
	);

	foreach ( $features as $feature ) {
		require $path.$feature.'.php';
	}
}


// Load up post types and their fields
add_action( 'init', 'ZEROTHEME_register_custom_data_structure' );
function ZEROTHEME_register_custom_data_structure() {
	require_once __DIR__ . '/taxonomy.php';
	require_once __DIR__ . '/post-types.php';
	require_once __DIR__ . '/fields.php';
}

// Load up global user configurable settings
require_once __DIR__ . '/cheezcap-config.php';
