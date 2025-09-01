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
	<div class="footerOuter">
<div class="footer">  
<div class="footerLeft">© Alagappa Performing Arts Academy. </div>
<div class="footerRight"><a href="http://inqtechnologies.com/" target="_blank">Powered by InQ Technologies</a></div>
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
