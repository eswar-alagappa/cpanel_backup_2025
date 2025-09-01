<?php
/*
Template Name:Instruments
*/
?>
<?php

get_header(); ?>
<div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>
<?php

 if ( have_posts() ) : 
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 

 while ( have_posts() ) : the_post(); 
 ?>
<div class="musicApaaContent">



 
<?php
// To retrive the sub pages(children)
$args = array('post_type' => 'page','numberposts' => -1,'post_status' => null,'post_parent' => $post->ID,'orderby'=>'menu_order','order'=>'asc');
$posts = get_posts($args);

if($posts) :
	foreach ($posts as $post) :
	?>
<div class="instruments">
<div class="instrumentsInner">
<div class="instrumentsLeft">
<h3><?php echo $post->post_title;?></h3>
<?php echo $content = wpautop( $post->post_content );?>
</div>
<div class="instrumentsRight"><?php if ( has_post_thumbnail() ) { 
			the_post_thumbnail('homepage'); 
		} ?></div>
</div>
</div>


<?php	
		
		endforeach;
endif;
?>


   

  


  </div>
   <?php endwhile; ?>


 <?php endif; ?> 

 
 
<?php wp_reset_query(); ?>
</div>
</div>
</div>


<?php get_footer(); ?>
