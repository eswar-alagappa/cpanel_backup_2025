<?php
//$CI =& get_instance();
//$CI->method($param);
$this->Home =& get_instance(); 
$getLeftbanners = $this->Home->getLeftbanners();
$arg1 = $this->uri->segment(1);
$arg2 = $this->uri->segment(2);
$highLightMenuText = ((isset($arg2) && !empty($arg2)) ? $arg2 : '');
$highLightMenu = ((isset($highLightMenuText) && !empty($highLightMenuText)) ? strtoupper(str_replace('-',' ',$highLightMenuText)) : '');

if(isset($arg1) && !empty($arg1))
{
	
	$parentMenu = strtoupper(str_replace('-',' ',$arg1)); //echo 'test->'.$parentMenu;
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
}
?>
<div class="musicInnerContentLeft">


<div class="musicLeftMenu">
<div class="curveTop"></div>
<div class="musicLeftMenuContent">
<h3 class="pBottom8"><?php echo $parentMenu ?></h3>	
<ul>
		<?php foreach($getLeftbanners as $key => $menu){ ?>
<li class="page_item page-item-2311 <?php echo ((isset($highLightMenu) && !empty($highLightMenu) && $highLightMenu== strtoupper($menu->name)) ? 'current_page_item' : ''); ?>" ><a href="<?php echo base_url().'music/'.$menu->link ?>"><span><?php echo stripslashes($menu->name); ?></span></a></li>
<?php } ?>

	</ul>
	
    </div>
<div class="curveBottom"></div>
</div>


<div class="curveOuter">
<div class="curveTop"></div>
<div class="innerVideoGallery">
<h3 class="pBottom8 pLeft">video <span>gallery</span></h3>
<a href="<?php echo base_url().'music/academics/video-gallery'?>"><img width="188" height="132" src="<?php echo base_url().'music_assets/home/images/video-img-inner.gif'?>"></a></div>
<div class="curveBottom"></div>
</div>



</div>