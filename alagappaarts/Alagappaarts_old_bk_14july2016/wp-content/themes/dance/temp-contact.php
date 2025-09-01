<?php
/*
Template Name:Contact us
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
<div class="contactOuter">
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>


<?php the_content(); ?> 
<?php endwhile; ?>
<?php endif; ?>
 
  </div>
   <div class="registerFormOuter">
<div class="fl"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/register-title-bg-left.png" width="5" height="44" /></div><div class="registerFormTitle">Please use the following contact information to connect with us</div><div class="fr"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/register-title-bg-right.png" width="5" height="44" /></div>
<div class="registerForm">
<?php insert_cform('1'); ?>
</div>
</div>
</div>
</div>
</div>
</div>


<?php get_footer(); ?>
