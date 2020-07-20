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

      <?php if(has_excerpt()): ?>
        <p class="excerpt"><?php if(post_password_required()){ the_excerpt(); }else{ echo get_the_excerpt(); } ?></p>
      <?php endif; ?>

      <?php /* uses Reading Time plugin by Jason Yingling to estimate post's reading time or a custom_field "time" to define embbed video elapsed time. Download Reading Time plugin from wordpress.org/plugins/reading-time-wp */ ?>

      <time class="entry-meta-info estimated-time">
        
        <?php if(get_post_meta( get_the_ID(), 'time')):
          
          printf( __('Watch in %s min','zen-read'), get_post_meta( get_the_ID(), 'time', true) );
        
        elseif(shortcode_exists('rt_reading_time')):

          printf( __('Read %s in %s min', 'zen-read'), '<span class="screen-reader-text"> about ' . get_the_title() . '</span>', do_shortcode('[rt_reading_time]') );

        endif; ?>

      </time>

      <?php if( comments_open() && get_comments_number() > 1 ): ?>
      <a class="comment-counter entry-meta-info" href="<?php echo get_permalink(); ?>/#comments">
        <?php printf( __('%s comments', 'zen-read'), get_comments_number() ); ?>
      </a>
      <?php endif; ?>

      <?php get_template_part( 'content-meta-fields' ); ?>

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
    'nextpagelink'     => __('Next chapter', 'zen-read') . '<i class="material-icons next">arrow_forward</i>',
    'previouspagelink' => '<i class="material-icons back">arrow_back</i><span class="screen-reader-text">' . __('Previous chapter', 'zen-read') . '</span>',
    'pagelink'         => '%',
    'echo'             => 1
    );
    wp_link_pages( $args ); ?></div>
  
  </div><!-- .entry-content -->


  <footer class="entry-meta">

    <div id="categories-list">
      <?php $parent_category = getParentCategory(); ?>
      <a href="<?php echo $parent_category['link']; ?>" class="parent" title="<?php printf( __('Posts in %s', 'zen-read'), $parent_category['name']); ?>">
        <?php echo $parent_category['name']; ?>
      </a>
      <a href="#categories-list" class="more" title="<?php _e('More tags and categories in this post', 'zen-read'); ?>">...</a>
      <div class="all">
        <?php
          $categories = get_the_category();
          $separator = '';
          $output = '';
          if ( ! empty( $categories ) ) {
              foreach( $categories as $category ) {
                  $output .= '<a href="' . get_category_link( $category->term_id ) . " alt=" . __('Posts in ','zen-read') . $category->name . '">' . $category->name . '</a>' . $separator;
              }
              echo trim( $output, $separator );
          }
          echo get_the_tag_list();
        ?>
      </div>
    </div>

    <!-- DATE -->
    <time class="entry-meta-info publish-date">
      <?php printf( __('Published in %s at %s', 'zen-read'), get_the_date(), get_the_time('G:i') ); ?>
    </time>

  </footer>

</article><!-- #post-<?php the_ID(); ?> -->