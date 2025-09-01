<?php $this->load->view('left_banner'); ?>
<div id="content-full">
<h2>Contact us</h2>
	<div class="contactContent">
    <div class="contactContentL"><span>Please fill the following form to <br>
Connect with us</span>

						<span style="color:#088904;text-align:center;"><?php if ($this->session->flashdata('SucMessage')!='') { ?>
							<div class="alert alert-success alert-dismissable">
								<?php echo $this->session->flashdata('SucMessage') ;   ?>
							</div>
								<?php } ?>
						</span>
						
<div class="cf_info " id="usermessagea"></div>

<form id="cformsform" class="cform contact-form " method="post" action="<?php echo base_url().'vaasthu/contact-us'?>" enctype="multipart/form-data">

	<ol class="cf-ol">
		<li class="" id="li--1">
		<label for="cf_field_1"><span>Name:</span></label>
		<input type="text" title="" value="<?php echo (isset($post_set['contact_name']) && !empty($post_set['contact_name']) ? $post_set['contact_name'] : '');?>" class="single fldrequired" id="cf_field_1" name="contact_name"><span class="reqtxt">*</span><?php echo form_error('contact_name'); ?>
		</li>

		<li class="" id="li--2">
		<label for="cf_field_2"><span>Phone No:</span></label>
		<input type="text" title="" value="<?php echo (isset($post_set['contact_phone']) && !empty($post_set['contact_phone']) ? $post_set['contact_phone'] : '');?>" class="single fldrequired" id="cf_field_2" name="contact_phone"><span class="reqtxt">*</span><?php echo form_error('contact_phone'); ?>
		</li>

		<li class="" id="li--3">
		<label for="cf_field_3"><span>Email:</span></label>
		<input type="text" title="" value="<?php echo (isset($post_set['contact_mail']) && !empty($post_set['contact_mail']) ? $post_set['contact_mail'] : '');?>" class="single fldemail fldrequired" id="cf_field_3" name="contact_mail"><span class="emailreqtxt">*</span>
		<?php echo form_error('contact_mail'); ?></li>

		<li class="" id="li--4">
		<label for="cf_field_4"><span>Company :</span></label>
		<input type="text" title=""  value="<?php echo (isset($post_set['contact_company']) && !empty($post_set['contact_company']) ? $post_set['contact_company'] : '');?>" class="single fldrequired" id="cf_field_4" name="contact_company"><span class="reqtxt">*</span><?php echo form_error('contact_company'); ?></li>

		<li class="" id="li--5">
		<label for="cf_field_5"><span>Message:</span></label>
		<textarea title="" class="area fldrequired" id="cf_field_5" name="contact_message" rows="8" cols="30"><?php echo (isset($post_set['contact_message']) && !empty($post_set['contact_message']) ? $post_set['contact_message'] : '');?></textarea><span class="reqtxt">*</span><?php echo form_error('contact_message'); ?></li>
	</ol>
	
<p class="cf-sb"><input type="submit" onclick="return cforms_validate('', false)" value="Submit" class="sendbutton" id="sendbutton" name="sendbutton"></p>

</form>

	
    </div>
    
     <div class="contactContentR">
	<span>Alagappa Performing Arts Academy,</span>
    <div class="contactInnerRight">
     <p><strong>United States</strong><br>
1647, Andorre Glen,<br>
Escondido,<br>
CA 92029, USA</p>
   <iframe width="360" height="150" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3343.0313738776895!2d-117.1041298!3d33.0819592!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80dbf43fe2726fc5%3A0x913e0c4615b5d509!2s1647+Andorre+Glen%2C+Escondido%2C+CA+92029%2C+USA!5e0!3m2!1sen!2sin!4v1412320151031" style="border: 0;"></iframe>    </div>
    
     <div class="contactInnerRight">
    <p><strong>India</strong><br>
# 90,Dr.Alagappa Road,<br>
Purasaiwalkam,<br>
Chennai &ndash; 600084<br>
<a href="mailto:customersupport@alagappaarts.com">customersupport@alagappaarts.com</a></p>
   <iframe width="360" height="150" frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3886.2963585975617!2d80.2567426!3d13.080394799999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52660afb0149c9%3A0x2f913c9883243f9c!2s90%2C+Dr+Alagappa+Chetty+Rd%2C+Purasawalkam%2C+Chennai%2C+Tamil+Nadu+600084!5e0!3m2!1sen!2sin!4v1412320793347"></iframe>    </div>
    
    
    
    
    
   
    
    
    </div>
    </div>

</div>