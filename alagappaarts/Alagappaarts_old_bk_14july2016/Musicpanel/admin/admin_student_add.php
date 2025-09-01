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
include("../config/classes/programmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/keywordmaster.class.php");
include('adminheader.php');
$programmaster  = new programmaster();
$programname = $programmaster->getProgramnameFasttrack();
$centremaster  = new centremaster();
$centrenames = $centremaster->getcentrenames();
$keywordmaster  = new keywordmaster();
$studentstatus = $keywordmaster->getstudentstatusactive();
	
if(isset($_REQUEST['btnStudentadd']))
{
	
		$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$studentDOB =date('Y-m-d', strtotime($_REQUEST['txtdob']));
		$arrstudent = array('first_name'=> $_REQUEST['txtFname'],'last_name'=>$_REQUEST['txtLname'],'dob'=>$studentDOB,
		'age'=>$_REQUEST['txtAge'],'gender'=>$_REQUEST['rdgender'],'phone'=>$_REQUEST['txtcontact'],'mobile'=>$_REQUEST['txtMobile'],
		'email_id'=>$_REQUEST['txtEmail'],'address'=>$_REQUEST['txtAddress'],'city'=>$_REQUEST['txtCity'],'state'=>$_REQUEST['txtState'],
		'country'=>$_REQUEST['txtCountry'],'zipcode'=>$_REQUEST['txtZip'],'bharathanatyam_experience'=>$_REQUEST['txtExpBha'],
		'special_qualification'=>$_REQUEST['txtSpecqualification'],'name_of_guru'=>$_REQUEST['txtguruname'],'guru_location'=>$_REQUEST['txtLoca'],
		'other_info'=>$_REQUEST['txtotherinfo'],'status'=>$_REQUEST['rdstatus'],
		'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] ,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$studentmaster  = new studentmaster();
	/*	$count = $studentmaster -> checkstudent($arrstudent);
		if($count){
			$msg = "Student Already Exist";
		}
		else{*/
			$studentID = $studentmaster -> addstudent ($arrstudent);
			if($studentID){
  				$programDetails = $programmaster->getprogramYearMonth($_REQUEST['chkProgram']);
				// $studentDOJ =date('Y-m-d', strtotime($_REQUEST['txtdoj']));
				
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
				$arrstudentsProg[] = array('student_id'=>$studentID,'program_id'=> $programDetail['id'],'centre_id'=>$_REQUEST['ddlCenter'],'enrollment_id'=>$_REQUEST['txtEnrollmentid'],'is_fasttrack'=>$isfasttrack);
				
				
				// 'enrollment_date'=> $studentDOJ,'scheduled_cc_date'=>$addMonth,
				}
				
				$ackmsg = $studentmaster -> addstudentsProg ($arrstudentsProg);
				
				$arrCodevalue =array('code'=>'studentstatus','value'=>'Active');
				$getActiveId = $keywordmaster->getIdforvalue($arrCodevalue);
				if(isset($_REQUEST['txtEnrollmentid']) && $_REQUEST['rdstatus'] == $getActiveId){
					
						$random_id_length = 10; 
						$rnd_id = crypt(uniqid(rand(),1)); 
						$rnd_id = strip_tags(stripslashes($rnd_id)); 
						$rnd_id = str_replace(".","",$rnd_id); 
						$rnd_id = strrev(str_replace("/","",$rnd_id)); 
						$rnd_id = substr($rnd_id,0,$random_id_length); 
						$password =md5($rnd_id);
						
				$arrstudentsLogindetail  = array('user_id'=>$studentID,'username'=>$_REQUEST['txtEnrollmentid'],'password'=> $password,'role_id' =>2,'status'=>'Y','loginid'=>$loginid);
				$isLoginDetailadded  = $studentmaster -> addstudentsLogindetail ($arrstudentsLogindetail);
				if($isLoginDetailadded ){
					$arrStudentDetails = array('from'=>ADMIN_EMAIL,'mailto'=>$_REQUEST['txtEmail'],'subject'=>"APAA User Credentials",'firstName'=>$_REQUEST['txtFname'],
					'lastName'=>$_REQUEST['txtNname'],'username' =>$_REQUEST['txtEnrollmentid'],'password'=> $rnd_id);
					$isLoginDetailmailed = $studentmaster -> mailStudentDetails ($arrStudentDetails);
					}
				}
			}
			if($ackmsg)
			{
				$_SESSION['ackmsg'] = 'Student added successfully';
				header('location:admin_student_listing.php');
				
			}
			else
			{
				$msg = "Internal error.Try again.";
			}
		
		/*}*/
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
    <div class="registrationContent">
      <h2>add student </h2>
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
		<input name="txtFname" type="text" />  </li>
        
      <li><label>Last Name:</label>
		<input name="txtLname" type="text" />  </li>
        
      <li><label>D.O.B:</label>
         <input class="w200" name="txtdob" type="text" id="datepicker"/> 
        
         </li>
       <li><label> Age :<strong class="star">*</strong></label>
		<input name="txtAge" type="text"  maxlength="3" />  </li>
        
        <li><label> Gender :<strong class="star">*</strong></label>
		<div class="studentgender"><input class="radiobtn" name="rdgender" type="radio" value="M" />Male
        <input class="radiobtn" name="rdgender" type="radio" value="F" />Female</div> </li>
        
        <li>
           <label>Mobile:<strong class="star">*</strong> </label>
		<input name="txtMobile" type="text" />  </li>
        
        <li>
           <label>Alternate Phone Number: </label>
		<input name="txtcontact" type="text" />  </li>
   
      </ul>
     
      <ul>
      
<li><label>Address: </label>
		<textarea name="txtAddress" class="h71" ></textarea> </li>
 
        <li><label>City:<strong class="star">*</strong></label>
		<input name="txtCity" type="text" />  </li>
        <li><label>State:<strong class="star">*</strong></label>
		<input name="txtState" type="text" />  </li>
        <li><label>Country:<strong class="star">*</strong> </label>
		<input name="txtCountry" type="text" />  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input name="txtZip" type="text" />  </li>  
             <li><label>Email:<strong class="star">*</strong></label>
		<input name="txtEmail" type="text" />  </li>
       </ul>
      </fieldset>
      
         <fieldset class="w100">
        <legend>Interested Program  </legend>
       <ul class="chkprogram">

        <li class="program">
        <span>Program<strong class="star">*</strong></span>
        
        <?php
		foreach($programname as $program)
	 	{
		echo '<label for="checkbox"><input type="checkbox" name="chkProgram[]" id="program'.$program[id].'" value="'.$program[id].'" class="chklist"/>'.$program[name].'</label>';
 	
	
	 
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
			echo '<label class="fastTrack"><input type="checkbox" name="chkFastTrack'.$program[id].'" value="Y" class="chklist" />Fast Track</label>';
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
	echo "<option value='{$centrenames->fields[id]}'  >{$centrenames->fields[academy_name]}</option>";
	 $centrenames-> MoveNext();
	} ?>
</select> </li>

</ul>
<!--<ul>
         <li class="studentdate"><span>Date of Joining:<strong class="star">*</strong></span>
          
           <input class="w200" name="txtdoj" type="text" id="datepickerdoj" /> 
		 </li>
</ul>-->
        </fieldset>
        
        <fieldset class="w100">
        <legend>Music Details </legend>
       <ul class="experience">
                <li><label>Experience in Music :<strong class="star">*</strong></label>
                     <input class="frm_element" id="txtExpBha" tabindex="16" maxlength="20" name="txtExpBha"></li>
                     
                      <li><label>Special accomplishments (if any)</label>
                     <input class="frm_element" id="txtSp" tabindex="17" maxlength="100" name="txtSpecqualification"><br/><br/></li>
                  <li><label>Name of your Guru :<strong class="star">*</strong> </label><input class="frm_element" id="txtGuru" tabindex="18" maxlength="50" name="txtguruname"></li>
                  
                   <li><label>Located at 	:</label><input class="frm_element" id="txtLoca" tabindex="19" maxlength="50" name="txtLoc"><br/><br/></li>
                   <li><label>Other relevant info</label><textarea class="frm_element" id="txtInfo" style="height: 30px;" tabindex="20" name="txtotherinfo"></textarea> 
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
        
        <li><div class="studentstatus"> <?php  foreach($studentstatus as $value)
 	{  echo "<input type='radio' value='{$value[id]}' name='rdstatus' class='radiobtn'>{$value[value]}"; }?></div></li>
                </ul>
         <ul class="referenceCode" style="display:none"><li>
        <label>Enter Reference Code  :<strong class="star">*</strong> </label>
<input type="text" name="txtEnrollmentid" value=""> </li></ul>
        </fieldset>
      </div>
      <ul><li class="button"><input name="btnStudentadd" value="submit" type="submit" class="submitBtn" />
        <input name="resetbtn" value="reset" type="reset" class="resetBtn" />
        </li></ul>
      </div>
      </form>
    </div>
      </div>
<?php 
include('adminfooter.php');
}
?>