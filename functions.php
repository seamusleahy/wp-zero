<?php

// Keep this to pull zero features
require_once( dirname(__FILE__).'/zero/init.php');

define( 'THEME_VERSION_NUMBER', '0.0.1' );



add_action( 'after_setup_theme', 'ZEROTHEME_setup' );
function ZEROTHEME_setup() {
  
}