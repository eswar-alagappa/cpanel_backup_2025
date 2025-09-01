<?php
/*
Template Name:Faq
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

<div id="accordion">


<?php

 if ( have_posts() ) : 
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("paged=$paged&posts_per_page=10&order=asc&post_type=post&cat=6&orderby=menu_order");

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

wp_reset_query();



?>

</div>
</div>
</div>
</div>


<?php get_footer(); ?>
