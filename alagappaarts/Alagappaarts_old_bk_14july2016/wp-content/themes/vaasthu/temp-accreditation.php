<?php
/*
Template Name: Accrediation
*/
?>

<?php get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/colorbox.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){
$(".popupImage").colorbox({rel:'popupImage'});
});
</script>

<div id="content" class="<?php echo $post->post_name; ?>Content">

	<?php while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>


	<?php endwhile; ?>

</div>		
	
<div id="sidebar"><?php get_sidebar('menu'); ?></div>
<?php get_footer(); ?>