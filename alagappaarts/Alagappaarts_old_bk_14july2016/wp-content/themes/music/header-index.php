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

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery-1.4.2.min.js"></script>



<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.equalHeight.js"></script>



<script type="text/javascript">



$(document).ready(function() {



						   



						   $(".equalheight").equalHeights();



						   });



</script>

</head>



<body class="musicBg">

<div class="wrapper">

<div class="musicHeader">

<div class="headerLeft"><a href="http://alagappaarts.com/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sprite-img.gif" width="1" height="1" class="musicLogo" /></a></div>

<div class="musicHeaderLeft">

<div class="enquiry">

<div class="enquiryLeft">

  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/enquiry-bg.png" width="44" height="27" />

  </div>

  <div class="enquiryRight">

  enquiry<br />

<span>customersupport@alagappaarts.com</span>

</div>

  </div>

<?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'primary' , 'menu_class' => 'menu') ); ?>

</div>

</div>

<div class="homeMusicBanner"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/Music-banner.jpg" width="1000" height="265" /></div>
