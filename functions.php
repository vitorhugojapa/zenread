<?php

//define theme's width
if ( ! isset( $content_width ) ) {
  $content_width = 1024;
  //every image will be cut with the max. $content_width
}


//add localization support
load_theme_textdomain( 'zen-read', get_template_directory() . '/languages' );


//add jQuery support
function add_scripts() {
  if (!is_admin()) {
    wp_enqueue_script('jquery');
  }
}
add_action('init', 'add_scripts');

function page_home_posts( $wp_query ) {
    if ( $wp_query->is_main_query() && is_home() )
        $wp_query->set( 'tag', 'acao' );
}


//unlock excerpts from password protected posts
function unlocked_excerpt($excerpt){
  if(post_password_required()){
    $post = get_post();
    $excerpt = $post->post_excerpt;
  }
  return $excerpt;
}
add_filter( 'the_excerpt', 'unlocked_excerpt' );


//custom password protection form
function custom_post_password_form() {
    
    global $post;
    
    $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

    $form = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="post-password-form">
    <h4>' . __( "To view this post, enter the password below.", "zen-read" ) . '</h4>
    <label for="' . $label . '">' . __( "Password", "zen-read" ) . ':</label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" tabindex="1" autofocus /><input type="submit" name="Submit" value="' . esc_attr__( "Submit", "zen-read" ) . '" tabindex="2" /></form>';

    return $form;
}
add_filter( 'the_password_form', 'custom_post_password_form' );


//edit password protected post titles
add_filter( 'protected_title_format', 'remove_protected_text' );
  function remove_protected_text() {
  return '<i class="material-icons">lock</i> ' . __('%s', 'zen-read');
}


//add post-thumbnail support
add_theme_support( 'post-thumbnails' );


//add branding support
add_theme_support( 'custom-logo', array(
  'height'      => 60,
  'width'       => 155,
  'flex-height' => true,
  'flex-width'  => true,
  'header-text' => array( 'site-title', 'site-description' ),
) );

//add wp-admin editor style
add_editor_style();


//add menu support
register_nav_menu( 'categories', __('Categories', 'zen-read') );


//add feed links in wp-head
add_theme_support( 'automatic-feed-links' );


//setup the blog title
add_action( 'after_setup_theme', 'wpse_theme_setup' );
function wpse_theme_setup() {
    add_theme_support( 'title-tag' );
}


