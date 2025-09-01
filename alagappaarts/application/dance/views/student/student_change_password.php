<div class="content">

    

     <div class="contentOuter">

      <h2>Change Password</h2>

       <div class="contentOuter">

      <div class="changePassword">    
      <form method="post" action="<?php echo base_url(); ?>dance/student/student_change_password" id="frmchangepassword">

      

      <div class="changePasswordInner">

      <ul><li><label>Enter Old Password </label>

      <input type="text" value="<?php echo (isset($post_set['txtOldpassword']) && !empty($post_set['txtOldpassword']) ? $post_set['txtOldpassword'] : '');?>" name="txtOldpassword"></li>
		<span><?php echo form_error('txtOldpassword'); ?></span>
      <li><label>Enter New Password </label>

      <input type="password" value="<?php echo (isset($post_set['txtNewPassword']) && !empty($post_set['txtNewPassword']) ? $post_set['txtNewPassword'] : '');?>" id="newpassword" name="txtNewPassword"></li>
		<span><?php echo form_error('txtNewPassword'); ?></span>
      <li><label>Re enter New Password </label>

      <input type="password" value="<?php echo (isset($post_set['txtRenewpassword']) && !empty($post_set['txtRenewpassword']) ? $post_set['txtRenewpassword'] : '');?>" name="txtRenewpassword">
		<span><?php echo form_error('txtRenewpassword'); ?></span>
	  </li></ul>
      <div class="changePasswordBtn">

      <input type="submit" class="submitBtn fL" value="Submit" name="btnChangepassword">

      <a class="cancelBtn" href="<?php echo base_url().'dance/student/studentprofile'?>">Cancel</a>

      

      </div>

      </div>

      </form>

      </div>

 </div>

<div>

  

</div>

           

    </div>

  </div>