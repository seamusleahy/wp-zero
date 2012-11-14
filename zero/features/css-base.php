<?php
/**
 * Loads up the default set of stylesheets that the sub-theme can then over-ride by
 * creating a file of the same name in the sub-theme's css directory.
 */


wp_register_style( 'print', zero_get_overridden_file('/css/print.css'), array(), ZEROTHEME_VERSION_NUMBER, 'print' );
wp_register_style( 'screen', zero_get_overridden_file('/css/screen.css'), array(), ZEROTHEME_VERSION_NUMBER, 'screen' );
 
// Do not included them in the admin since this can cause side effects
if( !is_admin() ) {
  wp_enqueue_style( 'print' );
  wp_enqueue_style( 'screen' );
  
}
