<?php

/*

Template Name: academics faq

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

<div id="accordion">





<?php



 if ( have_posts() ) : 

 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("paged=$paged&posts_per_page=10&order=asc&post_type=post&cat=2&orderby=date");



 while ( have_posts() ) : the_post(); 







	



 ?>

<h3><?php the_title();?></h3> 

<div><?php the_content(); ?> </div>



 <?php endwhile; ?>

</div>



 <?php endif; ?> 



 <?php



  if(function_exists('wp_paginate')) {



    wp_paginate();



}



?>

 

<?php wp_reset_query(); ?>



   



  





  </div>

</div>

</div>

</div>





<?php get_footer(); ?>

