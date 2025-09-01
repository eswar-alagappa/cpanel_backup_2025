<?php

/*

Template Name:student login

*/





get_header(); 





?>

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



<div class="danceInnerContent">

        

 <?php get_sidebar();

 echo $q=$_SERVER['REQUEST_URL'];

 

  ?>       

        

<div class="danceInnerContentRight">

<div class="danceBanner">

<h2><span><?php the_title(); ?></span></h2>

</div>



    

<div class="apaaContent">


  <div class="loginBg">

  <p>Enter your Username and Password to login</p>

  <div class="loginForm">

  <form id="frmLogin"  method="post" action="http://alagappaarts.com/userpanel/student/">





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





<?php get_footer(); ?>

