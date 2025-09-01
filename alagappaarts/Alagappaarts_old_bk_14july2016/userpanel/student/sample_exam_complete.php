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
include("../config/classes/keywordmaster.class.php");
include("../config/classes/onlineexam.class.php");
include('studentheader.php');
$onlineexam = new onlineexam();
$usertestid = $_SESSION['usertest'];
?>



  
  <?php 
  
	 if(!$_SESSION[ 'uniqueTestKey' ])
		  {
			  header("location:online_exam_instruction.php");
		  }
		  
 if(isset($_SESSION['userexaminfo']))
  {
	 
	  $courseid = $_SESSION['userexaminfo']['course_id'];
	  $coursecode = $onlineexam->getcoursecodebyid( $courseid);
  }
		  
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
	  
       <div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Online Exams </li>
             
      </ul>
    </div>
    <div class="contentOuter">
    <h2 id='appendTimer'>Online Exams <?php echo ' - '.$coursecode; ?>
   
    
    </h2>
    
      <div class="contentInner">
     
    
    <?php 
	
			echo '<div class="onlineExamsOuter"><div class="onlineExamContinueContent">Thank you for taking up the sample exam.<a href="sample_exam_instruction.php"> Go Back </a>to write the another exam</div></div>';
	         unset($_SESSION['usertest']);
	         unset($_SESSION['questionarray']);
	         unset($_SESSION['questCount']);
	         unset($_SESSION['currentQuestion']);
	         unset($_SESSION['currentQuestiontype']);
	         unset($_SESSION['MatchCorrectQuestAnswer']);
	         unset($_SESSION['MatchQuestiontypeid']);
	         unset($_SESSION[ 'uniqueTestKey' ]);
	         unset($_SESSION[ 'uniqueTestKeyShown' ]);
	         unset($_SESSION['userexaminfo']);
		

	?>
</div>
</div>
</div>

      
   
    
<?php 
include('studentfooter.php');

}
?>