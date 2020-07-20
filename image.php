<?php get_header(); ?>

	<div id="primary" class="image-attachment">

		<div id="content" role="main">

			<?php the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('primary-content'); ?>>

				<header class="entry-header">

					<!-- image -->
					<div class="entry-attachment">

						<div class="attachment">

						  <?php echo wp_get_attachment_image( $post->ID, 'size-full' );?>

						</div><!-- .attachment -->

					</div><!-- .entry-attachment -->


					<h1 class="entry-title"><?php the_title(); ?></h1>

				</header><!-- .entry-header -->

				<div class="entry-content">

					<div class="entry-description">

						<?php the_content(); ?>

					</div><!-- .entry-description -->

				</div><!-- .entry-content -->

			</article><!-- #post-<?php the_ID(); ?> -->

			<?php get_template_part('pagination-image'); ?>

			<?php // comments_template(); ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>