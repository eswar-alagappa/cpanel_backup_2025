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
include("../config/classes/programmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/keywordmaster.class.php");

include('adminheader.php');
$programmaster  = new programmaster();
$programname = $programmaster->getProgramname();
$keywordmaster  = new keywordmaster();
$studentstatus = $keywordmaster->getstudentstatusactive();
$centremaster  = new centremaster();
$centrenames = $centremaster->getcentrenames();
//$studentid = $_GET[ studentid ];
$studentmaster  = new studentmaster();
$studentdetail = $studentmaster -> getStudentdetails($userid);
$_SESSION['student']['enrollmentid']=$studentdetail->fields[enrollment_id];
$studentProgram =$studentmaster -> getStudentprogram($studentdetail->fields[program_id]);
$studentCentre =$studentmaster -> getStudentcentre($studentdetail->fields[centre_id]);
$studenteditprofile = new loginmaster();
if(isset($_REQUEST['btnEditstudent']))
{
$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$studentDOB =date('Y-m-d', strtotime($_REQUEST['txtdob']));
	   	$arrstudent = array('dob'=>$studentDOB,
		'mobile'=>$_REQUEST['txtMobile'],'email_id'=>$_REQUEST['txtEmail'],'address'=>$_REQUEST['txtAddress'],'city'=>$_REQUEST['txtCity'],'state'=>$_REQUEST['txtState'],
		'country'=>$_REQUEST['txtCountry'],'zipcode'=>$_REQUEST['txtZip']);
		$ackmsg = $studentmaster -> updatestudentprofile ($arrstudent,$userid);
		 if($ackmsg)
		 {
			$_SESSION['ackmsg'] = 'You updated your profile successfully';
				 header('location:student_profile_students.php');
		} else 	{
			$msg = "Internal error.Try again.";
			}
		 
}
?>
<script type="text/javascript" src="../web/validation/student_profile.validate.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
$("#datepicker").datepick({
        buttonImage: '../web/images/calendar-img.gif',
        buttonImageOnly: true,
        showOn: 'button',
		/*minDate: 0, */
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: new Date(1900, 12-1, 01), 
		maxDate: new Date(1995,12-1,31),
		yearRange: "-60:+0",
		onClose: function() { $("#datepicker").focus(); }
     });

});
 </script>
<div class="headerBottom">
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
    <div class="wrapper">
  
  <div class="content">
     <div class="contentOuter">
      <h2>Edit Profile</h2>
       <form id="frmprofileedit" action="" name="formStudentadd" method="post">
       <div class="contentInner">
          <?php if( $msg )
	{
       echo "<div class='error'> {$msg} </div>";
      }
	  ?>
       <div class="profileContent">
      <div class="makePaymentForm">
      <ul>
      <li>
        <label> Ref. Code   : </label> 
<span><?php echo $studentdetail->fields[enrollment_id]; ?></span>

         </select>

  </li> 
         <li>
        <label> First Name 	   :  </label>
         <?php echo $studentdetail->fields[first_name]; ?>		</li>
         <li>
           <label> Last Name     : </label> 
  <span><?php echo $studentdetail->fields[last_name]; ?></span>
		</li>
         <!--<li>
           <label> Date Of Birth     : </label> 
  <span>Ramasamy</span>
		</li>-->
       <li class="studentdate"><label>D.O.B:<strong class="star"> *</strong></label>
      <?php   $dob =  split('-',$studentdetail->fields[dob]); 
	$dob[1].'/'.$dob[2].'/'.$dob[0];
	 $studentDOB =date('m/d/Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0])); 
		  ?> 
         <input class="w200" name="txtdob" type="text" id="datepicker" value="<?php echo $studentDOB;?>"/> </li>
    <li>
        <label> Address   :<strong class="star"> *</strong></label>  <textarea name="txtAddress" cols="" rows=""><?php echo $studentdetail->fields[address]; ?></textarea>
		 </li>
<li>
        <label> City   :<strong class="star"> *</strong>  </label><input name="txtCity" type="text" class="fL" value="<?php echo $studentdetail->fields[city]; ?>"></li>
        <li>
        <label> State	   :<strong class="star"> *</strong>  </label><input name="txtState" type="text" class="fL" value="<?php echo $studentdetail->fields[state]; ?>"></li>
        <li>
        <label> Country   :<strong class="star"> *</strong>  </label><input name="txtCountry" type="text" class="fL" value="<?php echo $studentdetail->fields[country]; ?>"></li>
        <li>
        <label> Zip code   :<strong class="star"> *</strong>  </label><input name="txtZip" type="text" class="fL" value="<?php echo $studentdetail->fields[zipcode]; ?>"></li>
        <li>
        <label> Email   :<strong class="star"> *</strong>  </label><input name="txtEmail" type="text" class="fL" value="<?php echo $studentdetail->fields[email_id]; ?>"></li>
        <li>
        <label> Phone   :<strong class="star"> *</strong>  </label><input name="txtMobile" type="text" class="fL" value="<?php echo $studentdetail->fields[mobile]; ?>"></li>

         <li class="btn"><input name="btnEditstudent" value="Update" type="submit" class="saveBtn fL" />
        <a href="student_profile_students.php" class="cancelBtn" >Cancel</a>
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
</div>
 
<?php 
include('studentfooter.php');
}
?>