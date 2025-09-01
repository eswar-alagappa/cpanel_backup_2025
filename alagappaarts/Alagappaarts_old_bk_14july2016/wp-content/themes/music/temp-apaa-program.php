<?php
/*
Template Name:apaa program
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

<?php query_posts('category_name=apaa')?>
<?php if (have_posts()) : ?>
<?php $i = 0 ;?>
<div class="registerFormTitleLeftBg"></div>
<div id="tabvanilla" class="navi"><ul class="tabnav">
<?php while (have_posts()) : the_post(); ?>

<li id="<?php echo $i ?>"><a href="#content<?php echo $i ?>"><span><?php the_title();?></span></a></li>
<?php $i++ ;?>
<?php endwhile; ?></ul></div>
<div class="registerFormTitleRightBg"></div>
<?php endif; ?>

<?php if (have_posts()) : ?>
<?php $i = 0 ;?>
<div class="feesStructure">
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
