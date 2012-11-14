<?php
/**
 * Adds the links for the Apple start up image
 */

add_action( 'wp_head', 'zero_apple_touch_startup_image_wp_head' );
function zero_apple_touch_startup_image_wp_head( ) {
	// the path to the images
	$path = get_stylesheet_directory().'/img/';
	
	// try the cache first
	$images = wp_cache_get( 'apple-touch-startup-image', 'ZEROTHEME' );
	
	// If not cached or in debug mode, then go ahead of load them up
	if($images == false || (defined('WP_DEBUG') && WP_DEBUG)) {
		$images = array();

		// check if the image directory exists
		if( is_dir($path) ) {
			
			if( $handle = opendir($path) ) {
				
				// Loop through all the images that match apple-touch-icon[-<X>x<Y>][-landscape][@<pixel-ratio>].png in name
				while( ($file = readdir($handle)) !== false ) {
					if( is_file($path.$file) && preg_match('#^apple-touch-startup-image(-(?P<x>\d+)x(?P<y>\d+))?(?P<landscape>-landscape)?(@(?P<ratio>\d+))?\.png$#', $file, $matches) !== 0 ) {
						
						$attrs = array(
							'href' => get_bloginfo( 'stylesheet_directory' ).'/img/'.$file,
							'rel' => 'apple-touch-startup-image',
						);
						
						// Set the size, orientation, and pixel-ratio
						if(!empty($matches['x'])) {
							$ratio = 1;
							if(!empty($matches['ratio'])) {
								$ratio = intval( $matches['ratio'] );
							}

							// The iPad rotates the image 90deg when landscape so our y becomes the width
							if( empty($matches['landscape']) ) {
								$width = intval($matches['x']) / $ratio;
							} else {
								$width = intval($matches['y']) / $ratio;
							}

							$attrs['media'] = '(device-width: '.$width.')';

							// orientation
							if( empty($matches['landscape']) ) {
								$attrs['media'] .= ' and (orientation: portrait)';
							} else {
								$attrs['media'] .= ' and (orientation: landscape)';
							}

							// retina
							if($ratio > 1) {
								$attrs['media'] .= ' and (-webkit-device-pixel-ratio: '.$ratio.')';
							}
						}

						$images[] = $attrs;
					}
				}
			}
			closedir( $handle );
		}
		
		// Save to cache
		wp_cache_set( 'apple-touch-startup-image', $images, 'ZEROTHEME' );
	}
	
	// output the icons
	foreach($images as $attrs) {
		echo '<link '.zero_get_formatted_attributes($attrs)."/>\n";
	}
}