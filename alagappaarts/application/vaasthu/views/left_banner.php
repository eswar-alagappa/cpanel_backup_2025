<?php
//$CI =& get_instance();
//$CI->method($param);
$this->Home =& get_instance(); 
$getLeftbanners = $this->Home->getLeftbanners();
$arg1 = $this->uri->segment(1);
$arg2 = $this->uri->segment(2);
$highLightMenuText = ((isset($arg2) && !empty($arg2)) ? $arg2 : '');
$highLightMenu = ((isset($highLightMenuText) && !empty($highLightMenuText)) ? strtoupper(str_replace('-',' ',$highLightMenuText)) : '');
$parentMenu = strtoupper(str_replace('-',' ',$arg1));//echo 'test->'.$parentMenu;

/*if(isset($arg1) && !empty($arg1))
{
	
	$parentMenu = strtoupper(str_replace('-',' ',$arg1));//echo 'test->'.$parentMenu;
	$childMenu = strtoupper(str_replace('-',' ',$arg2));
	if($parentMenu == 'ABOUT APAA' || $parentMenu == 'NEWS' || $parentMenu == 'CONTACT US'){
		$leftbannerImg = 'apaa-banner-left.jpg';
	}elseif($parentMenu == 'HERITAGE'){
		$leftbannerImg = 'heritage-banner-left.jpg';
	}elseif($parentMenu == 'ACADEMICS' && $childMenu !='FAQ' && $childMenu !='ELIGIBILITY'){
		$leftbannerImg = 'academics-banner-left.jpg';
	}elseif($parentMenu == 'ACADEMICS' && isset($childMenu) && !empty($childMenu) && $childMenu=='ELIGIBILITY'){
		$leftbannerImg = 'apaa-banner-left.jpg';
	}elseif($parentMenu == 'ACADEMICS' && isset($childMenu) && !empty($childMenu) && $childMenu=='FAQ'){
		$leftbannerImg = 'faq-banner.jpg';
	}elseif($parentMenu == 'EVENTS' && empty($childMenu) ){
		$leftbannerImg = 'event-banner.jpg';
	}elseif($parentMenu == 'EVENTS' && isset($childMenu) && !empty($childMenu) && $childMenu=='ANNOUNCEMENT' ){
		$leftbannerImg = 'announcement-banner.jpg';
	}elseif($parentMenu == 'EVENTS' && isset($childMenu) && !empty($childMenu) && $childMenu=='FAQ' ){
		$leftbannerImg = 'apaa-banner-left.jpg';
	}elseif($parentMenu == 'OUR CENTERS'){
		$leftbannerImg = 'center-banner.jpg';
	}elseif($parentMenu == 'FEATURED DANCER'){
		$leftbannerImg = 'dancer-of-the-month.jpg';
	}elseif($parentMenu == 'REGISTRATION' || $parentMenu == 'LOGIN' || $parentMenu == 'STUDENT' || $parentMenu == 'CENTER' || $parentMenu == strtoupper('forgetpassword')){
		$leftbannerImg = 'register-banner.png';
	}else{
		$leftbannerImg = '';
	}
}*/
?>
<!--<div class="danceInnerContentLeft"><div class="danceBannerLeft">

 <img src="<?php //echo base_url().'assets/home/images/'.$leftbannerImg ?>" alt="academics-banner-left.jpg" title="academics-banner-left.jpg" />

</div>-->

<?php
$childMenu = strtoupper(str_replace('-',' ',$arg2));
$leftImg = '';
if( ($parentMenu == 'ABOUT APAA' || $parentMenu == 'HERITAGE') && !$childMenu ){
	$leftImg = 'vaasthu-about-apaa.jpg';
}elseif($parentMenu == 'ABOUT APAA' && isset($childMenu) && !empty($childMenu) && $childMenu=='UNIVERSITY'){
	$leftImg = 'vaasthu-university.jpg';
}elseif($parentMenu == 'ABOUT APAA' && isset($childMenu) && !empty($childMenu) && $childMenu=='MANAGEMENT'){
	$leftImg = 'vaasthu-management.jpg';
}elseif($parentMenu == 'ABOUT APAA' && isset($childMenu) && !empty($childMenu) && $childMenu=='OBJECTIVE'){
	$leftImg = 'vaasthu-about-apaa.jpg';
}elseif($parentMenu == 'ABOUT APAA' && isset($childMenu) && !empty($childMenu) && $childMenu=='ADVISORY BOARD'){
	$leftImg = 'vaasthu-about-apaa.jpg';
}elseif($parentMenu == 'ABOUT APAA' && isset($childMenu) && !empty($childMenu) && $childMenu=='ACCREDITATION'){
	$leftImg = 'vaasthu-accreditation.jpg';
}elseif($parentMenu == 'ACADEMICS' && ($childMenu =='ELIGIBILITY' || $childMenu =='FAST TRACK' || $childMenu =='ONLINE EXAM' || $childMenu =='FAQ' ) ){
	$leftImg = 'vaasthu-eligibility.jpg';
}elseif($parentMenu == 'ACADEMICS' && isset($childMenu) && !empty($childMenu) &&  ($childMenu =='PHOTO GALLERY' || $childMenu =='VIDEO GALLERY' ) ){
	$leftImg = 'vaasthu-about-apaa.jpg';
}else if( ($parentMenu == 'OUR CENTERS') && !$childMenu ){
	$leftImg = 'vaasthu-centers.jpg';
}else if( ($parentMenu == 'CONTACT US') && !$childMenu ){
	$leftImg = 'vaasthu-contact.jpg';
}else if( ($parentMenu == 'REGISTRATION') && !$childMenu ){
	$leftImg = 'vaasthu-registration.jpg';
}elseif($parentMenu == 'ACADEMICS' && isset($childMenu) && !empty($childMenu) && $childMenu=='APAA PROGRAMS'){
	$leftImg = 'vaasthu-eligibility.jpg';
}elseif($parentMenu == 'ACADEMICS' && isset($childMenu) && !empty($childMenu) && $childMenu=='FEE STRUCTURE'){
	$leftImg = 'vaasthu-about-apaa.jpg';
}if( ($parentMenu == 'ACADEMICS' ) && !$childMenu ){
	$leftImg = 'vaasthu-about-apaa.jpg';
}
?>
<div class="inner-image">
<img title="<?php echo $leftImg;?>" alt="<?php echo $leftImg;?>" src="<?php echo base_url().'vaasthu_assets/home/images/'.$leftImg?>">
</div>
<?php if( isset($getLeftbanners) && !empty($getLeftbanners) ){?>
	<div id="sidebar">
		<div class="navigationMiddle">
			<div class="navigationMiddleInner"><h3><?php echo $parentMenu ?></h3>
				<ul>	
				<?php
					foreach($getLeftbanners as $key => $menu){ ?>
				<li class="page_item page-item-2311 <?php echo ((isset($highLightMenu) && !empty($highLightMenu) && $highLightMenu== strtoupper($menu->name)) ? 'current_page_item' : ''); ?>" ><a href="<?php echo base_url().'vaasthu/'.$menu->link ?>"><span><?php echo stripslashes($menu->name); ?></span></a></li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div> 
<?php } ?>