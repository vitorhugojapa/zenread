<?php get_header(); ?>

		<section id="primary">

			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<a href="#search"><h1 class="page-title"><?php _e('Searching for','zen-read')?> <span class="search-term"><?php echo get_search_query(); ?></span></h1></a>
				</header>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

                <?php get_template_part('pagination'); ?>

			<?php else : ?>

				<?php get_template_part('content-empty-result'); ?>

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>