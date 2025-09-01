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

	<div class="musicIndexContentOuter">
<div class="musicIndexContent">
<div class="welcomeContent equalheight">
<h3>WELCOME TO<br />
<span>ALAGAPPA ARTS ACADEMY</span></h3>
<p>Students of Indian classical performing arts spend years learning the art form and perfecting the art through rigorous practice to perform the 'Arangetram' or the formal initiation of the student to perform on stage. </p>
<p>This preparation of the student can take five to seven years and if the same student were to pursue academic studies during that time, he or she would be able to complete post graduate collegiate education...</p>
<a href="<?php bloginfo('wpurl'); ?>/apaa"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/readmore-btn.png" width="93" height="30"/></a>
</div>
<div class="academicContent equalheight">
<h3>Academic <span>features</span></h3>
<ul>
<li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?0">Certificate in Vocal and Instrumental Music</a></li>
<li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?1">Diploma in Vocal and Instrumental Music</a></li>
<li><a href="<?php bloginfo('wpurl'); ?>/academics/apaa-programs?2">Bachelor's Degree Vocal and Instrumental Music</a></li>
</ul>
</div>
<div class="videoGallery">
<h3>video <span>gallery</span></h3>
<a href="<?php bloginfo('wpurl'); ?>/academics/video-gallery/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/video-img.gif" width="190" height="145" /></a></div>
</div>
</div>
<?php get_footer(); ?>
