 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
   <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    
  <script>
  $(document).ready(function () {
	  var d = new Date();
	$( "#datepicker" ).datepicker({
		maxDate: new Date((d.getFullYear() - 06), (d.getMonth()), (d.getDate())),
      changeMonth: true,
      changeYear: true,
	   yearRange: '-60:-06',
	   dateFormat: 'mm/dd/yy',
    });
  });
  
 
  

  </script>
  <style>
  #frmCentreadd ul li p{
	  color:#f00;
  }
  </style>
<div class="musicInnerContentOuter">
	<div class="musicInnerContent">
		<?php $this->load->view('left_banner'); ?> 
		<div class="musicInnerContentRight">
			<div class="musicInnerBanner">Center Registration</div>

				<div class="musicApaaform"> <a target="_blank" href="
				<?php echo base_url().'music_assets/home/Music-Center-Accreditation.pdf' ?>"><img width="284" height="40" class="registerBtn" src="<?php echo base_url().'music_assets/home/images/registration-btn.png' ?>"></a>
					<div class="registerFormOuter">
							<div class="registerFormTitle">
							<div class="registerFormTitleLeftBg"></div>
							<div class="registerFormTitleBg">Please use the following information to register.</div>
							<div class="registerFormTitleRightBg"></div>
							</div>
							
						   <div class="registerFormOuter">
						  
								<div class="registerForm">
								<center><span class="studentregCorrect"></span></center>
								<center>
									<span class="successMsg">
									
									<?php if ($this->session->flashdata('SucMessage')) { ?>
										<div class="alert alert-danger alert-dismissable">
											<?php echo $this->session->flashdata('SucMessage'); ?>
										</div>
									</span>
									<span class="errorMsg">
													<?php }if ($this->session->flashdata('ErrMessage')) { ?>
														<div class="alert alert-danger alert-dismissable">
															<?php echo $this->session->flashdata('ErrMessage'); ?>
														</div>
													<?php } ?>      
									</span>
								</center>
									<form enctype="multipart/form-data" method="post" id="frmCentreadd" action="<?php echo base_url(); ?>music/center/registration">

									<ul>
									<li><label>Academy Name :<strong class="star">*</strong></label>
									<input type="text" name="academy_name" value="<?php echo (isset($post_set['academy_name']) && !empty($post_set['academy_name']) ? $post_set['academy_name'] : '');?>"><?php echo form_error('academy_name'); ?></li>
									 <li><label>Address:<strong class="star">*</strong> </label>
											<input type="text" name="academy_address" value="<?php echo (isset($post_set['academy_address']) && !empty($post_set['academy_address']) ? $post_set['academy_address'] : '');?>"><?php echo form_error('academy_address'); ?> </li>
											<li>
											<label> City :<strong class="star">*</strong></label>
											<input type="text" name="academy_city" value="<?php echo (isset($post_set['academy_city']) && !empty($post_set['academy_city']) ? $post_set['academy_city'] : '');?>"> <?php echo form_error('academy_city'); ?> </li>
											<li><label>State :<strong class="star">*</strong></label>
											<input type="text" name="academy_state" value="<?php echo (isset($post_set['academy_state']) && !empty($post_set['academy_state']) ? $post_set['academy_state'] : '');?>" > <?php echo form_error('academy_state'); ?> </li>
											<li><label>Country:<strong class="star">*</strong></label>
											<input type="text" name="academy_country" value="<?php echo (isset($post_set['academy_country']) && !empty($post_set['academy_country']) ? $post_set['academy_country'] : '');?>"> <?php echo form_error('academy_country'); ?> </li>
											<li><label>Zip:<strong class="star">*</strong></label>
											<input type="text" name="academy_zip" value="<?php echo (isset($post_set['academy_zip']) && !empty($post_set['academy_zip']) ? $post_set['academy_zip'] : '');?>"> <?php echo form_error('academy_zip'); ?>  </li>


										  <li>
											<label>Director Name :<strong class="star">*</strong></label>
											<input type="text" name="director_name" value="<?php echo (isset($post_set['director_name']) && !empty($post_set['director_name']) ? $post_set['director_name'] : '');?>"> <?php echo form_error('director_name'); ?> </li>
											
										  <li class="studentdate"><label>Director's D.O.B:<strong class="star">*</strong></label>
											 <input type="text" readonly="readonly" id="datepicker" name="director_dob" value="<?php echo (isset($post_set['director_dob']) && !empty($post_set['director_dob']) ? $post_set['director_dob'] : '');?>" class="w200 fL hasDatepick"> <?php echo form_error('director_dob'); ?>
										   </li><li><label>Email :<strong class="star">*</strong></label>
											<input type="text" name="director_email" value="<?php echo (isset($post_set['director_email']) && !empty($post_set['director_email']) ? $post_set['director_email'] : '');?>"> <?php echo form_error('director_email'); ?> </li>
											
											<li>
											   <label> Special Qualifications : </label>
											<input type="text" name="director_special_qualification" value="<?php echo (isset($post_set['director_special_qualification']) && !empty($post_set['director_special_qualification']) ? $post_set['director_special_qualification'] : '');?>"> </li>

													<li><label>Experience in Music:</label>
														 <input name="exp_music" maxlength="20" tabindex="16" id="exp_music" class="frm_element" value="<?php echo (isset($post_set['exp_music']) && !empty($post_set['exp_music']) ? $post_set['exp_music'] : '');?>"></li>
														 <li>
											   <label>Events Performances : </label>
											<input type="text" name="events_performance" value="<?php echo (isset($post_set['events_performance']) && !empty($post_set['events_performance']) ? $post_set['events_performance'] : '');?>" >  </li>
											<li>
											   <label> Awards Titles : </label>
											<textarea style="height: 30px;" name="awards_title" cols="" rows=""><?php echo (isset($post_set['awards_title']) && !empty($post_set['awards_title']) ? $post_set['awards_title'] : '');?></textarea>  </li>
										   
											
											</ul>
											<ul>
											<li>
									  <label>Email :<strong class="star">*</strong></label><input type="text" name="academy_email" value="<?php echo (isset($post_set['academy_email']) && !empty($post_set['academy_email']) ? $post_set['academy_email'] : '');?>" > <?php echo form_error('academy_email'); ?> </li>

									<li>
									  <label>Website : </label><input type="text" name="academy_website"></li>

										  <li><label> Phone Day Time :<strong class="star">*</strong></label>
											<input type="text" name="academy_phone" value="<?php echo (isset($post_set['academy_phone']) && !empty($post_set['academy_phone']) ? $post_set['academy_phone'] : '');?>" > <?php echo form_error('academy_phone'); ?></li>
									 
											<li>
											   <label>Alternate Phone : </label>
											<input type="text" name="academy_alternate_phone" value="<?php echo (isset($post_set['academy_alternate_phone']) && !empty($post_set['academy_alternate_phone']) ? $post_set['academy_alternate_phone'] : '');?>" >  </li>
											 <li>
											   <label>Number Arangetrams : </label>
											<input type="text" name="academy_no_of_arrangetram" value="<?php echo (isset($post_set['academy_no_of_arrangetram']) && !empty($post_set['academy_no_of_arrangetram']) ? $post_set['academy_no_of_arrangetram'] : '');?>" >  </li>
											 <li><label>Year of Establishment : </label>
											<input type="text" name="academy_year_of_establishment" value="<?php echo (isset($post_set['academy_year_of_establishment']) && !empty($post_set['academy_year_of_establishment']) ? $post_set['academy_year_of_establishment'] : '');?>" >  </li>
										   
										  
									<li><label>Address: </label>
											<input type="text" name="director_address" value="<?php echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?>" > <?php echo form_error('director_address'); ?> </li>
											
											<li><label>State :<strong class="star">*</strong></label>
											<input type="text" name="director_state" value="<?php echo (isset($post_set['director_state']) && !empty($post_set['director_state']) ? $post_set['director_state'] : '');?>" > <?php echo form_error('director_state'); ?> </li>
											<li><label>Country:<strong class="star">*</strong></label>
											<input type="text" name="director_country" value="<?php echo (isset($post_set['director_country']) && !empty($post_set['director_country']) ? $post_set['director_country'] : '');?>" > <?php echo form_error('director_country'); ?> </li>
											<li><label>Zip:<strong class="star">*</strong></label>
											<input type="text" name="director_zip" value="<?php echo (isset($post_set['director_zip']) && !empty($post_set['director_zip']) ? $post_set['director_zip'] : '');?>" > <?php echo form_error('director_zip'); ?> </li>
									 

													<li><label>Name of your Guru : </label><input name="name_of_guru" maxlength="50" tabindex="18" id="name_of_guru" value="<?php echo (isset($post_set['name_of_guru']) && !empty($post_set['name_of_guru']) ? $post_set['name_of_guru'] : '');?>" class="frm_element"></li>
														 
														  <li><label>Located at 	:</label><input name="located_at" maxlength="50" tabindex="19" id="located_at" value="<?php echo (isset($post_set['located_at']) && !empty($post_set['located_at']) ? $post_set['located_at'] : '');?>" class="frm_element"></li>
														  
													   <li><label>Other relevant info</label><textarea name="other_relevant_info" tabindex="20" style="height: 30px;" id="txtInfo" class="frm_element"> <?php echo (isset($post_set['other_relevant_info']) && !empty($post_set['other_relevant_info']) ? $post_set['other_relevant_info'] : '');?> </textarea> 
												  </li>

										 
									</ul>

									 
											  
									<div class="centerregisterBtn"><input type="submit" id="submit" value="Register" class="registerBtn" name="submit"></div>

									</form>
								</div>
						</div>
					</div>
				</div>


		</div>
	</div>
</div>


