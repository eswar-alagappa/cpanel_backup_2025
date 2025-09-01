<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[centerinfo][role_id];
$userid = $_SESSION[centerinfo][user_id];
$loginid = $_SESSION[centerinfo][id];
$username = $_SESSION[centerinfo][academy_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$iscenter  = $loginmaster->iscenter($arrlogin);
/*echo $iscenter ;
exit;*/
if(!$iscenter)
{
	header('location:index.php?msg=Enter username password');
}
else{
include('centerheader.php');

include("../config/classes/centremaster.class.php");

$centremaster = new centremaster();


if(isset($_REQUEST['btnChangepassword']))
{
	    $msg = "";
			
		$arrchangepassword = array('user_id'=>$userid,'password'=>md5($_REQUEST['txtRenewpassword']),'oldpassword'=>md5($_REQUEST['txtOldpassword']),'role_id'=>$roleid,'status'=>'',
		'loginid'=>$loginid);
		$passworddetails = $loginmaster -> changecentrepassword($arrchangepassword);
		
		
		if($passworddetails)
		{
		 	$_SESSION['ackmsg'] = 'Password changed successfully';	
			header("location:center_profile_center.php");
		}
		else
		{
			$msg = "Old password doesn't match";
		}
	
}
?>
<script type="text/javascript" src="../web/validation/change-password.validate.js"></script>
<body>
<div class="headerBottom">
      <div class="admiTitle">Welcome To <?php echo $_SESSION[centerinfo][academy_name]; ?>
</div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenavactive"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
<div class=" wrapper">
  
  <div class="content">
    
     <div class="contentOuter">
      <h2>Change Password</h2>
       <div class="contentOuter">
      <div class="changePassword">    <?php if( $msg )
	{
      echo "<div class='error'> {$msg} </div>";
      }
	  ?>
      <form id="frmchangepassword" action="" method="post">
      
      <div class="changePasswordInner">
      <ul><li><label>Enter Old Password </label>
      <input name="txtOldpassword" type="text" /></li>
      <li><label>Enter New Password </label>
      <input name="txtNewPassword" type="text" id="newpassword"/></li>
      <li><label>Re enter New Password </label>
      <input name="txtRenewpassword" type="text" /></li></ul>
      <div class="changePasswordBtn">
      <input name="btnChangepassword" value="Submit" type="submit" class="submitBtn fL" />
      <a href="center_profile_center.php" class="cancelBtn" >Cancel</a>
      
      </div>
      </div>
      </form>
      </div>
 </div>
<div>
  
</div>
           
    </div>
  </div>
</div>
<?php 
include('centerfooter.php');
}
?>