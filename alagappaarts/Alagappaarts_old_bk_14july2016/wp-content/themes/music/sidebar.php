<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div class="musicInnerContentLeft">

<?php get_sidebar('menu'); ?>   

<div class="curveOuter" style="display:none;">
<div class="curveTop"></div>
<div class="musicMemberLogin">
<h3 class="pBottom8">Member <span>Login</span></h3>
<input type="text" onblur="if(this.value =='') this.value='User name';" onfocus="if(this.value=='User name') this.value='';" class="emailInput" value="User name" name="txtUser name"><input type="text" onblur="if(this.value =='') this.value='Password';" onfocus="if(this.value=='Password') this.value='';" class="PasswordInput" value="Password" name="txtPassword">
<input name="login" type="button" value="login" class="loginBtn" />
</div>
<div class="curveBottom"></div>
</div>
<div class="curveOuter">
<div class="curveTop"></div>
<div class="innerVideoGallery">
<h3 class="pBottom8 pLeft">video <span>gallery</span></h3>
<a href="<?php bloginfo('wpurl'); ?>/academics/video-gallery/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/video-img-inner.gif" width="188" height="132" /></a></div>
<div class="curveBottom"></div>
</div>
</div>


