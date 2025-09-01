<?php
/*
Template Name: Fees
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

<?php query_posts('category_name=fees')?>
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
<div class="contentLeftTop">
<?php while (have_posts()) : the_post(); ?>


<div id="content<?php echo $i ?>" class="tabdiv"><?php the_content(); ?> </div>
<?php $i++ ;?>
<?php endwhile; ?>
</div>
<?php endif; ?>




</div>


</div>
</div>
</div>


<?php get_footer(); ?>
