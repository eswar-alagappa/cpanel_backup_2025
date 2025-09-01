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
			height:400px;
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
			padding: 100px;
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
			width: 200px;
			clear: both;
			border: 1px solid #6d2d2b;
			background:#6d2d2b;
			padding: 0;
			height: 40px;
			font-size: 16px;
			text-transform: uppercase;
			text-decoration:none;
			text-align:center;
			line-height:40px;
			border-radius:10px;
			color: #fff;
			font-weight: bold;
			display: block;
			margin-top:-15px;
			margin-left:15px;
			cursor: pointer;}
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
		.profile_view{
			color: #2D1800;
			font-size: 10px;
			font-weight: bold;
			padding: 4px 4px 4px 8px;
			text-align: center;
			text-decoration:none;
		}
		</style>
		
		<div class="firstbox">
			<div class="first_innerbox">
				<div class="firstinnerbox">
					<a href="<?php echo base_url().'dance/student/course_details'?>" class="main_btn">
						COURSES DETAILS
					</a>
				</div>
				
				<div class="secondinnerbox">
					<a href="<?php echo base_url().'dance/student/student_syllabus'?>" class="main_btn">
						SYLLABUS
					</a>
				</div>
				
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
				<a href="<?php echo base_url().'dance/student/view_studentprofile'?>" class="profile_view">View Profile</a>
			</div>
		</div>
		
		</div>
       </div>
      <div>
        
      </div>
           
    </div>
    </div>