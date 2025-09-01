<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[userinfo][role_id];
$userid = $_SESSION[userinfo][user_id];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginid = $_SESSION[userinfo][id];
$loginmaster = new loginmaster();
$admin  = $loginmaster->isadmin($arrlogin);
if(!$admin)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/programmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/keywordmaster.class.php");

include('adminheader.php');
$programmaster  = new programmaster();
$programname = $programmaster->getProgramnameFasttrack();
$keywordmaster  = new keywordmaster();
$studentstatus = $keywordmaster->getstudentstatusactive();
$centremaster  = new centremaster();
$centrenames = $centremaster->getcentrenames();
$studentid = $_GET[ studentid ];
$studentmaster  = new studentmaster();
$studentdetail = $studentmaster -> getStudentdetails($studentid);

$_SESSION['student']['enrollmentid']=$studentdetail->fields[enrollment_id];
$studentProgram = $studentmaster -> getProgramsforStudent($studentid);
/*print "<pre>";
print_r($studentdetail);
exit;*/
$studentCentre = $studentmaster -> getStudentcentre($studentdetail->fields[centre_id]);

 $arrCodevalue =array('code'=>'studentstatus','value'=>'Active');
$getActiveId = $keywordmaster->getIdforvalue($arrCodevalue);
if(isset($_REQUEST['btnStudentedit']))
{
		$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$studentDOB =date('Y-m-d', strtotime($_REQUEST['txtdob']));
			
		$arrstudent = array('id'=>$studentid,'first_name'=> $_REQUEST['txtFname'],'last_name'=>$_REQUEST['txtLname'],'dob'=>$studentDOB,
		'age'=>$_REQUEST['txtAge'],'gender'=>$_REQUEST['rdgender'],'phone'=>$_REQUEST['txtcontact'],'mobile'=>$_REQUEST['txtMobile'],
		'email_id'=>$_REQUEST['txtEmail'],'address'=>$_REQUEST['txtAddress'],'city'=>$_REQUEST['txtCity'],'state'=>$_REQUEST['txtState'],
		'country'=>$_REQUEST['txtCountry'],'zipcode'=>$_REQUEST['txtZip'],'bharathanatyam_experience'=>$_REQUEST['txtExpBha'],
		'special_qualification'=>$_REQUEST['txtSpecqualification'],'name_of_guru'=>$_REQUEST['txtguruname'],'guru_location'=>$_REQUEST['txtLoc'],
		'other_info'=>$_REQUEST['txtotherinfo'],'status'=>$_REQUEST['rdstatus'],'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$ackmsg = $studentmaster -> updatestudent ($arrstudent);
	   if($ackmsg)
			{	
			    $studentID = $studentdetail->fields[id];
			
				$programDetails = $programmaster->getprogramYearMonth($_REQUEST['chkProgram']);
			//	$studentDOJ =date('Y-m-d', strtotime($_REQUEST['txtdoj']));
				
				foreach($programDetails as $programDetail)
				{
					$isfasttrack = 'N';
				//fast track option selected	
				if($programDetail['fasttrack_duration']>0)
				{
					$progid = $programDetail['id'];
					$fasttrackid = 'chkFastTrack'.$progid;
					
					if($_REQUEST[$fasttrackid] == 'Y')
					{
						
						$isfasttrack = 'Y';
					}
					
					
				}
				//$addYear = strtotime(date("Y-m-d H:i:s", strtotime($mysql_datetime)) . "+". $programDetail['duration_year']."year");
				//$addMonth = strtotime(date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s', $addYear))) . "+".$programDetail['duration_month']." month");
				
					$arrstudentsProg[] = array('student_id'=> $studentid ,'program_id'=> $programDetail[id],'enrollment_id'=>$_REQUEST['txtEnrollmentid'],'centre_id'=>$_REQUEST['ddlCenter'], 'is_fasttrack'=>$isfasttrack);
					// 'enrollment_date'=> $studentDOJ,'scheduled_cc_date'=>$addMonth,
				}
				
				 $ackmsg = $studentmaster -> updatestudentsProg ($arrstudentsProg);
	
				if( $_REQUEST['rdstatus'] ==  $getActiveId)
				$loginstatus = 'Y'; else  $loginstatus = 'N';
	
				 $loginmaster  = new loginmaster();
				$studentRoleid = $loginmaster->getroleid('Student');
				  $studentDetail=array('user_id'=> $studentID,'role_id'=>$studentRoleid);
				 $isUserinLogin = $loginmaster->checkStudentloginDetail($studentDetail);
				 if($isUserinLogin){
					 			if($_SESSION['student']['enrollmentid'] != $_REQUEST['txtEnrollmentid'] &&  $_REQUEST['rdstatus'] ==  $getActiveId ){ 
								$arrStudentDetails = array('from'=>ADMIN_EMAIL,'mailto'=>$_REQUEST['txtEmail'],'subject'=>"Apaa Changed User credential",
								'firstName'=> $studentdetail->fields[first_name],'lastName'=>$studentdetail->fields[last_name],'username' =>$_REQUEST['txtEnrollmentid'],'password'=> '');
							/*	$isLoginDetailmailed = $studentmaster -> mailStudentDetails ($arrStudentDetails);*/
								}
					 $arrstudentsLogindetail  = array('user_id'=>$studentID,'username'=>$_REQUEST['txtEnrollmentid'],'status'=>$loginstatus,'role_id'=>$studentRoleid);
				$studentmaster -> updatestudentsLogindetail ($arrstudentsLogindetail);
					 }
				 else  if(!($isUserinLogin) && $_REQUEST['rdstatus'] ==  $getActiveId ){$random_id_length = 10; 
						$rnd_id = crypt(uniqid(rand(),1)); 
						$rnd_id = strip_tags(stripslashes($rnd_id)); 
						$rnd_id = str_replace(".","",$rnd_id); 
						$rnd_id = strrev(str_replace("/","",$rnd_id)); 
						$rnd_id = substr($rnd_id,0,$random_id_length); 
						$password =md5($rnd_id);
						
			$arrstudentsLogindetail  = array('user_id'=>$studentID,'username'=>$_REQUEST['txtEnrollmentid'],'password'=> $password,'role_id' =>2,'status'=>$loginstatus,'loginid'=>$loginid);
				$isLoginDetailadded = $studentmaster -> addstudentsLogindetail ($arrstudentsLogindetail);}
				 if($isLoginDetailadded ){
					$arrStudentDetails = array('from'=>ADMIN_EMAIL,'mailto'=>$_REQUEST['txtEmail'],'subject'=>"APAA User Credentials",
					'firstName'=> $studentdetail->fields[first_name],'lastName'=>$studentdetail->fields[last_name],'username' =>$_REQUEST['txtEnrollmentid'],'password'=> $rnd_id);
					/*$isLoginDetailmailed = $studentmaster -> mailStudentDetails ($arrStudentDetails);*/
					}
				
				$_SESSION['ackmsg'] = 'Student has been updated successfully';
				 header('location:admin_student_listing.php');
		} 
		else 	{
			$msg = "Internal error.Try again.";
			}
}
?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
$("#datepicker").datepick({
        buttonImage: '../web/images/calendar-img.gif',
        buttonImageOnly: true,
        showOn: 'button',
		/*minDate: 0, */
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: new Date(1950, 01-1, 01), 
		yearRange: "-60:+0",
		onClose: function() { $("#datepicker").focus(); }
     });
	 $("#datepickerdoj").datepick({
        buttonImage: '../web/images/calendar-img.gif',
        buttonImageOnly: true,
        showOn: 'button',
		/*minDate: 0, */
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: new Date(1990, 01-1, 01), 
		
		yearRange: "-60:+0",
		onClose: function() { $("#datepickerdoj").focus(); }
     });

});
 </script>
