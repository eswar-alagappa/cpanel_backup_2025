<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    
  <script>
  $(document).ready(function () {
	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	   yearRange: '-60:-06',
	   dateFormat: 'mm/dd/yy',
    });
 });
</script>

<div class="content">
     <div class="contentOuter">
      <h2>Edit Profile</h2>
       <form enctype="multipart/form-data" method="post" name="formStudentadd" action="<?php echo base_url(); ?>music/student/edit_profile" id="frmprofileedit">
       <div class="contentInner">
                 <div class="profileContent">
      <div class="makePaymentForm">
      <ul>
      <li>
        <label> Ref. Code   : </label> 
<span><?php echo $user_data->UserName ?></span>

         

  </li> 
         <li>
        <label> First Name 	   :  </label>
         <?php echo $user_data->firstname ?>		</li>
         <li>
           <label> Last Name     : </label> 
  <span><?php echo $user_data->lastname ?></span>
		</li>
         <!--<li>
           <label> Date Of Birth     : </label> 
  <span>Ramasamy</span>
		</li>-->
       <li class="studentdate"><label>D.O.B:<strong class="star"> *</strong></label>
       
         <input type="text" value="<?php echo ( isset($post_set['dob']) && !empty($post_set['dob']) ? $post_set['dob'] : (isset($user_data->user_dob) && !empty($user_data->user_dob)) ? date('m/d/Y',strtotime($user_data->user_dob)) : '') ?>" id="datepicker" name="dob" class="w200 hasDatepick"><!--<img class="datepick-trigger" src="../web/images/calendar-img.gif" alt="Select date" title="Select date">-->  </li>
		 <span><?php echo form_error('dob'); ?></span>
    <li>
        <label> Address   :<strong class="star"> *</strong></label>  <textarea rows="" cols="" name="address"><?php echo (  isset($post_set['address']) && !empty($post_set['address']) ? $post_set['address'] : (isset( $user_data->uaddress) && !empty($user_data->uaddress)) ? $user_data->uaddress : ''); ?></textarea>
		 <span><?php echo form_error('address'); ?></span>
		 </li>
<li>
        <label> City   :<strong class="star"> *</strong>  </label><input type="text" value="<?php echo ( isset($post_set['city']) && !empty($post_set['city']) ? $post_set['city'] : (isset( $user_data->ucity) && !empty($user_data->ucity)) ? $user_data->ucity : ''); ?>" class="fL" name="city"></li>
        <span><?php echo form_error('city'); ?></span>
		<li>
        <label> State	   :<strong class="star"> *</strong>  </label><input type="text" value="<?php echo ( isset($post_set['state']) && !empty($post_set['state']) ? $post_set['state'] : (isset( $user_data->ustate) && !empty($user_data->ustate)) ? $user_data->ustate : ''); ?>" class="fL" name="state"></li>
        <span><?php echo form_error('state'); ?></span>
		<li>
        <label> Country   :<strong class="star"> *</strong>  </label><input type="text" value="<?php echo ( isset($post_set['country']) && !empty($post_set['country']) ? $post_set['country'] : (isset( $user_data->ucountry) && !empty($user_data->ucountry)) ? $user_data->ucountry : '');  ?>" class="fL" name="country"></li>
        <span><?php echo form_error('country'); ?></span>
		<li>
        <label> Zip code   :<strong class="star"> *</strong>  </label><input type="text" value="<?php echo ( isset($post_set['zip']) && !empty($post_set['zip']) ? $post_set['zip'] : (isset( $user_data->uzip) && !empty($user_data->uzip)) ? $user_data->uzip : ''); ?>" class="fL" name="zip"></li>
        <span><?php echo form_error('zip'); ?></span>
		<li>
        <label> Email   :<strong class="star"> *</strong>  </label><input type="text" value="<?php echo ( isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : (isset( $user_data->uemail) && !empty($user_data->uemail)) ? $user_data->uemail : ''); ?>" class="fL" name="email"></li>
        <span><?php echo form_error('email'); ?></span>
		<li>
        <label> Phone   :<strong class="star"> *</strong>  </label><input type="text" value="<?php echo ( isset($post_set['contact']) && !empty($post_set['contact']) ? $post_set['contact'] : (isset( $user_data->mobile) && !empty($user_data->mobile)) ? $user_data->mobile : ''); ?>" class="fL" name="contact">
		<span><?php echo form_error('contact'); ?></span>
		</li>

         <li class="btn"><input type="submit" class="saveBtn fL" value="Update" name="btnEditstudent">
        <a class="cancelBtn" href="<?php echo base_url().'music/student/profile'?>">Cancel</a>
        </li>
      </ul>
      </div>
      </div>
      </div>
      </form>
<div>
  
</div>
           
    </div>
</div>