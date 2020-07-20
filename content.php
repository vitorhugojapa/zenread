<?php $class = 'listed';

if(!has_post_thumbnail()):

  $class = $class . ' no-featured-image';

else:

  list($width, $height) = getimagesize(getFeaturedImageURL('medium'));

  if($width < $height){
    $class = $class . ' portrait';
  }else{
    $class = $class . ' landscape';
  }

endif;

if(get_post_meta( get_the_ID(), 'dark', true )){ $class = $class . ' dark'; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>

  <?php if(has_post_thumbnail()):?>
  <a href="<?php the_permalink(); ?>" class="post-featured-image" style="background-image: url(<?php echo getFeaturedImageURL('large'); ?>)">
    <?php getFeaturedImage(); ?>
  </a>
  <?php endif; ?>

  <div class="wrapper">
    <header class="entry-header">
      
      <?php $parent_category = getParentCategory(); ?>
      <aside class="category parent-category entry-meta-info">
        <?php echo $parent_category['name']; ?>
      </aside>

  		<h1 class="entry-title">
        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
      </h1>

      <?php if(has_excerpt()): ?>
        <p class="excerpt"><?php if(post_password_required()){ the_excerpt(); }else{ echo get_the_excerpt(); } ?></p>
      <?php endif; ?>

    </header>

    <footer class="entry-meta">
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
    </footer>
  </div>
  
</article><!-- #post-<?php the_ID(); ?> -->