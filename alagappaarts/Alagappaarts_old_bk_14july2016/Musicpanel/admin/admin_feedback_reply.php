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
include("../config/classes/feedbackmaster.class.php");
include('adminheader.php');
include("../config/classes/keywordmaster.class.php");
$keywordmaster  = new keywordmaster();
$feedbackStatus = $keywordmaster->getIdforvalue(array('code'=>'feedbackstatus','value'=>'unread'));
$getfeedback  = new feedbackmaster();

global $DB;
$Feedbackid=$_GET[id];
$adminFeedbackView = $getfeedback -> SendReply($Feedbackid);
//echo "<pre>";print_r($adminFeedbackView);exit;
if(isset($_REQUEST['btnReply']))
{
	$msg = "";
	$mysql_datetime = date('Y-m-d H:i:s');
$arradminReply = array('subject'=>'','message'=>'','student_id'=>'','mailed_on'=>'' ,'mailed_by'=> '','reply'=>$_REQUEST['txtReplyMessage'],'replied_on'=>$mysql_datetime,'replied_by'=>$userid,'status'=>$feedbackStatus);
$storeadminReplyDB=$getfeedback->addAdminreply($arradminReply,$Feedbackid);
$setFeedbackStatus="update feedback set status =(select id from keywordmaster where value ='read' and code ='feedbackstatus')";
$excuteStatus  = $DB->Execute($setFeedbackStatus);
  	if($storeadminReplyDB)
		{
			$_SESSION['ackmsg'] = 'Your reply sent successfully';
			header("location:admin_feedback_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}	
}
?>
 <script type="text/javascript" src="../web/validation/send-announcement.validate.js"></script>
  <div class="content">
    <div class="topNav">
      <ul>
         <li><a  href="masters_dashboard.html">dashboard</a></li>
        <li><a  href="feedback_listing.html">Feedback</a></li>
        <li class="last"> &nbsp; Feedback reply</li>
      </ul>
    </div>
     <form id="frmSendAnnouncement" method="post" actio="">
    <div class="studentViewContent">
     
      
     <h2>Feedback reply </h2>
      <div class="addProgramForm">
      <ul>
      <li>
        <label>Program enrolled: </label>
		<span><?php echo $adminFeedbackView->fields[name]; ?></span>  </li> 
        
      <li>
        <label>Student  : </label>
		<span><?php echo $adminFeedbackView->fields[first_name]; ?></span>  </li> 
         <li>
        <label>Date : </label>
		<span><?php echo $adminFeedbackView->fields[mail_date]; ?>  </span>  </li> 
          
         <li>
        <label>Subject : </label>
		<span><?php echo $adminFeedbackView->fields[subject]; ?> </span> </li> 
        <li>
        <label>Comments  : </label>
        <span><?php echo $adminFeedbackView->fields[message]; ?></span>
        </li> 
        <li class="replyMessage">
        <label>Enter Reply Message  : </label>
       <textarea name="txtReplyMessage" cols="" rows=""></textarea>
		</li>
	       
         <li class="btn"><input type="submit" class="saveBtn" value="send" name="btnReply">
        <a href="admin_feedback_listing.php" class="cancelBtn">Cancel</a>
        </li>
      
      </ul>
      </div>
    </div>
    </form>
  </div>
  <?php 
include('adminfooter.php');
}
?>

