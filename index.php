<?php get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>
	        
	        <?php get_template_part('pagination'); ?>
			
		<?php endif; ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>