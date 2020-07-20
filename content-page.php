<?php //check if it has a featured image and if it is a portrait one

$class = 'primary-content primary-page-content';

if(!has_post_thumbnail()):

  $class = $class . ' no-featured-image';

else:

  list($width, $height) = getimagesize(getFeaturedImageURL('medium'));

  if($width < $height){ $class = $class . ' portrait'; }

endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>

  <header class="entry-header">

    <?php if(has_post_thumbnail()): ?>
    <!-- featured image -->
    <a href="<?php echo getFeaturedImageURL('full'); ?>" class="post-featured-image" title="<?php echo getFeaturedImageAlt(); ?>" style="background-image: url(<?php echo getFeaturedImageURL('large'); ?>)" data-gallery>
      <?php getFeaturedImage(); ?>
    </a>
    <!-- .post-featured-image -->
    <?php endif; ?>

    <div class="wrapper">
      <!-- author picture -->
      <a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" )); ?>" title="<?php printf( __('More posts from $s', 'zen-read'), get_the_author() ); ?>" class="author-picture avatar icon">
        <?php //prints author's avatar and name
        echo get_avatar( get_the_author_meta( 'ID' ), 96 );
        printf( __('by %s','zen-read'), get_the_author() ); ?>
      </a>

      <h1 class="entry-title"><?php the_title(); ?></h1>

      <hr>

    </div><!-- .wrapper -->

  </header>

  <div class="entry-content">
    
    <?php the_content(); ?>

    <div class="chapters"><?php
    $args = array(
    'before'           => '<h3>' . __('Continue reading', 'zen-read') . ':</h3>',
    'after'            => '',
    'link_before'      => '',
    'link_after'       => '',
    'next_or_number'   => 'next',
    'separator'        => ' ',
    'nextpagelink'     => __('Next page', 'zen-read') . '<i class="material-icons next">arrow_forward</i>',
    'previouspagelink' => '<i class="material-icons back">arrow_back</i><span class="screen-reader-text">' . __('Previous page', 'zen-read') . '</span>',
    'pagelink'         => '%',
    'echo'             => 1
    );
    wp_link_pages( $args ); ?></div>
  
  </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->