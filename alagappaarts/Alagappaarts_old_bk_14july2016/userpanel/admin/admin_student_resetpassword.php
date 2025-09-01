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
include("../config/classes/studentmaster.class.php");

$studentid = $_GET[ studentid ];
$programid  = $_GET[ programid ];
$studentmaster  = new studentmaster();

$studentmaster -> resetPassword($studentid,$programid,$loginid);
$_SESSION['ackmsg'] = 'Student Password reset Successfully ';
 header('location:admin_student_listing.php');
?>


<?php 

}
?>