<?php
define( 'THEME_AJAX_URL_PATH', 'ajax' );

/**
 * Allow for easy AJAX templates
 */
function ZEROTHEME_themeajax_print_settings() {
	// AJAX handler
	if ( !get_option('permalink_structure') ) {
		$ajaxurl = 'index.php?is_ajax=1';
	} else {
		$ajaxurl = '/' . THEME_AJAX_URL_PATH . '/';
	}

	echo '<script>';
	echo 'window.themeSettings = ';
	echo json_encode( array(
			'ajaxUrl' => home_url( $ajaxurl ),
		) );
	echo '</script>';
}
add_action( 'wp_print_scripts', 'ZEROTHEME_themeajax_print_settings' );


/**
 * Set the content-type for the header
 *
 * @param unknown $type string - the short reference for the type
 *
 * Accepted types: json, javascript, rss, text, xml, atom, css, html
 */
function ZEROTHEME_themeajax_set_type( $type ) {
	$types = array(
		'json' => 'application/json',
		'javascript' => 'text/javascript',
		'rss' => 'application/rss+xml; charset=ISO-8859-1',
		'text' => 'text/plain',
		'xml' => 'text/xml',
		'atom' => 'application/atom+xml',
		'css' => 'text/css',
		'html' => 'text/html'
	);

	if ( isset( $types[$type] ) ) {
		header( 'Content-type: '.$types[$type] );
	}
}



/**
 * Add is_ajax query var
 */
function ZEROTHEME_themeajax_query_vars( $vars ) {
	$vars[] = 'is_ajax';
	return $vars;
}
add_filter( 'query_vars', 'ZEROTHEME_themeajax_query_vars' );



/**
 * Adding AJAX rewrite rule
 */
function ZEROTHEME_themeajax_generate_rewrite_rules( $rewrite ) {
	// AJAX handler
	$ajax = array( THEME_AJAX_URL_PATH . '(/.*)?' => 'index.php?is_ajax=1' );

	$rewrite->rules = $ajax + $rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'ZEROTHEME_themeajax_generate_rewrite_rules' );


/**
 * Incept the AJAX calls
 */
function ZEROTHEME_themeajax_template_redirect() {
	global $wp_query;

	if ( filter_var( $wp_query->get('is_ajax'), FILTER_VALIDATE_BOOLEAN ) && 
	     isset( $_GET['action'] ) && 
	     preg_match( '#^[a-zA-Z][_a-zA-Z0-9]*$#', $_GET['action']) && 
	     method_exists( $this, $_GET['action'] ) ) {
		$action = $_GET['action'];
		
		do_action( 'ZEROTHEME_themeajax', $action );
		do_action( "ZEROTHEME_themeajax_$action" );

		exit();
	}
}
add_action( 'template_redirect', 'ZEROTHEME_themeajax_template_redirect' );
