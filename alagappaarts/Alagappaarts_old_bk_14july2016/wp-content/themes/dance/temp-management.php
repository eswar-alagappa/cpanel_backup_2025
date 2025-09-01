<?php
/*
Template Name:management
*/
?>
<?php

get_header(); ?>

<div class="danceInnerContent">
        
 <?php get_sidebar(); ?>       
        
<div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span><?php the_title(); ?></span></h2>
</div>

    
<div class="apaaContent">
<?php query_posts('category_name=management&post_status=null&sort_column=post_title&order=DESC')?>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
<div class="apaaContentInnerr">
<h3><?php the_title(); ?>, <span><?php echo get('designation'); ?></span></h3>
<div class="apaaContentInnerrImg"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('homepage'); } ?></div>
<?php the_content(); ?> 
</div>


<?php endwhile; ?>

<?php endif; ?>

</div>
</div>
</div>
</div>


<?php get_footer(); ?>