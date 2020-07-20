<?php if( comments_open() && (!post_password_required()) ): ?>

<?php $class = '';

if(isset($_GET['replytocom'])){ $class = 'class="replytocom"'; } ?>

<div id="comments" <?php echo $class; ?>>

  <h2 id="comments-title"><?php _e('Write a comment','zen-read'); ?><span class="screen-reader-text"> <?php printf( __('about %s','zen-read'), get_the_title()); ?></span></h2>

  <?php get_template_part('comment-form'); ?>

  <?php if ( have_comments() ) : ?>

  <div class="commentlist">

    <div class="wrapper">

      <?php if( get_comments_number() > 1 ):?>
      <h2 class="comment-count-title"><?php printf( __('%s comments', 'zen-read'), get_comments_number()); ?><span class="screen-reader-text"> <?php printf( __('about %s below','zen-read'), get_the_title() ); ?></span></h2>
      <?php endif; ?>

      <ul>
        <?php //print each comment
        $args = array('avatar_size' =>  96,
                      'reply_text'  =>  __('Reply', 'zen-read'),
                      'callback'    =>  'customCommentTemplate');
        wp_list_comments($args); ?>
      </ul>

    </div><!-- .wrapper -->

    <nav id="pagination">
      <?php customCommentPagination(); ?>
    </nav>

  </div><!-- .commentlist -->

  <?php endif; ?>

</div><!-- #comments -->
<?php endif; ?>