<?php
$ch = curl_init();
$from="gopi@gmail.com";
$cc="damu@inqtechnologies.com";
$to="damuslm@gmail.com";
$bcc="gopinath93@gmail.com";
$subject="Alagappa";

$message="Message with dummy content as test mail.2";

$data=array('from'=>$from,'to'=>$to,'cc'=>$cc,'bcc'=>$bcc,'subject'=>$subject,'message'=>$message);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "http://inqclients.com/alagappaarts/mailing.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $data1 = curl_exec($ch);
    curl_close($ch);


?>