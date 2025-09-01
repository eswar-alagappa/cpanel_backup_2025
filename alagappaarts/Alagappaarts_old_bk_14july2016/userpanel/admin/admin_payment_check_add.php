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
include("../config/classes/paymentmaster.class.php");
include("../config/classes/keywordmaster.class.php");
$studentid = $_GET['studentid'];
$programid = $_GET['program_id'];
$paymentmaster = new paymentmaster();
$keywordmaster  = new keywordmaster();
$paymentOption = $keywordmaster->getkeyword('paymentoption');
$paymentStatus = $keywordmaster->getIdforvalue(array('code'=>'paymentstatus','value'=>'Done'));
$paymentMode = $keywordmaster->getIdforvalue(array('code'=>'paymentmode','value'=>'Check Payment'));
$getPendingpaymentStudentDetails = $paymentmaster -> viewPaymentPendingStudent(array('student_id'=>$studentid,'program_id'=>$programid));

if(isset($_REQUEST['btnSubmit'])){
	$mysql_datetime = date('Y-m-d H:i:s');
	$checkReceivedOn = date('Y-m-d', strtotime($_REQUEST['txtPaidOn']));
	$checkDate = date('Y-m-d', strtotime($_REQUEST['txtCheckDate']));
	$checkCreditedOn = date('Y-m-d', strtotime($_REQUEST['txtCreditedOn']));
	$paymentStatusID = $keywordmaster->getIdforvalue($arrStatusID);
	
	$arrCheckPayment= array('student_id'=>$studentid,'program_id'=>$getPendingpaymentStudentDetails[0]['program_id'],'payment_option_id'=>$_REQUEST['rspaymentOption'],'payment_mode_id'=>$paymentMode,'amount'=>$_REQUEST['txtAmountPaid'],'paid_on'=>$checkReceivedOn,'comments'=>$_REQUEST['txtComment'],'payment_status_id'=>$paymentStatus,'updated_by'=>$userid,'updated_on'=>$mysql_datetime,'check_no'=>$_REQUEST['txtCheckNo'],'check_date'=>$checkDate,'bank_branch'=>$_REQUEST['txtBanknameBranch'],'credited_on'=>$checkCreditedOn);
	
$ackmsg =  $paymentmaster -> addCheckPayment($arrCheckPayment);
if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Check payment added successfully';
			header("location:admin_payment_check.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
?>
<script type="text/javascript" src="../web/validation/check-payment.validate.js"></script>
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
     <form id="frmCheckPayment" method="post">
    <div class="onlineExamContent">
      <div class="onlineExamContentTitle">
      	<ul> 
        <li><span>Student ID 		</span>:    <?php echo $getPendingpaymentStudentDetails[0][enrollment_id];?>	</li>
        <li><span>Student Name  		</span>: <?php echo $getPendingpaymentStudentDetails[0][first_name];?> 	</li>
        <li><span>Center Name 		</span>: <?php echo $getPendingpaymentStudentDetails[0][center_name];?>  		</li>
        </ul>
        <ul>
        <li><span>Program enrolled 		</span>: <?php echo $getPendingpaymentStudentDetails[0][program_enrolled];?>  		</li>
        <li><span>Date of joining 		</span>: <?php echo $getPendingpaymentStudentDetails[0][doj];?></li>
        <li><span>Amount paid($) 		</span>: <?php if($getPendingpaymentStudentDetails[0][paid_amount])
		echo $getPendingpaymentStudentDetails[0][paid_amount];
		else
		echo '<label style="color:red;">Payment not yet received </label>'?></li>
        </ul>
        
      </div>
      <div class="addProgramForm">
      <ul class="w90p">
      <fieldset>
        <legend>Check Details</legend>
         <li> <label> Payment Option : </label> 
       <span class="pL10"><?php 
	   if(!$getPendingpaymentStudentDetails[0][paid_amount])
	   {
	   foreach($paymentOption as $value){
		  
		   	  echo "<label class='rdlList'><input type='radio' value='{$value[id]}' id='{$value[value]}'  name='rspaymentOption' class='radiobtn'";
			  if($value['value'] == "Fully")
			  echo "checked";
			  echo">{$value[value]}</label>"; 
			}
	   }
	   else
	   {
		   $paymentOptionPartial = $keywordmaster->getIdforvalue(array('code'=>'paymentoption','value'=>'Partial'));
		   echo 'Partial payment';
		   echo "<input type='hidden' name='rspaymentOption' value='{$paymentOptionPartial}'/>";
	   }
			 ?>  </span> 
		</li>
       
         <li class="paidondatepick">
        <label>Check Received On  : </label>
		<span class="pL10"><input name="txtPaidOn" type="text" class="datepicker1"/></span>  </li> 
        <li>
        <label>Check No 	 : </label>
       <span class="pL10"><input name="txtCheckNo" type="text" /> </span> 
		</li>
        <li class="checkdatepick">
         <label>Check Date   : </label>
<span class="pL10"><input name="txtCheckDate" type="text" class="datepicker1"/></span>  </li>
<li class="paidamount">
        <label>Check Amount  : </label>
<span>$ <input name="txtAmountPaid" type="text" /></span>   </li>
	<li>
    <label>Bank Name &amp; Branch : </label>
<span class="pL10"><input name="txtBanknameBranch" type="text" /> </span>   </li> 
         <li class="creditondatepick">
         <label>Credited on   : </label>
<span class="pL10"><input name="txtCreditedOn" type="text" class="datepicker1"/>  </span>  </li> 

<li>

        <label>Comments  : </label>
<span class="pL10"><textarea name="txtComment" cols="" rows=""></textarea></span>   </li>
  
</fieldset>
      <li class="paymentbtn"><input name="btnSubmit" value="Save" type="submit" class="saveBtn" />
       <a href="admin_payment_check.php"> <input name="btnReset" value="Cancel" type="button" class="cancelBtn" /></a>
      </li>
      </ul>
      </div>
    
     
    </div>
    </form>

  </div>
<?php 
include('adminfooter.php');
}
?>