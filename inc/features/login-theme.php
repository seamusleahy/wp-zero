<?php
/**
 * Adds custom CSS and changes the WordPress logo and link to the current site
 */

/**
 * Add CSS to customize the login page
 */
add_action( 'login_head', 'ZEROTHEME_login_theme_login_head' );
function ZEROTHEME_login_theme_login_head() {
	$styles = new WP_Styles();

	// TODO: create a search order for file extensions for stylesheets
	if ( file_exists( get_stylesheet_directory().'/css/login.css' ) ) {
		$styles->add( 'custom-login', get_bloginfo( 'stylesheet_directory' ).'/css/login.css' );
		$styles->enqueue( 'custom-login' );
	} else if ( file_exists( get_stylesheet_directory().'/css/login.css' ) ) {
			$styles->add( 'custom-login', get_bloginfo( 'stylesheet_directory' ).'/css/login.css' );
			$styles->enqueue( 'custom-login' );
		}


	$styles = apply_filters( 'ZEROTHEME_write_login_styles', $styles );

	$styles->do_items();
}



/**
 * Change the logo to link to the site's homepage instead of WordPress.org
 */
add_filter( 'login_headerurl', 'ZEROTHEME_login_theme_login_headerurl' );
function ZEROTHEME_login_theme_login_headerurl( $url ) {
	return home_url( '/' );
}



/**
 * Change the text of the logo to be the site's name instead of WordPress
 */
add_filter( 'login_headertitle', 'ZEROTHEME_login_theme_login_headertitle' );
function ZEROTHEME_login_theme_login_headertitle( $url ) {
	return esc_attr( get_bloginfo( 'name' ) );
}
