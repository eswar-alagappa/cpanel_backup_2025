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
<script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.bxslider.min.js"></script>
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.bxslider.css" rel="stylesheet" />

<script type="application/javascript">
	$(document).ready(function(){
	 $('.bxslider').bxSlider({
		  mode: 'fade',
  captions: false,
   pager: true,     
  slideWidth: 1024,
  controls: false,      
  auto: true,
   stopAuto: false,
  slideMargin: 0,
 nextText: 'next',                   // string - text displayed for 'next' control
  nextImage: '',                      // string - filepath of image used for 'next' control. ex: 'images/next.jpg'
  nextSelector: null,                 // jQuery selector - element to contain the next control. ex: '#next'
  prevText: 'prev',                   // string - text displayed for 'previous' control
  prevImage: '',                      // string - filepath of image used for 'previous' control. ex: 'images/prev.jpg'
});
	});
</script>

</head>
<body <?php body_class(); ?> >
<div class="indexBg">
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


    <div class="image-homepage"> 
		
		<ul class="bxslider" >
        
       
       <li><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner3.jpg" /></li>
       <li><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner4.jpg" /></li>
       <li><img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner5.jpg" /></li>
      
       
        <?php /*?><?php
global $post;
$id = '876'; 
$post = get_post($id); 
setup_postdata($post);  ?>

    <?php $attachments = new Attachments( 'attachments' );  ?>
<?php if( $attachments->exist() ) : ?>
<?php  while( $attachments->get() ) : 

?>  
    
      <li>
      <img src="<?php echo $attachments->src( 'full' ); ?>" alt="" />
      </li>

     <?php $i++; endwhile; ?>
<?php endif; ?> <?php */?>
    </ul>
		
	</div>



