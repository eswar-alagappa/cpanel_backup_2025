<?php include("../config/config.inc.php"); 
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
	include("../config/classes/onlineexam.class.php");
include('studentheader.php');
$onlineexam = new onlineexam();
?>
<script type="application/javascript">
$(document).ready(function(){
	$("#frmContinue").validate({
  rules: {
txtKey:{
		required: true	
		}
	 },
 messages:{
		txtKey : "Enter the unique exam key"
           
	},
errorElement: 'div',
errorClass:'validateError',
errorPlacement: function(error, element) { 
if((element).attr("name")=="txtKey")
	{
		error.appendTo( ".errorHolder" );
	} 
}
	});
	
	});
</script>
<?php 
  if(isset($_SESSION['userexaminfo']))
  {
	  ?>
<div class="headerBottom">

      <div class="admiTitle">Welcome  <?php  echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
 <?php
 
	 
	  $courseid = $_SESSION['userexaminfo']['course_id'];
	  $coursecode = $onlineexam->getcoursecodebyid( $courseid);

  ?>
   <div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Online Exams</li>
             
      </ul>
    </div>
    <div class="contentOuter">
    <h2>Online Exams <?php echo ' - '.$coursecode; ?></h2>
      <div class="contentInner">
        
	  

       <div class="onlineExamsOuter">
      <div class='onlineExamContinueContent'>
       <?php  if($_SESSION['uniquekeywrong'])
	  {
		  echo '<div class="error">Exam unique key is wrong.</div>';
		  unset($_SESSION['uniquekeywrong']);
	  }
	  ?>
      <form name='frmContinue' method='post' action='online_exam_questions.php' id="frmContinue">
      <span>Enter the Unique Exam Key initially provided to you. To proceed the exam click on 'Continue'.</span>
      <label><input type='text' name='txtKey' value=''/></label><label><input type='submit' name='btnSubmit' value='Continue' class='btnContinue'/></label>
		<div class="errorHolder"></div>
</form>
      </div>
      </div>
      </div>
    </div>
    </div>
<?php
   }
}
?>