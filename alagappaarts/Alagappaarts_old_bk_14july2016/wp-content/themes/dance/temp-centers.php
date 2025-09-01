<?php
/*
Template Name: Centers
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

<div class="centerListOuter">
<div class="fl"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/register-title-bg-left.png" width="5" height="44" /></div>
<div class="centersTop">
<?php query_posts('category_name=centers')?><?php if (function_exists('wp_snap')) { echo wp_snap(); } ?>

</div><div class="fr"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/register-title-bg-right.png" width="5" height="44" /></div>
</div>
<div class="centersContent">

<strong>How does a Dance center become an authorized dance center?</strong>
<p>A dance center should complete the accreditation form on the website and send it to APAA. To obtain APAC Certification a dance center must demonstrate the skills necessary to train students on learning, using and developing their skills. A center that fulfills the requirements for certification is an APAC (Alagappa Performing Arts Academy Authorized Certification Center). APAA, on a regular basis, will update the list of Authorized Dance Centers.</p>



<?php if (have_posts()) : ?>
<div class="centersOuter">

<?php $i= 1; ?>
<?php while (have_posts()) : the_post(); ?>
<?php if($i % 2  == 1) echo "<ul>"; ?>

<li>
<span class="equalheight"><?php the_title(); ?><br />
<strong>Director :  <?php echo get_post_meta($post->ID, 'director', true); ?></strong>
</span>
<?php the_content(); ?>
</li>
<?php if($i % 2  == 0) echo "</ul>"; ?>
<?php $i++;?>
<?php endwhile; ?>

</div>
<?php endif; ?>





</div>

</div>
</div>
</div>
</div>


<?php get_footer(); ?>
