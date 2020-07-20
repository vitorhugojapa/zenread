<!DOCTYPE html>
<?php $htmlclass;
/* if is single and get a cutom field named "dark" set the class to use a dark UI */
if(is_single() && get_post_meta( get_the_ID(), 'dark', true )){
  $htmlclass = ' class="dark"';
} ?>
<html <?php language_attributes(); echo $htmlclass; ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>"/>

<link async rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

<?php wp_head(); ?>

</head>

<body <?php

   //add page slug and listing format as classes
   if( is_page() ){
      
      body_class( getPageSlug() );

   //add post categories and listing format as classes
   }else if(is_single()){
      
      body_class( getCategorySlugs() );

  //add listing format class
  }else{
      body_class(get_option( 'theme_listing_format' ));
  }
?>>
<div id="page">
  
	<header id="top" role="navigation">

    <?php get_template_part('menu'); ?>

	</header><!-- #top -->
  
	<div id="main">