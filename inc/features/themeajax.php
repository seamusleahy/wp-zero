<?php
/**
 * Allow for easy AJAX templates
 */
function ZEROTHEME_themeajax_print_settings() {
	echo '<script>';
	echo 'window.themeSettings = ';
	echo json_encode( array(
			'ajaxUrl' => get_bloginfo( 'wpurl' ).'/wp-admin/admin-ajax.php',
			'themeAjaxAction' => 'themeajax'
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
 * A generic AJAX handler for the theme
 */
function ZEROTHEME_themeajax_handler() {
	$template = isset( $_REQUEST['template'] ) ? $_REQUEST['template'] : '';

	if ( !empty( $template ) ) {
		$template = preg_replace("[^\w\s\d\-_~,;:\[\]\(\]]|[\.]{2,}", '', $template );
		locate_template( array( 'ajax/'.$template.'.php' ), true );
		die();
	}
}
add_action( 'wp_ajax_themeajax', 'ZEROTHEME_themeajax_handler' );
add_action( 'wp_ajax_nopriv_themeajax', 'ZEROTHEME_themeajax_handler' );
