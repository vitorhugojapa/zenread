<?php get_header(); ?>

	<div id="primary">

		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">

				<span class="author-picture">
			    	<a href="<?php echo get_author_posts_url( get_the_author_meta( "ID" )); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 180 ); ?></a>
				</span>

				<h1 class="page-title">
					<small><?php _e('Published by','zen-read');?></small><?php echo get_the_author(); ?>
				</h1>

				<?php if( get_the_author_meta( 'description' ) ): ?>
				<p class="author-description bio"><?php echo get_the_author_meta( 'description' ); ?></p>
				<?php endif; ?>

				<aside id="author-social">
				  <?php get_template_part('author-social'); ?>
				</aside>

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