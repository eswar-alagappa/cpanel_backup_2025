<div class="musicInnerContentOuter">
	<div class="musicInnerContent">
	 <?php $this->load->view('left_banner'); ?>


	 
	 
	 <div class="musicInnerContentRight">
	<div class="musicInnerBanner">Contact Us</div>

		
		<div class="contactUsContent">
			<div class="contactUsContentTop">
			<div class="contactUsTopLeftOuter">
			<div class="contactUsTopLeftTopBg"></div>
			<div class="contactUsTopLeft">
			<span>United States</span>
			1647, Andorre Glen, <br>
			Escondido, CA 92029, USA
			</div>
			<div class="contactUsTopLeftBottomBg"></div>
			</div>

			<div class="contactUsTopRightOuter">
			<div class="contactUsTopRightTopBg"></div>
			<div class="contactUsTopRight">
			<span>India</span>
			# 90,Dr.Alagappa Road,<br>
			Purasaiwalkam, Chennai - 600084
			<a href="mailto:customersupport@alagappaarts.com">customersupport@alagappaarts.com </a></div>
			<div class="contactUsTopRightBottomBg"></div>
			</div>
			</div>

				<div class="registerFormOuter">
						<div class="registerFormTitle">
							<div class="registerFormTitleLeftBg"></div>
							<div class="registerFormTitleBg">Please use the following contact information to connect with us</div>
							<div class="registerFormTitleRightBg"></div>
						</div>
					<div class="contactUsForm">
					
						<span style="color:#088904;text-align:center;"><?php if ($this->session->flashdata('SucMessage')!='') { ?>
							<div class="alert alert-success alert-dismissable">
								<?php echo $this->session->flashdata('SucMessage') ;   ?>
							</div>
								<?php } ?>
						</span>

						<div class="cf_info " id="usermessagea"></div>
						
						<form id="cformsform" class="cform contact-form " method="post" action="<?php echo base_url(); ?>music/contact-us" enctype="multipart/form-data">
							<ol class="cf-ol">
								<li class="" id="li--1"><label for="cf_field_1"><span>Name:</span></label><input type="text" title=""  value="<?php echo (isset($post_set['contact_name']) && !empty($post_set['contact_name']) ? $post_set['contact_name'] : '');?>" class="single fldrequired" id="cf_field_1" name="contact_name"><span class="reqtxt">*</span><?php echo form_error('contact_name'); ?></li>
								
								<li class="" id="li--2"><label for="cf_field_2"><span>Phone No:</span></label><input type="text" title=""  value="<?php echo (isset($post_set['contact_phone']) && !empty($post_set['contact_phone']) ? $post_set['contact_phone'] : '');?>" class="single fldrequired" id="cf_field_2" name="contact_phone"><span class="reqtxt">*</span><?php echo form_error('contact_phone'); ?></li>
								
								<li class="" id="li--3"><label for="cf_field_3"><span>Company :</span></label><input type="text" title="" value="<?php echo (isset($post_set['contact_company']) && !empty($post_set['contact_company']) ? $post_set['contact_company'] : '');?>" class="single fldrequired" id="cf_field_3" name="contact_company"><span class="reqtxt">*</span><?php echo form_error('contact_company'); ?></li>
								
								<li class="" id="li--4"><label for="cf_field_4"><span>Message:</span></label><textarea title="" class="area fldrequired" id="cf_field_4" name="contact_message" rows="8" cols="30"><?php echo (isset($post_set['contact_message']) && !empty($post_set['contact_message']) ? $post_set['contact_message'] : '');?></textarea><span class="reqtxt">*</span><?php echo form_error('contact_message'); ?></li>
								
								<li class="" id="li--5"><label for="cf_field_5"><span>Email:</span></label><input type="text" title="" value="<?php echo (isset($post_set['contact_mail']) && !empty($post_set['contact_mail']) ? $post_set['contact_mail'] : '');?>" class="single fldemail fldrequired" id="cf_field_5" name="contact_mail"><span class="emailreqtxt">*</span><?php echo form_error('contact_mail'); ?></li>
								
								<li class="" id="li--6"><label for="cf_field_6"><span>Country</span></label><input type="text" title="" value="" class="single fldrequired" id="cf_field_6" name="contact_country">
								<span class="reqtxt">*</span><?php echo form_error('contact_country'); ?></li>
								
							</ol>
							
							
							<p class="cf-sb"><input type="submit" onclick="" value="Submit" class="sendbutton" id="sendbutton" name="sendbutton"></p>
							
						</form>
					
					</div>

				</div>


			  </div>

		
		
	</div>



	</div>
</div>