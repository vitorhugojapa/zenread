<?php get_header(); ?>

	<div id="primary">

		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">

				<h1 class="page-title">
					<?php echo single_cat_title( '', false ); ?>
				</h1>

				<?php if(! empty( category_description() )): ?>
				<div class="category-archive-meta">
					<?php echo category_description(); ?>
				</div>
				<?php endif; ?>

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