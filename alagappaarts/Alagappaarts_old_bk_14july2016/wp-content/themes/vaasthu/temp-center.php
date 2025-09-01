<?php
/*
Template Name: Center
 * The default template for displaying pages.
 */
?>

<?php get_header(); ?>
<div id="content-full">
<h2><?php the_title(); ?></h2>
	<div class="centerContent"><?php while ( have_posts() ) : the_post(); ?>
		
		<?php the_content(); ?>


	<?php endwhile; ?></div>

</div>		
	

<?php get_footer(); ?>