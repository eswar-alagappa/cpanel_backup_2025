<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	<div class="musicFooter">
<div class="musicFooterLeft"><div class="musicFooterLeftInLeft">© Alagappa Performing Arts Academy.</div>
<div class="musicFooterLeftInRight"> 
  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook-icon.gif" width="73" height="16" />
  <img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter-icon.gif" width="64" height="16" /></div></div>
<div class="musicFooterRight"><a href="http://sanjaytechnologies.org/" target="_blank">Powered by Sanjay Technologies</a></div>
</div>
</div>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
