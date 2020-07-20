<div id="menu" role="navigation">

	<!-- branding -->
	<a href="<?php echo get_home_url(); ?>" class="custom-logo-link" rel="home" itemprop="url" title="<?php _e('Go to Home', 'zen-read'); ?>">
	<?php if(has_custom_logo()):

		$custom_logo_id = get_theme_mod( 'custom_logo' );

		$logo_src = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>

		<img width="310" height="120" src="<?php echo $logo_src[0]; ?>" class="custom-logo" alt="<?php _e('Go to Home', 'zen-read'); ?>" itemprop="logo">
	<?php else:
		echo bloginfo('name');
	endif; ?>
	</a>

	<?php /* menu items */
	if(has_nav_menu('categories')):
		$args = array(
			'theme_location' => 'categories',
			'container' => '',
	  	);
		wp_nav_menu($args);
	elseif(is_user_logged_in()):?>
	 <ul id="menu-categories" class="menu" role="navigation">
	 	<li class="menu-item">
	 		<a href="<?php echo get_site_url() , '/wp-admin/nav-menus.php'; ?>" class="admin-option"><?php _e('Add menu', 'zen-read'); ?></a>
	 	</li>
	</ul>
	<?php endif; ?>

	<div class="social" role="navigation">

		<?php if(get_option( 'theme_social_first' )):

		$social_items = array (
		    1 => get_option( 'theme_social_first' ),
		    2 => get_option( 'theme_social_second' ),
		    3 => get_option( 'theme_social_third' ),
		    4 => get_option( 'theme_social_fourth' ),
		    5 => get_option( 'theme_social_fifth' ),
		    6 => get_option( 'theme_social_sixth' ),
	    );

	    $i = 1;

    	while($i<=6){

    		switch ($social_items[$i]) {
    			case 'theme_youtube_channel': ?>
					<a href="<?php echo get_option( 'theme_youtube_channel' ); ?>"  class="youtube fa fa-youtube-play" target="_blank" title="<?php _e('Go to YouTube Channel','zen-read');?>">
					<span class="label">YouTube</span></a><?php
    				break;

    			case 'theme_linkedin_url': ?>
					<a href="<?php echo get_option( 'theme_linkedin_url' ); ?>"  class="linkedin fa fa-linkedin" target="_blank" title="<?php _e('Go to Linkedin Profile','zen-read');?>">
					<span class="label">Linkedin</span></a><?php
    				break;

    			case 'theme_whatsapp_number': ?>
					<a href="https://api.whatsapp.com/send?phone=<?php echo get_option( 'theme_whatsapp_number' ); ?>"  class="whatsapp fa fa-whatsapp" title="<?php _e('Contact through WhatsApp','zen-read');?>">
					<span class="label">WhatsApp</span></a><?php
    				break;

    			case 'theme_facebook_url': ?>
					<a href="<?php echo get_option( 'theme_facebook_url' ); ?>"  class="facebook fa fa-facebook" target="_blank" title="<?php _e('Go to Facebook Page','zen-read');?>">
					<span class="label">Facebook</span></a><?php
    				break;

    			case 'theme_instagram_profile': ?>
					<a href="<?php echo get_option( 'theme_instagram_profile' ); ?>"  class="instagram fa fa-instagram" target="_blank" title="<?php _e('Go to Instagram Profile','zen-read');?>">
					<span class="label">Instagram</span></a><?php
    				break;


    			case 'theme_twitter_profile': ?>
					<a href="http://twitter.com/<?php echo get_option( 'theme_twitter_profile' ); ?>"  class="twitter fa fa-twitter" target="_blank" title="<?php _e('Go to Twitter Profile','zen-read');?>">
					<span class="label">Twitter</span></a><?php
    				break;

    			case 'theme_google_profile': ?>
    				<a href="<?php echo get_option( 'theme_google_profile' ); ?>"  class="google-plus fa fa-google-plus" target="_blank" title="<?php _e('Go to Google+ Profile','zen-read');?>">
					<span class="label">Google+</span></a><?php
    				break;

    			case 'theme_dribbble_profile': ?>
					<a href="<?php echo get_option( 'theme_dribbble_profile' ); ?>"  class="dribbble fa fa-dribbble" target="_blank" title="<?php _e('Go to Dribbble Portfolio','zen-read');?>">
					<span class="label">Dribbble</span></a><?php
    				break;

    			case 'theme_behance_profile': ?>
					<a href="<?php echo get_option( 'theme_behance_profile' ); ?>"  class="behance fa fa-behance" target="_blank" title="<?php _e('Go to Behance Portfolio','zen-read');?>">
					<span class="label">Behance</span></a><?php
    				break;

    			case 'theme_github_url': ?>
					<a href="<?php echo get_option( 'theme_github_url' ); ?>"  class="github fa fa-github" target="_blank" title="<?php _e('Go to Projects on GitHub','zen-read');?>">
					<span class="label">Github</span></a><?php
    				break;

    			case 'theme_appstore_url': ?>
					<a href="<?php echo get_option( 'theme_appstore_url' ); ?>"  class="apple fa fa-apple" target="_blank" title="<?php _e('Go to Apps in the App Store','zen-read');?>">
					<span class="label">iOS Apps</span></a><?php
    				break;

    			case 'theme_googleplay_url': ?>
    				<a href="<?php echo get_option( 'theme_googleplay_url' ); ?>"  class="android fa fa-android" target="_blank" title="<?php _e('Go to Apps in the App Store','zen-read');?>">
					<span class="label">Android Apps</span></a><?php
    				break;

    			case 'theme_apple_podcast_url': ?>
					<a href="<?php echo get_option( 'theme_apple_podcast_url' ); ?>"  class="podcast fa fa-podcast" target="_blank" title="<?php _e('Go to Podcast on iTunes','zen-read');?>">
					<span class="label">Podcast</span></a><?php
    				break;

    			case 'theme_twitch_url': ?>
					<a href="<?php echo get_option( 'theme_twitch_url' ); ?>"  class="twitch fa fa-twitch" target="_blank" title="<?php _e('Go to Twitch Channel','zen-read');?>">
					<span class="label">Twitch</span></a><?php
    				break;

    			case 'theme_medium_url': ?>
    				<a href="<?php echo get_option( 'theme_medium_url' ); ?>"  class="medium fa fa-medium" target="_blank" title="<?php _e('Go to Medium Articles','zen-read');?>">
					<span class="label">Medium</span></a><?php
    				break;

    			case 'theme_pinterest_profile': ?>
    				<a href="<?php echo get_option( 'theme_pinterest_profile' ); ?>"  class="pinterest fa fa-pinterest" target="_blank" title="<?php _e('Go to Pinterest Profile','zen-read');?>">
					<span class="label">Pinterest</span></a><?php
    				break;

    			case 'theme_soundcloud_url': ?>
    				<a href="<?php echo get_option( 'theme_soundcloud_url' ); ?>"  class="soundcloud fa fa-soundcloud" target="_blank" title="<?php _e('Go to Soundcloud','zen-read');?>">
					<span class="label">Soundcloud</span></a><?php
    				break;
    		}

    		$i++;
		}?>

		<div id="social">

			<div class="wrapper">

				<?php $profile = 0; ?>

				<?php //YouTube
				if(get_option( 'theme_youtube_channel' )): ?>

				<a href="<?php echo get_option( 'theme_youtube_channel' ); ?>"  class="youtube fa fa-youtube-play" target="_blank" title="<?php _e('Go to YouTube Channel','zen-read');?>">
					<span class="label">YouTube</span></a>
				<?php $profile++; endif; ?>


				<?php //Apple Podcast
				if(get_option( 'theme_apple_podcast_url' )): ?>

				<a href="<?php echo get_option( 'theme_apple_podcast_url' ); ?>"  class="podcast fa fa-podcast" target="_blank" title="<?php _e('Go to Podcast on iTunes','zen-read');?>">
					<span class="label">Podcast</span></a>
				<?php $profile++; endif; ?>


				<?php //Twitch
				if(get_option( 'theme_twitch_url' )): ?>

				<a href="<?php echo get_option( 'theme_twitch_url' ); ?>"  class="twitch fa fa-twitch" target="_blank" title="<?php _e('Go to Twitch Channel','zen-read');?>">
					<span class="label">Twitch</span></a>
				<?php $profile++; endif; ?>


				<?php //Linkedin
				if(get_option( 'theme_linkedin_url' )): ?>

				<a href="<?php echo get_option( 'theme_linkedin_url' ); ?>"  class="linkedin fa fa-linkedin" target="_blank" title="<?php _e('Go to Linkedin Profile','zen-read');?>">
					<span class="label">Linkedin</span></a>
				<?php $profile++; endif; ?>


				<?php //WhatsApp
				if(get_option( 'theme_whatsapp_number' )): ?>

				<a href="https://api.whatsapp.com/send?phone=<?php echo get_option( 'theme_whatsapp_number' ); ?>"  class="whatsapp fa fa-whatsapp" title="<?php _e('Contact through WhatsApp','zen-read');?>">
					<span class="label">WhatsApp</span></a>
				<?php $profile++; endif; ?>


				<?php //Facebook
				if(get_option( 'theme_facebook_url' )): ?>

				<a href="<?php echo get_option( 'theme_facebook_url' ); ?>"  class="facebook fa fa-facebook" target="_blank" title="<?php _e('Go to Facebook Page','zen-read');?>">
					<span class="label">Facebook</span></a>
				<?php $profile++; endif; ?>


				<?php //Instagram
				if(get_option( 'theme_instagram_profile' )): ?>

				<a href="<?php echo get_option( 'theme_instagram_profile' ); ?>"  class="instagram fa fa-instagram" target="_blank" title="<?php _e('Go to Instagram Profile','zen-read');?>">
					<span class="label">Instagram</span></a>
				<?php $profile++; endif; ?>


				<?php //Twitter
				if(get_option( 'theme_twitter_profile' )): ?>

				<a href="http://twitter.com/<?php echo get_option( 'theme_twitter_profile' ); ?>"  class="twitter fa fa-twitter" target="_blank" title="<?php _e('Go to Twitter Profile','zen-read');?>">
					<span class="label">Twitter</span>
				</a>
				<?php $profile++; endif; ?>


				<?php //Dribbble
				if(get_option( 'theme_dribbble_profile' )): ?>

				<a href="<?php echo get_option( 'theme_dribbble_profile' ); ?>"  class="dribbble fa fa-dribbble" target="_blank" title="<?php _e('Go to Dribbble Portfolio','zen-read');?>">
					<span class="label">Dribbble</span></a>
				<?php $profile++; endif; ?>


				<?php //Behance
				if(get_option( 'theme_behance_profile' )): ?>

				<a href="<?php echo get_option( 'theme_behance_profile' ); ?>"  class="behance fa fa-behance" target="_blank" title="<?php _e('Go to Behance Portfolio','zen-read');?>">
					<span class="label">Behance</span></a>
				<?php $profile++; endif; ?>


				<?php //Github
				if(get_option( 'theme_github_url' )): ?>

				<a href="<?php echo get_option( 'theme_github_url' ); ?>"  class="github fa fa-github" target="_blank" title="<?php _e('Go to Projects on GitHub','zen-read');?>">
					<span class="label">Github</span></a>
				<?php $profile++; endif; ?>


				<?php //Apple Developer
				if(get_option( 'theme_appstore_url' )): ?>

				<a href="<?php echo get_option( 'theme_appstore_url' ); ?>"  class="apple fa fa-apple" target="_blank" title="<?php _e('Go to Apps in the App Store','zen-read');?>">
					<span class="label">iOS Apps</span></a>
				<?php $profile++; endif; ?>


				<?php //Android Developer
				if(get_option( 'theme_googleplay_url' )): ?>

				<a href="<?php echo get_option( 'theme_googleplay_url' ); ?>"  class="android fa fa-android" target="_blank" title="<?php _e('Go to Apps in the App Store','zen-read');?>">
					<span class="label">Android Apps</span></a>
				<?php $profile++; endif; ?>


				<?php //Medium
				if(get_option( 'theme_medium_url' )): ?>

				<a href="<?php echo get_option( 'theme_medium_url' ); ?>"  class="medium fa fa-medium" target="_blank" title="<?php _e('Go to Medium Articles','zen-read');?>">
					<span class="label">Medium</span></a>
				<?php $profile++; endif; ?>


				<?php //Pinterest
				if(get_option( 'theme_pinterest_profile' )): ?>

				<a href="<?php echo get_option( 'theme_pinterest_profile' ); ?>"  class="pinterest fa fa-pinterest" target="_blank" title="<?php _e('Go to Pinterest Profile','zen-read');?>">
					<span class="label">Pinterest</span></a>
				<?php $profile++; endif; ?>


				<?php //Soundcloud
				if(get_option( 'theme_soundcloud_url' )): ?>

				<a href="<?php echo get_option( 'theme_soundcloud_url' ); ?>"  class="soundcloud fa fa-soundcloud" target="_blank" title="<?php _e('Go to Soundcloud','zen-read');?>">
					<span class="label">Soundcloud</span></a>
				<?php $profile++; endif; ?>


				<?php //Google+
				if(get_option( 'theme_google_profile' )): ?>

				<a href="<?php echo get_option( 'theme_google_profile' ); ?>"  class="google-plus fa fa-google-plus" target="_blank" title="<?php _e('Go to Google+ Profile','zen-read');?>">
					<span class="label">Google+</span></a>
				<?php $profile++; endif; ?>

			</div>
			
			<?php if($profile > 2): ?>
				<!-- opens more social profiles if there is -->
				<a href="#social" class="more" title="<?php _e('more','zen-read'); ?>">
					<i class="material-icons">more_vert</i>
					<span class="label"><?php _e('more','zen-read'); ?></span>
				</a>
				
				<!-- close -->
				<a href="#back" class="close" title="<?php _e('close','zen-read'); ?>">
					<i class="material-icons">close</i>
					<span class="label"><?php _e('close','zen-read'); ?></span>
				</a>
			<?php endif; ?>
			
		</div>

		<?php elseif(is_user_logged_in()): ?>
		<a href="<?php echo get_site_url() , '/wp-admin/customize.php'; ?>" class="admin-option" title="<?php _e('Add social profiles menu', 'zen-read'); ?>">
			<i class="material-icons">add</i>
			<span class="label"><?php _e('Profiles', 'zen-read'); ?></span>
		</a>
		<?php endif; ?>

		<nav id="search">	
			<!-- opens search form -->
			<a href="#search" class="search" title="<?php _e('search','zen-read'); ?>">
				<i class="material-icons">search</i>
				<span class="label"><?php _e('search','zen-read'); ?></span>
			</a>
			<!-- close search form -->
			<a href="#back" class="close-search" title="<?php _e('close','zen-read'); ?>">
				<i class="material-icons">close</i>
				<span class="label"><?php _e('close','zen-read'); ?></span>
			</a>
			<?php get_search_form(); ?>
		</nav>

	</div>

</div>