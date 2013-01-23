<?php
/**
 * Add a menu item in the pages for the homepage.
 */

function ZEROTHEME_home_page_menu_item( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'ZEROTHEME_home_page_menu_item' );