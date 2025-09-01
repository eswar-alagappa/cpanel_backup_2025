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
include("../config/classes/feedbackmaster.class.php");
$Feedbackid=$_GET[id];
$sendFeedback  = new feedbackmaster();
$StudentFeedbackView = $sendFeedback -> getStudentFeedbackView($Feedbackid);
?>
<div class="headerBottom">
      <div class="admiTitle">Welcome <?php echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
        <li class="homeIcon"><a href="../music/index.html">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenavactive"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
      
    </div>
    <div class=" wrapper">
  <div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">Dashboard</a></li>
      <li><a  href="student_feedback_listing.php">Feedback</a></li>
        <li class="last"> &nbsp; Feedback View </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2>Feedback View</h2>
      <div class="sendFeedback">
      <ul><li>
        <label>Date			: </label>
		<span><?php echo $StudentFeedbackView->fields[mail_date]; ?></span> </li> 
         <li>
        <label>Subject : </label>
		<span><?php echo $StudentFeedbackView->fields[subject]; ?></span> </li> 
       
        <li>
        <label>Comments  : </label>
        <span><?php echo $StudentFeedbackView->fields[message]; ?></span>
        </li>
        
        <li>
        <label>Feedback	Reply	: </label>
        <span><?php if( $StudentFeedbackView->fields[reply] )echo $StudentFeedbackView->fields[reply]; else echo '-'; ?></span>
        </li>
        <li class="btn">
          <a href="student_feedback_listing.php"><input name="" value="Back" type="submit" class="saveBtn" /></a>
        </li>
      
      </ul>
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