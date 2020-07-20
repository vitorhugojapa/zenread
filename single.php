<?php get_header(); ?>

		<div id="primary">

			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content-single', get_post_format() ); ?>

					<div id="author-info">
						<?php get_template_part( 'author-bio' ); ?>
						<hr>
					</div>

					<?php comments_template( '', true ); ?>

				<?php endwhile; ?>

			</div><!-- #content -->
			
		</div><!-- #primary -->

<?php get_footer(); ?>