<!DOCTYPE html>

<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>
Alagappa Arts &#8211; Vaasthu | Alagappa arts</title>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/alagappaarts.png" />

<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>vaasthu_assets/home/css/style.css" />

<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>vaasthu_assets/home/css/custom-cforms.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

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
<?php if(base_url() == current_url() ) {?>
<script src="<?php echo base_url().'vaasthu_assets/home/js/jquery.min.js'?>"></script>
<script src="<?php echo base_url().'vaasthu_assets/home/js/jquery.bxslider.min.js'?>"></script>
<link href="<?php echo base_url().'vaasthu_assets/home/css/jquery.bxslider.css'?>" rel="stylesheet" />

<script type="application/javascript">
	$(document).ready(function(){
	 $('.bxslider').bxSlider({
		  mode: 'fade',
  captions: false,
   pager: true,     
  slideWidth: 1024,
  controls: false,      
  auto: true,
   stopAuto: false,
  slideMargin: 0,
 nextText: 'next',                   // string - text displayed for 'next' control
  nextImage: '',                      // string - filepath of image used for 'next' control. ex: 'images/next.jpg'
  nextSelector: null,                 // jQuery selector - element to contain the next control. ex: '#next'
  prevText: 'prev',                   // string - text displayed for 'previous' control
  prevImage: '',                      // string - filepath of image used for 'previous' control. ex: 'images/prev.jpg'
});
	});
</script>
<?php } ?>
</head>
<body class="home blog" >

<div class="<?php echo ((base_url() == current_url() ) ? 'indexBg' : 'innerBg')?>">
<div id="container">

<div id="header">
<div class="logo"> 
		<a href="<?php echo base_url().'vaasthu'?>"><img src="<?php echo base_url().'vaasthu_assets/home/images/logo.png'?>" class="Vaasthu" alt="Alagappa Performing Arts academy" title="Alagappa Performing Arts academy" /></a>
	</div>
    
    
<div id="pre-header">
	 
		<div class="nav-head">
		<?php echo $menuList ?>
		<!--<ul id="menu-menu-1" class="menu"><li id="menu-item-154" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-154"><a href="http://alagappaarts.com/vaasthu/">Home</a></li>
<li id="menu-item-158" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-158"><a href="http://alagappaarts.com/vaasthu/about-apaa/">APAA</a>
<ul class="sub-menu">
	<li id="menu-item-159" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a href="http://alagappaarts.com/vaasthu/about-apaa/university/">University</a></li>
	<li id="menu-item-155" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-155"><a href="http://alagappaarts.com/vaasthu/about-apaa/management/">Management</a></li>
	<li id="menu-item-161" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-161"><a href="http://alagappaarts.com/vaasthu/about-apaa/objective/">Objective</a></li>
	<li id="menu-item-160" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-160"><a href="http://alagappaarts.com/vaasthu/about-apaa/accreditation/">Accreditation</a></li>
</ul>
</li>
<li id="menu-item-172" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-172"><a href="http://alagappaarts.com/vaasthu/heritage/">Heritage</a></li>
<li id="menu-item-162" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-162"><a href="http://alagappaarts.com/vaasthu/academics/programs/">Academics</a>
<ul class="sub-menu">
	<li id="menu-item-163" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-163"><a href="http://alagappaarts.com/vaasthu/academics/programs/">Programs</a></li>
	<li id="menu-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="http://alagappaarts.com/vaasthu/academics/eligibility/">Eligibility</a></li>
	<li id="menu-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165"><a href="http://alagappaarts.com/vaasthu/academics/fast-track/">Fast Track</a></li>
	<li id="menu-item-166" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-166"><a href="http://alagappaarts.com/vaasthu/academics/fee-structure/">Fee Structure</a></li>
	<li id="menu-item-167" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-167"><a href="http://alagappaarts.com/vaasthu/academics/photo-gallery/">Photo Gallery</a></li>
	<li id="menu-item-168" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-168"><a href="http://alagappaarts.com/vaasthu/academics/video-gallery/">Video Gallery</a></li>
	<li id="menu-item-169" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-169"><a href="http://alagappaarts.com/vaasthu/academics/online-exam/">Online Exam</a></li>
	<li id="menu-item-170" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-170"><a href="http://alagappaarts.com/vaasthu/academics/faq/">FAQ</a></li>
</ul>
</li>
<li id="menu-item-156" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-156"><a href="http://alagappaarts.com/vaasthu/our-center/">Our Center</a></li>
<li id="menu-item-173" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-173"><a href="http://alagappaarts.com/vaasthu/registration/">Registration</a></li>
<li id="menu-item-171" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-171"><a href="http://alagappaarts.com/vaasthu/contact-us/">Contact us</a></li>
</ul>-->

</div>	
</div>
</div>
