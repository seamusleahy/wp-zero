<?php
/**
 * This snippet displays the contents for a single post/page/custom-post-type display.
 *
 * @package WordPress
 * @subpackage ZEROTHEME
 */?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('article'); ?>>
    <header>
      
      <?php // 1) Link to the parent post, this is used for Pages, attachments, and custom post-types that are hierarchical ?>
      <?php if ( !empty( $post->post_parent ) ) : ?>
        <span></span><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'ZEROTHEME' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php
           printf( __( 'Go up to %s', 'ZEROTHEME' ), get_the_title( $post->post_parent ) );
          ?></a></span>
      <?php endif; ?>
      
      <?php // 2) Display the post title ?>
      <h1><?php the_title(); ?></h1>

      <?php // 3) Display the publish date of the post ?>
      <time pubdate datetime="<?php echo get_the_date('c'); ?>"><?php
            printf( __('%1$s at %2$s'), get_the_date(),  get_the_time()) ?></time>
      
      <?php // 4) Display and link to the author ?>
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
      
      <?php // 5) Display the categories for the post ?>
      <?php echo get_the_category_list( ', ' ); ?>
      
      <?php // 6) Display the tags for the post ?>
      <?php the_tags( ); ?> 
      
      <?php // 7) Display the terms from a custom taxonomy ?>
      <?php // the_terms( $post->ID, 'TAXONOMY' );?>
      
      <?php // 8) Link to full size attachment if this is attachement ?>
      <?php if(wp_attachment_is_image()) {
        printf('<a href="%1$s">%2$s</a>', wp_get_attachment_url(),  __('View full-size image', 'ZEROTHEME'));
      } else if(wp_get_attachment_url())  {
        printf('<a href="%1$s">%2$s</a>', wp_get_attachment_url(),  __('Download', 'ZEROTHEME'));
      }?>
      
      <?php // 9) Display attachment meta data ?>
      <?php if ( is_attachment() && $metadata = wp_get_attachment_metadata()) {
        echo '<dl class="attachments">';
        foreach($metadata as $key => $val) {
        	echo '<dt>'.$key.'</dt>';
        	echo '<dd>';
        	switch($key) {
        		case 'image_meta':
        			echo '<dl>';
        			foreach($val as $imk => $imv) {
        				echo '<dt>'.$imk.'</dt>';
        				echo '<dd>'.$imv.'</dd>';
        			}
        			echo '</dl>';
        			break;
        		
        		case 'sizes':
        			echo '<ul>';
              foreach($val as $size) {
              	$image_url = wp_get_attachment_image_src($post->ID, array($size['width'], $size['height']));
                echo '<li><a href="'.$image_url[0].'">'.$size['width'].'x'.$size['height'].'</a></li>';
              }
              echo '</ul>';
        			break;
        			
        		default:
        			echo $val;
        	}
        	echo '</dd>';
        }
        echo '</dl>';
      } ?>
    </header>
    

    <?php // 10) Display feature image <http://codex.wordpress.org/Function_Reference/the_post_thumbnail> ?>
    <?php if(has_post_thumbnail()): ?>
      <div class="thumbnail">
        <?php the_post_thumbnail( 'large', array() ); ?>
      </div>
    <?php endif; ?>

    <?php // The content ?>
    <div class="prose"><?php the_content(); ?></div>
    
    <?php // Edit link for admins and pagination ?>
    <footer>
      <?php edit_post_link( __( 'Edit', 'ZEROTHEME' ), ' <span class="edit-link">', '</span>' ); ?>
      <?php wp_link_pages( array( 'before' => '<div class="pager">' . __( 'Pages:', 'ZEROTHEME' ), 'after' => '</div>' ) ); ?>
    </footer>
  
  <?php // Display the comments ?>
  <?php comments_template( '', true ); ?>
  
  </article>
<?php endwhile; // end of the loop. ?>