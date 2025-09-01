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
include("../config/classes/keywordmaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/paymentmaster.class.php");
include('adminheader.php');
$paymentmaster = new paymentmaster();
$keywordmaster = new keywordmaster();
define( MAX_NO_OF_ROWS_PAGINATION,20);
$paymentDetails = $paymentmaster -> getStudentsPaypalPayment( );
$getPaymentDetails = $DB -> execute( $paginationObj->getQuery($paymentDetails));

$countofPayments = count($getPaymentDetails -> fields[id]);
static $recordcount=0;
	$forcount = $DB->execute($paymentDetails);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}


?>
<div class="content">
    <div class="topNav">
      <ul>
         <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li><a  href="approval_dashboard.html">Approvals</a></li>
        <li class="last"> &nbsp; Payment Approvals</li>
      </ul>
    </div>
    <?php if(isset($_SESSION['ackmsg']))
{
echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
unset($_SESSION['ackmsg']);

}
 ?>
    <div class="studentViewContent">
      <h2><span>Payment Approvals</span>
   
      </h2>
    <?php  if($countofPayments){ ?>
       
      <div class="studentList">
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
               <th>Student Id </th>
                <th> Student Name</th>
                <th> Program Enrolled</th>
                <th> Paid On </th>
                <th> Payment Mode </th>
                <th>Details</th>
                <th> Transaction No</th>
                <th> Amount($)	</th>
                <th width="75"> Actions</th>
              </tr> 
              <?php  foreach  ($getPaymentDetails as $getPaymentDetail)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				  		   <td>{$getPaymentDetail[enrollment_id]}</td> 
				   <td>{$getPaymentDetail[studentname]}</td> 
                <td>{$getPaymentDetail[name]}</td> 
				   <td>{$getPaymentDetail[paid_on]} </td>
                <td> {$getPaymentDetail[paymentmode]}  </td>";
				echo "<td>";
            echo "{$getPaymentDetail[paymentoption]}";
			echo "</td>";
					echo "<td>";
            echo "{$getPaymentDetail[transno]}";
			echo "</td>";
               echo "<td>";
			      echo $getPaymentDetail[amount];
			   echo "</td>";
			   $arrStatusID = array('code'=>'paymentstatus','value'=>'Done');
				$paymentStatusID = $keywordmaster->getIdforvalue($arrStatusID);
				
				if( $paymentStatusID === $getPaymentDetail[payment_status_id])
				echo "<td><a href='javascript:;'><img src='../web/images/approve-btn-inactive.png' width='20' height='18' title='Approve payment'/></a></td>	 ";
				else 
			     echo "<td><a href='admin_payment_paypal_approval.php?payment={$getPaymentDetail[id]}'><img src='../web/images/approve-btn.png' width='20' height='18' title='Approve payment'/></a></td>	 ";
			   echo "</tr>";
				  $i++;
 				 }?>
              
             
            </tbody>
          </table>
        </div>
      </div>
<div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $paymentDetails ); ?></ul></div>
      </div>
    <?php   } else { echo "<div class='adminError'>No paypal payemnt made yet</div>";} ?>
    </div>
  </div>

<?php 
include('adminfooter.php');
}
?>