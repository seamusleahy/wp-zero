<?php
/**
 * Sets up the WYSIWYG editor to use the objects/_prose.scss stylesheet so you
 * don't have to duplicate work.
 */

add_editor_style( array( 'css/editor.css' ) );


/**
 * Add the prose class name to the editor area
 */
add_filter( 'tiny_mce_before_init', 'ZEROTHEME_css_editor_mce_settings' );
function ZEROTHEME_css_editor_mce_settings( $initArray ) {
	$initArray['body_class'] = 'prose';
	return $initArray;
};
