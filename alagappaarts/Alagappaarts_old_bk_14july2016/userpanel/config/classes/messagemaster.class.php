<?php
include_once("class.phpmailer.php");

class messagemaster
{
	function  getCentre(){
		global $DB;
		$getCentrename ="select DISTINCT country from centremaster  where status='Y'";
		$excuteCentrename  = $DB->Execute($getCentrename);
		return $excuteCentrename; 
	}
	function  getCentrename(){
		global $DB;
		$getCentrename ="select DISTINCT academy_name, id from centremaster  where status='Y'";
		$excuteCentrename  = $DB->Execute($getCentrename);
		return $excuteCentrename; 
	}
	
	function getstudent($arrStudent){
		global $DB;
	$getStudent ="select sm.id, cm.id, sm.first_name , cm.academy_name , sm.email_id, cm.country from studentmaster sm JOIN student_education se ON sm.id=se.student_id JOIN centremaster cm ON cm.id = se.centre_id  where se.centre_id='{$arrStudent[id]}'";
	    $excuteStudent  = $DB->getArray($getStudent);
		return $excuteStudent; 
	}
	function addStudentCentreMsg($arrMessage)
	{
		global $DB;
		if(!$arrMessage[student_id]){
		$CentreID=$arrMessage[centre_id];
		foreach($CentreID as $CentreIDs){
		$insertCentre = "insert into message values('','{$arrMessage[subject]}','{$arrMessage[message]}','{$CentreIDs}','','{$arrMessage[mailed_on]}','{$arrMessage[mailed_by]}')";
		$excuteInsert1 = $DB->Execute($insertCentre);
		if($excuteInsert1){
		$SelectCentreDetail="select email_id, academy_name from  centremaster where id=$CentreIDs";
		$excuteSelectQuery  = $DB->getArray($SelectCentreDetail);
		$from=ADMIN_EMAIL;
					$to = $excuteSelectQuery[0][email_id];
					$subject = $arrMessage[subject];
					$message = '<br/>Dear '. $excuteSelectQuery[0][academy_name].',<br/><br/>';
					$message .= $arrMessage[message];
					$message .= "<br/><br/>Thanks to be with us.";  
					$message .= "<br/><br/>Regards,";  
					$message .= "<br/>The Apaa Team.";  
					$header = "From: The Apaa team <".$from.">\r\n";
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
		/*if (mail($to, $subject, $message,  $header) )
					return  true;
					else
					return false;*/
		
		}
		
		}
		
		}
		
		else if($arrMessage[student_id]){
		$StudentID=$arrMessage[student_id];
		foreach($StudentID as $StudentIDs){
		$insertStudent = "insert into message values('','{$arrMessage[subject]}','{$arrMessage[message]}','{$arrMessage[centre_id]}','{$StudentIDs}','{$arrMessage[mailed_on]}','{$arrMessage[mailed_by]}')";
		$excuteInsert2 = $DB->Execute($insertStudent);
		if($excuteInsert2){
		$SelectStudentDetail="select email_id, first_name from studentmaster where id=$StudentIDs";
		$excuteSelectQuery  = $DB->getArray($SelectStudentDetail);
		$from=ADMIN_EMAIL;
					$to = $excuteSelectQuery[0][email_id];
					$subject =$arrMessage[subject];
					$message = '<br/>Dear '. $excuteSelectQuery[0][first_name].',<br/>';
					$message .= $arrMessage[message];
					$message .= "<br/><br/>Thanks to be with us.";  
					$message .= "<br/><br/>Regards,";  
					$message .= "<br/>The Apaa Team.";  
					$header = "From: The Apaa team <".$from.">\r\n";
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
	
				/*	$mail = new PHPMailer();  
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
		/*if (mail($to, $subject, $message,  $header) )
					return  true;
					else
					return false;*/
		
		}
		}
		}
		return true;
	}
	
	function getMessage(){
		global $DB;
		$getMessage ="select id, subject, message, DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date from message";
		return $getMessage;
	}
	/*function getMessageStudentView($Messageid){
		global $DB;
		$getMessageinfo ="select  msg.subject, msg.message ,DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date, cm.email_id as centremailid ,sm.email_id as studentmailid from message msg where msg.student_id=(select sm.id  from studentmaster sm) or (msg.center_id=(select cm.id from centremaster cm))and msg.id=$Messageid";
		$excuteMessage  = $DB->Execute($getMessageinfo);
		return $excuteMessage; 
	}*/
	
	/*function getMessageStudentView($Messageid){
		global $DB;
		$getMessageinfo ="select  msg.id, msg.subject, msg.message ,DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date, sm.email_id, sm.first_name ,sm.last_name, se.student_id from message msg JOIN student_education se ON msg.student_id=se.student_id JOIN studentmaster sm ON sm.id=se.student_id where msg.id=$Messageid";
		//echo $getMessageinfo;
		$excuteMessage  = $DB->Execute($getMessageinfo);
		return $excuteMessage; 
	}*/
	function getMessageCentreView($Messageid){
		global $DB;
		$getMessageinfo ="select  msg.subject, msg.message ,DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date, cm.id, cm.email_id, cm.academy_name from message msg JOIN centremaster cm ON cm.id=msg.center_id where msg.id=$Messageid";
		
		$excuteMessage  = $DB->Execute($getMessageinfo);
		return $excuteMessage; 
	}
	
	
	
	
}

?>