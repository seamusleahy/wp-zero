<?php
function zero_themeajax_print_settings() {
  echo '<script>';
  echo 'window.themeSettings = ';
  echo json_encode(array(
    'ajaxUrl' => get_bloginfo('wpurl').'/wp-admin/admin-ajax.php',
    'themeAjaxAction' => 'themeajax'
  ));
  echo '</script>';
}
add_action( 'wp_print_scripts', 'zero_themeajax_print_settings' );