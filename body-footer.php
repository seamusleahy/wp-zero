<?php
/**
 * The template for footer of the page (from the end of the content to before the closing body tag).
 *
 * @package WordPress
 * @subpackage ZEROTHEME
 */?>
<?php get_sidebar(); ?>



<footer role="contentinfo" id="footer" class="site-footer">
	<?php
		// If you want to have a footer sidebar
		//get_sidebar( 'footer' );
	?>

			<div class="site-info">
				<?php // Copyright the site ?>
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				&copy; 
				<?php 
				// Display the date range for years for copyright
				// The start year of the year range
				$start_copyright_year = 2010;
				$current_year = (int) date('Y');
				
				// Don't display the range if the end year is the same as the start year, instead just display the year
				if( $start_copyright_year >= $current_year ) {
				  echo $current_year;
				} else {
				  echo $start_copyright_year.' - '.$current_year;
				}
				?>
			</div>

	</footer>

