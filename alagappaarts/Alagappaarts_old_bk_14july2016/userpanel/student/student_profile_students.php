<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[studentinfo][role_id];
$userid = $_SESSION[studentinfo][user_id];
$username = $_SESSION[studentinfo][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);
if(!$student)
{
	header('location:index.php?msg=Enter username password');
}
else{
include('studentheader.php');

include("../config/classes/studentmaster.class.php");
$studentviewprofile  = new studentmaster();
$studentprofile = $studentviewprofile -> getStudentprofiledetails($userid);
$studentProgram =$studentviewprofile -> getStudentProfileprogram($studentprofile->fields[program_id]);

$studentCentre =$studentviewprofile -> getStudentProfilecentre($studentprofile->fields[centre_id]);

?><div class="headerBottom">
      <div class="admiTitle">Welcome <?php echo $_SESSION[studentinfo][first_name]; ?>
</div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenavactive"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
<div class=" wrapper">

    
   <div class="content">
       <div class="contentOuter">
      <h2><span>Student's Profile</span> 
       <div class="profileRightBtn">
       <ul>
       <li class="edit"><a href="student_profile_edit.php">Edit Profile</a></li>
       <li class="changePassword"><a href="student_change_password.php">Change password</a></li>
       </ul>
       </div>
      </h2>
      
      <?php if(isset($_SESSION['ackmsg']))
		{
		echo '<center><div class="success">'.$_SESSION['ackmsg'].'</div></center>';
		unset($_SESSION['ackmsg']);
		
		}
		?>

       <div class="contentInner">
       <div class="profileContent">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="500" scope="col">Student Profile</th>
    <th width="500" scope="col">Dance Centre</th>
  </tr>
  <tr>
    <td><span>RefCode</span>		: <?php echo $studentprofile->fields[enrollment_id]; ?>    <br />
     <span> First Name	</span>	:  <?php echo $studentprofile->fields[first_name]; ?><br />
      <span>Last Name</span>		: <?php echo $studentprofile->fields[last_name]; ?><br />
      <span>Address	</span>	:    <?php echo $studentprofile->fields[address]; ?> <br />
      <span>City	</span>		: <?php echo $studentprofile->fields[city]; ?><br />
     <span> State</span>		: <?php echo $studentprofile->fields[state]; ?><br />
     <span> Zip code</span>		: <?php echo $studentprofile->fields[zipcode]; ?><br />
     <span> Country	</span>	: <?php echo $studentprofile->fields[country]; ?><br />
     <span> Email</span>			: <?php echo $studentprofile->fields[email_id]; ?><br />
     <span> Phone</span>		: <?php echo $studentprofile->fields[mobile]; ?>
     <div class="photo"><img src="../uploads/student/<?php echo $studentprofile->fields[photo]; ?>" /></div>
</td>
    <td><span>Name</span>		: <?php echo $studentCentre->fields[academy_name]; ?><br />
    <span>Address</span>		: <?php echo $studentCentre->fields[address]; ?><br />
      <span>City	</span>		: <?php echo $studentCentre->fields[city]; ?><br />
      <span>State	</span>	:  <?php echo $studentCentre->fields[state]; ?><br />
      <span>Zip code</span>		: <?php echo $studentCentre->fields[zipcode]; ?><br />
      <span>Country</span>	: <?php echo $studentCentre->fields[country]; ?><br />
      <span>Phone</span>		: <?php echo $studentCentre->fields[contact]; ?><br />
      <?php /*?><span>Programs enrolled</span> 		: <?php echo $studentProgram->fields[name]; ?></td><?php */?>
  </tr>
</table>
</div>
       </div>
      <div>
        
      </div>
           
    </div>
    </div>
    </div>
     <?php 
include('studentfooter.php');
}
?>