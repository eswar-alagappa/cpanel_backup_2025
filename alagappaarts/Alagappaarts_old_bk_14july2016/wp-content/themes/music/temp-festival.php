<?php
/*
Template Name:festival
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

<p>Listed below are some of the dance festivals of India which are famous for the various renowned artists who perform in the beautiful backdrops of the age old temples, where they are held every year. These festivals attract a large audience from both India and abroad. They create a divine ambience around both the artistes and the spectators.</p>
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

<div class="festivals">
   <div class="festivalsImg"><?php if ( has_post_thumbnail() ) { 
			the_post_thumbnail('homepage'); 
		} ?>
</div>
   <h2><?php echo $post->post_title;?></h2>

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