//comments html template 
function customCommentTemplate($comment, $args, $depth) {

    if ( 'div' === $args['style'] ) {
      $tag       = 'div';
      $add_below = 'comment';
    } else {
      $tag       = 'li';
      $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
      
      <?php if ( 'div' != $args['style'] ) : ?>
          
          <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    
      <?php endif; ?>
    
      <div class="comment-author vcard">

        <?php
        if ( $args['avatar_size'] != 0 ):
        
          echo get_avatar( $comment, $args['avatar_size'] );

        endif; ?>

        <cite class="fn"><?php echo get_comment_author_link(); ?></cite><span class="says"> <?php _e('said:','zen-read'); ?></span>

      </div>
      
      <?php if ( $comment->comment_approved == '0' ) : ?>
          
          <em class="comment-awaiting-moderation">
            <?php _e('Waiting for approval', 'zen-read'); ?>
          </em>

      <?php endif; ?>

    <div class="comment-meta commentmetadata">

      <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        
        <?php
        //convert date to time to compare
        $commentDateTime = strtotime( get_comment_date() );
        //define the max. interval
        $todaysDate = strtotime('-8 week');
        //if the time is in the interval, displays a better format
        if ( $commentDateTime >= $todaysDate ) {
          echo human_time_diff( get_comment_date('U') , current_time('timestamp') ) , __(' ago','zen-read');
        }else{
          //paste date and time
          printf( __('in %s', 'zen-read'), date_i18n( get_option( 'date_format' ), strtotime(get_the_date('m/d-Y')) ) );
        } ?>
          
      </a>
      
      <?php edit_comment_link( __('Edit', 'zen-read') ); ?>

      <?php echo get_comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'respond_id' => 'comments', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

    </div>

    <?php comment_text(); ?>

    <?php if ( 'div' != $args['style'] ) : ?>

    </div><!-- end .comment -->
    
    <?php endif;
}


//returns page slug
function getPageSlug(){
  return 'single page-' . basename(get_permalink()) . ' ' . get_option( 'theme_listing_format' );
}


function humanizedDate($post){
  _e('Published ', 'zen-read');
  //convert date to time to compare
  $postDateTime = strtotime( $post->post_date );
  //define the max. interval
  $todaysDate = strtotime('-8 week');
  //if the time is in the interval, displays a better format
  if ( $postDateTime >= $todaysDate ) {
    echo human_time_diff( get_the_date('U') , current_time('timestamp') ) , __(' ago','zen-read');
  }else{
    printf( __('in %s', 'zen-read'), date_i18n( get_option( 'date_format' ), strtotime(get_the_date('m/d-Y')) ) );
  }
}


//return categories slugs inside a loop post
function getCategorySlugs(){
  $cats = '';
  $category = get_the_category();
  $catSize = sizeof($category);
  $ci = 0;
  for($ci;$ci<$catSize;$ci++){
    $cats .= ' category-' . $category[$ci]->slug;
  }
  return $cats . ' ' . get_option( 'theme_listing_format' );
}


function getParentCategory(){

  $parent = array('name' => false, 'color' => false);

  foreach((get_the_category()) as $cat){

    $args = array( 'child_of' => $cat->cat_ID );

    $categories = get_categories( $args );
    if( $categories ) {
      $parent['name'] = $cat->name;
      $parent['link'] = get_category_link($cat->cat_ID);

      break;
    }
  }

  //if $parent['name'] is not valid, it means that the previous loop didn't find anything and in this case returns the first category related with the post
  if(!$parent['name']){
    $cat = get_the_category();
    $parent['name'] = $cat[0]->name;
    $parent['link'] = get_category_link($cat[0]->cat_ID);
  }
  return $parent;
}


function custom_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//add featured images to the rss
function rss_post_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<p>' . get_the_post_thumbnail($post->ID, 'large') .
		'</p><br/>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');


//remove pages from search query
function searchfilter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'post');
  }
  return $query;
}
add_filter('pre_get_posts','searchfilter');


//add user profile fields
function extra_contact_info($contactmethods) {
  
  unset($contactmethods['aim']);

  unset($contactmethods['yim']);

  unset($contactmethods['jabber']);

  $contactmethods['facebook'] = 'Facebook';

  $contactmethods['twitter'] = 'Twitter';

  $contactmethods['linkedin'] = 'LinkedIn';

  $contactmethods['googleplus'] = 'Google+';
  
  $contactmethods['youtube'] = 'YouTube';
  
  $contactmethods['instagram'] = 'Instagram';
  
  $contactmethods['whatsapp'] = 'WhatsApp';
  
  $contactmethods['imessage'] = 'iMessage';
  
  $contactmethods['soundcloud'] = 'SoundCloud';
  
  $contactmethods['podcasts'] = 'Podcasts';

  $contactmethods['dribbble'] = 'Dribbble';
  
  $contactmethods['behance'] = 'Behance';
  
  $contactmethods['deviantart'] = 'DeviantArt';
  
  $contactmethods['pinterest'] = 'Pinterest';

  return $contactmethods;

}
add_filter('user_contactmethods', 'extra_contact_info');


add_theme_support( 'post-formats', array(
  'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio'
) );


function getFeaturedImageURL( $size ){
  $post = $GLOBALS['post'];
  $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size );
  return $image['0'];
}


