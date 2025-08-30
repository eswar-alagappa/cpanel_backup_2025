<?php
if(isset($_REQUEST['submitBtn'])) 
{
function stringbuilder($title,$content)
{
	if($content!="")
	{
		return '<tr> <td>'.$title.'</td> <td>'.$content.'</td> </tr>';
	}
}
	$name = $_REQUEST['txtName'];
	
	$dept = $_REQUEST['txtDept'];
	
	$year=$_REQUEST['txtYear'];
	
	$email = $_REQUEST['txtEmail'];
	
	$phone = $_REQUEST['txtContact'];
	
	$Mobile = $_REQUEST['txtMobile'];
	
	$address=$_REQUEST['txtAddress'];
	
	$organisation = $_REQUEST['txtOrg'];
	
	$designation=$_REQUEST['txtDesignation'];
	
	$city = $_REQUEST['txtCity'];

	$state = $_REQUEST['txtState'];
	
	$pincode = $_REQUEST['txtPin'];
	

	

$mailto="info@umayalwomenscollege.co.in";

   $my_subject = "Alumnae Registeration";
   	$my_message = "
		  <table cellpadding='2' cellspacing='5'>".

		  stringbuilder('Name:',$name). stringbuilder('Departmant:',$dept).  stringbuilder('Year of Passing:',$year). stringbuilder('Email ID:',$email). stringbuilder('Phone Number:',$phone).stringbuilder('Mobile Number:',$Mobile). stringbuilder('Organisation:',$organisation). stringbuilder('Designation:',$designation). stringbuilder('Address:',$address).stringbuilder('City:',$city).  stringbuilder('State:',$state).  stringbuilder('Pin code:',$pincode). 
		 "</table>

		  ";
    $header = "From: ".$name." <".$email.">\r\n";
    $header .= "Reply-To: ".$email."\r\n";
  $header .= 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    if (mail($mailto, $my_subject, $my_message,  $header)) {
        echo "<script type='text/javascript'>alert('Thanks for your Registration');window.location = \"admissions.html\"; </script>";  
	  }
  else
	  {
		   echo "<script type='text/javascript'>alert('Unable to process your request'); window.location = \"admissions.html\";</script>";
	  }
}
?>
