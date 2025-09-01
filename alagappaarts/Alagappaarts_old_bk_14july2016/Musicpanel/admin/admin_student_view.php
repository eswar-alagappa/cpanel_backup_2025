<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[userinfo][role_id];
$userid = $_SESSION[userinfo][user_id];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$admin  = $loginmaster->isadmin($arrlogin);
if(!$admin)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/studentmaster.class.php");
include('adminheader.php');
$studentid = $_GET[ studentid ];
$studentmaster  = new studentmaster();
$studentdetail = $studentmaster -> getStudentdetails($studentid);
$studentProgram =$studentmaster -> getStudentprogram($studentdetail->fields[program_id]);

$studentCentre =$studentmaster -> getStudentcentre($studentdetail->fields[centre_id]);
?>

<div class="content">
       <div class="topNav">
       <ul>
      <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="centre_listing.html">centre</a></li>
        <li class="last"> &nbsp; View centre</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>View Student</h2>
      
      <div class="registrationForm">
            <div class="registrationFormStudents">
                <fieldset class="w100">
        <legend>Personal Details    </legend>
      <ul>
      
         
      <li>
        <label>First Name:<?php echo $studentdetail->fields[first_name]; ?>  </label>
		</li>
        
      <li>
        <label>Last Name: First Name:<?php if($studentdetail->fields[last_name]) echo $studentdetail->fields[last_name]; else '-'; ?>    </label>
		</li>
        
      <li>
        <label>D.O.B: <?php $dob =  split('-',$studentdetail->fields[dob]); 
	$dob[1].'/'.$dob[2].'/'.$dob[0];
	 $directorDOB =date('d-M-Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0]));
		 echo $directorDOB; ?> </label>
         </li>
         
       <li>
         <label> Age :<?php echo $studentdetail->fields[age]; ?></label>
		  </li>
        
        <li>
          <label> Gender : <?php echo $studentdetail->fields[gender]; ?></label>
		</li>
        
        <li>
           <label>Mobile: <?php echo $studentdetail->fields[mobile]; ?></label>
		 </li>
        
        <li>
           <label>Alternate Phone Number: <?php if($studentdetail->fields[phone] ) echo $studentdetail->fields[phone]; else echo '-'; ?></label>
		  </li>
      
      </ul>
     
      <ul>
      
<li><label>Address:  <?php if($studentdetail->fields[address] ) echo $studentdetail->fields[address]; else echo '-'; ?></label>
		</li>
        
        <li>
          <label>City: <?php echo $studentdetail->fields[city]; ?></label>
		 </li>
        <li>
          <label>State: <?php echo $studentdetail->fields[state]; ?></label>
		  </li>
        
        <li><label>Country: <?php echo $studentdetail->fields[country]; ?>  </label>
		</li>
        <li>
          <label>Zip: <?php echo $studentdetail->fields[zipcode]; ?></label>
		  </li>
         <li>
          <label>Email: <?php echo $studentdetail->fields[email_id]; ?></label>
		 </li>
      </ul>
      </fieldset>
           
          <fieldset class="w100">
        <legend>Interested Program  </legend>
       <ul>

        <li class="program">
        <label>Program :   <?php echo $studentProgram->fields[name]; ?></label>
        </li>
        
         </ul>
         <ul>
         <li>
           <label> Center :
  <?php echo $studentCentre->fields[academy_name]; ?></label>
		 </li>
</ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Music Details </legend>
       <ul class="experience">
                <li>
                  <label>Experience in Music :  <?php echo $studentdetail->fields[bharathanatyam_experience]; ?> </label>
                   </li>
                     
                      <li><label>Special accomplishments (if any) : <?php if($studentdetail->fields[special_qualification] ) echo $studentdetail->fields[special_qualification]; else echo '-'; ?> </label></li>
              <li>
                <label>Name of your Guru :  <?php echo $studentdetail->fields[name_of_guru]; ?></label></li>
                  
                   <li><label>Located at 	: <?php if($studentdetail->fields[guru_location] ) echo $studentdetail->fields[guru_location]; else echo '-'; ?> </label></li>
                   <li>
                     <label>Other relevant info :  <?php if($studentdetail->fields[other_info] ) echo $studentdetail->fields[other_info]; else echo '-'; ?> </label>
                   </li>
                       </ul>
         <ul>
         
         </ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Student Status  </legend>
       <ul class="experience">
                <li class="w100">
        <label class="w100">Status : </label>
         
 
        <li> <?php   echo $studentdetail->fields[value];  ?>
		</li>
                </ul>
         <ul>
         
</ul>
        </fieldset>

      
      </div>
      <ul> <li class="button"><a href="admin_student_listing.php" class="backBtn">Back</a>        </li> </ul>
      </div>
      
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>