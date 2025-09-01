<style>
    .profileRightBtn {
    float: right;
    width: 50%;
}
</style>
<div class="content">
       <div class="contentOuter" style="margin-top:50px">
      <h2><span>Student's Profile</span> 
       <div class="profileRightBtn">
       <ul>
        <li class="edit"><a href="<?php echo base_url().'dance/student/student_syllabus'?>">Syllabus</a></li>
       <li class="edit"><a href="<?php echo base_url().'dance/student/edit_studentprofile'?>">Edit Profile</a></li>
       <li class="changePassword"><a href="<?php echo base_url().'dance/student/student_change_password'?>">Change password</a></li>
       </ul>
       </div>
      </h2>
      
      
       <div class="contentInner">
       <div class="profileContent">
       <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <th width="500" scope="col">Student Profile</th>
  </tr>
  <tr>
    <td><span>RefCode</span>		: <?php echo $user_data->username ?>    <br>
     <span> First Name	</span>	:  <?php echo $user_data->firstname ?><br>
      <span>Last Name</span>		: <?php echo $user_data->lastname ?><br>
      <span>Address	</span>	:    <div style="margin-left: 160px; width: 180px;"><?php echo $user_data->uaddress; ?></div> <br>
      <span>City	</span>		: <?php echo $user_data->ucity ?><br>
     <span> State</span>		: <?php echo $user_data->ustate ?><br>
     <span> Zip code</span>		: <?php echo $user_data->uzip ?><br>
     <span> Country	</span>	: <?php echo $user_data->ucountry ?><br>
     <span> Email</span>			: <?php echo $user_data->uemail ?><br>
     <span> Phone</span>		: <?php echo $user_data->mobile ?>    
		<?php $profile = (( isset($user_data->photo) && !empty($user_data->photo) ) ? base_url().'assets/profile/'.$user_data->photo :
			((empty($user_data->photo) &&  isset($user_data->gender) && (!empty($user_data->gender)) && $user_data->gender=='Female' ) ? base_url().'assets/home/images/female.png' :
			((empty($user_data->photo) &&  isset($user_data->gender) && (!empty($user_data->gender)) && $user_data->gender=='Male' ) ? base_url().'assets/home/images/male.png' : '')));
		?>
	 <div class="photo"><img src="<?php echo $profile; ?>"></div>
</td>
   </tr>
</tbody></table>
</div>
       </div>
      <div>
        
      </div>
           
    </div>
    </div>