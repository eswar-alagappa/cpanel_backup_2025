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
$keywordmaster  = new keywordmaster();
$paymentOption = $keywordmaster->getkeyword('paymentoption');
$studentmaster  = new studentmaster();
$paymentmaster  = new paymentmaster();
$studentPrograms =$paymentmaster -> getProgramsforStudent($userid );

foreach($studentPrograms as $value)
 	{ 
	 $lastProgramid = $value[id];  }
	$arrStudentProgram = array('program_id' => $lastProgramid ,'student_id' => $userid );
 $studentDojandfee = $paymentmaster -> getDojandfee($arrStudentProgram);
if(isset($_REQUEST['btnPayment'])){
	
	$mysql_datetime = date('Y-m-d H:i:s');
	 $arrCodevalue =array('code'=>'paymentmode','value'=>'Paypal Payment');
	$getPaypalPaymentmode = $keywordmaster->getIdforvalue($arrCodevalue);
	 $arrCodevalue =array('code'=>'paymentstatus','value'=>'Transaction Failed');
	$getPendingpaymentStatus = $keywordmaster->getIdforvalue($arrCodevalue);
	$arrpayment = array('student_id'=> $userid,'program_id'=>$_REQUEST['selectProgram'],'payment_option_id'=>$_REQUEST['rspaymentOption'],
		'payment_mode_id'=>$getPaypalPaymentmode,'amount'=>$_REQUEST['amount'],'paid_on'=>$mysql_datetime ,'payment_status_id'=>$getPendingpaymentStatus,
		'updated_by'=>'' ,'updated_on'=>$mysql_datetime);
	$paymentId =  $paymentmaster->addPayment($arrpayment);
		$_SESSION[PaymentID] =$paymentId;
		if($paymentId){
			$arrPaypalpayment=  array('payment_id'=> $paymentId,'transaction_no'=>'','comments'=>$_REQUEST['txtComments']);
				$addpaypalPayment =  $paymentmaster->addPaypalPayment($arrPaypalpayment);
				}
		
	 ?>
	 <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypalPayment" id="paypalPayment" >
	  <!-- <form action="https://www.sandbox.paypal.com/webscr" method="post" name="paypalPayment" id="paypalPayment" >-->
        <input type="hidden" name="cmd" value="_xclick" />
          <!-- <input type="hidden" name="business" value='deepika@inqtechnologies.com' />-->
		<input type="hidden" name="business" value='info@alagappaarts.com' />
	 <input type="hidden" name="notify_url" value='<?php  echo NOTIFY_URL ;?>' />
	 <input type="hidden" name="return" value='<?php  echo RETURN_URL ;?>' />
	 <input type="hidden" name="cancel" value='<?php  echo CANCEL_URL ;?>' />
	<input type='hidden' name='currency_code' value='USD' />
	<input type='hidden' name='lc' value='GB'><input type='hidden' name='bn' value='PP-BuyNowBF'>
	<input type='hidden' name='item_name' id='item_name'  size='45' value='<?php echo $username  ; ?>' />
	<input type='hidden' name='item_number' id='item_number'  size='45' value='<?php echo $userid  ; ?>' />
    <input type='hidden' name='amount' id='item_number'  size='45' value='<?php echo $_REQUEST['amount']  ; ?>' />
</form>
<?php if($addpaypalPayment)
		 echo "<script type='text/javascript'> document.paypalPayment.submit(); </script>";}
