<?php include("../config/config.inc.php"); 
if($_REQUEST['txn_id'] ){
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
include("../config/classes/paymentmaster.class.php");
include("../config/classes/keywordmaster.class.php");
include('studentheader.php');

?>
<div class="headerBottom">

      <div class="admiTitle">Welcome  <?php  echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="student_profile_students">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
<div class="content">

    <?php
   
	if($_REQUEST['txn_id'] && 	$_REQUEST['payment_status']=="Pending"){
	
			$paymentId = 	$_SESSION[PaymentID] ;
			$paymentmaster  = new paymentmaster();
			$keywordmaster  = new keywordmaster();
			 $arrCodevalue =array('code'=>'paymentstatus','value'=>'Processing');
	$getProcessingpaymentStatus = $keywordmaster->getIdforvalue($arrCodevalue);
		$arrPaypalpayment = array ('transaction_no'=>$_REQUEST['txn_id'],'payment_id'=>$paymentId ,'payment_status_id'=> $getProcessingpaymentStatus);
	$updatepaypalPayment =  $paymentmaster->updatePaypalPayment($arrPaypalpayment);
		unset($_SESSION[PaymentID]);
	}
/*echo "<pre>";
	print_r($_REQUEST);php */
    echo "<div class='cofirmation' >Thanks For Payment</div>";
	?>
  </div>
<?php 
include('studentfooter.php');
}
}
else
{header('location:dashboard.php');
	}
?>