<?php //Facebook
if(get_the_author_meta( 'facebook' )): ?>
<a href="<?php echo get_the_author_meta( 'facebook' ); ?>"  class="facebook" target="_blank">
	<span class="icon fa fa-facebook fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Facebook', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //Twitter
if(get_the_author_meta( 'twitter' )): ?>
<a href="<?php echo get_the_author_meta( 'twitter' ); ?>"  class="twitter" target="_blank">
	<span class="icon fa fa-twitter fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Twitter', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //Instagram
if(get_the_author_meta( 'instagram' )): ?>
<a href="<?php echo get_the_author_meta( 'instagram' ); ?>"  class="instagram" target="_blank">
	<span class="icon fa fa-instagram fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Instagram', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //Linkedin
if(get_the_author_meta( 'linkedin' )): ?>
<a href="<?php echo get_the_author_meta( 'linkedin' ); ?>"  class="linkedin" target="_blank">
	<span class="icon fa fa-linkedin fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Linkedin', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //YouTube
if(get_the_author_meta( 'youtube' )): ?>
<a href="<?php echo get_the_author_meta( 'youtube' ); ?>"  class="youtube" target="_blank">
	<span class="icon fa fa-youtube-play fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s channel on YouTube', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //Google+
if(get_the_author_meta( 'googleplus' )): ?>
<a href="<?php echo get_the_author_meta( 'googleplus' ); ?>"  class="googleplus" target="_blank">
	<span class="icon fa fa-google-plus fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Google+', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //WhatsApp
if(get_the_author_meta( 'whatsapp' )): ?>
<a href="tel:<?php echo get_the_author_meta( 'whatsapp' ); ?>"  class="whatsapp" target="_blank">
	<span class="icon fa fa-whatsapp fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s WhatsApp number', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //iMessage
if(get_the_author_meta( 'imessage' )): ?>
<a href="<?php echo get_the_author_meta( 'imessage' ); ?>"  class="imessage" target="_blank">
	<span class="icon fa fa-comment fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s iMessage contact', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //SoundCloud Link
if(get_the_author_meta( 'soundcloud' )): ?>
<a href="<?php echo get_the_author_meta( 'soundcloud' ); ?>"  class="soundcloud" target="_blank">
	<span class="icon fa fa-soundcloud fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Soundcloud', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //Dribbble
if(get_the_author_meta( 'dribbble' )): ?>
<a href="<?php echo get_the_author_meta( 'dribbble' ); ?>"  class="dribbble" target="_blank">
	<span class="icon fa fa-dribbble fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Dribbble', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //Behance
if(get_the_author_meta( 'behance' )): ?>
<a href="<?php echo get_the_author_meta( 'behance' ); ?>"  class="behance" target="_blank">
	<span class="icon fa fa-behance fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Behance', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //DeviantArt
if(get_the_author_meta( 'deviantart' )): ?>
<a href="<?php echo get_the_author_meta( 'deviantart' ); ?>"  class="deviantart" target="_blank">
	<span class="icon fa fa-deviantart fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on DeviantArt', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //Pinterest
if(get_the_author_meta( 'pinterest' )): ?>
<a href="<?php echo get_the_author_meta( 'pinterest' ); ?>"  class="pinterest" target="_blank">
	<span class="icon fa fa-pinterest fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on Pinterest', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>


<?php //GitHub
if(get_the_author_meta( 'github' )): ?>
<a href="<?php echo get_the_author_meta( 'github' ); ?>"  class="github" target="_blank">
	<span class="icon fa fa-github fw"></span>
	<span class="screen-reader-text">
		<?php printf( __('%s\'s profile on GitHub', 'zen-read'), '<span class="author-name">' . get_the_author() . '</span>' ) ;?>
	</span>
</a>
<?php endif; ?>