<?php 
include_once("class.phpmailer.php");

class paymentmaster
{
	function addPayment($arrpayment)
	{
		
		global $DB;
		$select = "select * from student_payment where student_id='{$arrpayment[student_id]}' and  program_id = '{$arrpayment[program_id]}' and  payment_status_id=(select id from keywordmaster  
		where value ='Transaction Failed' and code ='paymentstatus')";
		$excuteSelect = $DB->Execute($select);
		
		foreach ($excuteSelect as $paymentid ){
				$deletepaypal= "delete from payment_paypal where  payment_id = {$paymentid[id]}";
				$DB->Execute($deletepaypal);
				$deletepayment = "delete from student_payment where id = {$paymentid[id] }";
				$DB->Execute($deletepayment);
		}
		$insert = "insert into student_payment values('','{$arrpayment[student_id]}','{$arrpayment[program_id]}','{$arrpayment[payment_option_id]}','{$arrpayment[payment_mode_id]}',
		'{$arrpayment[amount]}','{$arrpayment[paid_on]}','','{$arrpayment[payment_status_id]}','{$arrpayment[updated_by]}','{$arrpayment[updated_on]}')";
		 $excuteInsert = $DB->Execute($insert);
		if($excuteInsert){
			$getLastinsertedIdquery = "select max(id) as id from student_payment";
				$getLastinsertedId = $DB->Execute($getLastinsertedIdquery);
		}
		$lastid =  $getLastinsertedId->fields[id];
	     return $lastid ;
	}
	function addPaypalPayment($addPaypalPayment)
	{
		global $DB;
		$insert = "insert into payment_paypal values('','{$addPaypalPayment[payment_id]}','{$addPaypalPayment[transaction_no]}','{$addPaypalPayment[comments]}')";
		$excuteInsert = $DB->Execute($insert);
		return $excuteInsert ;
	}
	function updatePaypalPayment($arrPaypalpayment)
	{
		global $DB;
		$updatePaypal = "update  payment_paypal set transaction_no = '{$arrPaypalpayment[transaction_no]}'  where payment_id = '{$arrPaypalpayment[payment_id]}' ";
		$excuteUpdatepaypal= $DB->Execute($updatePaypal);
		$updatePayment = "update  student_payment set 	payment_status_id = '{$arrPaypalpayment[payment_status_id]}'  where id = '{$arrPaypalpayment[payment_id]}' ";
		
		$excuteUpdatepayment= $DB->Execute($updatePayment);
		if($DB->Affected_Rows())
		return true;
		else
		return false;
	}
	function getDojandfee($arrStudentProgram){
		global $DB;
		
		$selectQuery = "select sm.id, DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as doj,
		 (select sum(amount) from student_payment where student_id ={$arrStudentProgram[student_id]} and program_id = {$arrStudentProgram[program_id]} 
		 and (payment_status_id = (select  id from keywordmaster where code ='paymentstatus' and  value = 'Done' )
		 or payment_status_id = (select  id from keywordmaster where code ='paymentstatus' and  value = 'Processing' )   ) ) as paid_amount,
		 pm.total_fee as fee from studentmaster sm
		join student_education se on se.student_id = sm.id
		join programmaster pm on pm.id = se.program_id
		where se.student_id ={$arrStudentProgram[student_id]} and se.program_id = {$arrStudentProgram[program_id]} ";
		//echo $selectQuery;
		$excuteselectQuery  = $DB->getArray($selectQuery);
	
		return $excuteselectQuery; 
	}
	function getProgramsforStudent($studentid){
		global $DB;
		$getProgramsforStudent ="select se.enrollment_date as doj, se.program_id as id,	pm.name as name, se.student_id as studentid , pm.total_fee as programtotalfee 
		 from  student_education  se join programmaster pm   ON se.program_id = pm.id 
		where  se.student_id= '{$studentid}'";
		$excuteProgramsforStudent  = $DB->getArray($getProgramsforStudent);
		foreach ($excuteProgramsforStudent  as $key => $programs ){
			$selectQuery  ="select sum(amount) as paidamount from  student_payment where  student_id = '{$programs[studentid]}'
			 and  program_id = '{$programs[id]}' and (payment_status_id = (select id from keywordmaster where code = 'paymentstatus' and value ='Done')
			 or payment_status_id = (select id from keywordmaster where code = 'paymentstatus' and value ='Processing'))" ;
			$excuteselectQuery  = $DB->getArray($selectQuery);
		
			if(($excuteselectQuery[0][paidamount]  ==  $programs[programtotalfee]))
			unset($excuteProgramsforStudent[$key]);
			}
		return $excuteProgramsforStudent; 
	}
	function getPaymentDetail($studentid)
	{
		global $DB;
		$getpaymentinfo ="select pm.name , km.value as paymentoption , DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , sp.amount ,kp.value as paymentmode ,ks.value as paymentstatus
		from student_payment sp  join programmaster pm on  sp.program_id  =  pm.id  join keywordmaster km on sp.payment_option_id =  km.id  join keywordmaster
		 kp on sp.payment_mode_id =  kp.id join keywordmaster ks on sp.payment_status_id  =  ks.id
		where sp.student_id=$studentid  and sp.payment_status_id != (select id from keywordmaster where code = 'paymentstatus' and value ='Transaction Failed') ";
		
		$excutePaymentInfo  = $DB->getArray($getpaymentinfo);
		return $excutePaymentInfo; 
	}
	function getStudentsPaypalPayment()
	{
		global $DB;
		$getPayedStudent ="select sp.id, sm.first_name as studentname, pm.name , km.value as paymentoption ,DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , sp.amount
		 ,kp.value as paymentmode , pp.transaction_no as transno ,sp.student_id ,sp.program_id 	,sp.payment_status_id 	,se.enrollment_id
			from student_payment sp  join programmaster pm on  sp.program_id  =  pm.id  join keywordmaster km on sp.payment_option_id =  km.id  join keywordmaster
			 kp on sp.payment_mode_id =  kp.id join  studentmaster sm on sp.student_id  =  sm.id  join  payment_paypal pp on pp.payment_id   =  sp.id 
			 join  student_education se on (se.student_id   =  sp.student_id  and   se.program_id   =  sp.program_id )
			 where sp.payment_status_id != (select id from keywordmaster where value ='Transaction Failed' and code ='paymentstatus')";
	//	$excutepayedStudent  = $DB->getArray($getPayedStudent);
		/*foreach ($excutepayedStudent  as  $key => $students ){
				 $selectQuery ="select  enrollment_id from    student_education  where  student_id = '{$students[student_id]}' and  program_id = '{$students[program_id]}'" ;
			  $excuteselectQuery  = $DB->getArray($selectQuery);
			  $excutepayedStudent[$key]['enrollment_id'] =  $excuteselectQuery[0][enrollment_id];
		}*/
		return $getPayedStudent; 
	}
	function getPaymentDetailsonAdmin($paymentid)
	{
		global $DB;
		$getprogram ="select sp.id, sm.first_name , 	pm.name , km.value as paymentoption ,DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , sp.amount ,kp.value as paymentmode ,ks.value as paymentstatus , pp.transaction_no , pp.comments ,
		sp.student_id ,sp.program_id from student_payment sp  join programmaster pm on  sp.program_id  =  pm.id  join keywordmaster km on sp.payment_option_id =  km.id  join keywordmaster
 kp on sp.payment_mode_id =  kp.id join keywordmaster ks on sp.payment_status_id  =  ks.id  join  payment_paypal pp on pp.payment_id   =  sp.id 
  join  studentmaster sm on sp.student_id  =  sm.id   
		where sp.id=$paymentid";
		$excuteProgram  = $DB->getArray($getprogram);
		$selectQuery ="select se.enrollment_id as enrollment_id , cm.academy_name as academy_name, DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as doj  from    student_education se  join centremaster  cm  on se.centre_id = cm.id 
			 where  se.student_id = '{$excuteProgram[0][student_id]}' and  se.program_id = '{$excuteProgram[0][program_id]}'" ;
		 $excuteselectQuery  = $DB->getArray($selectQuery);
		 $excuteProgram[0]['enrollment_id'] =  $excuteselectQuery[0][enrollment_id];
		 $excuteProgram[0]['academy_name'] =  $excuteselectQuery[0][academy_name];
		 $excuteProgram[0]['doj'] =  $excuteselectQuery[0][doj];
		return $excuteProgram; 
	}
	function approvePaypalPayment($arrPaypalUpdate)
	{
		
		global $DB;
		
		if($arrPaypalUpdate[enrollment_date]){
			 $selectQuery = "select is_fasttrack from  student_education se  where  se.student_id = '{$arrPaypalUpdate[student_id]}' and se.program_id= '{$arrPaypalUpdate[program_id]}'";
			 
		$excuteselectQuery = $DB->getArray($selectQuery);
		$getprogram ="select * from programmaster where id ='{$arrPaypalUpdate[program_id]}'";
		$programDetails  = $DB->getArray($getprogram);
		$mysql_datetime = date('Y-m-d H:i:s', strtotime($arrPaypalUpdate[enrollment_date]));
		
		if($excuteselectQuery[0][is_fasttrack] == 'Y'){
			
			// $addMonth = strtotime(date("Y-m-d H:i:s",  $arrPaypalUpdate[enrollment_date]) . "+".$programDetail[0]['fasttrack_duration']." month");
			//$dateOneMonthAdded = strtotime(date("Y-m-d", strtotime($todayDate)) . "+1 month");

			$addMonth = strtotime(date("Y-m-d H:i:s", strtotime($mysql_datetime))."+".$programDetails[0]['fasttrack_duration']." month");
		}
		else {
			 $addYear = strtotime(date("Y-m-d H:i:s", strtotime($mysql_datetime))."+". $programDetails[0]['duration_year']."year");
			// $addYear = strtotime(date("Y-m-d H:i:s",   $arrPaypalUpdate[enrollment_date]  ) . "+". $programDetail[0]['duration_year']."year");
			$addMonth = strtotime(date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s', $addYear))) . "+".$programDetails[0]['duration_month']." month");
		}
			 
				
			$scheduled_cc_date = date("Y-m-d H:i:s", $addMonth ); 
		//	echo $scheduled_cc_date ;
			$updateEnrollmentdate = "update  student_education set  enrollment_date = '{$arrPaypalUpdate[enrollment_date]}' ,  scheduled_cc_date = '{$scheduled_cc_date}' 
			  where program_id ={$arrPaypalUpdate[program_id]}
		and student_id ='{$arrPaypalUpdate[student_id]}' ";
		//echo $updateEnrollmentdate;
		$excuteUpdate = $DB->Execute($updateEnrollmentdate);
		}
		
		//exit;
		$approvePayment =
		$updatePaypalStatus = "update student_payment set payment_status_id= '{$arrPaypalUpdate[payment_status_id]}',comments='{$arrPaypalUpdate[comments]}' where id ='{$arrPaypalUpdate[id]}' and student_id ='{$arrPaypalUpdate[student_id]}' ";
		$excuteUpdate = $DB->Execute($updatePaypalStatus);
		$selectQuery  ="select *  from  studentmaster sm 
						join student_education se on se.student_id = sm.id 
						join programmaster pm on pm.id = se.program_id
						where 
						pm.total_fee = (select sum(amount)  from student_payment 
						where student_id = '{$arrPaypalUpdate[student_id]}' and  program_id= '{$arrPaypalUpdate[program_id]}' and 
						payment_status_id = (select id from keywordmaster where
						code  = 'paymentstatus' and  value='Done')) and se.student_id = '{$arrPaypalUpdate[student_id]}' and se.program_id= '{$arrPaypalUpdate[program_id]}'" ;
		
		$excuteselectQuery  = $DB->getArray($selectQuery);
		if($excuteselectQuery ){
			$updatePaymentStatus = "update student_education set payment_status_id= '{$arrPaypalUpdate[payment_status_id]}'  where program_id ='{$arrPaypalUpdate[program_id]}'
			 and student_id ='{$arrPaypalUpdate[student_id]}' ";
			$excuteUpdate = $DB->Execute($updatePaymentStatus);
			}
		return true;
		}
		function listPaymentPendingStudents()
		{
		global $DB;
		$listPendingPayment ="select sm.id,se.enrollment_id, sm.first_name as studentname,  sm.last_name as studentlastname, pm.id as program_id, pm.name as programname , DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as doj,
		 (select sum(amount) from student_payment
		 where student_id = sm.id and program_id=pm.id 
		 and (payment_status_id  = (select id from keywordmaster where code='paymentstatus' and value='Processing') or
		 payment_status_id  = (select id from keywordmaster where code='paymentstatus' and value='Done') ) ) as paid_amount,
		 pm.total_fee from studentmaster sm
		join student_education se on se.student_id = sm.id
		join programmaster pm on pm.id = se.program_id
		where sm.status = (select id from keywordmaster where code='studentstatus' and value='Active') and se.payment_status_id = (select id from keywordmaster where code='paymentstatus' and value='Pending')";
		//$excuteProgram = $DB->getArray($listPendingPayment);
		return $listPendingPayment ;
		}
		function viewPaymentPendingStudent($arrStudent)
		{
			global $DB;
			$pendingStudentSQL = "select se.enrollment_id,sm.first_name,cm.academy_name as center_name,pm.name as program_enrolled,se.program_id,DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as doj,
			 (select sum(amount) from student_payment where student_id = {$arrStudent['student_id']} and program_id={$arrStudent['program_id']}) as paid_amount
			 from studentmaster sm join student_education se on se.student_id = sm.id 
			 join centremaster cm on cm.id = se.centre_id 
			 join programmaster pm on pm.id = se.program_id 
			 where sm.id = {$arrStudent['student_id']} and se.program_id = {$arrStudent['program_id']} ";
		$viewPendingStudent = $DB->getArray($pendingStudentSQL);
			return $viewPendingStudent;
		}
		function addCheckPayment($arrCheckPayment)
		{
		 global $DB ;
		 //print_r($arrCheckPayment);
		 
		 $selectQuery = "select id from  student_payment sp  where  sp.student_id = '{$arrCheckPayment[student_id]}' and sp.program_id= '{$arrCheckPayment[program_id]}'";
			//echo $selectQuery;
		$excuteselectQuery = $DB->getArray($selectQuery);
		
		if(!$excuteselectQuery[0]['id']){
			 $checkQuery = "select is_fasttrack from  student_education se  where  se.student_id = '{$arrCheckPayment[student_id]}' and se.program_id= '{$arrCheckPayment[program_id]}'";
			 
		$excutecheckQuery = $DB->getArray($checkQuery);
		$getprogram ="select * from programmaster where id ='{$arrCheckPayment[program_id]}'";
		$programDetails  = $DB->getArray($getprogram);
		$mysql_datetime = date('Y-m-d H:i:s', strtotime($arrCheckPayment[paid_on]));
		if($excutecheckQuery[0][is_fasttrack] == 'Y'){
		$addMonth = strtotime(date("Y-m-d H:i:s", strtotime($mysql_datetime))."+".$programDetails[0]['fasttrack_duration']." month");
		}
		else {
			 $addYear = strtotime(date("Y-m-d H:i:s", strtotime($mysql_datetime))."+". $programDetails[0]['duration_year']."year");
				$addMonth = strtotime(date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s', $addYear))) . "+".$programDetails[0]['duration_month']." month");
		}
		$scheduled_cc_date = date("Y-m-d H:i:s", $addMonth );
		$updateEnrollmentdate = "update  student_education set  enrollment_date = '{$arrCheckPayment[paid_on]}' ,  scheduled_cc_date = '{$scheduled_cc_date}'   where program_id ={$arrCheckPayment[program_id]}
		and student_id ='{$arrCheckPayment[student_id]}' ";
		//echo $updateEnrollmentdate;
		$excuteUpdate = $DB->Execute($updateEnrollmentdate);
		
		}
	//	exit;
		 
		 
		 $insertStudentPayment = "insert into student_payment (student_id,program_id,payment_option_id,payment_mode_id,amount,paid_on,comments,payment_status_id,updated_by,updated_on)values('{$arrCheckPayment[student_id]}','{$arrCheckPayment[program_id]}','{$arrCheckPayment[payment_option_id]}','{$arrCheckPayment[payment_mode_id]}',		'{$arrCheckPayment[amount]}','{$arrCheckPayment[paid_on]}','{$arrCheckPayment[comments]}','{$arrCheckPayment[payment_status_id]}','{$arrCheckPayment[updated_by]}','{$arrCheckPayment[updated_on]}')";
		
		 $excuteStudentPaymentInsert = $DB->Execute($insertStudentPayment);
		if($excuteStudentPaymentInsert){
			$getLastinsertedIdquery = "select max(id) as id from student_payment";
				$getLastinsertedId = $DB->Execute($getLastinsertedIdquery);
		}
		$lastid =  $getLastinsertedId->fields[id];
		if($lastid)
		{
		 $insertCheckPayment = "insert into payment_check(payment_id,check_no,bank_branch,check_date,credited_on) values($lastid,'{$arrCheckPayment[check_no]}','{$arrCheckPayment[bank_branch]}','{$arrCheckPayment[check_date]}','{$arrCheckPayment[credited_on]}')";
		$excuteCheckPaymentInsert = $DB->Execute($insertCheckPayment);
		$getLastCheckPaymentSql = "select max(id) as id from payment_check where payment_id={$lastid}";
		$getLastCheckPaymentID = $DB->Execute($getLastCheckPaymentSql);
		
		
		}
		$arrCheckPayment['mailsubject']= "Payment through check";
		
		if($getLastCheckPaymentID->fields[id] && $lastid)
		{
			
			$this->updatePaymentStatus($arrCheckPayment);
			return true;
		}
		else
		return false;
			
		}
		function addPaypalPaymentadmin($arrPaypalPayment){
			
		 global $DB ;
		  
		 $selectQuery = "select id from  student_payment sp  where  sp.student_id = '{$arrPaypalPayment[student_id]}' and sp.program_id= '{$arrPaypalPayment[program_id]}'";
			// echo $selectQuery;
		$excuteselectQuery = $DB->getArray($selectQuery);
		
		if(!$excuteselectQuery[0]['id']){
			 $checkQuery = "select is_fasttrack from  student_education se  where  se.student_id = '{$arrPaypalPayment[student_id]}' and se.program_id= '{$arrPaypalPayment[program_id]}'";
			 
		$excutecheckQuery = $DB->getArray($checkQuery);
		$getprogram ="select * from programmaster where id ='{$arrPaypalPayment[program_id]}'";
		$programDetails  = $DB->getArray($getprogram);
		$mysql_datetime = date('Y-m-d H:i:s', strtotime($arrPaypalPayment[paid_on]));
		///echo $mysql_datetime;
		if($excutecheckQuery[0][is_fasttrack] == 'Y'){
		$addMonth = strtotime(date("Y-m-d H:i:s", strtotime($mysql_datetime))."+".$programDetails[0]['fasttrack_duration']." month");
		}
		else {
			 $addYear = strtotime(date("Y-m-d H:i:s", strtotime($mysql_datetime))."+". $programDetails[0]['duration_year']."year");
				$addMonth = strtotime(date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s', $addYear))) . "+".$programDetails[0]['duration_month']." month");
		}
		//echo $arrPaypalPayment[paid_on] ;
		$scheduled_cc_date = date("Y-m-d H:i:s", $addMonth );
		$updateEnrollmentdate = "update  student_education set  enrollment_date = '{$arrPaypalPayment[paid_on]}' ,  scheduled_cc_date = '{$scheduled_cc_date}'   where program_id ={$arrPaypalPayment[program_id]}
		and student_id ='{$arrPaypalPayment[student_id]}' ";
		//echo $updateEnrollmentdate;
		$excuteUpdate = $DB->Execute($updateEnrollmentdate);
		
		}
		//exit;
		 
		 
		 $insertStudentPayment = "insert into student_payment (student_id,program_id,payment_option_id,payment_mode_id,amount,paid_on,comments,payment_status_id,updated_by,updated_on)values('{$arrPaypalPayment[student_id]}','{$arrPaypalPayment[program_id]}','{$arrPaypalPayment[payment_option_id]}','{$arrPaypalPayment[payment_mode_id]}',		'{$arrPaypalPayment[amount]}','{$arrPaypalPayment[paid_on]}','{$arrPaypalPayment[comments]}','{$arrPaypalPayment[payment_status_id]}','{$arrPaypalPayment[updated_by]}','{$arrPaypalPayment[updated_on]}')";
		
		 $excuteStudentPaymentInsert = $DB->Execute($insertStudentPayment);
		if($excuteStudentPaymentInsert){
			$getLastinsertedIdquery = "select max(id) as id from student_payment";
				$getLastinsertedId = $DB->Execute($getLastinsertedIdquery);
		}
		$lastid =  $getLastinsertedId->fields[id];
		if($lastid)
		{
		 $insertCheckPayment = "insert into payment_paypal(payment_id,transaction_no ) values($lastid,'{$arrPaypalPayment[transaction_no]}' )";
		$excuteCheckPaymentInsert = $DB->Execute($insertCheckPayment);
		$getLastCheckPaymentSql = "select max(id) as id from payment_paypal where payment_id={$lastid}";
		$getLastCheckPaymentID = $DB->Execute($getLastCheckPaymentSql);
		
		
		}
		$arrPaypalPayment['mailsubject']= "Payment through paypal";
		
		if($getLastCheckPaymentID->fields[id] && $lastid)
		{
			
			$this->updatePaymentStatus($arrPaypalPayment);
			return true;
		}
		else
		return false;
			
		
		}
		
		function updatePaymentStatus($arrPayment)
		{
			global $DB;
			
			$selectQuery = "select sm.id,sm.email_id,sm.first_name,sm.last_name,se.program_id from studentmaster sm join student_education se on se.student_id = sm.id   join programmaster pm on pm.id = se.program_id where pm.total_fee <= (select sum(amount) from student_payment where student_id = '{$arrPayment[student_id]}' and program_id= '{$arrPayment[program_id]}' and payment_status_id = (select id from keywordmaster where code = 'paymentstatus' and value='Done')) and sm.id = '{$arrPayment[student_id]}' and se.program_id= '{$arrPayment[program_id]}'";
		$excuteselectQuery = $DB->getArray($selectQuery);
		$arrPayment['studentemail']= $excuteselectQuery[0][email_id];
		$arrPayment['studentname']= $excuteselectQuery[0][first_name].' '.$excuteselectQuery[0][last_name];
		if(count($excuteselectQuery)){
		
		$updatePaymentStatus = "update student_education set payment_status_id=(select id from keywordmaster where code='paymentstatus' and value='Done') where program_id ={$excuteselectQuery[0][program_id]}
		and student_id ='{$excuteselectQuery[0][id]}' ";
		$excuteUpdate = $DB->Execute($updatePaymentStatus);
		$this->mailPayment($arrPayment);
		}
		}
		function mailPayment($arrPayment){
		//exit;
			$from = ADMIN_EMAIL;
					$to = $arrPayment['studentemail'];
					$subject =$arrPayment['mailsubject'];
					if($arrPayment['mailsubject'] ==  'Payment through check'){
					 $message = '<br/>Dear '. $arrPayment['studentname'].',';
					  $message .= "<br/>You have paid the amount of ".$arrPayment['amount']." through check and the check details are stated below: ";
					   $message .= "<br/><br/>Check No:{$arrPayment['check_no']}";
					  $message .= "<br/><br/>Check Date: {$arrPayment['check_date']}";
					  $message .= "<br/><br/>Bank Name & branch: {$arrPayment['bank_branch']}";
					  $message .= "<br/><br/>You can check the payment status by logging into the user panel.";  
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>The Apaa Team.";
					}
					else {
						$message = '<br/>Dear '. $arrPayment['studentname'].',';
					  $message .= "<br/>You have paid the amount of ".$arrPayment['amount']." through paypal and the payment  details are stated below: ";
					   $message .= "<br/><br/>Transcation No : {$arrPayment['check_no']}";
					     $message .= "<br/><br/>Paid on: {$arrPayment['paid_on']}";
					
					  $message .= "<br/><br/>You can check the payment status by logging into the user panel.";  
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>The Apaa Team.";
						}
					  $header = "From: Customer Support <".$from.">\r\n";
					 $header .= 'MIME-Version: 1.0' . "\r\n";
					$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$data=array('from'=>$from,'to'=>$to,'cc'=>$cc,'bcc'=>$bcc,'subject'=>$subject,'message'=>$message,'header'=>$header);
$ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "http://inqtechnologies.com/alagappaarts/mailing.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $data1 = curl_exec($ch);
    curl_close($ch);
					
					/*$mail = new PHPMailer();  
		$mail->IsSMTP();  // telling the class to use SMTP			
		$mail->Host = "mail.alagappaarts.com";   
		$mail->Port = "587"; 		
		$mail->Username = "alagappausers@alagappaarts.com"; // SMTP username
		$mail->Password = "Ala&@001"; // SMTP password		
		$mail->SMTPAuth = yes; 	
		$mail->From = $from;
		$mail->FromName = $from; 
		$mail->AddAddress($to); 
		$mail->addBCC("customersupport@alagappaarts.com");
		$mail->AddReplyTo($from);

		$mail->Subject  = $subject;
		$mail->Body     = $message;
		$mail->IsHTML(true);
		$mail->WordWrap = 50; 
		if($mail->Send())
			{
				return  true;
			}
			else
			{	
				return false;
			
			}*/
         		//mail($to, $subject, $message,  $header);
				
		}
		
		
	
}
?>