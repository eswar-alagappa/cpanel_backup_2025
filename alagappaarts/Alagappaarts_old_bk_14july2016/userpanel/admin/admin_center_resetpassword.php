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
include("../config/classes/centremaster.class.php");

$centreid = $_GET[ centerid ];
$centremaster  = new centremaster();
$centerdetail = $centremaster ->getcentredetails($centreid);
//echo $centreid ;
$centername = $centerdetail->fields[academy_name];
$centremaster -> resetPassword($centreid,$loginid);
$_SESSION['ackmsg'] = "{$centername}  Password  has been reset Successfully ";
 header('location:admin_centre_listing.php');
?>


<?php 

}
?>