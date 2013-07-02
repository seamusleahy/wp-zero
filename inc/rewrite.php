<?php

/**
 * Customize the rewrite rules
 */


/**
 * Register our rewrite rules on the activation of the theme
 */
function ZEROTHEME_activate_rewrite_rules( $oldname, $oldtheme=false ) {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ZEROTHEME_activate_rewrite_rules', 10, 2 );


/**
 * Customize the rewrite rules
 */
function ZEROTHEME_generate_rewrite_rules( $rewrite ) {

	// // Customize the rewrite rules for a custom post type
	// // Add rewrite tags to use for generating the permalink
	// // Configure the ZEROTHEME_permalink() function in this file
	// $rewrite->add_rewrite_tag( '%custom-taxonomy%', '([^/]+)', "custom-taxonomy=" );
	// $rewrite->add_rewrite_tag( '%custom-post-type%', '([^/]+)', "custom-post-type=" );

	// // Permalink setup
	// // Parameters: $permalink_structure, $ep_mask = EP_NONE, $paged = true, $feed = true, $forcomments = false, $walk_dirs = true, $endpoints = true
	// $custom_post_type_rules = $rewrite->generate_rewrite_rules( '/the/path/to/the/%custom-taxonomy%/%custom-post-type%/', EP_PERMALINK, true, false, false, false );


	// // Custom rewrite rules
	// $custom_rules = array(
	// 	'the/path/to/([^/]+)/page/([0-9]{1,})' => 'index.php?query_var=$matches[1]&paged=$matches[2]',
	// 	'the/path/to/([^/]+)'                  => 'index.php?query_var=$matches[1]',
	// );

	// $rewrite->rules = $custom_post_type_rules + $custom_rules + $rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'ZEROTHEME_generate_rewrite_rules' );


/**
 * Alter the term permalinks
 */
function ZEROTHEME_get_term_link( $termlink, $term, $taxonomy ) {

	// // Customize the term permalinks for a custom taxonomy
	// if ( $taxonomy == 'custom-taxonomy' ) {

	// 	// Create the a permalink that are hierarchical
	// 	$hierarchical_slugs = array();
	// 	$ancestors = get_ancestors($term->term_id, $taxonomy);
	// 	foreach ( (array)$ancestors as $ancestor ) {
	// 		$ancestor_term = get_term($ancestor, $taxonomy);
	// 		$hierarchical_slugs[] = $ancestor_term->slug;
	// 	}
	// 	$hierarchical_slugs = array_reverse($hierarchical_slugs);
	// 	$hierarchical_slugs[] = $term->slug;

	// 	return home_url( 'path/to/' . implode('/', $hierarchical_slugs) );

	// 	// Create a non-hierarchical permalink
	// 	return home_url ( 'path/to/' . $term->slug );
	// }

	return $termlink;
}
add_filter('term_link', 'ZEROTHEME_get_term_link', 3, 10 );


/**
 * Alter the permalink for a custom post type
 */
function ZEROTHEME_permalink( $url, $post = 0, $leavename = false, $sample = false ) {

	// Configure the permalink for a post type with a customize rewrite structure
	// if ( !empty( $post->post_type ) && $post->post_type == 'custom-post-type' ) {
	// 	$slug = $post->post_name;
	// 	$url = '/the/path/to/the/%custom-taxonomy%/%custom-post-type%/';

	// 	// The term for the permalink
	// 	$terms = wp_get_post_terms( $post->ID, 'custom-taxonomy' );
	// 	$display_term = null;

	// 	// This will get the first term that is at the top level
	// 	foreach ($terms as $term ) {
	// 		if ( $term->parent == 0 ) {
	// 			$display_term = $term->slug;
	// 			break;
	// 		}
	// 	}
	// 	// Default with no terms are present
	// 	if ( empty( $display_term ) ) {
	// 		$display_region = '';
	// 	}
	// 	// Replace the taxonomy token with the actual value
	// 	$url = str_replace( '%custom-taxonomy%', $display_region, $url );

	// 	// Replace the %postname% with the slug, unless we are on the post edit screen because it uses %postname% for edit field
	// 	if ( !$leavename && !empty( $slug ) ) {
	// 		$url = str_replace( '%postname%', $slug, $url );
	// 	}

	// 	$url = home_url( user_trailingslashit($url) );
	// }

	return $url;
}
add_filter( 'post_type_link', 'ZEROTHEME_permalink', 10, 4 );