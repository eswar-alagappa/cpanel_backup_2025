<?php
@session_start();
ini_set('error_reporting', E_ALL & ~E_NOTICE);
require("class.phpmailer.php");

	$subject = 'Hi';
	$message="Test";
				

	// Always set content-type when sending HTML email
		$mail = new PHPMailer();  
		$mail->IsSMTP();  // telling the class to use SMTP			
		$mail->Host = "webmail.webindia.com";   
		$mail->Port = "25"; 		
		$mail->Username = "rajeshwari@webindia.com"; // SMTP username
		$mail->Password = "raji2007"; // SMTP password		
		$mail->SMTPAuth = yes; 	
		$mail->From = "rrajeswari.mca@gmail.com";
		$mail->FromName = "Raji"; 
		$mail->AddAddress("rk@inqtechnologies.com"); 
		$mail->addCC("rrajeswari.mca@gmail.com");
		$mail->AddReplyTo("rajeshwari@webindia.com");

		$mail->Subject  = $subject;
		$mail->Body     = $message;
		$mail->IsHTML(true);
		$mail->WordWrap = 50; 
		if($mail->Send())
			{
				echo "mail sent";
			}
			else
			{	
				echo "Error"; 
			
			}
	

?>
 