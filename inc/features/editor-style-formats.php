<?php
/**
 * Setups and manages the WYSIWYG style formats drop-down
 */

/**
 * 
 */
add_filter( 'tiny_mce_before_init', 'ZEROTHEME_editor_style_formats_mce_settings' );
function ZEROTHEME_editor_style_formats_mce_settings( $initArray ) {
	$style_formats = ZEROTHEME_editor_style_formats();
	$init_array['style_formats'] = json_encode( $style_formats );  

	return $initArray;
};

/**
 * Add custom styles drop down to the WYSIWYG editor
 */
add_filter( 'mce_buttons_2', 'ZEROTHEME_enable_editor_style_formats_dropdown');
function ZEROTHEME_enable_editor_style_formats_dropdown( $buttons ) {
	$style_formats = ZEROTHEME_editor_style_formats();
	if ( !empty($style_formats) ) {
		array_unshift( $buttons, 'styleselect' );
	}
	return $buttons;
}

/**
 * Get the TinyMCE custom style formats
 *
 * @return array - the non-JSONified array of style formats
 */
function ZEROTHEME_editor_style_formats() {
	static $style_formats = array();
	if ( empty($style_formats) ) {
		$style_formats = apply_filters( 'ZEROTHEME_editor_style_formats', array() );
	}
	return $style_formats;
}