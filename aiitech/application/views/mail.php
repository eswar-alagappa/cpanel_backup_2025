<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$formcontent="Name: $name \nEmail : $email \nPhone: $phone \nMessage: $message\n\nRegards,\n$name";
$subject = "-- AIITECH CONTACT FORM ENQUIRY --";
//$sendtomail = "alagappaschools@alagappa.org";
$sendtomail = "hari@sanjaytechnologies.net";
//$title = "Contact Form";
//$mailheader = "From: 'info@alagappa.org' \r\n";
mail($sendtomail, $subject, $formcontent);
//echo "Thank You!";
?>