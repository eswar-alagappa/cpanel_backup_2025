<?php
/*
Template Name:management
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


<?php

 if ( have_posts() ) : 
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 

 while ( have_posts() ) : the_post(); 
 ?>
 
<?php
// To retrive the sub pages(children)
$args = array('post_type' => 'page','numberposts' => -1,'post_status' => null,'post_parent' => $post->ID,'orderby'=>'menu_order','order'=>'asc');
$posts = get_posts($args);

if($posts) :
	foreach ($posts as $post) :
	?>

<div class="management">
  <h2><?php echo $post->post_title;?><br />
<span><?php echo get('designation'); ?></span>
</h2>
 <div class="managementImg"><?php if ( has_post_thumbnail() ) { 
			the_post_thumbnail('homepage'); 
		} ?></div>
<?php echo $content = wpautop( $post->post_content );?>
  </div>




<?php	
		
		endforeach;
endif;
?>
 <?php endwhile; ?>


 <?php endif; ?> 

 
 
<?php wp_reset_query(); ?>

   

  


  </div>
</div>
</div>
</div>


<?php get_footer(); ?>
