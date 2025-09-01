<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[userinfo][role_id];
$userid = $_SESSION[userinfo][user_id];
$loginid = $_SESSION[userinfo][id];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$admin  = $loginmaster->isadmin($arrlogin);
if(!$admin)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/studentmaster.class.php");
include("../config/classes/keywordmaster.class.php");
$keywordmaster  = new keywordmaster();
include('adminheader.php');
global $DB;
$studentid = $_GET[ studentid ];
$studentmaster  = new studentmaster();
$studentdetail = $studentmaster -> getStudentdetails($studentid);
$studentProgram =$studentmaster -> getStudentprogram($studentdetail->fields[program_id]);

$studentCentre =$studentmaster -> getStudentcentre($studentdetail->fields[centre_id]);
if(isset($_REQUEST['btnStudentApprove']))
{
	
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrCodevalue =array('code'=>'studentstatus','value'=>'Active');
		$getActiveId = $keywordmaster->getIdforvalue($arrCodevalue);
		$centre_id=$studentdetail->fields[centre_id];
			$getLastEnrollmentidquery = "select seid.end_index as id  , cm.centreid as  centre_code from  
			centremaster cm join student_enrollmentid  seid on cm.id = seid.centre_id  where seid.centre_id ='$centre_id'";
			$getLastEnrollmentid =  $DB->getArray($getLastEnrollmentidquery);
			$Enrollmentid= $getLastEnrollmentid[0][id];
			$last_index =  $Enrollmentid + 1;
			$updaterenrollmentid ="update student_enrollmentid set end_index = '{$last_index}' where  centre_id = '$centre_id' ";
			$DB -> execute($updaterenrollmentid);
			$studentenrollmentid =  $getLastEnrollmentid[0][centre_code].$last_index;
		$arrStudent = array('student_id'=> $studentid ,'program_id'=>$studentdetail->fields[program_id], 'enrollment_id'=>$studentenrollmentid ,'status'=>$getActiveId );
/*	$arrStudent = array('student_id'=> $studentid ,'program_id'=>$studentdetail->fields[program_id], 'enrollment_id'=> $_REQUEST['txtEnrollmentid'],'status'=>$getActiveId );*/
		
		 $ackmsg =$studentmaster -> approveStudent ($arrStudent);
						 $random_id_length = 10;
						$rnd_id = crypt(uniqid(rand(),1)); 
						$rnd_id = strip_tags(stripslashes($rnd_id)); 
						$rnd_id = str_replace(".","",$rnd_id); 
						$rnd_id = strrev(str_replace("/","",$rnd_id)); 
						$rnd_id = substr($rnd_id,0,$random_id_length); 
						$password =md5($rnd_id);
						 
				$arrstudentsLogindetail  = array('user_id'=>$studentid,'username'=>$studentenrollmentid,'password'=> $password,'role_id' =>2,'status'=>'Y','loginid'=>$loginid);
				$isLoginDetailadded = $studentmaster -> addstudentsLogindetail ($arrstudentsLogindetail);
				 if($isLoginDetailadded ){
					$arrStudentDetails = array('from'=>ADMIN_EMAIL,'mailto'=>$studentdetail->fields[email_id],'subject'=>"APAA User Credentials",
					'firstName'=> $studentdetail->fields[first_name],'lastName'=>$studentdetail->fields[last_name],'username' =>$studentenrollmentid,'password'=>$rnd_id,'centername'=>$studentCentre->fields[academy_name],'programname'=>$studentProgram->fields[name]);
					$isLoginDetailmailed = $studentmaster -> mailStudentDetails ($arrStudentDetails);
					}
		 if($ackmsg)
			{
				$_SESSION['ackmsg'] = 'Student has been approved';
				header('location:admin_student_listing.php');
				
			}
			else
			{
				$msg = "Internal error.Try again.";
			}
		
		
}
?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
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
      <h2>Student Approval Confirmation</h2>
      
      <div class="registrationForm">
       <span class=""><?php echo $msg ;?></span>
       <form name="frmStudentApproval" id="frmStudentApproval" method="post"> 
            <div class="registrationFormStudents"><?php /*?><ul class="referenceCode" ><li>
        <label>Enter Reference Code  :<strong class="star">*</strong>  </label>
<input type="text" name="txtEnrollmentid" value="<?php echo $studentdetail->fields[enrollment_id]; ?>"> </li></ul><?php */?>
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
          <label>Email: <?php echo $studentdetail->fields[email_id]; ?></label>
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
           <label> Centre :
  <?php echo $studentCentre->fields[academy_name]; ?></label>
		 </li>
</ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Bharatanatyam Details </legend>
       <ul class="experience">
                <li>
                  <label>Experience in Bharathanatyam :  <?php echo $studentdetail->fields[bharathanatyam_experience]; ?> </label>
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
     
      <ul> <li class="button"><input type="submit" class="backBtn fl" value="Approve" name="btnStudentApprove">      
      <a href="admin_student_listing.php" class="cancelBtn">Cancel</a> </li>
       </ul>
       </form>
      </div>
      
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>