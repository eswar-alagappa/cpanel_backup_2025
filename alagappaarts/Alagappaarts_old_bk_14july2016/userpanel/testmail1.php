<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
$mail=mail("damuslm@gmail.com","InQ Test",'dfsfs');
var_dump($mail);
print_r($mail);
print_r(error_get_last());

include_once("config/classes/class.phpmailer.php");
require("config/classes/class.smtp.php");
try{
                $mail = new PHPMailer();  
		$from = "sasicsdom@gmail.com";
		$to = 'damu@inqtechnologies.com';
		$subject = "Assign Exam";
		$message = "Test mail";
                $mail->IsSMTP();  // telling the class to use SMTP
	        $mail->SMTPDebug=0;
	        $mail->SMTPSecure = "ssl";
	        $mail->SMTPKeepAlive = true;
	        $mail->Mailer = "mail";
		$mail->Host = "smtp.gmail.com";   
		$mail->Port = "465"; 		
		$mail->Username = "sasicsdom@gmail.com"; // SMTP username
		$mail->Password = "profession14"; // SMTP password			
		$mail->SMTPAuth = true; 	
		$mail->From = $from;
		$mail->FromName = $from; 
		$mail->AddAddress($to); 
		//$mail->addBCC("sasicsdom@gmail.com");
		$mail->AddReplyTo($from);
		$mail->Subject  = $subject;
		$mail->Body     = $message;
		$mail->IsHTML(true);
		$mail->WordWrap = 50; 
                 //$mail->Send();
		if($mail->Send())
			{
                                 //print_r($mail);
                               //exit;
				echo 'sent';	exit;
				
			}
			else
			{	
                          // echo  $mail->ErrorInfo;
				echo 'not sent'.$mail->ErrorInfo;	exit;
				
			
			}

}catch (phpmailerException $e) {
echo "error1".$e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
echo "error2".$e->getMessage(); //Boring error messages from anything else!
}
			?>