<?php
/*
 * The template for homepage.
 */
?>

<?php get_header(); ?>
<div id="content-full">

<div class="article">

<div class="homeMiddleLabel">
<?php dynamic_sidebar('certificate'); ?>
<?php dynamic_sidebar('diploma'); ?>
<?php dynamic_sidebar('degree'); ?>
</div>

<div class="homeBottomContent">
 <div class="homeContentLeft"> <?php
global $post;
$id = '28'; //set the post id here
$post = get_post($id); //get the post
setup_postdata($post); //setup the post ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
</div>

	
    <div class="homeContentRight">
    <div class="homeContentRightInner">
    <h2>E-brochure</h2>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/pdf-icon.png" />
    <p>APAA will review and reserve the right to admit any student.</p>
    <a href="">Download now</a>
    </div>
</div>    
    </div>
	

</div>

</div>
<?php get_footer(); ?>