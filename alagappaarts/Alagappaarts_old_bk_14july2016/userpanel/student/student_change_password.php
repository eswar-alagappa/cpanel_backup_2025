<?php

include("../config/config.inc.php");

include("../config/classes/loginmaster.class.php");

$roleid = $_SESSION[studentinfo][role_id];
$loginid = $_SESSION[studentinfo][id];
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

$studentpasswordmaster = new loginmaster();

if(isset($_REQUEST['btnChangepassword']))

{

	    $msg = "";

			

		$arrstudentpassworddetails = array('user_id'=>$userid,'password'=>md5($_REQUEST['txtRenewpassword']),'oldpassword'=>md5($_REQUEST['txtOldpassword']),'role_id'=>'','status'=>'',
		'loginid'=>$loginid);

		$passworddetails = $studentpasswordmaster -> changepassword($arrstudentpassworddetails);

		

		

		if($passworddetails)

		{

		 	$_SESSION['ackmsg'] = 'Password changed successfully';	

			header("location:student_profile_students.php");

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

      <div class="admiTitle">Welcome <?php echo $_SESSION[studentinfo][first_name]; ?>

</div>

      <div class="menuBottom">

       <ul>

          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>

            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>

          <li class="profilenavactive"><a href="student_profile_students.php">Profile</a></li> 

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

      <input name="txtOldpassword" type="password" /></li>

      <li><label>Enter New Password </label>

      <input name="txtNewPassword" type="password" id="newpassword"/></li>

      <li><label>Re enter New Password </label>

      <input name="txtRenewpassword" type="password" /></li></ul>

      <div class="changePasswordBtn">

      <input name="btnChangepassword" value="Submit" type="submit" class="submitBtn fL" />

      <a href="student_profile_students.php" class="cancelBtn" >Cancel</a>

      

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

include('studentfooter.php');

}

?>