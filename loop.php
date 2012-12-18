<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * @package WordPress
 * @subpackage ZEROTHEME
 */
?>



<div class="index">
<?php
// Start the Loop.
// Without further ado, the loop:
// ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'article' ); ?>>
		<header>
			<?php // Post title that links ?>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php // Publish date ?>
			<time pubdate datetime="<?php echo date( 'c', (int) get_the_date( 'U' ) ); ?>"><?php echo get_the_date(); ?> - <?php the_time(); ?></time>

			<?php // The Author of the post ?>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>

			<?php // The categories the post is in ?>
			<?php echo get_the_category_list( ', ' ); ?>

			<?php // The tags the post is in ?>
			<?php the_tags( ); ?>

			<?php // The terms from a custom taxonomy ?>
			<?php // the_terms( $post->ID, 'TAXONOMY' );?>
		</header>

		<?php // The featured image ?>
		<?php if ( has_post_thumbnail() ): ?>
			<div class="thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail', array() ); ?></a>
			</div>
		<?php endif; ?>

		<?php // The excerpt/content ?>
		<div class="prose"><?php the_excerpt(); // the_content(); ?></div>

		<?php // The comment link ?>
		<footer class="meta">
			<?php if ( comments_open() || have_comments() ) {
	comments_popup_link( __( 'Leave a comment' ), __( '1 Comment' ), __( '% Comments' ) );
} ?>
		</footer>
	</article>
<?php endwhile; // End the loop. ?>

<?php // The pagination control?>
<nav class="pager"><?php echo ZEROTHEME_paginate_index_links(); ?></nav>
</div>
