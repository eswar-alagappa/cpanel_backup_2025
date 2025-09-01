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
	include("../config/classes/messagemaster.class.php");
   	include('adminheader.php');
$Messageid=$_GET[id];
$sendMessage  = new messagemaster();

//$MessageStudentDetailView = $sendMessage -> getMessageStudentView($Messageid);
//echo "<pre>";print_r($MessageStudentDetailView);
$MessageDetailCentreView = $sendMessage -> getMessageCentreView($Messageid);
//echo "<pre>";print_r($MessageDetailCentreView);
//exit;
	?>
     
  <div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="material_listing.html">material</a></li>
       <li class="last"> &nbsp; View material</li> 
        </ul>
    </div>
    <div class="studentViewContent">
      <h2>View Announcement</h2>
      <div class="addProgramForm">
      <ul class="w305">
       
                 
         <li>
        <label>Subject  : </label>
		<span><?php echo $MessageDetailCentreView->fields[subject]; ?></span>   </li>
       
         <li>
        <label>Message   : </label>
		<span class="w200"><?php echo $MessageDetailCentreView->fields[message]; ?>
</span>   </li>
        <li>
        <label>Mail to   : </label>
		<span><?php echo $MessageDetailCentreView->fields[email_id]; ?></span>  </li>
        <li>
        <label>Mailed on   : </label>
		<span><?php echo $MessageDetailCentreView->fields[mail_date]; ?></span>  </li>
        <li class="btn"><a href="admin_announcements_listing.php"><input type="submit" class="saveBtn" value="Back" name=""></a>
        </li>
      </ul>
      </div>
      
      
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>