function getFeaturedImage(){
  echo '<img src="' . getFeaturedImageURL("medium") . '" sizes="(min-width: 320px) 100vw, 100vw" srcset="' .  getFeaturedImageURL("thumbnail") . ' 130w, ' . getFeaturedImageURL("medium") . ' 320w, ' . getFeaturedImageURL("large") .' 1024w" alt="' . getFeaturedImageAlt() . '" class="featured-image"/>';
}


//removes the default WP gallery styles
add_filter( 'use_default_gallery_style', '__return_false' );


function getFeaturedImageAlt(){
  $post = $GLOBALS['post'];
  $image_id = get_post_thumbnail_id( $post->ID );
  return get_post_meta($image_id, '_wp_attachment_image_alt', true);
}


function customYoutubeSettings($code){
  //if it is a YouTube URL, add default parameters
  if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
    $return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&autohide=1&HD=1", $code);
    return $return;
  }
  return $code;
}
add_filter('embed_handler_html', 'customYoutubeSettings');
add_filter('embed_oembed_html', 'customYoutubeSettings');


function customPagination(){

  $prev = '';
  $next = '';

  if( get_previous_posts_link() ){
    $prev = get_previous_posts_link('Previous');
    $newprev = ' class="previous"><span class="screen-reader-text">' . __('Previous page', 'zen-read') . '</span><i class="material-icons">arrow_back</i>';
    $prev = str_replace('>Previous', $newprev, $prev );
  }

  if( get_next_posts_link() ){
    $next = get_next_posts_link('Next');
    $newnext = ' class="next"><span class="screen-reader-text">' . __('Next page', 'zen-read') . '</span><i class="material-icons">arrow_forward</i>';
    $next = str_replace('>Next', $newnext, $next );
  }

  echo $prev;
  echo $next;
}


function customCommentPagination(){

  $prev = '';
  $next = '';

  if( get_previous_comments_link() ){
    $prev = get_previous_comments_link('Previous');
    $newprev = ' class="previous"><span class="screen-reader-text">' . __('Previous comments', 'zen-read') . '</span><i class="material-icons">arrow_back</i>';
    $prev = str_replace('>Previous', $newprev, $prev );
  }

  if( get_next_comments_link() ){
    $next = get_next_comments_link('Next');
    $newnext = ' class="next"><span class="screen-reader-text">' . __('Next comments', 'zen-read') . '</span><i class="material-icons">arrow_forward</i>';
    $next = str_replace('>Next', $newnext, $next );
  }

  echo $prev;
  echo $next;
}


//remove jetpack css minification
add_filter( 'jetpack_implode_frontend_css', '__return_false' );


//remove unecessary jetpack css styles
function remove_jetpack_styles() {
  //wp_deregister_style( 'AtD_style' ); // After the Deadline
  //wp_deregister_style( 'jetpack_likes' ); // Likes
  wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
  //wp_deregister_style( 'jetpack-carousel' ); // Carousel
  //wp_deregister_style( 'grunion.css' ); // Grunion contact form
  wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
  wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
  wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
  wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
  //wp_deregister_style( 'noticons' ); // Notes
  //wp_deregister_style( 'post-by-email' ); // Post by Email
  //wp_deregister_style( 'publicize' ); // Publicize
  //wp_deregister_style( 'sharedaddy' ); // Sharedaddy
  //wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
  //wp_deregister_style( 'stats_reports_css' ); // Stats
  wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
  //wp_deregister_style( 'presentations' ); // Presentation shortcode
  //wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
  //wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
  //wp_deregister_style( 'widget-conditions' ); // Widget Visibility
  //wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
  //wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
  //wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
  //wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
add_action('wp_print_styles', 'remove_jetpack_styles' );


//modify the default number of jetpack related posts
function jetpackme_more_related_posts( $options ) {
    $options['size'] = 3;
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'jetpackme_more_related_posts' );


//removes jetpack related posts automatic embbeding
function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'jetpackme_remove_rp', 20 );