<div class="content">
    <div class="topNav">
      <ul>
         <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a href="students_listing.html">students</a></li>
        <li class="last"> &nbsp; student view</li>
      </ul>
    </div>
   <?php //echo "<pre>";  print_r($studentdetail);?>
    <div class="registrationContent">
      <h2>edit student </h2>
      <form id="studentForm" action="" name="formStudentadd" method="post">
      
      <div class="registrationForm">
      <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
            <div class="registrationFormStudents">
          
       <fieldset class="w100">
        <legend>Personal Details    </legend>
      <ul>
      
         
      <li><label>First Name:<strong class="star">*</strong></label>
		<input name="txtFname" type="text"  value="<?php echo $studentdetail->fields[first_name]; ?>" />  </li>
        
      <li><label>Last Name:</label>
		<input name="txtLname" type="text"  value="<?php echo $studentdetail->fields[last_name]; ?>" />  </li>
        
      <li><label>D.O.B:</label>
      <?php   $dob =  split('-',$studentdetail->fields[dob]); 
	
	 $directorDOB =date('m/d/Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0])); 
		  ?> 
         <input class="w200" name="txtdob" type="text" id="datepicker" value="<?php echo $directorDOB;?>"/> 
        </li>
         
       <li><label> Age :<strong class="star">*</strong></label>
		<input name="txtAge" type="text"  value="<?php echo $studentdetail->fields[age]; ?>" maxlength="3" />  </li>
        
        <li><label> Gender :<strong class="star">*</strong></label>
		<div class="studentgender"><input class="radiobtn" name="rdgender" type="radio" value="M"  <?php if( $studentdetail->fields[gender]== 'M') echo "CHECKED";  ?>  />Male
        <input class="radiobtn" name="rdgender" type="radio" value="F" <?php if( $studentdetail->fields[gender]== 'F') echo "CHECKED";  ?>  />Female</div> </li>
        
        <li>
           <label>Mobile:<strong class="star">*</strong> </label>
		<input name="txtMobile" type="text"  value="<?php echo $studentdetail->fields[mobile]; ?>" />  </li>
        
        <li>
           <label>Alternate Phone Number: </label>
		<input name="txtcontact" type="text"   value="<?php echo $studentdetail->fields[phone]; ?>" />  </li>
   
      </ul>
     
      <ul>
      
<li><label>Address: </label>
		<textarea name="txtAddress" class="h71" ><?php echo $studentdetail->fields[address]; ?></textarea> </li>
     
        <li><label>City:<strong class="star">*</strong></label>
		<input name="txtCity" type="text" value="<?php echo $studentdetail->fields[city]; ?>" />  </li>
        <li><label>State:<strong class="star">*</strong></label>
		<input name="txtState" type="text" value="<?php echo $studentdetail->fields[state]; ?>"  />  </li>
        <li><label>Country:<strong class="star">*</strong> </label>
		<input name="txtCountry" type="text" value="<?php echo $studentdetail->fields[country]; ?>" />  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input name="txtZip" type="text" value="<?php echo $studentdetail->fields[zipcode]; ?>" />  </li>
           <li><label>Email:<strong class="star">*</strong></label>
		<input name="txtEmail" type="text" value="<?php echo $studentdetail->fields[email_id]; ?>"  />  </li>
       </ul>
      </fieldset>
      
         <fieldset class="w100">
        <legend>Interested Program  </legend>
       <ul class="chkprogram">

        <li class="program">
        <span>Program Enrolled<strong class="star">*</strong></span>
       
       <?php 
	    
	foreach($programname as $program)
	{
	echo "<label><input type='checkbox' value='{$program[id]}' name='chkProgram[]'";
	foreach($studentProgram as $studentProg)
	{
		if($program[id] == $studentProg[id])
		echo "checked";
	}
	
	echo" class='chklist' />{$program[name]}</label>";
	
	
	}
		?>
        
    </li>
  </ul>
  <ul class="fasttrackStream">
         <li>
         <span>Stream</span>
         <?php
		foreach($programname as $program)
	 	{
		
 		if($program[fasttrack_duration]>0)
		{
			echo '<label class="fastTrack"><input type="checkbox" name="chkFastTrack'.$program[id].'" value="Y" class="chklist"';
			foreach($studentProgram as $studentProg)
			{
				if($program[id] == $studentProg[id])
				{
					if($studentProg[is_fasttrack] == 'Y')
					echo "checked";
				}
			}
			echo ' />Fast Track</label>';
		}
	
	 
	}
		
		?>
         
         </li>
         
</ul>
         <ul>
         <li><span>Select Center:<strong class="star">*</strong></span>
		<select class="w300" name="ddlCenter">
<option  value="">Select</option>

 <?php while(!$centrenames->EOF)
 	{
		if($centrenames->fields[id] == $studentCentre->fields[id])
		echo "<option value='{$centrenames->fields[id]}' selected  >{$centrenames->fields[academy_name]}</option>";
		else 
	echo "<option value='{$centrenames->fields[id]}'  >{$centrenames->fields[academy_name]}</option>";
	 $centrenames-> MoveNext();
	} ?>
</select> </li>
</ul>
 <!--<ul>
         <li class="studentdate"><span>Date of Joining:<strong class="star">*</strong></span>
           <?php   	 $studentDOJ = date('m/d/Y', strtotime($studentdetail->fields[enrollment_date])); 
		  ?> 
           <input class="w200" name="txtdoj" type="text" id="datepickerdoj" value="<?php echo $studentDOJ;?>"/> 
		 </li>
</ul>-->
        </fieldset>
        
        <fieldset class="w100">
        <legend>Music Details </legend>
       <ul class="experience">
                <li><label>Experience in Music :<strong class="star">*</strong></label>
                     <input class="frm_element" id="txtExpBha" tabindex="16" maxlength="20" name="txtExpBha" value="<?php echo $studentdetail->fields[bharathanatyam_experience]; ?>" /></li>
                     
                      <li><label>Special accomplishments (if any)</label>
                     <input class="frm_element" id="txtSp" tabindex="17" maxlength="100" name="txtSpecqualification"  value="<?php echo $studentdetail->fields[special_qualification]; ?>"><br/><br/></li>
                  <li><label>Name of your Guru :<strong class="star">*</strong> </label><input class="frm_element" id="txtGuru" tabindex="18" maxlength="50" name="txtguruname"  value="<?php echo $studentdetail->fields[name_of_guru]; ?>" /></li>
                  
                   <li><label>Located at 	:</label><input class="frm_element" id="txtLoca" tabindex="19" maxlength="50" name="txtLoc" value="<?php echo $studentdetail->fields[guru_location]; ?>"><br/><br/></li>
                   <li><label>Other relevant info</label><textarea class="frm_element" id="txtInfo" style="height: 30px;" tabindex="20" name="txtotherinfo"><?php echo $studentdetail->fields[other_info]; ?></textarea> 
                       </li>
                       </ul>
         <ul>
         
</ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Student Status  </legend>
       <ul class="experience">
                <li class="w100">
        <label class="w100">Status :<strong class="star">*</strong> </label>
         
		</li>  
     
        <li><div class="studentstatus">
        <?php  foreach($studentstatus as $value)
 	{  
	
	if( $studentdetail->fields[value] == $value[value])
	$checked ="CHECKED";
	echo "<input type='radio' value='{$value[id]}' name='rdstatus'  {$checked} class='radiobtn'>{$value[value]}";
	$checked ="";
	 }?> 
         </div></li>
                </ul>
          <?php // echo  $studentdetail->fields[payment_status_id].'id'.$getActiveId ;  //if( $studentdetail->fields[19]== '10') {?>
         <ul class="referenceCode"  <?php if( $studentdetail->fields[statusid] != $getActiveId) echo "style='display:none'"; ?> ><li>
        <label>Enter Reference Code  :<strong class="star">*</strong> </label>
<input type="text" name="txtEnrollmentid" value="<?php echo $studentdetail->fields[enrollment_id]; ?>"> </li></ul>
<?php //}?>
        </fieldset>
      </div>
      <ul><li class="button"><input name="btnStudentedit" value="update" type="submit" class="submitBtn fl" />
        <a class="cancelBtn" href="admin_student_listing.php">Cancel</a>
        </li></ul>
      </div>
      </form>
    </div>
      </div>
<?php 
include('adminfooter.php');
}
?>