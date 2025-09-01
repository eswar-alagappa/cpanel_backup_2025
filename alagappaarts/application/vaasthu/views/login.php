<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>

<?php $this->load->view('left_banner'); ?>



 <script>

  $(document).ready(function () {
	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	   yearRange: '-40:-04',
	   dateFormat: 'mm/dd/yy',
    });
	
	
	/*$('.close_img').on('click',function(){
			var img = $(this).attr('data');
			if(img !='')
			{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>dance/student/remove_img",
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
	});*/
	
	
  });
  
  /*$(document).ready(function () {
	
	$("a.refresh").on('click',function() { 
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'dance/student/captcha_refresh'; ?>",
                        success: function(res) { 
                            if (res)
                            {
                                  $("div.image").html(res);
								  //$('.realperson-hash').val(res);
                            }
                        }
                    });
                });
				

  });*/
  

  </script>
  
<div id="content-full">
<h2>Registration</h2>
	<div class="registrationContent">
			
		<div class="cf_info " id="usermessage2a"></div>
		
		<center><span class="successMsg">
				<?php if ($this->session->flashdata('SucMessage')) { ?>
					<div class="alert alert-danger alert-dismissable">
                        <?php echo $this->session->flashdata('SucMessage'); ?>
                    </div>
			</span><span class="errorMsg">
				<?php }if ($this->session->flashdata('ErrMessage')) { ?>
					<div class="alert alert-danger alert-dismissable">
                        <?php echo $this->session->flashdata('ErrMessage'); ?>
                    </div>
				<?php } ?>
