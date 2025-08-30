<?php //
require("./PHPMailer/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "mail.sanjaytechnologies.net";  // specify main and backup server
$mail->SMTPAuth = TRUE;     // turn on SMTP authentication
$mail->Username = "immanuel@sanjaytechnologies.net";  // SMTP username
$mail->Password = "immanSanjay21"; // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
//$mail->SMTPOptions = array(
//'ssl' => array(
//'verify_peer' => false,
//'verify_peer_name' => false,
//'allow_self_signed' => true
//)
//);
$mail->From = "karthiyalini25@gmail.com";
$mail->FromName = "Mailer";
$mail->AddAddress("sanjayimman@gmail.com", "Josh Adams");
                // name is optional
$mail->AddReplyTo("sanjayimman@gmail.com", "Information");

//$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "Here is the subject";
$mail->Body    = "This is the HTML message body in bold!";
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
   echo "Message could not be sent. 
";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";


//$to = "sanjayimman@gmail.com";
//$subject = "My subject";
//$txt = "Hello world!";
//$headers = "From: aryaimman@gmail.com" . "\r\n" .
//"CC: immansmith@gmail.com";
//
//mail($to,$subject,$txt,$headers);

?>