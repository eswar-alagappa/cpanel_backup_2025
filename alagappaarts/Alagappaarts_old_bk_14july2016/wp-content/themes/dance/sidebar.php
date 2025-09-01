<?php



/**



 * The Sidebar containing the primary and secondary widget areas.



 *



 * @package WordPress



 * @subpackage Twenty_Ten



 * @since Twenty Ten 1.0



 */



?>



<div class="danceInnerContentLeft"><div class="danceBannerLeft">



 <?php if(function_exists('show_media_header')){ show_media_header(); } ?>



</div>



<div class="danceLeftContent">



<?php get_sidebar('menu'); ?>   



<div class="courses" id="tabcourses">



<h2>Programs</h2>



<ul>



<li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?0">Certificate</a></li>



<li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?1">Associate Degree</a></li>



<li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?2">Diploma</a></li>



<li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?3">Bachelor's Degree</a></li>



</ul>



</div>



<div class="news innerNews">



<h2>news</h2>



<?php query_posts('showposts=1&category_name=news')?>



<?php if (have_posts()) : ?>



		<?php while (have_posts()) : the_post(); ?>   



<?php the_content(); ?>







 <?php endwhile; ?>



	<?php endif; ?>



    

<?php wp_reset_query(); ?>



</div>



</div>



</div>



