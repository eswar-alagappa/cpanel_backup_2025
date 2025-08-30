<?php  
session_start();
error_reporting(0);

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
$mail->From = $_POST['email'];
$mail->FromName = "Admission Enquiry";
$mail->AddAddress("kumaran@alagappa.org", "kumaran");
                // name is optional
$mail->AddReplyTo("kumaran@alagappa.org");

//$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);

if(count($_POST) > 0){
    
 if(!preg_match("/^[a-zA-Z ]*$/", $_POST['name']) || $_POST['name'] == '') {
     echo  $nameErr = "Only letters and white space allowed"; 
      $_SESSION['msg'] = '
  <strong>Failure!</strong> Only letters and white space allowed..!!
';
       echo '<meta http-equiv="refresh" 
   content="0; url=http://www.alagappaschoolkaraikudi.com/">';
      
       exit();
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] == '') {
    
     
           $_SESSION['msg'] = '
  <strong>Failure!</strong> Invalid email format..!!
';
            echo '<meta http-equiv="refresh" 
   content="0; url=http://www.alagappaschoolkaraikudi.com/">';
            exit();
    }
    if (!preg_match('/^[0-9]{10}+$/', $_POST['mobile_no']) || $_POST['mobile_no'] == '' ) {
	 
           $_SESSION['msg'] = '
  <strong>Failure!</strong> invalid phone number..!!
';
           echo '<meta http-equiv="refresh" 
   content="0; url=http://www.alagappaschoolkaraikudi.com/">';
            exit();
    }

$to = 'sanjayimman@gmail.com';

$subject = 'Admission Enquiry';


 $content = '
		<table>
						<tr>
							<td>Name : </td><td>'.$_POST['name'].'</td>
						</tr>
                                                <tr>
							<td>Parent/Guardian Name : </td><td>'.$_POST['parent_name'].'</td>
						</tr>
                                                <tr>
							<td>Email-id : </td><td>'.$_POST['email'].'</td>
						</tr>
                                                <tr>
							<td>Mobile : </td><td>'.$_POST['mobile_no'].'</td>
						</tr>
                                                <tr>
							<td>DOB : </td><td>'.$_POST['dob'].'</td>
						</tr>
                                                <tr>
							<td>Course Name : </td><td>'.$_POST['class'].'</td>
						</tr>
                                                <tr>
							<td>Hostel Facilities : </td><td>'.$_POST['hostel'].'</td>
						</tr>
                                                <tr>
							<td>Transportation Services : </td><td>'.$_POST['trans'].'</td>
						</tr>
                                               
                                                
                                                <tr>
							<td>Address Type: </td><td>'.$_POST['address'].'</td>
						</tr>
						
					</table>
				'; 
 echo $msg = '<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            <p>Dear Alagappa Team,</p>
			<p>'.$content.'</p>
			<!--<p>If you have questions, contact us at</p>
			<p>customersupport@alagappaarts.com</p>-->
            <p>Thank you,</p>
            <p>Sincerely yours,</p>
			<p>'.$_POST['name'].' </p>
          </td>
        </tr>
      </table>
      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>
</table>
<!-- /body -->



</body>';
 
 
 
 $mail->Subject = $subject;
$mail->Body    = $msg;
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
 
 $mail->Send();
//$headers = "From: " . strip_tags($_POST['email']) . "\r\n";
//$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
//$headers .= "CC: immanuel@sanjaytechnologies.net\r\n";
//$headers .= "MIME-Version: 1.0\r\n";
//$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

echo $to;
echo $_POST['email'];

//echo   mail($to, $subject, $msg, $headers);

$_SESSION['msg'] =  'Your enquiry details submitted successfully';

  echo '<meta http-equiv="refresh" 
   content="0; url=http://www.alagappaschoolkaraikudi.com/">';
}else{
  echo '<meta http-equiv="refresh" 
   content="0; url=http://www.alagappaschoolkaraikudi.com/">';
}?>