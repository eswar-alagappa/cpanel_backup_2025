<?php
/*
Template Name: Centers
*/
?>
<?php

get_header(); ?>
<div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>

<div class="musicApaaContent">

<?php query_posts('category_name=centers')?>

<?php if (have_posts()) : 

 while ( have_posts() ) : the_post(); 
 ?>

<div class="ourCenter">
  
<div class="ourCenterContent">
<div class="ourCenterTitle"><?php the_title();?></div>
<div class="ourCenterInner">
<?php the_content();?>
</div>
</div>
  </div>

 <?php endwhile; ?>


 <?php endif; ?> 

 
 
<?php wp_reset_query(); ?>


   

  


  </div>
 

</div>
</div>
</div>


<?php get_footer(); ?>
