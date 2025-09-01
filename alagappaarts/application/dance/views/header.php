<!DOCTYPE html>

<html lang="en-US">

<head>

<meta charset="UTF-8" />

<title>Alagappa Arts &#8211; Dance | Alagappa arts</title>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/alagappaarts.png" />

<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/home/css/style.css" />

<link rel='stylesheet' id='cforms2-css'  href='<?php echo base_url()?>assets/home/css/contact-cform.css' type='text/css' media='all' />
            <script type="text/javascript" src="<?php echo base_url()?>assets/home/js/jquery.min.js"></script>
			
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>

<style>
    
    @keyframes blinker {  
  50% { opacity: 0; }
  
}
</style>

<script type='text/javascript' src='<?php echo base_url()?>assets/home/js/jquery.js'></script><script>jQueryWP = jQuery;</script>
<!--<script type='text/javascript' src='<?php echo base_url()?>assets/home/js/jquery-migrate.min.js'></script>-->
<script type='text/javascript' src='<?php echo base_url()?>assets/home/js/jquery.md5.js'></script>
<!--<script type='text/javascript'>
/* <![CDATA[ */
var cforms2_ajax = {"url":"http:\/\/alagappaarts.com\/dance\/wp-admin\/admin-ajax.php","nonces":{"reset_captcha":"fb82806703","submitcomment":"90d8fe07c1"}};
/* ]]> */
</script>-->

<!--<script type='text/javascript'>
/* <![CDATA[ */
var rlArgs = {"script":"swipebox","selector":"lightbox","customEvents":"","activeGalleries":"1","animation":"1","hideCloseButtonOnMobile":"0","removeBarsOnMobile":"0","hideBars":"1","hideBarsDelay":"5000","videoMaxWidth":"1080","useSVG":"1","loopAtEnd":"0"};
/* ]]> */
</script>

<script type='text/javascript'>AC_FL_RunContent = 0;</script>
<!--<script type='text/javascript' src="<?php echo base_url()?>assets/home/js/AC_RunActiveContent.js"></script>-->
<div id="faq-accordion-1" class="faq-plugin-accordion" data-active="false" data-animate="true" data-collapsible="false"></div>





</head>

<?php
$ci =& get_instance();

$method = $ci->router->fetch_method(); // gets function name (controller function)
?>
<body class="<?php echo ((isset($method) && !empty($method) && $method=='index') ? 'dancebg clearfix' : 'danceInnerBg'); ?>">


<div class="wrapper">

<div class="danceHeader">

<div class="headerLeft"><a href="<?php echo base_url()?>dance"><img src="<?php echo base_url()?>assets/home/images/sprite-img.gif" width="1" height="1" class="danceLogo" alt="Alagappa Performing Arts academy" title="Alagappa Performing Arts academy" /></a></div>



<div class="menu">
<?php echo $menuList ?>

</div>


</div>


