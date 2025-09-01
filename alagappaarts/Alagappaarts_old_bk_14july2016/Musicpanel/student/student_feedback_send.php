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
include("../config/classes/keywordmaster.class.php");
$keywordmaster  = new keywordmaster();
$feedbackStatus = $keywordmaster->getIdforvalue(array('code'=>'feedbackstatus','value'=>'unread'));


$studentfeedback = new feedbackmaster();
if(isset($_REQUEST['btnSend']))
{
	$msg = "";
	$mysql_datetime = date('Y-m-d H:i:s');
$arrFeedback = array('subject'=>$_REQUEST['txtSubject'],'message'=>$_REQUEST['txtMessage'],'student_id'=>$userid,'mailed_on'=>$mysql_datetime ,'mailed_by'=> $_SESSION[studentinfo][role_id],'reply'=>'','replied_on'=>'','replied_by'=>'','status'=>$feedbackStatus);
 $storeFeedbackDB=$studentfeedback->addStudentFeedback($arrFeedback);
   	if($storeFeedbackDB)
		{
			$_SESSION['ackmsg'] = 'Your feedback sent successfully';
			header("location:student_feedback_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}	
}
?>
<script type="text/javascript" src="../web/validation/send-announcement.validate.js"></script>
 <div class="headerBottom">
      <div class="admiTitle">Welcome <?php echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
        <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenavactive"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
      
    </div>
 <div class="wrapper">
  <div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">Dashboard</a></li>
      <li><a  href="student_feedback_listing.php">Feedback</a></li>
        <li class="last"> &nbsp; Send Feedback </li>
     </ul>
    </div>
    
    <form id="frmSendAnnouncement" method="post" action="">
    <div class="contentOuter">
      
      <h2>Send Feedback</h2>
      <div class="sendFeedback">
      <ul>
      <li><label> Subject  : </label> <input type="text" name="txtSubject" /> </li>        
      <li><label> Comments   :  </label><textarea name="txtMessage" cols="" rows=""></textarea></li>
      <li class="btn"><input name="btnSend" value="Send" type="submit" class="saveBtn" />
       <a href="student_feedback_listing.php"> <input name="btnSend" value="Cancel" type="reset" class="cancelBtn" /></a>
       <!--<a href="student_feedback_listing.php" class="cancelBtn">Cancel</a>-->
        </li>
      </ul>
      </div>
      <div>
        
</div>
           
    </div>
    </form>
  </div>
</div>
<?php 
include('studentfooter.php');
}
?>