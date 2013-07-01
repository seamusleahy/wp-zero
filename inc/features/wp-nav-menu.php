<?php
/**
 * Add some extra arguments to wp_nav_menu
 *
 * 'before_nav_list' is a string to insert before the top-level list but within the container
 * 'after_nav_list' is a string to insert after the top-level list but within the container
 */
function ZEROTHEME_wp_nav_menu_items( $items, $args ) {
	if( !isset( $args->before_nav_list ) ) {
		$args->before_nav_list = '';
	}
	if( !isset( $args->after_nav_list ) ) {
		$args->after_nav_list = '';
	}

	return $args->before_nav_list . $items . $args->after_nav_list;
}
add_filter( 'wp_nav_menu_items', 'ZEROTHEME_wp_nav_menu_items', 10, 2 );
