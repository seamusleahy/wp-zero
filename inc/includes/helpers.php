<?php

/**
 * Format an array of keyed values as HTML attributes.
 *
 * @param unknown $attributes array - key value pair of attributes
 * @return string
 */
function ZEROTHEME_get_formatted_attributes( $attributes ) {
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
