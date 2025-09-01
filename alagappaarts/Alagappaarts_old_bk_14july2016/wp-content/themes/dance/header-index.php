<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="main">

 *

 * @package WordPress

 * @subpackage Twenty_Ten

 * @since Twenty Ten 1.0

 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php

	/*

	 * Print the <title> tag based on what is being viewed.

	 */

	global $page, $paged;



	wp_title( '|', true, 'right' );



	// Add the blog name.

	bloginfo( 'name' );



	// Add the blog description for the home/front page.

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		echo " | $site_description";



	// Add a page number if necessary:

	if ( $paged >= 2 || $page >= 2 )

		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );



	?></title>



<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />



<?php

	if ( is_singular() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );



	wp_head();

?>

<script type='text/javascript' src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.js"></script>

 <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery-migrate-1.2.1.min.js"></script> 
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/slick.min.js"></script> 
<script type='text/javascript' src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.aviaSlider.min.js"></script>

<script type='text/javascript' src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.prettyPhoto.js"></script>

<script type='text/javascript' src="<?php bloginfo('stylesheet_directory'); ?>/scripts/custom.js"></script>

</head>



<body class="dancebg clearfix">

<div class="wrapper">

<div class="danceHeader">

<div class="headerLeft"><a href="http://alagappaarts.com/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite-img.gif" width="1" height="1" class="danceLogo" alt="Alagappa Performing Arts academy" title="Alagappa Performing Arts academy" /></a></div>



<?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'primary' , 'menu_class' => 'menu') ); ?>



</div>

<div class="danceIndexBanner">

<ul class="aviaslider" id="frontpage-slider">

<li class="slider">

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-bg.jpg" name="blankbg"  width="1000" height="340"  id="blankbg">

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider.jpg" width="448" height="341" />

<h2>APAA Proudly features Ms.Vishal Ramani<br>
The first APAC to launch<br>
APAA Program in San Jose.
<span class="slider1">Director of<br>
Shri Krupa Dance Foundation</span></h2>
</li>


<li class="slider">

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-bg.jpg" name="blankbg"  width="1000" height="340"  id="blankbg">

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/bannerimg1-1.jpg" width="448" height="341" />

<h2>The hands must explain the meaning.<br/>

The eyes must speak the emotion.<br/>

The feet must beat with a rhythm.<br/>

The body should catch the tune.<span>- Natyasastra</span></h2>

</li>

<li class="slider">

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-bg.jpg" name="blankbg"  width="1000" height="340"  id="blankbg">     

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/bannerimg2-2.jpg" width="448" height="341" />

<h2>The hands must explain the meaning.<br/>

The eyes must speak the emotion.<br/>

The feet must beat with a rhythm.<br/>

The body should catch the tune.<span>- Natyasastra</span></h2>

 </li>



<li class="slider">

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-bg.jpg" name="blankbg"  width="1000" height="340"  id="blankbg">     

<img src="<?php bloginfo('stylesheet_directory'); ?>/images/bannerimg3-3.jpg" width="448" height="341" />

<h2>The hands must explain the meaning.<br/>

The eyes must speak the emotion.<br/>

The feet must beat with a rhythm.<br/>

The body should catch the tune.<span>- Natyasastra</span></h2>

 </li>



</ul>

</div>


