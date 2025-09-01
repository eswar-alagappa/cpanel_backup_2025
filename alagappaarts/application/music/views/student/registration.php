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
	
	
	$('.close_img').on('click',function(){
			var img = $(this).attr('data');
			if(img !='')
			{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>music/student/remove_img",
					data:{imgname:img},
					success: function(value)
					{
							if( value ==1){
								//window.location.reload();
								$('li.photo').find('img').hide();
								$('input[name="uploadImage"]').val(' ');
							}
					}
					
				});
			}
	});
	
	
	  $("#program_id").change(function(){
      $("#hdn_program").val($("#program_id option:selected").text());
    });
    
      $("#music_type").change(function(){
      $("#hdn_musictype").val($("#music_type option:selected").text());
    });
    
      $("#center_id").change(function(){
      $("#hdn_center").val($("#center_id option:selected").text());
    });
    
     $("#hdn_program").val($("#program_id option:selected").text());
     $("#hdn_musictype").val($("#music_type option:selected").text());
      $("#hdn_center").val($("#center_id option:selected").text());
	
  });
  
  $(document).ready(function () {
	
	$("a.refresh").on('click',function() { 
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'music/student/captcha_refresh'; ?>",
                        success: function(res) { 
                            if (res)
                            {
                                  $("div.image").html(res);
								  //$('.realperson-hash').val(res);
                            }
                        }
                    });
                });
				

  });
  

  </script>
  <style>
  #studentForm ul li p{
	  color:#f00;
  }
  </style>
