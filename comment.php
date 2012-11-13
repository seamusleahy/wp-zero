<?php
/**
 * The template for a comment.
 *
 * @package WordPress
 * @subpackage ZEROTHEME
 */?>
     <div class="comment-entry">
      <header class="comment-author vcard">
        <?php 
        // Avatar
        ?>
        <?php if ($avatar_size != 0) echo get_avatar( $comment, $avatar_size ); ?>

        <?php 
        // Name that links to this comment
        ?>
        <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
        
        <?php 
        // The comment publish date
        ?>
        <time pubdate datetime="<?php echo get_comment_date('c'); ?>"><?php
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></time>
      </header>
      
      <?php 
      // The comment content
      ?>
      <div class="prose"><?php 
        // Display a message to the user when their comment is awaiting approval
        if ($comment->comment_approved == '0') {
          echo '<p class="awaiting-moderation"><em>'.__('Your comment is awaiting moderation.').'</em><p>';
        }

        // Comment text
        comment_text();
        ?></div>
      
      <?php 
      // Link to reply to this comment
      ?>
      <div class="reply">
      <?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => $depth+1))) ?>
      </div>
    </div>