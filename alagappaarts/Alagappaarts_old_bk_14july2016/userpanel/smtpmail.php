<?php

if(mail("kaviyarasank07@gmail.com","InQ Test",'dfsfs'))
{
echo 'sent';
}
else
{
echo 'Not sent';
}
include_once("config/classes/class.phpmailer.php");
                $mail = new PHPMailer();  
		$from = 'sasi@inqtechnologies.com';
		$to = 'sasicsdom@gmail.com';
		$subject = "Assign Exam";
		$message = '<br/> Test mail';
                $mail->IsSMTP();  // telling the class to use SMTP	
		$mail->Host = "smtp.gmail.com";   
		$mail->Port = "465"; 		
		$mail->Username = "sasicsdom@gmail.com"; // SMTP username
		$mail->Password = "profession14"; // SMTP password			
		$mail->SMTPAuth = yes; 	
		$mail->From = $from;
		$mail->FromName = $from; 
		$mail->AddAddress($to); 
		//$mail->addBCC("customersupport@alagappaarts.com");
		$mail->AddReplyTo($from);
		$mail->Subject  = $subject;
		$mail->Body     = $message;
		$mail->IsHTML(true);
		$mail->WordWrap = 50; 
		if($mail->Send())
			{
                                 //print_r($mail);
                               //exit;
				echo 'sent';	exit;
				
			}
			else
			{	
				echo 'not sent';	exit;
				
			
			}
			?>