<?php
/*
Template Name: Festival
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
<?php query_posts('category_name=festival')?>
<p>Listed below are some of the dance festivals of India which are famous for the various renowned artists who perform in the beautiful backdrops of the age old temples, where they are held every year. These festivals attract a large audience from both India and abroad. They create a divine ambience around both the artistes and the spectators.</p>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
<div class="apaaContentInnerr">
<h3><?php the_title(); ?></h3>
<div class="apaafestivalImg"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('homepage'); } ?></div>
<?php the_content(); ?> 
</div>


<?php endwhile; ?>

<?php endif; ?>

</div>
</div>
</div>
</div>


<?php get_footer(); ?>