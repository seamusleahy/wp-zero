<?php
/**
 * Adds the links for the Apple Touch Icon.
 *
 * If for theme on WP.COM, remove this file and use Blavatar instead.
 */
add_action( 'wp_head', 'ZEROTHEME_apple_touch_icon_wp_head' );
function ZEROTHEME_apple_touch_icon_wp_head( ) {
	// the path to the images
	$path = get_stylesheet_directory().'/img/';
	$url_path = get_stylesheet_directory_uri().'/img/';

	// try the cache first
	$icons = wp_cache_get( 'apple-touch-icons', 'ZEROTHEME' );

	// If not cached or in debug mode, then go ahead of load them up
	if ( false === $icons || ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ) {
		$icons = array();

		// Get all the Apple Touch Icons files
		foreach ( glob( $path.'apple-touch-icon*.png' ) as $file ) {

			// match apple-touch-icon[-<X>x<Y>][-precomposed].png
			// Examples: apple-touch-icon.png, apple-touch-icon-precomposed.png, apple-touch-icon-114x144.png, apple-touch-icon-72x72-precomposed.png
			if ( preg_match( '#apple-touch-icon(-(?P<size>\d+x\d+))?(?P<precomposed>-precomposed)?\.png$#', $file, $matches ) !== 0 ) {
				$attrs = array(
					'href' => $url_path.$matches[0],
					'rel' => 'apple-touch-icon',
				);

				// If the icon precomposed, then changed the 'rel' to set it as so for the browser.
				if ( !empty( $matches['precomposed'] ) ) {
					$attrs['rel'] = 'apple-touch-icon-precomposed';
				}

				// If the image size is defined, then add 'sizes' attribute for the browser.
				if ( !empty( $matches['size'] ) ) {
					$attrs['sizes'] = $matches['size'];
				}

				// Push
				$icons[] = $attrs;

				// output the icon
				echo '<link '.ZEROTHEME_get_formatted_attributes( $attrs )."/>\n";
			}
		}

		if ( count( $icons ) > 0 ) {
			// Save to cache
			wp_cache_set( 'apple-touch-icons', $icons, 'ZEROTHEME' );
		}
	}
}
