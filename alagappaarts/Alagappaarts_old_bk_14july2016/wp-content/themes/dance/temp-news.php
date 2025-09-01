<?php
/*
Template Name:News
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
<?php query_posts('category_name=news')?>
<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>   
<div class="newsOuter">
  <div class="newsLeft">
  <span><?php the_time('M')?></span><span class="year"><?php the_time('Y')?></span>
  <p><?php the_time('d')?></p>
  </div>
  <div class="newsRight"><span><?php the_title(); ?></span><?php the_content(); ?>
  </div>
  </div>
  


 <?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
</div>
</div>

<?php get_footer(); ?>
