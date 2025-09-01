<?php
/*
Template Name:contact us
*/
?>
<?php

get_header(); ?>
<div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>
<?php

 if ( have_posts() ) : 


 while ( have_posts() ) : the_post(); 
 ?>
<div class="contactUsContent">
<div class="contactUsContentTop">
<div class="contactUsTopLeftOuter">
<div class="contactUsTopLeftTopBg"></div>
<div class="contactUsTopLeft">
<span>United States</span>
1647, Andorre Glen, <br />
Escondido, CA 92029, USA
</div>
<div class="contactUsTopLeftBottomBg"></div>
</div>

<div class="contactUsTopRightOuter">
<div class="contactUsTopRightTopBg"></div>
<div class="contactUsTopRight">
<span>India</span>
# 90,Dr.Alagappa Road,<br />
Purasaiwalkam, Chennai - 600084
<a href="mailto:customersupport@alagappaarts.com">customersupport@alagappaarts.com </a></div>
<div class="contactUsTopRightBottomBg"></div>
</div>
</div>

<div class="registerFormOuter">
  <div class="registerFormTitle">
<div class="registerFormTitleLeftBg"></div>
<div class="registerFormTitleBg">Please use the following contact information to connect with us</div>
<div class="registerFormTitleRightBg"></div>

</div>
<div class="contactUsForm">
<?php insert_cform('1'); ?>
</div>

</div>


  </div>
   <?php endwhile; ?>


 <?php endif; ?> 

 
 
<?php wp_reset_query(); ?>
</div>
</div>
</div>


<?php get_footer(); ?>
