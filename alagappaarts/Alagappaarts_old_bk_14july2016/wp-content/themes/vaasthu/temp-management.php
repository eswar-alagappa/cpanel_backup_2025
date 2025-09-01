<?php
/*
Template Name: Management
*/
?>
<?php

get_header(); ?>
<div id="content" class="<?php echo $post->post_name; ?>Content">

   
<h2><?php the_title(); ?></h2>    

<?php query_posts('category_name=management')?>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
<div>
<strong><?php the_title(); ?>, <span><?php echo get_post_meta(get_the_ID(),'management_desig',true); ?></span></strong>

<?php /*?><img src='<?php echo get_post_meta(get_the_ID(),'management_image',true); ?>'/><?php */?>

<?php if ( has_post_thumbnail() ) { 
			the_post_thumbnail('homepage'); 
		} ?>
<?php the_content(); ?> 
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query();?>



</div>		
	
<div id="sidebar">
<?php get_sidebar('menu'); ?>
</div>
<?php get_footer(); ?>