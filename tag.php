<?php get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<small><?php _e('Posts tagged with','zen-read'); ?></small><?php echo single_tag_title( '', false ); ?>
				</h1>

				<?php $meta_description = tag_description();
				
				if (!empty( $meta_description )){ ?>
					
				<div class="tag-archive-meta">

					<?php echo $meta_description; ?>

				</div>

				<?php } ?>

			</header>


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>
	        
	        <?php get_template_part('pagination'); ?>

			
		<?php else : ?>

			<?php get_template_part('content-empty-results'); ?>

		<?php endif; ?>
		

		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>