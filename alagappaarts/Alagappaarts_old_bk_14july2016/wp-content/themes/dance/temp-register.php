<?php
/*
Template Name:register
*/
?>
<?php

get_header(); ?>

<div class="danceInnerContent">
        
 <?php get_sidebar(); ?>       
        
<div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span><?php the_title(); ?></span></h2>
</div>

    
<div class="apaaContent">



   
<div class="registerBtn"><a href="<?php bloginfo('wpurl'); ?>/register/students-registration"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/student-btn.png" width="249" height="101" /></a></div>
<div class="registerBtn"><a href="<?php bloginfo('wpurl'); ?>/register/center-registration"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/center-btn.png" width="249" height="101" /></a></div>

</div>
</div>
</div>
</div>


<?php get_footer(); ?>
