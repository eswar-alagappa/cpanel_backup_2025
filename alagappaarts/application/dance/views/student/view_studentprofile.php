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
       <!--<table width="100%" cellspacing="0" cellpadding="0" border="0">
		  <tbody><tr>
			<th width="500" scope="col">Student Profile</th>
		  </tr>
		  <tr>
			<td><span>RefCode</span>		: protanma12    <br>
			 <span> First Name	</span>	:  Vignesh<br>
			  <span>Last Name</span>		: G<br>
			  <span>Address	</span>	:    <div style="margin-left: 160px; width: 180px;">2b,Chokkankothan Street,West Masi Street,Madurai-1</div> <br>
			  <span>City	</span>		: Madurai<br>
			 <span> State</span>		: Tamil Nadu<br>
			 <span> Zip code</span>		: 625001<br>
			 <span> Country	</span>	: India<br>
			 <span> Email</span>			: vigneshteamwork@gmail.com<br>
			 <span> Phone</span>		: +918695658158    
					 <div class="photo"><img src="./Alagappaarts-Online exam_files/male.png"></div>
		</td>
		   </tr>
		</tbody></table>-->
		<style>
		.profileContent{
			width:100%;
			min-height:550px;
			background:#fcd5b5;
		}
		.firstbox{
			width:50%;
			background:#fcd5b5;
			float:left;
		}
		.secondbox{
			width:50%;
			background:#fcd5b5;
			float:left;
		}
		.first_innerbox{
			background:#fcd5b5;
			width: auto;
			height: auto;
			margin: 0 auto;
			padding: 20px;
			position: relative;
		}
		.firstinnerbox{
			width: 280px;
			clear: both;
			border: 1px solid #6d2d2b;
			background:#ffffff;
			padding: 0;
			height: 40px;
			font-size: 16px;
			text-transform: uppercase;
			text-decoration:none;
			text-align:center;
			line-height:30px;
			color: #fff;
			font-weight: bold;
			display: block;
			margin: 10px;
		}
		.secondinnerbox{
			width: 280px;
			clear: both;
			border: 1px solid #6d2d2b;
			background:#ffffff;
			padding: 0;
			height: 40px;
			font-size: 16px;
			text-transform: uppercase;
			text-decoration:none;
			text-align:center;
			line-height:30px;
			color: #fff;
			font-weight: bold;
			display: block;
			margin: 10px;
			margin-top:50px;
		}
		.main_btn{
			width: 150px;
			clear: both;
			border: 1px solid #6d2d2b;
			background:#6d2d2b;
			padding: 0;
			height: 30px;
			font-size: 14px;
			text-transform: uppercase;
			text-decoration:none;
			text-align:center;
			line-height:30px;
			border-radius:10px;
			color: #fff;
			font-weight: bold;
			display: block;
			margin-top:-15px;
			margin-left:15px;
			cursor: text;}
		.second_innerbox{
			background:#fcd5b5;
			width: auto;
			height: auto;
			margin: 0 auto;
			padding: 50px;
			position: relative;
			text-align: center;
		}
		.img-circle{
			border-radius: 50%;
			border:1px solid #385d8a;
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
		}
		.profile_name{
			color: #2D1800;
			font-size: 14px;
			font-weight: bold;
			padding: 4px 4px 4px 8px;
			text-align: center;
			text-transform: uppercase;
		}
		.profile_edit{
			color: #2D1800;
			font-size: 10px;
			font-weight: bold;
			padding: 4px 4px 4px 8px;
			text-align: center;
			text-decoration:none;
		}
		.course_table{
			width: 100% !important;
			margin: 0 auto;
			border-collapse: collapse;
			
		}
		.profileContent table th {
			background: none repeat scroll 0 0 #fcd5b5;
			color: #000000;
			font-size: 10px;
			font-weight: bold;
			padding: 4px 4px 4px 8px;
			text-align: left;
			text-transform: uppercase;
			width:25%;
		}
		.profileContent table td {
			background: none repeat scroll 0 0 #fcd5b5;
			color: #000000 !important;
			font-size: 10px;
			font-weight: bold;
			padding: 4px 4px 4px 8px;
			text-align: left;
			text-transform: uppercase;
		}
		.profileContent table tr td {
			padding: 12px 0 12px 15px;
			text-align: left;
			font-size: 10px;
			color: #131212;
			line-height: 19px;
			font-weight: bold;
			vertical-align: top;
		}
		.profileContent table tr:hover td {
			background-color: #fcd5b5;
			color:#000000;
		}
		</style>
		
		<div class="firstbox">
			<div class="first_innerbox">
				
				<table class="course_table">
					<tr><th>RefCode</th><td> : <?php echo $user_data->username ?></td></tr>
					<tr><th>First Name</th><td> : <?php echo $user_data->firstname ?></td></tr>
					<tr><th>Last Name</th><td> : <?php echo $user_data->lastname ?></td></tr>
					<tr><th>Address</th><td> : <?php echo $user_data->uaddress ?></td></tr>
					<tr><th>City</th><td> : <?php echo $user_data->ucity ?></td></tr>
					<tr><th>State</th><td> : <?php echo $user_data->ustate ?></td></tr>
					<tr><th>Zip code</th><td> : <?php echo $user_data->uzip ?></td></tr>
					<tr><th>Country</th><td> : <?php echo $user_data->ucountry ?></td></tr>
					<tr><th>Email</th><td> : <?php echo $user_data->uemail ?></td></tr>
					<tr><th>Phone</th><td> : <?php echo $user_data->mobile ?></td></tr>
				</table>
			</div>
		</div>
		<div class="secondbox">
			<div class="second_innerbox">
				<?php $profile = (( isset($user_data->photo) && !empty($user_data->photo) ) ? base_url().'assets/profile/'.$user_data->photo :
					((empty($user_data->photo) &&  isset($user_data->gender) && (!empty($user_data->gender)) && $user_data->gender=='Female' ) ? base_url().'assets/home/images/female.png' :
					((empty($user_data->photo) &&  isset($user_data->gender) && (!empty($user_data->gender)) && $user_data->gender=='Male' ) ? base_url().'assets/home/images/male.png' : '')));
				?>
				<img src="<?php echo $profile; ?>" class="img-circle" alt="" ><br>
				<span class="profile_name"><?php echo $user_data->firstname ?> <?php echo $user_data->lastname ?></span><br>
				<a href="<?php echo base_url().'dance/student/edit_studentprofile'?>" class="profile_edit">Edit Profile</a>
			</div>
		</div>
		
		</div>
       </div>
      <div>
        
      </div>
           
    </div>
    </div>