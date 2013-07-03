<?php

// Create a custom post-type template below in the comment block
// Replace 'CUSTOM TYPE', 'CUSTOM TYPES', and 'CUSTOM-TYPE' with the name for your type.
/*
register_post_type( 'CUSTOM-TYPE',
	// The text to display for referring to the custom post type
	array(
		'labels' => array(
			'name' => __( 'CUSTOM TYPES' ),
			'singular_name' => __( 'CUSTOM TYPE' ),
			'edit_item' => __( 'Edit CUSTOM TYPE' ),
			'update_item' => __( 'Update CUSTOM TYPE' ),
			'all_items' => __( 'All CUSTOM TYPES' ),
			'add_new_item' => __( 'Add CUSTOM TYPE' ),
			'view_item' => __( 'View CUSTOM TYPE' ),
			'search_items' => __( 'Search CUSTOM TYPES' ),
			'not_found' => __( 'No CUSTOM TYPES found' ),
			'not_found_in_trash' => __( 'No CUSTOM TYPES found in Trash' ),
			'parent_item_colon' => '',
			'menu_name' => 'CUSTOM TYPES'
		),

		// Whether a post type is intended to be used publicly either via the admin interface or by front-end users.
		'public' => true,

		// Whether to generate a default UI for managing this post type in the admin.
		'show_ui' => true,

		// Whether to exclude posts with this post type from front end search results.
		'exclude_from_search' => false,
		// 'publicly_queryable' => false, // (defaults to public)
		// 'show_in_nav_menus' => true, // (defaults to public)
		// 'show_in_menu' => false, // (defaults to show_ui)
		// 'show_in_admin_bar' => true, // (default to show_in_menu)

		'capability_type'=> 'post',
		'supports' => array(
			'title',
			'author',
			'thumbnail',
			'editor',
			// 'custom-fields',
			'excerpt',
			'comments',
			// 'page-attributes',
			'revisions',
			// 'post-formats',
			// 'trackbacks',
		),

		// The position in the menu order the post type should appear in the admin menu.
		'menu_position' => 5,

		// An array of registered taxonomies like category or post_tag that will be used with this post type.
		'taxonomies' => array( 'categories' ),

		// Whether the post type is hierarchical (e.g. page).
		'hierarchical' => false,


		// Create a custom icon for the admin menu <http://kremalicious.com/wp-icons-template/>
		// Or use premade http://randyjensenonline.com/thoughts/wordpress-custom-post-type-fugue-icons/
		'menu_icon' => get_bloginfo( 'stylesheet_directory' ).'/img/admin/icon-CUSTOM-TYPE.png'
		
		'rewrite' => array(
			'slug' => 'CUSTOM-TYPES',
			'with_front' => false,
		),

		'has_archive' => true, // Create an archive page
	)
);
*/
