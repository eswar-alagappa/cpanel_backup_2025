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

<?php wp_enqueue_script( 'cufon', get_bloginfo('template_url') .'/js/cufon-yui.js', array('jquery') ); ?>





<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php

	/* We add some JavaScript to pages with the comment form

	 * to support sites with threaded comments (when in use).

	 */

	if ( is_singular() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );



	/* Always have wp_head() just before the closing </head>

	 * tag of your theme, or you will break many plugins, which

	 * generally use this hook to add elements to <head> such

	 * as styles, scripts, and meta tags.

	 */

	wp_head();

?>


<?php if(is_page(array('apaa-programs','fee-structure','instrumental-music','vocal-music','instrumental-music-fees','vocal-music-fees'))) { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery-ui-personalized-1.5.2.packed.js"></script>



<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/sprinkle.js"></script>

<script type="text/javascript">



    $(document).ready(function(){

		var tabID = location.search.substring(1); 

		if(tabID){

			$('.feesStructure div').each(function(){ $(this).hide(); });

			$('#tabvanilla ul li').each(function(){ $(this).removeClass('ui-tabs-selected'); });

			$('#content'+tabID).show();

			$('#'+tabID).addClass('ui-tabs-selected');

			

		}

		});





</script>



<?php } ?>



<?php if(is_page(array('faq','faq-2'))) { ?>



<script type="text/javascript">
          $(document).ready(function(){
            $("#accordion").accordion({active: false, alwaysOpen: false, autoheight: false});
          });
          </script>





<?php } ?>





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




