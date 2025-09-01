<?php



/**



 * The main template file.
 *
 * This is the most generic template file in a WordPress theme



 * and one of the two required files for a theme (the other being style.css).



 * It is used to display a page when nothing more specific matches a query.



 * E.g., it puts together the home page when no home.php file exists.



 * Learn more: http://codex.wordpress.org/Template_Hierarchy



 *



 * @package WordPress



 * @subpackage Twenty_Ten



 * @since Twenty Ten 1.0



 */







get_header(); ?>

<div class="listing">
  <div  class="memberLogin">
    <h2><a href="<?php bloginfo('wpurl'); ?>/featured-dancer">Feature Dance Teacher</a></h2>
    <?php query_posts('category_name=dance of the month')?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
       <p><strong><?php the_title(); ?></strong> <?php echo get('guru_description'); ?></p>
      <a href="<?php bloginfo('wpurl'); ?>/featured-dancer">Read More</a>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <div class="indexcourses">
    <h2><a href="<?php bloginfo('wpurl'); ?>/academics">ACADEMIC Programs</a></h2>
    <ul>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?0">Certificate</a></li>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?1">Associate Degree</a></li>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?2">Diploma</a></li>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?3">Bachelor's Degree</a></li>
    </ul>
  </div>
  <div class="indexnews">
    <h2><a href="<?php bloginfo('wpurl'); ?>/news">news</a></h2>
    <?php query_posts('showposts=1&category_name=news')?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <a href="<?php bloginfo('wpurl'); ?>/news">
    <?php if ( has_post_thumbnail() ) { 
			the_post_thumbnail('homepage'); 
		} ?>
    </a>
    <p><strong>
      <?php the_title(); ?>
      </strong> <?php echo get('guru_description'); ?></p>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
  </div>
  
</div>
<div class="danceIndexContentOuter">
  <div class="danceIndexContent">
    <h2>about University</h2>
    <?php

if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
    <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
    <?php endif; ?>
    <?php //echo getPageContent(463,210); First parameter is PAGE ID and second is number of words displayed. ?>
    <a href="<?php bloginfo('wpurl'); ?>/about-apaa/university">
    <input name="login" type="button" value="read more" class="readMoreBtn" />
    </a> </div>
  <div class="danceIndexContent">
    <h2>APAA</h2>
    <p><?php echo getPageContent(2,210); //First parameter is PAGE ID and second is number of words displayed. ?>... </p>
    <a href="<?php bloginfo('wpurl'); ?>/about-apaa">
    <input name="read more" type="button" value="read more" class="readMoreBtn" />
    </a> </div>
  <div class="danceIndexContent last">
    <h2>Academic Programs</h2>
    <ul>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?0">Certificate</a></li>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?1">Associate Degree</a></li>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?2">Diploma</a></li>
      <li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?3">Bachelor's Degree</a></li>
    </ul>
  </div>
</div>
</div>
<?php get_footer(); ?>
