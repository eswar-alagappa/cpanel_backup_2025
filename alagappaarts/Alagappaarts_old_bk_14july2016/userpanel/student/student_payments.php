<?php include("../config/config.inc.php"); 
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
include("../config/classes/keywordmaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/paymentmaster.class.php");
include('studentheader.php');
$paymentmaster = new paymentmaster();
$studentPrograms =$paymentmaster -> getProgramsforStudent($userid );
//echo "<pre>";
$getPaymentDetails = $paymentmaster -> getPaymentDetail($userid);

?>
<div class="headerBottom">

      <div class="admiTitle">Welcome  <?php  echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
<div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Payments </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2><span>Payment History</span>
        <?php  if($studentPrograms) { ?>
      <span class="makePaymentbtn"><a class="submitBtn" href="student_makepayment.php">Make Payment</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span> 
      <?php } ?>
      </h2>
     
      <div class="contentInner">
       <?php if($getPaymentDetails) {?>
      <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Program Enrolled</th>
                <th> Payment Option	</th>
                <th>  Date of Payment</th>
                 <th> Amount paid ($)</th>
                 <th>Payment mode</th>
                 <th>Status</th>
              </tr>
             <?php  foreach  ($getPaymentDetails as $getPaymentDetail)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$getPaymentDetail[name]}</td>
                <td> {$getPaymentDetail[paymentoption]}  </td>
                <td>{$getPaymentDetail[paid_on]} </td>";
               echo "<td>";
			      echo $getPaymentDetail[amount];
			   echo "</td>";
			   echo "<td>";
			   echo "{$getPaymentDetail[paymentmode]}";
			   echo "</td><td>{$getPaymentDetail[paymentstatus]}";
			   echo "</td>	 
              </tr>";
				  $i++;
 				 }?>
            
            </tbody>
          </table>
           <?php   }else{ echo "<div class='warning'>Payment not yet paid. To make the payment through Paypal, Click on the  button '<strong>Make Payment</strong>'.  </div>" ;}  ?>
          </div>
       
      <div>
        
      </div>
           
    </div>
  </div>
<?php 
include('studentfooter.php');
}
?>