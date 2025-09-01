<?php
/*
Template Name: Fees
*/
?>
<?php

get_header(); ?>
<div id="content" class="<?php echo $post->post_name; ?>Content">

   
<h2><?php the_title(); ?></h2>    

<?php query_posts('category_name=fees&order=ASC')?>
<?php if (have_posts()) : ?>
<?php $i = 0 ;?>
<div id="tabvanilla" class="navi"><ul class="tabnav">
<?php while (have_posts()) : the_post(); ?>

<li><a href="#content<?php echo $i ?>"><?php the_title();?></a></li>
<?php $i++ ;?>
<?php endwhile; ?></ul></div>
<?php endif; ?>

<?php if (have_posts()) : ?>
<?php $i = 0 ;?>
<div class="feescontent">
<?php while (have_posts()) : the_post(); ?>


<div id="content<?php echo $i ?>" class="tabdiv"><?php the_content(); ?> </div>
<?php $i++ ;?>
<?php endwhile; ?>
</div>
<?php endif; ?>

<?php wp_reset_query();?>



</div>		
	
<div id="sidebar">
<?php get_sidebar('menu'); ?>
</div>
<?php get_footer(); ?>
