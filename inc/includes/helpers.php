<?php
/**
 * Slugify a string
 *
 * @param unknown $text    string - the text to slugify
 * @param unknown $options array (optional) - force_lowercase, separated_character, accepted_characters
 */
function ZEROMTHEME_slugify( $text, $options= array() ) {
	$options = array_merge( array(
			'force_lowercase' => true,
			'separated_character' => '-',
			'accepted_characters' => '\w',
		), $options );

	if ( $options['force_lowercase'] ) {
		$text = strtolower( $text );
	}

	$text = preg_replace( '/[^'.str_replace( '/', '\/', $options['accepted_characters'] ).']+/', $options['separated_character'], $text );

	return $text;
}


/**
 * Format an array of keyed values as HTML attributes.
 *
 * @param unknown $attributes array - key value pair of attributes
 * @return string
 */
function ZEROMTHEME_get_formatted_attributes( $attributes ) {
	if ( is_null( $attributes ) || count( $attributes )==0 ) {
		return '';
	}

	$attrs = array();

	foreach ( $attributes as $k => $v ) {
		if ( is_array( $v ) ) {
			$attrs[] = $k.'="'.implode( ' ', $v ).'"';
		} else {
			$attrs[] = $k.'="'.(string) $v.'"';
		}
	}

	return implode( ' ', $attrs );
}
