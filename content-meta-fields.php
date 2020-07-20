<div class="meta-fields">

  <?php
  /* visit link */
  /* get custom field named "link" and sanitize it to use */
  $link = esc_url(get_post_meta( get_the_ID(), 'link', true ));

  if($link): ?>
    <a href="<?php echo $link; ?>" class="link-button" target="_blank">
      <?php
      /* get an optional custom field named "label" and sanitize it */
      $label = sanitize_text_field(get_post_meta( get_the_ID(), 'label', true ));
      if($label){ echo $label; }else{ _e('Visit','zen-read'); } ?>
    </a>
  <?php endif; ?>

  <?php
  /* download link */
  /* get custom field named "download" and sanitize it to use */
  $download = esc_url(get_post_meta( get_the_ID(), 'download', true ));

  if($download): ?>
    <a href="<?php echo $download; ?>" class="link-button link-download" target="_blank">
      <?php _e('Download','zen-read'); ?>
    </a>
  <?php endif; ?>

  <?php
  /* buy link */
  /* get custom field named "buy" and sanitize it to use */
  $buy = esc_url(get_post_meta( get_the_ID(), 'buy', true ));

  if($buy): ?>
    <a href="<?php echo $buy; ?>" class="link-button link-buy" target="_blank">
      <?php _e('Buy','zen-read'); ?> 
      <?php
      /* get an optional custom field named "price" and sanitize it */
      $price = sanitize_text_field(get_post_meta( get_the_ID(), 'price', true ));
      if($price){ echo $price; } ?>
    </a>
  <?php endif; ?>

  <?php
  /* rating info */
  /* get a numeral custom field name "rating" (0,1,2,3,4,5+) */
  $rating = round(sanitize_key(get_post_meta( get_the_ID(), 'rating', true )));
  if($rating>5){ $rating = 5; }
  if($rating<1){ $rating = 0; }

  if(get_post_meta( get_the_ID(), 'rating')): ?>
    <div class="rating">
    <?php
    /* print rating stars on screen */
    $i = 0;
    while( $i < $rating ){ ?>
      <i class="material-icons star">star</i>
    <?php $i++; }

    /* print unfilled stars */
    $j = 5-$rating;
    while( $j > 0 ){ ?>
      <i class="material-icons star-border">star_border</i>
    <?php $j--; }

    /* Google Search microformat scheme*/
    ?>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Rating",
      "ratingValue": "<?php echo $rating; ?>",
      "bestRating": "5",
      "worstRating": "0",
      "author": "<?php echo get_the_author(); ?>",
    }
    </script>
    </div>
  <?php endif; ?>

  <?php
  /* info */
  /* get custom field named "info" and sanitize it to use */
  $info = sanitize_text_field(get_post_meta( get_the_ID(), 'info', true ));
  if($info): ?>
    <i class="meta-info-field"><?php echo $info; ?></i>
  <?php endif; ?>

</div>