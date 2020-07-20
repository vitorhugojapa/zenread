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

      <h1 class="entry-title"><?php the_title(); ?></h1>

      <?php if(has_excerpt()): ?>
        <p class="excerpt"><?php if(post_password_required()){ the_excerpt(); }else{ echo get_the_excerpt(); } ?></p>
      <?php endif; ?>

      <?php if( comments_open() && get_comments_number() > 1 ): ?>
      <a class="comment-counter entry-meta-info" href="<?php echo get_permalink(); ?>/#comments">
        <?php printf( __('%s comments', 'zen-read'), get_comments_number() ); ?>
      </a>
      <?php endif; ?>

      <?php //tweet via
      $tweet_via = '';
      if(get_option( 'theme_twitter_profile' )){
        $tweet_via = '&via=' . get_option( 'theme_twitter_profile' ); }

      //tweet URL
      $tweet_url = 'https://twitter.com/share?url=' . get_permalink() . $tweet_via . '&text=&quot;' . get_the_title() . '&quot; – ' . get_the_excerpt(); ?>

      <a href="<?php echo $tweet_url; ?>" class="link-button link-tweet" target="_blank">
        <?php _e('Tweet this','zen-read'); ?>
      </a>

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