    <span class="clear"></span>

</div><!-- #main -->

<footer id="footer">

<?php /* if Jetpack is not installed OR infinite Scroll is not active OR is in single or page loop, paste fixed footer */
if( !class_exists( 'Jetpack' ) || !Jetpack::is_module_active( 'infinite-scroll' ) || is_single() || is_page() ):
	get_template_part('footer-jetpack-infinite-scroll');
endif; ?>
  
</footer><!-- #footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

<link async href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>

<script type="text/javascript" async src="https://use.fontawesome.com/6ec75a539a.js"></script>

<script async type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/scripts.js"></script>

<script type="text/javascript" src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
<script type="text/javascript">
	window.sr = ScrollReveal();
	sr.reveal('article.listed');
</script>

<?php if( is_singular() && get_option( 'thread_comments' ) ){
	wp_enqueue_script( 'comment-reply' );
} ?>

</body>
</html>