<header class="page-header">

	<h1 class="page-title"><?php _e('Nothing found', 'zen-read'); ?></h1>

	<p class="no-results-description">

		<?php if( is_search() ):

		printf( __('There is no results about %s. What about the suggestions below?', 'zen-read'), '<span class="search-term">' . get_search_query() . '</span>'); ?>
		
		<?php else: _e('What about the suggestions below?', 'zen-read'); ?>

	<?php endif; ?>
	</p>
</header>


<div id="random-posts">

	<?php $posts = get_posts('orderby=rand&numberposts=4');

	foreach($posts as $post) { ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

	<?php } ?>

</div><!-- .random-posts -->