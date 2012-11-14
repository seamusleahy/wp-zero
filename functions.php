<?php

// Keep this to pull zero features
require_once( dirname(__FILE__).'/zero/init.php');

define( 'THEME_VERSION_NUMBER', '0.0.1' );


/**
 * General configuration for the theme
 */
add_action( 'after_setup_theme', 'ZEROTHEME_setup' );
function ZEROTHEME_setup() {
  
  // ———————————————————————————————-
  // Add custom image sizes
  // http://codex.wordpress.org/Function_Reference/add_image_size
  // ———————————————————————————————-
  // add_image_size( 'my-custom-image-size', 220, 185, true );


  // ———————————————————————————————-
  // Register widget regions
  // http://codex.wordpress.org/Function_Reference/register_sidebar
  // ———————————————————————————————-
  register_sidebar(array(
    'id' => 'primary-sidebar',
    'name' => __('Primary Sidebar', 'ZEROTHEME'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));

}

/**
 * Enqueue theme Javascript files
 */
add_action('wp_enqueue_scripts', 'ZEROTHEME_enqueue_scripts');
function ZEROTHEME_enqueue_scripts() {
  // Don't load our scripts in the admin section
  if( !is_admin() ) {
    // http://codex.wordpress.org/Function_Reference/wp_enqueue_script
    // wp_register_script( 'plugins', get_template_directory_uri().'/js/plugins.js', array('jquery'), THEME_VERSION_NUMBER);
    // wp_enqueue_script( 'plugins' );
    // wp_register_script( 'script', get_template_directory_uri().'/js/script.js', array('jquery', 'script'), THEME_VERSION_NUMBER);
    // wp_enqueue_script( 'script' );
  }
}    
 
