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
		$leftbannerImg = 'apaa-banner-left.jpg';
	}elseif($parentMenu == 'EVENTS' && isset($childMenu) && !empty($childMenu) && $childMenu=='FAQ' ){
		$leftbannerImg = 'apaa-banner-left.jpg';
	}elseif($parentMenu == 'OUR CENTERS'){
		$leftbannerImg = 'center-banner.jpg';
	}elseif($parentMenu == 'FEATURED GURU'){
//		$leftbannerImg = 'dancer-of-the-month.jpg';
            $leftbannerImg = 'thejaswini-raj.png';
		$leftbannerImg1 = 'https://www.youtube.com/embed/O64XL7A2MUQ';
	}	elseif($parentMenu == 'DEMO'){
		$leftbannerImg = 'thejaswini-raj.png';
		$leftbannerImg1 = 'https://www.youtube.com/embed/O64XL7A2MUQ';
	}elseif($parentMenu == 'REGISTRATION' || $parentMenu == 'LOGIN' || $parentMenu == 'STUDENT' || $parentMenu == 'CENTER' || $parentMenu == strtoupper('forgetpassword')){
		$leftbannerImg = 'register-banner.png';
	}else{
		$leftbannerImg = '';
	}
}
?>
<div class="danceInnerContentLeft"><div class="danceBannerLeft">

 <img src="<?php echo base_url().'assets/home/images/'.$leftbannerImg ?>" alt="academics-banner-left.jpg" title="academics-banner-left.jpg" />

</div>

<div class="danceLeftContent">
<?php if( isset($getLeftbanners) && !empty($getLeftbanners) ){?>
<div  class="<?php echo ((isset($arg1) && !empty($arg1) && ($arg1=='registration' || $arg1=='login' || $arg1=='student' || $arg1=='center')) ? 'studentleftNav' : 'academicsleftNav');?>"><h2><?php echo $parentMenu ?></h2>	<ul>
		
<?php

	foreach($getLeftbanners as $key => $menu){ 
?>
<li class="page_item page-item-2311 <?php echo ((isset($highLightMenu) && !empty($highLightMenu) && $highLightMenu== strtoupper($menu->name)) ? 'current_page_item' : ''); ?>" ><a href="<?php echo base_url().'dance/'.$menu->link ?>"><span><?php echo stripslashes($menu->name); ?></span></a></li>
<?php } ?>
</ul></div> <?php } ?>

<div class="courses" id="tabcourses">

<h2>Programs</h2>

<ul>

<li><a href="<?php echo base_url().'dance/academics/apaa-programs' ?>">Certificate</a></li>

<li><a href="<?php echo base_url().'dance/academics/apaa-programs' ?>">Advanced certificate</a></li>

<li><a href="<?php echo base_url().'dance/academics/apaa-programs' ?>">Diploma</a></li>

<li><a href="<?php echo base_url().'dance/academics/apaa-programs' ?>">Bachelor's Degree</a></li>

<li><a href="<?php echo base_url().'dance/academics/master-program'?>"> Master’s Degree <span style="font-weight: 800; color: #d10700; animation: blinker 2s linear infinite;">(New)</span></a></li>

</ul>

</div>

<div class="news innerNews">

<h2>news</h2>
 <p>
     <!--<strong>
     Admission Open </strong> <!--Isha Gondi --><!--Sangeetha Ramachandran    -->  <!--Disciple of Smt.Jeyanthi Ghatraju - Natyanjali,--><!--Smt.Deepali Vora – Nitya Shetra Dance School,--> 
   The examination dates for all the APAA students 
May 30th to 2nd June.<br>
Students will be assigned with new user id and password
   <!--  <span style="    font-weight: bold;
    padding: 3px 3px;
    background: #a90000;
    text-align: center;"><a href="https://alagappaarts.com/dance/student/new_registration" target="_blank" style="color: #ffffff; animation: blinker 2s linear infinite;">Online Application</a></span>-->
</p>  
</div>

<div class="danceBannerLeft">

 <iframe width="81%" height="200" style="padding-top: 18px;" frameborder="0" allowfullscreen="allowfullscreen" src="<?php echo $leftbannerImg1 ?>"></iframe>
 
</div>

</div>

</div>