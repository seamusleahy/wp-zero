<?php
/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 */
add_filter( 'gallery_style', 'ZEROMTHEME_remove_gallery_css' );
function ZEROMTHEME_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
