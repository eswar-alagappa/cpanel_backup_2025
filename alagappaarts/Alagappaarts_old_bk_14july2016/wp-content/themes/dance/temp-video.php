<?php
/**
Template Name: Video
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div class="danceInnerContent">
        
 <?php get_sidebar(); ?>       
        
<div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span><?php the_title(); ?></span></h2>
</div>
<div class="apaaContent videogallery">
 <?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?> 
<?php the_content();?>
<?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
</div>
</div>


<?php get_footer(); ?>
