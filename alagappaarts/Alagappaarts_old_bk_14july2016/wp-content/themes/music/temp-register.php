<?php
/*
Template Name:register
*/
?>
<?php

get_header(); ?>
<div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>
<div class="musicApaaform"> 
<div class="registerFormOuter">
<div class="registerFormTitle">
<div class="registerFormTitleLeftBg"></div>
<div class="registerFormTitleBg">Please use the following information to register</div>
<div class="registerFormTitleRightBg"></div>

</div>
<div class="registerForm">
<?php insert_cform('3'); ?>
</div>

</div>
  </div>
</div>
</div>
</div>


<?php get_footer(); ?>