</span></center>

		<form id="cforms2form" class="cform student-register-form " method="post" action="<?php echo base_url().'vaasthu/registration'?>" enctype="multipart/form-data">
		
			<ol class="cf-ol">
			
				<li class="" id="li-2-1"><label for="cf2_field_1"><span>Program :</span></label>
				<!--<input type="text" title="" value="" class="single fldrequired" id="cf2_field_1" name="cf2_field_1">-->
				<select name="program_id" id="program_id" class="single fldrequired">
  <option value="">Select</option>
  <?php if(!empty($programs)) { foreach($programs as $k=>$pgm){?>
		<option value="<?php echo $pgm->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && ($post_set['program_id']== $pgm->program_id) ? 'selected' : '');?>><?php echo stripslashes($pgm->name); ?></option>
	<?php } } ?>
  </select><span class="reqtxt">*</span><?php echo form_error('program_id'); ?>
				</li>
				
				<li class="" id="li-2-2"><label for="cf2_field_2"><span>First Name : </span></label><input type="text" title="" value="<?php echo (isset($post_set['first_name']) && !empty($post_set['first_name']) ? $post_set['first_name'] : '');?>" class="single fldrequired" id="first_name" name="first_name"><span class="reqtxt">*</span><?php echo form_error('first_name'); ?></li>
				
				<li class="" id="li-2-3"><label for="cf2_field_3"><span>Last Name :</span></label><input type="text" title="" value="<?php echo (isset($post_set['last_name']) && !empty($post_set['last_name']) ? $post_set['last_name'] : '');?>" class="single fldrequired" id="last_name" name="last_name"><span class="reqtxt">*</span><?php echo form_error('last_name'); ?></li>
				
				<li class="" id="li-2-4"><label for="cf2_field_4"><span>Age:</span></label><input type="text" title="" value="<?php echo (isset($post_set['age']) && !empty($post_set['age']) ? $post_set['age'] : '');?>" class="single fldrequired" id="age" name="age">
				<span class="reqtxt">*</span><?php echo form_error('age'); ?></li>
				
				<li class="" id="li-2-5"><label for="cf2_field_5"><span>D.O.B :</span></label><input type="text" title="" value="<?php echo (isset($post_set['dob']) && !empty($post_set['dob']) ? $post_set['dob'] : '');?>" class="datetxtbox hasDatepick" id="datepicker" name="dob">
				<span class="reqtxt">*</span><?php echo form_error('dob'); ?></li>
				
				<li class="" id="li-2-6"><label for="cf2_field_6"><span>Center:</span></label>
				<input type="text" title="" readonly value="Vaasthu Science World Research Centre" class="single fldrequired" id="cf2_field_6" name="cf2_field_6">
				<!--<select name="center_id" id="cf2_field_6" class="single fldrequired">
  <option value="">Select</option>
  
  <?php if(!empty($centers)) { foreach($centers as $k=>$center){?>
		<option value="<?php echo $k; ?>" <?php echo (isset($post_set['center_id']) && !empty($post_set['center_id'])  && ($post_set['center_id']== $k) ? 'selected' : '');?>><?php echo stripslashes($center); ?></option>
	<?php } } ?>

   </select>--><span class="reqtxt">*</span><?php echo form_error('center_id'); ?></li>
				
				<li class="" id="li-2-7"><label for="cf2_field_7"><span>Address :</span></label><textarea title="" class="area fldrequired" id="cf2_field_7" name="address" rows="8" cols="30"><?php echo (isset($post_set['address']) && !empty($post_set['address']) ? $post_set['address'] : '');?></textarea><span class="reqtxt">*</span><?php echo form_error('address'); ?></li>
				
				<li class="" id="li-2-8"><label for="cf2_field_8"><span>City :</span></label><input type="text" title="" value="<?php echo (isset($post_set['city']) && !empty($post_set['city']) ? $post_set['city'] : '');?>" class="single fldrequired" id="cf2_field_8" name="city"><span class="reqtxt">*</span><?php echo form_error('city'); ?></li>
				
				<li class="" id="li-2-9"><label for="cf2_field_9"><span>Country :</span></label><input type="text" title="" value="<?php echo (isset($post_set['country']) && !empty($post_set['country']) ? $post_set['country'] : '');?>" class="single fldrequired" id="cf2_field_9" name="country">
				<span class="reqtxt">*</span><?php echo form_error('country'); ?></li>
				
				<li class="" id="li-2-10"><label for="cf2_field_10"><span>Zip :</span></label><input type="text" title="" value="<?php echo (isset($post_set['zip']) && !empty($post_set['zip']) ? $post_set['zip'] : '');?>" class="single fldrequired" id="cf2_field_10" name="zip">
				<span class="reqtxt">*</span><?php echo form_error('zip'); ?></li>
				
				<li class="" id="li-2-11"><label for="cf2_field_11"><span>Mobile:</span></label><input type="text" title="" value="<?php echo (isset($post_set['contact']) && !empty($post_set['contact']) ? $post_set['contact'] : '');?>" class="single fldrequired" id="cf2_field_11" name="contact"><span class="reqtxt">*</span><?php echo form_error('contact'); ?></li>
				
				<li class="" id="li-2-12"><label for="cf2_field_12"><span>Alternate Phone Number :</span></label><input type="text" title="" value="<?php echo (isset($post_set['other_contact']) && !empty($post_set['other_contact']) ? $post_set['other_contact'] : '');?>" class="single fldrequired" id="cf2_field_12" name="other_contact"><span class="reqtxt">*</span></li>
				
				<li class="" id="li-2-13"><label for="cf2_field_13"><span>Email:</span></label><input type="text" title="" value="<?php echo (isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : '');?>" class="single fldemail fldrequired" id="cf2_field_13" name="email"><span class="emailreqtxt">*</span><?php echo form_error('email'); ?></li>
				
				<li class="" id="li-2-14"><label for="cf2_field_14"><span>Special accomplishments (if any)</span></label><input type="text" title="" value="<?php echo (isset($post_set['special_accomplishment']) && !empty($post_set['special_accomplishment']) ? $post_set['special_accomplishment'] : '');?>" class="single fldrequired" id="cf2_field_14" name="special_accomplishment"><span class="reqtxt">*</span><?php echo form_error('special_accomplishment'); ?></li>
			
			
			</ol>
		
			<p class="cf-sb"><input type="submit" value="Submit" class="sendbutton" id="sendbutton2" name="submit"></p>
		
		</form>


	</div>

</div>