<?php get_header(); ?>

	<section id="primary">

		<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

		        <header class="page-header">

		            <h1 class="page-title">
		            	<small><?php _e('Published in','zen-read');?></small> <?php single_month_title(' '); ?>
		            </h1>
		            
		        </header>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>
	          
	            <?php get_template_part('pagination'); ?>

			<?php else : ?>

				<?php get_template_part('content-empty-results'); ?>

			<?php endif; ?>

		</div><!-- #content -->

	</section><!-- #primary -->

<?php get_footer(); ?>