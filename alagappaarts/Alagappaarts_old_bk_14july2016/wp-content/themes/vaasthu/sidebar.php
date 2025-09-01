<?php
/*
 * The sidebar for displaying widgets.
 */
?>

<div id="sidebar">
	<?php if ( is_active_sidebar( 'primary' ) ) : ?>
	
		<?php dynamic_sidebar( 'primary' ); ?>

	<?php else : ?> 
			
	<?php endif; ?>
</div>