?>
<script type="text/javascript" >
$(document).ready(function() {
	$('#selectProgram').change(function() {
	  var selctedval= $('#selectProgram').val();
	  var studentid = $('#item_number').val();

		 $.ajax({
                       type: "GET",
                       url: "programfeedetail.php",
                       data: {program_id: selctedval, student_id: studentid}, 
                       success: function(result){
						     
                       		$('#feeDetails').html(result);
							
							
                       }
                     });
  });
$("#studentPayment").validate({
  rules: {
rspaymentOption:{
	required: true}},
 messages:{
		rspaymentOption : "Please select payment option"
 },
 errorElement: 'div',
 errorClass: 'validateError',
 errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rspaymentOption")
error.appendTo( ".errorPaymentoption");
}
 }
 });
 $("input[name$='rspaymentOption']").live("click",function(){
	
var radio_value = $(this).attr('id');

if(radio_value == 'Partial') {

	    var amount = $('#hiddenFeefull').attr("value");
		var roundedvalue = amount / 2;
		$('#fee').html('$'+roundedvalue);
		$('#hiddenFee').attr("value",roundedvalue);
}
else  if(radio_value=='Fully'  ) 
{
		 var amount = $('#hiddenFeefull').attr("value");
		$('#fee').html('$'+amount);
		$('#hiddenFee').attr("value",amount);
}
});
});
</script>
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
      <li><a  href="dashboard.php">Dashboard</a></li>
      <li><a  href="student_payments.php">Payments</a></li>
        <li class="last"> &nbsp; Make Payment </li>
      </ul>
    </div>
    <div class="contentOuter">
      <h2>Make Payment</h2>
      <div class="makePaymentForm">
       <?php 	 $arrCodevalue =array('code'=>'paymentoption','value'=>'Partial');
	$getpartiallypaymentOption = $keywordmaster->getIdforvalue($arrCodevalue);
	
	 $arrCodevalueforfull =array('code'=>'paymentoption','value'=>'Fully');
	$getfullypaymentOption = $keywordmaster->getIdforvalue($arrCodevalueforfull);  ?>
      <form action="" method="post" id="studentPayment" >
       <input type='hidden' name='paymentOptionFullid' id="payMentFullId" value='<?php echo $getfullypaymentOption; ?>'>
        <input type='hidden' name='paymentOptionPartialid' id="payMentPartialId"  value='<?php echo $getpartiallypaymentOption; ?>'> 
     <input type='hidden' name='lc' value='GB'><input type='hidden' name='bn' value='PP-BuyNowBF'>
	<input type='hidden' name='item_name' id='item_name'  size='45' value='<?php echo $username  ; ?>' />
	<input type='hidden' name='item_number' id='item_number'  size='45' value='<?php echo $userid  ; ?>' />
   <ul>
      <li>
        <label> Program Enrolled   : </label> 
        <select name="selectProgram" id = "selectProgram" class="w250"> 
         <?php foreach($studentPrograms as $value)
            {  echo "<option value='{$value[id]}'selected >{$value[name]}</option>"; }?>
             </select>
		 </li> 
         
         </ul>
          <ul id="feeDetails">
            <input type="hidden" id="hiddenFeefull" value="<?php  echo $studentDojandfee[0][fee]; ?>" name="fullAmoumt" /> 
      
         <li><label> Date of Joining :  </label> <span id="Doj"><?php echo $studentDojandfee[0][doj] ;  ?></span>	</li>
         <li> <label> Payment Option : </label> 
        
    
           <span id="selectPaymentOption"    <?php  if( $studentDojandfee[0][paid_amount]) echo "style='display:none;'";?> >
          <?php 
			foreach($paymentOption as $value){
				$checked="";
		   if($studentDojandfee[0][paid_amount]){
			   if($getpartiallypaymentOption == $value[id])
		   $checked="checked";
		   }
		   echo "<input type='radio' value='{$value[id]}' id='{$value[value]}' name='rspaymentOption'  {$checked} class='radiobtn'>{$value[value]}";
		  
			}
			 ?>
         </span>
          <span id='showPartially'  <?php  if( !$studentDojandfee[0][paid_amount]  ) echo "style='display:none;'"; ?> >
			
		 Partial
		 </span>	 
		<div <?php  if($studentDojandfee[0][paid_amount]  ) echo "style='display:none;'"; ?>  class="errorPaymentoption"> </div>
		</li>
        <li><label> Amount   :</label> <input type="hidden" id="hiddenFee" value="<?php if($studentDojandfee[0][paid_amount]) echo $studentDojandfee[0][fee] - $studentDojandfee[0][paid_amount] ; else echo $studentDojandfee[0][fee]; ?>" name="amount" /> 
             <span id="fee">$<?php if($studentDojandfee[0][paid_amount]) echo $studentDojandfee[0][fee] - $studentDojandfee[0][paid_amount] ; else echo $studentDojandfee[0][fee]; ?></span>
             </li>
              </ul>
             <ul>
		<li><label> Comments   :  </label><textarea name="txtComments" cols="" rows=""></textarea></li>
		 <li class="btn"><input name="btnPayment" value="Pay Now" type="submit" class="saveBtn fL" />
    <!--    <input name="" value="Cancel" type="reset" class="cancelBtn" />-->
        <a href="student_payments.php"  class="cancelBtn"  >Cancel</a>
        </li>
      </ul>
      </form>
      </div>


</div>
  </div>
<?php 
include('studentfooter.php');
}

?>