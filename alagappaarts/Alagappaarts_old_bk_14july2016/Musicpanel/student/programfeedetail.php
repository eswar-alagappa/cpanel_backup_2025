<?php
include("../config/config.inc.php");
include("../config/classes/keywordmaster.class.php");
include("../config/classes/paymentmaster.class.php");
if(isset($_GET['program_id']) && isset($_GET['student_id'])){
  $paymentmaster  = new paymentmaster();
  	$keywordmaster  = new keywordmaster();
	$paymentOption = $keywordmaster->getkeyword('paymentoption');
  	$arrStudentProgram = array('program_id' => $_GET['program_id'] ,'student_id' => $_GET['student_id'] );
 $studentDojandfee = $paymentmaster -> getDojandfee($arrStudentProgram);
  $arrCodevalue =array('code'=>'paymentoption','value'=>'Partial');
	$getpartiallypaymentOption = $keywordmaster->getIdforvalue($arrCodevalue);

	 $arrCodevalueforfull =array('code'=>'paymentoption','value'=>'Fully');
	$getfullypaymentOption = $keywordmaster->getIdforvalue($arrCodevalueforfull); 

	echo  "<input type='hidden' id='hiddenFeefull' value='{$studentDojandfee[0][fee]}' name='fullAmoumt' />";
	 
		echo "<li><label> Date of Joining :  </label> <span id='Doj'>{$studentDojandfee[0][doj]}</span>	</li>";
         echo "<li> <label> Payment Option : </label> ";
     
      if(!$studentDojandfee[0][paid_amount]) {
         echo "<span id='selectPaymentOption' >";
          
			foreach($paymentOption as $value){
			
		  
		   echo "<input type='radio' value='{$value[id]}' id='{$value[value]}' name='rspaymentOption'   class='radiobtn'>{$value[value]}";
		  
			}
			
         echo "</span>";
	  }else {
         echo " <span id='showPartially' >";
			
		echo " Partial";
		 echo "<input type='hidden' value='{$getpartiallypaymentOption}'  name='rspaymentOption'  />";
		 echo "</span>";
	  }
	    if(!$studentDojandfee[0][paid_amount]  )
		echo "<div class='errorPaymentoption'> </div>
		</li>";
       echo "<li><label> Amount   :</label>"; 
	   if($studentDojandfee[0][paid_amount]){
		 $amount =   $studentDojandfee[0][fee] - $studentDojandfee[0][paid_amount];
	  echo " <input type='hidden' id='hiddenFee' value='{$amount}' name='amount' />"; }
	  else  echo "<input type='hidden' id='hiddenFee' value='{$studentDojandfee[0][fee]}' name='amount' />";  
	   
             echo "<span id='fee'>$ ";
             if($studentDojandfee[0][paid_amount]) echo $studentDojandfee[0][fee] - $studentDojandfee[0][paid_amount] ; else echo $studentDojandfee[0][fee]; 
             echo "</span> </li>";
             
            
 }
?>