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

?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php

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



	?>
</title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php

	if ( is_singular() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );



	wp_head();

?>
<?php if(is_page(array('apaa-programs','fee-structure'))) { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/sprinkle.js"></script>
<script type="text/javascript">



    $(document).ready(function(){

		var tabID = location.search.substring(1); 

		if(tabID){

			$('.contentLeftTop div').each(function(){ $(this).hide(); });

			$('#tabvanilla ul li').each(function(){ $(this).removeClass('ui-tabs-selected'); });

			$('#content'+tabID).show();

			$('#'+tabID).addClass('ui-tabs-selected');

			

		}

		});





</script>
<?php } ?>
</head>
<body <?php body_class(); ?> >
<div class="innerBg">
<div id="container">

<div id="header">
<div class="logo"> 
		<a href="http://alagappaarts.com/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" class="Vaasthu" alt="Alagappa Performing Arts academy" title="Alagappa Performing Arts academy" /></a>
	</div>
    
    
<div id="pre-header">
	<?php if ( has_nav_menu( 'primary' ) ) : ?> 
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'nav-head' ) ); ?>
	<?php endif; ?>

</div>
</div>


<div class="inner-image"><?php if(function_exists('show_media_header')){ show_media_header(); } ?></div>