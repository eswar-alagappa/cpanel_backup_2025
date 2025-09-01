<?php

/*

Template Name:center login

*/





get_header(); 





?>
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/formcss.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.min.js"> </script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.validate.js"> </script>

<script   type="text/javascript"  >

$(document).ready(function(){

$("#frmLogin").validate({

  rules: {

txtUsername:{

		required: true	

		},

txtPassword:{

		required: true

		}

	 },

 messages:{

		txtUsername : "Enter the username",

		txtPassword : "Enter the password"

 

	},

errorElement: 'div'





});

});

</script>


<div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>
<div class="musicApaaform"> <a href="<?php bloginfo('wpurl'); ?>/wp-content/themes/music/images/application-form-music.pdf" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/registration-btn.png" width="284" height="40" class="registerBtn" /></a>
<div class="registerFormOuter">

 
    

<div class="apaaContent">


  <div class="loginBg">

  <p>Enter your Username and Password to login</p>

  <div class="loginForm">

  <form id="frmLogin"  method="post" action="http://alagappaarts.com/music/center/">





  <ul><li>

  <label>Username :</label>

  <input name="txtUsername" type="text" /></li>

  <li>

   <label>Password :</label>

  <input name="txtPassword" type="password" />

  </li>

  <input name="btnLogin" type="submit" class="registerBtn" value="login"/>

  </ul></form>

  </div>

  </div>

  

</div>
 
 </div>
  </div>
</div>
</div>
</div> 



<?php get_footer(); ?>
