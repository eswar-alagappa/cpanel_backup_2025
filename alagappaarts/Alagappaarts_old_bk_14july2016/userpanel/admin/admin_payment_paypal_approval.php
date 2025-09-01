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
include("../config/classes/keywordmaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/paymentmaster.class.php");
$paymentid = $_GET['payment'];
$keywordmaster = new keywordmaster();
$paymentmaster = new paymentmaster();

$getstudentDetails = $paymentmaster -> getPaymentDetailsonAdmin($paymentid);
if(isset($_REQUEST['btnApprove'])){
	if($_REQUEST['txtEnrollmentDate'])
	$enrollmentDate = date('Y-m-d', strtotime($_REQUEST['txtEnrollmentDate']));
	else 
	$enrollmentDate = '';
	
	$arrStatusID = array('code'=>'paymentstatus','value'=>'Done');
	$paymentStatusID = $keywordmaster->getIdforvalue($arrStatusID);
	$arrPaymentUpdate = array('id'=>$paymentid,'comments'=>$_REQUEST['txtComments'],'payment_status_id'=>$paymentStatusID,'student_id'=>$getstudentDetails[0]['student_id'],
	'program_id' => $getstudentDetails[0]['program_id'],'enrollment_date'=>$enrollmentDate );
	
$ackmsg =  $paymentmaster -> approvePaypalPayment($arrPaymentUpdate);
if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Payment has been approved';
			header("location:admin_payment_paypal.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
	global $DB;
	 $selectQuery = "select count(id) as countofprog from  student_payment sp  where  sp.student_id = '{$getstudentDetails[0][student_id]}' and sp.program_id= '{$getstudentDetails[0][program_id]}' and sp.id !=$paymentid ";
			 
			 
		$excuteselectQuery = $DB->getArray($selectQuery);
		$countofprog = $excuteselectQuery[0][countofprog];
		//echo $countofprog ;
	
?>
<script type="text/javascript" src="../web/scripts/datetimepicker/jquery.datepick.js"></script>
<script type="text/javascript" src="../web/scripts/datetimepicker/jquery.datepick.min.js"></script>
<script type="text/javascript" src="../web/scripts/datetimepicker/jquery.datepick.pack.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
$(".datepicker1").datepick({
        buttonImage: '../web/images/calendar-img.gif',
        buttonImageOnly: true,
        showOn: 'button',
		/*minDate: 0, */
		dateFormat:'dd-M-yy',
		buttonText:'Select date',
		minDate: new Date(2000, 12-1, 01), 
		maxDate: 0,
		//yearRange: "-60:+0",
		onClose: function() { $(".datepicker1").focus(); }
     });
	 $("#frmCheckPayment").validate({
		 errorPlacement: function(error, element) { 

if((element).attr("name")=="txtEnrollmentDate")
	{
		error.appendTo(element.parent());
	}
		 } 
		 });

});
 </script>
<div class="content">
    <div class="topNav">
      <ul>
       <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li><a  href="approval_dashboard.html">Approvals</a></li>
        <li class="last"> &nbsp;  Payment Approval - Paypal</li>
      </ul>
    </div>
    <div class="onlineExamContent">
      <div class="onlineExamContentTitle">
      	<ul> 
        <li><span>Student ID 		</span>:    <?php echo $getstudentDetails[0][enrollment_id];?>	</li>
        <li><span>Student Name  		</span>: <?php echo $getstudentDetails[0][first_name];?> 	</li>
        <li><span>Center Name 		</span>: <?php echo $getstudentDetails[0][academy_name];?>  		</li>
        </ul>
        <ul>
        <li><span>Program enrolled 		</span>: <?php echo $getstudentDetails[0][name];?>  		</li>
        <li><span>Date of joining 		</span>: <?php echo $getstudentDetails[0][doj];?></li>
        <li><span>Payment details 		</span>: <?php echo $getstudentDetails[0][paymentoption];?>	</li>
        </ul>
        
      </div>
      <div class="addProgramForm">
          <form id="frmCheckPayment" method="post" name="frmCheckPayment">
	  <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
     
      <fieldset>
        <legend>Payment Details</legend>
         <ul class="w90p">
      <li>
        <label>Amount Paid  : </label>
<span>$<?php echo $getstudentDetails[0][amount];?>	</span>   </li> 
         <li>
        <label>Paid on  : </label>
		<span><?php echo $getstudentDetails[0][paid_on];?>	</span>  </li> 
        <li>
        <label>Payment Mode 	 : </label>
       <span><?php echo $getstudentDetails[0][paymentmode];?> </span> 
		</li>
        <li>
          <label>Transaction Ref No   : </label>
  <span><?php echo $getstudentDetails[0][transaction_no];?>
  </span>  </li> 
  <?php if($getstudentDetails[0][comments])
  {
  ?>
   <li>
          <label>Student comments  : </label>
  <span><?php echo $getstudentDetails[0][comments];?>
  </span>  </li> 
  <?php }  
   
  if( $countofprog ==   0) { ?>
  <li class="checkdatepick">
         <label> Date   : </label>
<span class=""><input name="txtEnrollmentDate" type="text" class="datepicker1 required" title="Please Select Enrollment Date "/></span>  </li>
<?php } else {?>
<input name="txtEnrollmentDate" type="hidden"  value="" />
<?php }?>
<li>
        <label>Comments  : </label>
<span><textarea name="txtComments" cols="" rows=""></textarea></span>   </li></ul>

</fieldset>
    <ul class="w90p">   
    <li class="paymentbtn"><input name="btnApprove" value="Approve" type="submit" class="saveBtn" />
       <a href="admin_payment_paypal.php" >  <input name="btnReset" value="Cancel" type="button" class="cancelBtn" /></a>
        
      </li>
      </ul>
          </form>
      </div>
    
     
    </div>

  </div>
<?php 
include('adminfooter.php');
}
?>
  
