<?php
/**
 * The snippet for the search form
 *
 * Include by using get_search_form()
 *
 * @see http://codex.wordpress.org/Function_Reference/get_search_form
 *
 * @package WordPress
 * @subpackage ZEROTHEME
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" >
  <label class="screen-reader-text" for="s"><?php _e('Search for:'); ?></label>
  <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php  esc_attr_e('Site search'); ?>" />
  <button type="submit" id="searchsubmit"><?php _e('Search'); ?></button>
</form>