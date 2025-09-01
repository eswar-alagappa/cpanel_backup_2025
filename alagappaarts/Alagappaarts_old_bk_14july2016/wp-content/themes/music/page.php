<?php
/**
 * The template for displaying all pages.
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

		<div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>
<div class="musicApaaContent">
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
