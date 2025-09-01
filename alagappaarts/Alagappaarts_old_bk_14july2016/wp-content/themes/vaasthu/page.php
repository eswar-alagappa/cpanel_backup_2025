<?php
/*
 * The default template for displaying pages.
 */
?>

<?php get_header(); ?>
<div id="content" class="<?php echo $post->post_name; ?>Content">

	<?php while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>


	<?php endwhile; ?>

</div>		
	
<div id="sidebar"><?php get_sidebar('menu'); ?></div>
<?php get_footer(); ?>