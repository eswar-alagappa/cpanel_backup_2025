<?php
error_reporting(0);	
session_start();
?>
<div class="danceInnerContent">
 <?php $this->load->view('left_banner'); ?>


 
 
 <div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span>Contact Us</span></h2>
</div>

    
	<div class="apaaContent">
	<div class="contactOuter">



	<h2>Alagappa Performing Arts Academy,</h2>
	<div class="contactTopLeft">
		<span>United States</span><br>
		1647, Andorre Glen, <br>
		  Escondido, <br>
		  CA 92029, USA
	  </div>
	<div class="contactTopRight">
		<span>India</span><br>
		# 90,Dr.Alagappa Road, <br>
		Purasaiwalkam,<br>
		Chennai &ndash; 600084<br>
		<a href="mailto:customersupport@alagappaarts.com">customersupport@alagappaarts.com</a></div>
	 
	 
	  </div>
	   <div class="registerFormOuter">
	<div class="fl"><img width="5" height="44" src="../assets/home/images/register-title-bg-left.png"></div><div class="registerFormTitle">Please use the following contact information to connect with us</div><div class="fr"><img width="5" height="44" src="../assets/home/images/register-title-bg-right.png"></div>
	
	
	 

	<div class="registerForm">
	
	 <span style="color:#088904;text-align:center;"><?php if ($this->session->flashdata('SucMessage')!='') { ?>
		<div class="alert alert-success alert-dismissable">
			<?php echo $this->session->flashdata('SucMessage') ;   ?>
		</div>
<?php } ?></span>


	<div class="cf_info " id="usermessagea"></div>
		<form id="cformsform" class="cform contact-us " method="post" action="<?php echo base_url(); ?>dance/contact-us" enctype="multipart/form-data">
			<ol class="cf-ol">
				<li class="" id="li--1">
				<label for="cf_field_1">
				<span>Name:</span>
				</label>
				<input type="text" title="" value="<?php echo (isset($post_set['contact_name']) && !empty($post_set['contact_name']) ? $post_set['contact_name'] : '');?>" class="single fldrequired" id="cf_field_1" name="contact_name">
				<!--<input type="hidden" title="" value="^[A-Za-z ]+$" id="cf_field_1_regexp" name="cf_field_1_regexp">-->
				<span class="reqtxt">*</span>
				<?php echo form_error('contact_name'); ?>
				</li>
			
			
				<li class="" id="li--2">
				<label for="cf_field_2">
				<span>Phone No:</span></label>
				<input type="text" title="" value="<?php echo (isset($post_set['contact_phone']) && !empty($post_set['contact_phone']) ? $post_set['contact_phone'] : '');?>" class="single fldrequired" id="cf_field_2" name="contact_phone">
				<!--<input type="hidden" title="" value="^[0-9]+$" id="cf_field_2_regexp" name="cf_field_2_regexp">-->
				<span class="reqtxt">*</span>
				<?php echo form_error('contact_phone'); ?>
				</li>
			
				<li class="" id="li--3">
				<label for="cf_field_3">
				<span>Company:</span></label>
				<input type="text" title="" value="<?php echo (isset($post_set['contact_company']) && !empty($post_set['contact_company']) ? $post_set['contact_company'] : '');?>" class="single fldrequired" id="cf_field_3" name="contact_company">
				<span class="reqtxt">*</span>
				<?php echo form_error('contact_company'); ?>
				</li>
			
				<li class="" id="li--4">
				<label for="cf_field_4">
				<span>Message:</span></label>
				<textarea title="" class="area fldrequired" id="cf_field_4" name="contact_message" rows="8" cols="30"><?php echo (isset($post_set['contact_message']) && !empty($post_set['contact_message']) ? $post_set['contact_message'] : '');?></textarea>
				<span class="reqtxt">*</span>
				<?php echo form_error('contact_message'); ?>
				</li>
			
				<li class="" id="li--5">
				<label for="cf_field_5">
					<span>Email:</span>
				</label>
				<input type="text" title="" value="<?php echo (isset($post_set['contact_mail']) && !empty($post_set['contact_mail']) ? $post_set['contact_mail'] : '');?>" class="single fldemail fldrequired" id="cf_field_5" name="contact_mail">
				<span class="emailreqtxt">*</span>
				<?php echo form_error('contact_mail'); ?>
				</li>
			
				<li class="" id="li--6">
				<label for="cf_field_6">
				<span>Country</span></label>
				<input type="text" title="" value="" class="single fldrequired" id="cf_field_6" name="contact_country">
				<span class="reqtxt">*</span>
				<?php echo form_error('contact_country'); ?>
				</li>
				
				<li class="" id="li--6">
				<label for="cf_field_6">
				    
				    <div class="form-group">
					<div class="captcha">
					<img src="<?php echo base_url()?>demo_captcha.php" class="imgcaptcha" alt="captcha"  />
					<img src="<?php echo base_url()?>images/refresh.png" alt="reload" class="refresh" />
					</div>
									
				    <label class="form-label" for="captcha">Captcha</label>
                  <input id="captcha" class="form-input" type="text" required />
                  <i class="fa fa-cog" aria-hidden="true"></i>
				</li>
			
				<!--<li class="" id="li--7">
				<label class="seccap" for="cforms_captcha">
				<span>Verification Code :</span></label>
				<input type="text" title="" class="secinput" id="cforms_captcha" name="cforms_captcha">
				<img alt="" src="http://alagappaarts.com/dance/wp-admin/admin-ajax.php?action=cforms2_reset_captcha&amp;_wpnonce=b08e5f2bc4&amp;ts=&amp;rnd=986885" class="captcha" id="cf_captcha_img">
				<script type="text/javascript">jQuery(function() {reset_captcha();});</script>
				<a href="javascript:reset_captcha('')" title="reset captcha image">
				<span class="dashicons dashicons-update captcha-reset"></span></a>
				</li>-->
			</ol>
			
			<fieldset class="cf_hidden"><legend>&nbsp;</legend>
			<!--<input type="hidden" value="&lt;span&gt;One%20moment%20please...&lt;/span&gt;" id="cf_working" name="cf_working">
			<input type="hidden" value="&lt;span&gt;Please%20fill%20in%20all%20the%20required%20fields.&lt;/span&gt;" id="cf_failure" name="cf_failure">
			<input type="hidden" value="&lt;span&gt;Please%20double-check%20your%20verification%20code.&lt;/span&gt;" id="cf_codeerr" name="cf_codeerr">
			<input type="hidden" value="ynycf_field_1%24%23%24Enter%20only%20alphapets%20in%20Name%20Field%7Ccf_field_2%24%23%24Enter%20only%20numbers%20In%20Phone%20No%20Field%7Ccf_field_5%24%23%24Enter%20valid%20E-mail%20Id%20in%20Email%20Field%7C" id="cf_customerr" name="cf_customerr">-->
			</fieldset>
			<p class="cf-sb"><input type="submit"  value="Submit" class="sendbutton" id="sendbutton" name="sendbutton"></p>
		
		</form>
	</div>
	
	
	</div>
	</div>

	
	
</div>



</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script language="javascript">
$(document).ready(function(){

$(".refresh").on('click',function () { console.log('---aaaa-----')
    $(".imgcaptcha").attr("src","<?php echo base_url()?>demo_captcha.php?_="+((new Date()).getTime()));
    
    
});

})
</script>
<style>
    .captcha{
	position: relative;
	margin-top: 15px;
	z-index: 99;
	right: 0;
}
</style>