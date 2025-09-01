<?php
/*
 * The footer for displaying footer widgets and site-info.
 */
?>
</div>
<div id="footer">
	
	<div class="footer-right"> 

		<?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
	
		<?php dynamic_sidebar( 'footer-right' ); ?>

		<?php else : ?> 
		<?php endif; ?> 
	</div>

	<div class="footer-left"> 

		<?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
	
		<?php dynamic_sidebar( 'footer-left' ); ?>

		<?php else : ?> 
		<?php endif; ?> 
	</div>

	<div class="site-info">
		<?php _e('Copyright', 'darkorange'); ?> <?php echo date('Y'); ?>  Alagappa Performing Arts Academy.	<a href="http://sanjaytechnologies.org/" target="_blank" title="<?php _e('Designed by Sanjay Technologies', 'darkorange'); ?>"><?php _e('Designed by Sanjay Technologies', 'darkorange'); ?></a>
	</div>

</div>
</div><!-- #container -->

<?php
   /* Always have wp_footer() just before the closing </body>
    * tag of your theme, or you will break many plugins, which
    * generally use this hook to reference JavaScript files.
    */
    wp_footer();
?>
</body>
</html>