//modify jetpack's related posts title
function jetpackme_related_posts_headline( $headline ) {
  $headline = '<h3 class="jp-relatedposts-headline aside-title">' . __('Read more', 'zen-read') .'</h3>';
  return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'jetpackme_related_posts_headline' );


//modify jetpack's infinite scroll footer html
function customJetpackFooter() {
  get_template_part('footer-jetpack-infinite-scroll');
}


//print jetpack infinite scroll posts in loop
function customJetpackInfiniteContent(){
  while ( have_posts() ) : the_post();
    get_template_part( 'content', get_post_format() );
  endwhile;
}


//add infinite-scroll support and setup
add_theme_support( 'infinite-scroll', array(
//html element where infinite-scroll will print posts inside
    'container'       =>  'content',
//remove the wrapper
    'wrapper'         =>  false,
//inform jetpack that in this theme there is no footer widgets
    'footer_widgets'  =>  false,
    'footer'          =>  'body',
//custom footer html
    'footer_callback' =>  'customJetpackFooter',
    'posts_per_page'  =>  9,
    'render' => 'customJetpackInfiniteContent',
) );


function getFirstPostYear(){

  $args = array(
    'numberposts' => 1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC'
  );

  $posts = get_posts($args);

  $first_post = $posts[0];

  $first_post_date = $first_post->post_date;

  $first_post_date = date("Y", strtotime($first_post_date));

  return $first_post_date;
}


//Sanitization
function sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


