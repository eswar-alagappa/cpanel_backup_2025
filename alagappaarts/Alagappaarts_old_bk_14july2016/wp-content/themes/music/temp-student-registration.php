<?php
/*
Template Name:student-registration
*/
?>
<?php

get_header(); ?>
<div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>
<div class="musicApaaform"> <a href="<?php bloginfo('wpurl'); ?>/wp-content/themes/music/images/application-form-music.pdf" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/registration-btn.png" width="284" height="40" class="registerBtn" /></a>
<div class="registerFormOuter">
<div class="registerFormTitle">
<div class="registerFormTitleLeftBg"></div>
<div class="registerFormTitleBg">Please use the following information to register</div>
<div class="registerFormTitleRightBg"></div>

</div>
<div class="registerForm">
<?php insert_cform('2'); ?>
</div>

</div>
  </div>
</div>
</div>
</div>


<?php get_footer(); ?>
