<?php
/**
 * The primary sidebar
 *
 * @package WordPress
 * @subpackage ZEROTHEME
 */
?>
<?php if( is_active_sidebar( 'primary-sidebar' ) ): ?>
<div id="primary-sidebar"  role="complementary" class="sidebar widgets primary-sidebar">
  <?php dynamic_sidebar( 'primary-widget-area' ); ?>
</div>
<?php endif; ?>
