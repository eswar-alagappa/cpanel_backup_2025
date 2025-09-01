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
<style>
#main-footer{
	float:right;
	font-family: Arial,Helvetica,sans-serif;
}
#main-footer a{
	color:#fff;
	text-decoration:none;
	font-size:12px;
}
</style>
<div class="wrapper">
       	<div class="logo"><a href="<?php bloginfo('wpurl'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" width="178" height="63" alt="Alagappa Performing Arts Academy"></a></div>
        <div class="sections">
        	<a href="<?php bloginfo('wpurl'); ?>/newdance" target="_blank" class="float-shadow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dance.png" width="274" height="427" border="0" alt="Dance"></a>
        	<a href="<?php bloginfo('wpurl'); ?>/newmusic" target="_blank" class="float-shadow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/music.png" width="274" height="427" border="0" alt="Music"></a>
            <a href="<?php bloginfo('wpurl'); ?>/newvaasthu" target="_blank" class="float-shadow"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/vaasthu.png" width="274" height="427" border="0" alt="Vaasthu"></a>
        </div>
		
		<div id="main-footer">
			<a target="_blank" href="http://sanjaytechnologies.org/" >Developed by Sanjay Technologies</a>
		</div>
      </div>
      
      
      
      

		
</div>
