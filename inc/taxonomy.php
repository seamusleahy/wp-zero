<?php

// Create a custom taxonomies from the template in the comment block.
// Replace 'CUSTOM TERM', 'CUSTOM TERMS', and 'CUSTOM-TERM' with the name for your taxonomy.
/*
register_taxonomy( 'CUSTOM-TERMS', 
	array( 'post' ),
	array(
		'labels' => array(
			'name' => __( 'CUSTOM TERMS' ),
			'singular_name' => __( 'CUSTOM TERM' ),
			'search_items' => __( 'Search CUSTOM TERMS' ),
			'popular_items' => __( 'Popular CUSTOM TERMS' ),
			'all_items' => __( 'All CUSTOM TERMS' ),
			'parent_item' => __( 'Parent CUSTOM TERM' ),
			//'parent_item_colon' => __( 'Parent CUSTOM TERM:' ),
			'edit_item' => __( 'Edit CUSTOM TERM' ),
			'update_item' => __( 'Update CUSTOM TERM'),
			'add_new_item' => __( 'Add New CUSTOM TERM' ),
			'new_item_name' => __( 'New CUSTOM TERM Name' ),
			//'separate_items_with_commas' => 
			'add_or_remove_items' => __( 'Add or remove CUSTOM TERM' ),
			'choose_from_most_used' => __( 'Choose from the most used CUSTOM TERM' ),
			'menu_name' => 'CUSTOM TERMS',
		),

		'hierarchical' => false,

		'public' => true,
		'show_ui' => true,
		// 'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_admin_column' => true,
		// 'update_count_callback' => function(){}
		// 'query_var' => 'CUSTOM-TERM'

		'rewrite' => array(
			'slug' => 'CUSTOM-TERMS',
			'with_front' => false,
			'hierarchical' => false,
		),

		// 'capabilities' => array( ),
		// 'sort' =>

	)
);
*/