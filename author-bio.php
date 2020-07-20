<aside id="author-bio">
  
  <span class="author-picture">
    <a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" )); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 180 ); ?></a>
  </span>

  <a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" )); ?>" title="<?php echo get_the_author(); ?>" class="url fn author-name">
    <?php echo get_the_author(); ?>
  </a>

  <?php if( get_the_author_meta( 'description' ) ): ?>
    <p class="author-description bio"><?php echo get_the_author_meta( 'description' ); ?></p>
  <?php endif; ?>

  <aside id="author-social">    
      <?php get_template_part('author-social'); ?>
  </aside>

</aside>