<div class="musicInnerContentOuter">
	<div class="musicInnerContent">
	<?php $this->load->view('left_banner'); ?> 
		<div class="musicInnerContentRight">
			<div class="musicInnerBanner">
			Student’s Registration
			</div>



				<div class="musicApaaform"> <a target="_blank" href="<?php echo base_url().'music_assets/home/application-form-music.pdf'; ?>"><img width="284" height="40" class="registerBtn" src="
				<?php echo base_url().'music_assets/home/images/registration-btn.png' ?>"></a>
					<div class="registerFormOuter">
						<div class="registerFormTitle">
							<div class="registerFormTitleLeftBg"></div>
							<div class="registerFormTitleBg">To Get Admissions, Please fill in the form given below</div>
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
								<form enctype="multipart/form-data" method="post" id="studentForm" action="<?php echo base_url(); ?>music/student/registration">
								<ul>
								<li><label>Program :<strong class="star">*</strong></label>
                                <input type="hidden" name="hdn_program" id="hdn_program">
								<select name="program_id" id="program_id">
								<option value="">Select</option>
								<?php if(!empty($programs)) { foreach($programs as $k=>$pgm){?>
									<option value="<?php echo $pgm->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && ($post_set['program_id']== $pgm->program_id) ? 'selected' : '');?>><?php echo stripslashes($pgm->name); ?></option>
								<?php } } ?> 
								</select><?php echo form_error('program_id'); ?></li>
								
								<li><label>Music Type :<strong class="star">*</strong></label>
                                <input type="hidden" name="hdn_musictype" id="hdn_musictype">
								<select name="music_type" id="music_type">
								<option value="">Select</option>
								<option value="">Vocal Music</option>
								<option value="">Instrumental Music</option>
								<?php if(!empty($music_type)) { foreach($music_type as $k=>$type){?>
									<option value="<?php echo $k; ?>" <?php echo (isset($post_set['music_type']) && !empty($post_set['music_type'])  && ($post_set['music_type']== $k) ? 'selected' : '');?>><?php echo stripslashes($type); ?></option>
								<?php } } ?> 
								</select><?php echo form_error('music_type'); ?></li>
								
								<li>
								<label>Firsts Name :<strong class="star">*</strong></label><input type="text" value="<?php echo (isset($post_set['first_name']) && !empty($post_set['first_name']) ? $post_set['first_name'] : '');?>" 
								name="first_name"><?php echo form_error('first_name'); ?></li>
								<li>
								</li><li>
								<label>Last Name : </label><input type="text" value="<?php echo (isset($post_set['last_name']) && !empty($post_set['last_name']) ? $post_set['last_name'] : '');?>" name="last_name"><?php echo form_error('last_name'); ?></li>
								<li>
								</li><li>
								<label>Age :<strong class="star">*</strong></label>
								<input type="text" maxlength="3" value="<?php echo (isset($post_set['age']) && !empty($post_set['age']) ? $post_set['age'] : '');?>" name="age"><?php echo form_error('age'); ?></li>
								<li class="studentdate"><label>D.O.B : <strong class="star">*</strong></label><input type="text" id="datepicker" readonly="readonly" class="datetxtbox hasDatepick" name="dob" value="<?php echo (isset($post_set['dob']) && !empty($post_set['dob']) ? $post_set['dob'] : '');?>" ></li>
								
								<li><label> Gender :<strong class="star">*</strong></label>
									<div class="studentgender"><input type="radio" value="Male" name="gender" <?php if( !empty($post_set['gender']) && $post_set['gender'] =='Male') { ?> checked <?php }else{ ?>checked<?php } ?> class="radiobtn">Male
									<input type="radio" value="Female" name="gender" class="radiobtn" <?php if(!empty($post_set['gender']) && $post_set['gender'] =='Female') { ?> checked <?php } ?>>Female</div> <?php echo form_error('gender'); ?>
								</li>



								<li>

								<label>Photo : </label><input type="file" class="custom_upload" id="flePhoto" name="flePhoto">
								<input type="hidden" name="uploadImage" value="<?php echo (isset($post_set['uploadImage']) && !empty($post_set['uploadImage']) ? $post_set['uploadImage'] : '');?>">
   <?php echo (isset($post_set['uploadImage']) && !empty($post_set['uploadImage']) ? '<img src="../../music_assets/profile/'.$post_set['uploadImage'].'"><img data="'.$post_set['uploadImage'].'" class="close_img" src="../../music_assets/home/images/button_close1.gif">' : '');?>
   
								</li>
								<li>
								</li><li><label>Alternate Phone Number: </label><input type="text" value="<?php echo (isset($post_set['other_contact']) && !empty($post_set['other_contact']) ? $post_set['other_contact'] : '');?>" name="other_contact">  </li>     
								<li><label>Special accomplishments (if any)</label><input name="txtSpecqualification" value="<?php echo (isset($post_set['txtSpecqualification']) && !empty($post_set['txtSpecqualification']) ? $post_set['txtSpecqualification'] : '');?>" maxlength="100" tabindex="17"></li>
								<li><label>Other relevant info</label><textarea name="txtotherinfo" tabindex="20" style="height: 30px;"><?php echo (isset($post_set['txtotherinfo']) && !empty($post_set['txtotherinfo']) ? $post_set['txtotherinfo'] : '');?></textarea> </li>

								
								</ul>
								<ul>
								<li><label>Center :<strong class="star">*</strong> </label>
								 <input type="hidden" name="hdn_center" id="hdn_center">
								 
								<select name="center_id" id="center_id">
									<option value="">Select</option>
									<?php if(!empty($centers)) { foreach($centers as $k=>$center){?>
										<option value="<?php echo $center->center_academy_id; ?>" <?php echo (isset($post_set['center_id']) && !empty($post_set['center_id'])  && ($post_set['center_id']== $center->center_academy_id) ? 'selected' : '');?>><?php echo stripslashes($center->name); ?></option>
									<?php } } ?>
								</select><?php echo form_error('center_id'); ?></li>


								<li><label>Address:<strong class="star">*</strong> </label><textarea rows="" cols="" name="address"><?php echo (isset($post_set['address']) && !empty($post_set['address']) ? $post_set['address'] : '');?></textarea><?php echo form_error('address'); ?></li>
								<li> <label>City :<strong class="star">*</strong></label><input type="text" name="city" value="<?php echo (isset($post_set['city']) && !empty($post_set['city']) ? $post_set['city'] : '');?>"><?php echo form_error('city'); ?></li>

								<li>
								<label>State :<strong class="star">*</strong></label><input type="text" name="state" value="<?php echo (isset($post_set['state']) && !empty($post_set['state']) ? $post_set['state'] : '');?>"><?php echo form_error('state'); ?></li>


								<li>
								<label>Country :<strong class="star">*</strong></label><input type="text" name="country" value="<?php echo (isset($post_set['country']) && !empty($post_set['country']) ? $post_set['country'] : '');?>"><?php echo form_error('country'); ?></li>
								<li>
								<label>Zip :<strong class="star">*</strong></label><input type="text" name="zip" value="<?php echo (isset($post_set['zip']) && !empty($post_set['zip']) ? $post_set['zip'] : '');?>"><?php echo form_error('zip'); ?></li>
								<li><label>Mobile :<strong class="star">*</strong> </label><input type="text" name="contact" value="<?php echo (isset($post_set['contact']) && !empty($post_set['contact']) ? $post_set['contact'] : '');?>"><?php echo form_error('contact'); ?></li>
								<li><label>Email:<strong class="star">*</strong></label><input type="text" name="email" value="<?php echo (isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : '');?>"><?php echo form_error('email'); ?>  </li>

								<li><label>Experience in Music:<strong class="star">*</strong></label>
								<input name="exp_music" maxlength="20" tabindex="16" id="exp_music" class="frm_element" value="<?php echo (isset($post_set['exp_music']) && !empty($post_set['exp_music']) ? $post_set['exp_music'] : '');?>"><?php echo form_error('exp_music'); ?></li>

								<li><label>Name of your Guru :<strong class="star">*</strong> </label><input name="name_of_guru" maxlength="50" tabindex="18" value="<?php echo (isset($post_set['name_of_guru']) && !empty($post_set['name_of_guru']) ? $post_set['name_of_guru'] : '');?>"><?php echo form_error('name_of_guru'); ?></li>
								<li><label>Your Guru Located at 	:</label><input name="txtLoca" maxlength="50" tabindex="19" "<?php echo (isset($post_set['txtLoca']) && !empty($post_set['txtLoca']) ? $post_set['txtLoca'] : '');?>"></li>
								<br>

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