//add field in wp customizer
//documentation https://codex.wordpress.org/Plugin_API/Action_Reference/customize_register
//default categories can be found in: https://codex.wordpress.org/Theme_Customization_API
function theme_customize_register($wp_customize){

    /* SECTION: Social */
    $wp_customize->add_section('theme_social', array(
        'title'    => 'Social',
        'description' => '',
        'priority' => 50,
    ));


    /* SECTION: Social */
    $wp_customize->add_section('theme_reading', array(
        'title'    => __('Reading','zen-read'),
        'description' => '',
        'priority' => 50,
    ));


    /* TEXT INPUT: Disclaimer */
    $wp_customize->add_setting('theme_disclaimer', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('theme_disclaimer', array(
      'label'      => __('Disclaimer and footer notes', 'zen-read'),
      'section'    => 'theme_reading',
      'settings'   => 'theme_disclaimer',
      'type'       => 'textarea',
      'description'=> '',
    ));

    /* SELECT: Mobile Post Listing Format */
    $wp_customize->add_setting('theme_listing_format', array(
      'default'        => 'column-format',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'sanitize_select',
    ));
    $wp_customize->add_control('theme_listing_format', array(
      'settings' => 'theme_listing_format',
      'label'    => __('Mobile post listing:', 'zen-read'),
      'section'  => 'theme_reading',
      'type'     => 'select',
      'choices'    => array(
          'column-format' => __('Column','zen-read'),
          'row-format' => __('Row', 'zen-read'),
      ),
    ));

    /* SELECT: Social Option #1 */
    $wp_customize->add_setting('theme_social_first', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'sanitize_select',
    ));
    $wp_customize->add_control('theme_social_first', array(
      'settings' => 'theme_social_first',
      'label'    => __('Social menu #1', 'zen-read'),
      'section'  => 'theme_social',
      'type'     => 'select',
      'choices'    => array(
          'none' => '',
          'theme_facebook_url' => 'Facebook',
          'theme_instagram_profile' => 'Instagram',
          'theme_whatsapp_number' => 'WhatsApp',
          'theme_youtube_channel' => 'YouTube',
          'theme_twitch_url' => 'Twitch',
          'theme_linkedin_url' => 'Linkedin',
          'theme_twitter_profile' => 'Twitter',
          'theme_medium_url' => 'Medium',
          'theme_apple_podcast_url' => 'Podcast',
          'theme_soundcloud_url' => 'Soundcloud',
          'theme_google_profile' => 'Google+',
          'theme_pinterest_url' => 'Pinterest',
          'theme_dribbble_profile' => 'Dribbble',
          'theme_behance_profile' => 'Behance',
          'theme_github_url' => 'Github',
          'theme_appstore_url' => 'Apple Developer',
          'theme_googleplay_url' => 'Android Developer',
      ),
    ));

    /* SELECT: Social Option #2 */
    $wp_customize->add_setting('theme_social_second', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'sanitize_select',
    ));
    $wp_customize->add_control('theme_social_second', array(
      'settings' => 'theme_social_second',
      'label'    => __('Social menu #2', 'zen-read'),
      'section'  => 'theme_social',
      'type'     => 'select',
      'choices'    => array(
          'none' => '',
          'theme_facebook_url' => 'Facebook',
          'theme_instagram_profile' => 'Instagram',
          'theme_whatsapp_number' => 'WhatsApp',
          'theme_youtube_channel' => 'YouTube',
          'theme_twitch_url' => 'Twitch',
          'theme_linkedin_url' => 'Linkedin',
          'theme_twitter_profile' => 'Twitter',
          'theme_medium_url' => 'Medium',
          'theme_apple_podcast_url' => 'Podcast',
          'theme_soundcloud_url' => 'Soundcloud',
          'theme_google_profile' => 'Google+',
          'theme_pinterest_url' => 'Pinterest',
          'theme_dribbble_profile' => 'Dribbble',
          'theme_behance_profile' => 'Behance',
          'theme_github_url' => 'Github',
          'theme_appstore_url' => 'Apple Developer',
          'theme_googleplay_url' => 'Android Developer',
      ),
    ));

    /* SELECT: Social Option #3 */
    $wp_customize->add_setting('theme_social_third', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'sanitize_select',
    ));
    $wp_customize->add_control('theme_social_third', array(
      'settings' => 'theme_social_third',
      'label'    => __('Social menu #3', 'zen-read'),
      'section'  => 'theme_social',
      'type'     => 'select',
      'choices'    => array(
          'none' => '',
          'theme_facebook_url' => 'Facebook',
          'theme_instagram_profile' => 'Instagram',
          'theme_whatsapp_number' => 'WhatsApp',
          'theme_youtube_channel' => 'YouTube',
          'theme_twitch_url' => 'Twitch',
          'theme_linkedin_url' => 'Linkedin',
          'theme_twitter_profile' => 'Twitter',
          'theme_medium_url' => 'Medium',
          'theme_apple_podcast_url' => 'Podcast',
          'theme_soundcloud_url' => 'Soundcloud',
          'theme_google_profile' => 'Google+',
          'theme_pinterest_url' => 'Pinterest',
          'theme_dribbble_profile' => 'Dribbble',
          'theme_behance_profile' => 'Behance',
          'theme_github_url' => 'Github',
          'theme_appstore_url' => 'Apple Developer',
          'theme_googleplay_url' => 'Android Developer',
      ),
    ));

    /* SELECT: Social Option #4 */
    $wp_customize->add_setting('theme_social_fourth', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'sanitize_select',
    ));
    $wp_customize->add_control('theme_social_fourth', array(
      'settings' => 'theme_social_fourth',
      'label'    => __('Social menu #4', 'zen-read'),
      'section'  => 'theme_social',
      'type'     => 'select',
      'choices'    => array(
          'none' => '',
          'theme_facebook_url' => 'Facebook',
          'theme_instagram_profile' => 'Instagram',
          'theme_whatsapp_number' => 'WhatsApp',
          'theme_youtube_channel' => 'YouTube',
          'theme_twitch_url' => 'Twitch',
          'theme_linkedin_url' => 'Linkedin',
          'theme_twitter_profile' => 'Twitter',
          'theme_medium_url' => 'Medium',
          'theme_apple_podcast_url' => 'Podcast',
          'theme_soundcloud_url' => 'Soundcloud',
          'theme_google_profile' => 'Google+',
          'theme_pinterest_url' => 'Pinterest',
          'theme_dribbble_profile' => 'Dribbble',
          'theme_behance_profile' => 'Behance',
          'theme_github_url' => 'Github',
          'theme_appstore_url' => 'Apple Developer',
          'theme_googleplay_url' => 'Android Developer',
      ),
    ));

    /* SELECT: Social Option #5 */
    $wp_customize->add_setting('theme_social_fifth', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'sanitize_select',
    ));
    $wp_customize->add_control('theme_social_fith', array(
      'settings' => 'theme_social_fifth',
      'label'    => __('Social menu #5', 'zen-read'),
      'section'  => 'theme_social',
      'type'     => 'select',
      'choices'    => array(
          'none' => '',
          'theme_facebook_url' => 'Facebook',
          'theme_instagram_profile' => 'Instagram',
          'theme_whatsapp_number' => 'WhatsApp',
          'theme_youtube_channel' => 'YouTube',
          'theme_twitch_url' => 'Twitch',
          'theme_linkedin_url' => 'Linkedin',
          'theme_twitter_profile' => 'Twitter',
          'theme_medium_url' => 'Medium',
          'theme_apple_podcast_url' => 'Podcast',
          'theme_soundcloud_url' => 'Soundcloud',
          'theme_google_profile' => 'Google+',
          'theme_pinterest_url' => 'Pinterest',
          'theme_dribbble_profile' => 'Dribbble',
          'theme_behance_profile' => 'Behance',
          'theme_github_url' => 'Github',
          'theme_appstore_url' => 'Apple Developer',
          'theme_googleplay_url' => 'Android Developer',
      ),
    ));

    /* SELECT: Social Option #6 */
    $wp_customize->add_setting('theme_social_sixth', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'sanitize_select',
    ));
    $wp_customize->add_control('theme_social_sixth', array(
      'settings' => 'theme_social_sixth',
      'label'    => __('Social menu #6', 'zen-read'),
      'section'  => 'theme_social',
      'type'     => 'select',
      'choices'    => array(
          'none' => '',
          'theme_facebook_url' => 'Facebook',
          'theme_instagram_profile' => 'Instagram',
          'theme_whatsapp_number' => 'WhatsApp',
          'theme_youtube_channel' => 'YouTube',
          'theme_twitch_url' => 'Twitch',
          'theme_linkedin_url' => 'Linkedin',
          'theme_twitter_profile' => 'Twitter',
          'theme_medium_url' => 'Medium',
          'theme_apple_podcast_url' => 'Podcast',
          'theme_soundcloud_url' => 'Soundcloud',
          'theme_google_profile' => 'Google+',
          'theme_pinterest_url' => 'Pinterest',
          'theme_dribbble_profile' => 'Dribbble',
          'theme_behance_profile' => 'Behance',
          'theme_github_url' => 'Github',
          'theme_appstore_url' => 'Apple Developer',
          'theme_googleplay_url' => 'Android Developer',
      ),
    ));

    /* TEXT INPUT: Facebook */
    $wp_customize->add_setting('theme_facebook_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_facebook_url', array(
      'label'      => 'Facebook:',
      'section'    => 'theme_social',
      'settings'   => 'theme_facebook_url',
      'type'       => 'text',
      'description'=> __('Facebook page URL', 'zen-read'),
    ));

    /* TEXT INPUT: Instagram */
    $wp_customize->add_setting('theme_instagram_profile', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_instagram_profile', array(
      'label'      => 'Instagram:',
      'section'    => 'theme_social',
      'settings'   => 'theme_instagram_profile',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: WhatsApp */
    $wp_customize->add_setting('theme_whatsapp_number', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('theme_whatsapp_number', array(
      'label'      => 'WhatsApp:',
      'section'    => 'theme_social',
      'settings'   => 'theme_whatsapp_number',
      'type'       => 'text',
      'description'=> __('e.g: +5510987654321', 'zen-read'),
    ));

    /* TEXT INPUT: YouTube */
    $wp_customize->add_setting('theme_youtube_channel', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_youtube_channel', array(
      'label'      => 'YouTube:',
      'section'    => 'theme_social',
      'settings'   => 'theme_youtube_channel',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Twitch */
    $wp_customize->add_setting('theme_youtube_channel', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_youtube_channel', array(
      'label'      => 'Twitch:',
      'section'    => 'theme_social',
      'settings'   => 'theme_youtube_channel',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Linkedin */
    $wp_customize->add_setting('theme_linkedin_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_linkedin_url', array(
      'label'      => 'Linkedin:',
      'section'    => 'theme_social',
      'settings'   => 'theme_linkedin_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Twitch */
    $wp_customize->add_setting('theme_twitch_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_twitch_url', array(
      'label'      => 'Twitch:',
      'section'    => 'theme_social',
      'settings'   => 'theme_twitch_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Twitter */
    $wp_customize->add_setting('theme_twitter_profile', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('theme_twitter_profile', array(
      'label'      => 'Twitter:',
      'section'    => 'theme_social',
      'settings'   => 'theme_twitter_profile',
      'type'       => 'text',
      'description'=> __('Username only without the @', 'zen-read'),
    ));

    /* TEXT INPUT: Medium */
    $wp_customize->add_setting('theme_medium_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_medium_url', array(
      'label'      => 'Medium:',
      'section'    => 'theme_social',
      'settings'   => 'theme_medium_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Podcast */
    $wp_customize->add_setting('theme_apple_podcast_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_apple_podcast_url', array(
      'label'      => 'Podcast:',
      'section'    => 'theme_social',
      'settings'   => 'theme_apple_podcast_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Soundcloud */
    $wp_customize->add_setting('theme_soundcloud_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_soundcloud_url', array(
      'label'      => 'Soundcloud:',
      'section'    => 'theme_social',
      'settings'   => 'theme_soundcloud_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Google+ */
    $wp_customize->add_setting('theme_google_profile', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_google_profile', array(
      'label'      => 'Google+:',
      'section'    => 'theme_social',
      'settings'   => 'theme_google_profile',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Pinterest */
    $wp_customize->add_setting('theme_pinterest_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_pinterest_url', array(
      'label'      => 'Pinterest:',
      'section'    => 'theme_social',
      'settings'   => 'theme_pinterest_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Dribbble */
    $wp_customize->add_setting('theme_dribbble_profile', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_dribbble_profile', array(
      'label'      => 'Dribbble:',
      'section'    => 'theme_social',
      'settings'   => 'theme_dribbble_profile',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Behance */
    $wp_customize->add_setting('theme_behance_profile', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_behance_profile', array(
      'label'      => 'Behance:',
      'section'    => 'theme_social',
      'settings'   => 'theme_behance_profile',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Github */
    $wp_customize->add_setting('theme_github_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_github_url', array(
      'label'      => 'Github:',
      'section'    => 'theme_social',
      'settings'   => 'theme_github_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Apple App Store */
    $wp_customize->add_setting('theme_appstore_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_appstore_url', array(
      'label'      => 'App Store:',
      'section'    => 'theme_social',
      'settings'   => 'theme_appstore_url',
      'type'       => 'text',
      'description'=> '',
    ));

    /* TEXT INPUT: Google Play Store */
    $wp_customize->add_setting('theme_googleplay_url', array(
      'default'        => '',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
      'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('theme_googleplay_url', array(
      'label'      => 'Google Play Store:',
      'section'    => 'theme_social',
      'settings'   => 'theme_googleplay_url',
      'type'       => 'text',
      'description'=> '',
    ));
}

add_action('customize_register', 'theme_customize_register'); ?>