<?php
/**
 * Based on the load_template but it allows extra variables to be set.
 */
function ZEROTHEME_load_template( $_template_file,  $_vars = array(), $require_once = true ) {
	global $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
	
	if ( is_array( $wp_query->query_vars ) )
		extract( $wp_query->query_vars, EXTR_SKIP );
	
	extract( $_vars );
	
	if ( $require_once )
		require_once( $_template_file );
	else
		require( $_template_file );
}




/**
 * Similar to the WordPress get_template_part but $name can accept an array
 * 
 * @param unknown_type $slug
 * @param unknown_type $name
 */
function ZEROTHEME_get_template_part( $slug, $name=null) {
	do_action( "get_template_part_{$slug}", $slug, $name );
	
	$templates = array();
	
	$names = (array) $name;
	foreach($names as $name) {
		$templates[] = $slug . '-' . $name . '.php';
	}
	
	$templates[] = $slug . '.php';
	
	return locate_template($templates, true, false);
}