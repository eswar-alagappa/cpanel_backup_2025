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
include('adminheader.php');
include("../config/classes/studentmaster.class.php");
include("../config/classes/centremaster.class.php");
$studentmaster = new studentmaster();
$centremaster = new centremaster();
$studentStats = $studentmaster->studentStats();
$centreStats = $centremaster->centerStats();
?>

<div class="content">
        <div class="dashboardContent">
      <div class="dashboardDetails">
      <div class="dashboardDetailsTitle">Students</div>
      <?php if(count($studentStats))
	  {
		  ?>
      <div class="dashboardDetailsInner">
      <ul>
      <li><span>Total registered students</span>: <?php echo $studentStats['totalstudent'] ?></li>
      <li><span>Approved students</span>: <?php echo $studentStats['activestudent'] ?></li>
      <li><span>Waiting for Approval</span>: <?php echo $studentStats['unapprovedstudent'] ?></li>
      </ul>
      </div>
        <?php } ?>
      </div>
      <div class="dashboardDetails" style="display:none;">
      <div class="dashboardDetailsTitle">Exams</div>
      <div class="dashboardDetailsInner">
      <ul>
      <li><span>Total No. of Exams</span>: 32</li>
      <li><span>Exams conducted</span>: 20</li>
      <li><span>Waiting for Approval</span>: 12</li>
      </ul>
      </div>
        
      </div>
      <div class="dashboardDetails">
      <div class="dashboardDetailsTitle">Center</div>
      <?php if(count($centreStats))
	  {
		  ?>
      <div class="dashboardDetailsInner">
      <ul>
      <li><span>Registered Centers</span>: <?php echo $centreStats['totalcenter'] ?></li>
      <li><span>Approved Centers</span>: <?php echo $centreStats['activecenter'] ?></li>
      <li><span>Waiting for Approval</span>: <?php echo $centreStats['inactivecenter'] ?></li>
      </ul>
      </div>
         <?php } ?>
      </div>
      <div class="dashboardDetails mR0">
      <div class="dashboardDetailsTitle">Feedback</div>
      <div class="dashboardDetailsInner h65">
      <ul>
      <li><span>No Messages</span></li>
      
      </ul>
      </div>
        
      </div>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>