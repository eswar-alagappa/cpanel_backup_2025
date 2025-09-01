<?php
include_once("class.phpmailer.php");
include_once("class.smtp.php");
class studentmaster
{
	function checkstudent($arrstudent)
	{
		global $DB;
		$checkstudentname = "select id from studentmaster where email_id = '{$arrstudent['email_id']}'";
		$checkstudentnamers = $DB->Execute($checkstudentname);
		$count = count($checkstudentnamers->fields[0]);
		return $count;
	}
	function addstudent($arrstudent){
		global $DB;
		$insert = "insert into studentmaster values('','{$arrstudent[first_name]}','{$arrstudent[last_name]}','{$arrstudent[dob]}','{$arrstudent[age]}',
		'{$arrstudent[gender]}','','{$arrstudent[mobile]}','{$arrstudent[phone]}','{$arrstudent[email_id]}','{$arrstudent[address]}',
		'{$arrstudent[city]}','{$arrstudent[state]}','{$arrstudent[country]}','{$arrstudent[zipcode]}','{$arrstudent[bharathanatyam_experience]}',
		'{$arrstudent[special_qualification]}','{$arrstudent[name_of_guru]}','{$arrstudent[guru_location]}','{$arrstudent[other_info]}','{$arrstudent[status]}',
		'{$arrstudent[created_on]}','{$arrstudent[created_by]}','{$arrstudent[modified_by]}','{$arrstudent[modified_on]}')";
		$excuteInsert = $DB->Execute($insert);
		if($excuteInsert){
			$getLastinsertedIdquery = "select max(id) as id from studentmaster";
			$getLastinsertedId = $DB->Execute($getLastinsertedIdquery);
		}
		$lastid =  $getLastinsertedId->fields[id];
		return $lastid ;
	}
	function addstudentsProg($arrtudentsProgs){
		global $DB;
		foreach($arrtudentsProgs as $arrtudentsProg)
		{
			$scheduled_cc_date = date("Y-m-d H:i:s",$arrtudentsProg[scheduled_cc_date]); 
			//enrollment_date, '{$arrtudentsProg[enrollment_date]}', scheduled_cc_date , '{$scheduled_cc_date}',
		$insert = "insert into student_education (student_id,program_id,centre_id,enrollment_id, payment_status_id,graduation_status,cc_issued,is_fasttrack)  values('{$arrtudentsProg[student_id]}','{$arrtudentsProg[program_id]}',
		'{$arrtudentsProg[centre_id]}','{$arrtudentsProg[enrollment_id]}','8' ,'N','N','{$arrtudentsProg[is_fasttrack]}')";
		$excuteInsert = $DB->Execute($insert);
		}
		return true;
	}
	function addstudentsLogindetail($arrstudentsLogindetail){
		global $DB;
		$mysql_datetime = date('Y-m-d H:i:s');
		$insert = "insert into loginmaster values('','{$arrstudentsLogindetail[user_id]}','{$arrstudentsLogindetail[username]}','{$arrstudentsLogindetail[password]}',
		'{$arrstudentsLogindetail[role_id]}', '{$arrstudentsLogindetail[status]}','{$arrstudentsLogindetail[loginid]}','$mysql_datetime','{$_SERVER['REMOTE_ADDR']}')";
	
		$excuteInsert = $DB->Execute($insert);
		return true;
	}
	function updatestudentsLogindetail($arrstudentsLogindetail){
		global $DB;
		$update ="update  loginmaster set   username ='{$arrstudentsLogindetail[username]}',
		status='{$arrstudentsLogindetail[status]}' where user_id = '{$arrstudentsLogindetail[user_id]}' and  role_id = '{$arrstudentsLogindetail[role_id]}'  ";
		$excuteUpdate = $DB->Execute($update);
		return true; 
		}
	function getStudents($arrStudent)
	{
		
		$getStudents ="select DISTINCT (sm.id),se.student_id ,   sm.first_name ,sm.last_name ,	sm.status ,km.value,sm.email_id  from studentmaster sm  JOIN
		 student_education se ON sm.id = se.student_id   JOIN keywordmaster km ON sm.status = km.id where 1=1 ";//where se.graduation_status ='N'status='Y'
		
		return $getStudents;
	}
	function getStudentdetails($studentid)
	{
		global $DB;
		$getStudent ="select sm.*,se.student_id,se.program_id, se.centre_id,se.enrollment_id, se.enrollment_date, km.id as statusid, km.code,km.value  from studentmaster sm  JOIN student_education se ON sm.id = se.student_id   JOIN keywordmaster km ON sm.status = km.id where
						sm.id='{$studentid}'";
		//echo $getStudent;
		$excuteStudent  = $DB->Execute($getStudent);
		return $excuteStudent; 
	}
	function getStudentprogram($programid){
		global $DB;
		$getStudentprogram ="select * from programmaster where id= '{$programid}'";
		$excuteStudentprogram  = $DB->Execute($getStudentprogram);
		return $excuteStudentprogram; 
		}
	function getStudentcentre($centreid){
		global $DB;
		$getStudentcentre ="select * from centremaster where id= '{$centreid}'";
		$excuteStudentcentre  = $DB->Execute($getStudentcentre);
		return $excuteStudentcentre; 
	}
	function updatestudent($arrstudent){
		global $DB;
		$update = "update  studentmaster set  first_name = '{$arrstudent[first_name]}', last_name ='{$arrstudent[last_name]}',dob='{$arrstudent[dob]}', age ='{$arrstudent[age]}',
		gender = '{$arrstudent[gender]}', mobile = '{$arrstudent[mobile]}',phone = '{$arrstudent[phone]}', email_id ='{$arrstudent[email_id]}', address='{$arrstudent[address]}',
		city = '{$arrstudent[city]}', state ='{$arrstudent[state]}', country ='{$arrstudent[country]}', zipcode = '{$arrstudent[zipcode]}', bharathanatyam_experience ='{$arrstudent[bharathanatyam_experience]}',
		special_qualification = '{$arrstudent[special_qualification]}',name_of_guru = '{$arrstudent[name_of_guru]}',guru_location = '{$arrstudent[guru_location]}',
		other_info = '{$arrstudent[other_info]}',status = '{$arrstudent[status]}',modified_by = '{$arrstudent[modified_by]}',  modified_on = '{$arrstudent[modified_on]}' where id = '{$arrstudent[id]}' ";
		$excuteUpdate= $DB->Execute($update);
		if($DB->Affected_Rows())
		return true;
		else 
		return false;
		
	}
	function updatestudentsProg($arrtudentsProgs){
		global $DB;
		foreach($arrtudentsProgs as $arrtudentsProg)
		{
			$newPrograms[] = $arrtudentsProg[program_id];
		}
		$comparePrograms = $this->compareProgramsforUpdate($arrtudentsProgs[0][student_id], $newPrograms);
		
	    if(count($comparePrograms))
		{
			$i=0;
			foreach($comparePrograms as $compareProgram)
			{
				
				$deleteSQL = "delete from student_education where program_id={$compareProgram[$i]} and student_id ={$arrtudentsProgs[0][student_id]}";
				$executeDelete = $DB->Execute($deleteSQL);
				$i++;
			}
		}
		
		foreach($arrtudentsProgs as $arrtudentsProg)
		{
			
			$checkavailability = "select id from student_education where student_id ={$arrtudentsProg[student_id]} and  program_id = 		{$arrtudentsProg[program_id]}";
			$rscheckavailability = $DB->getArray($checkavailability);
			
			
			//$scheduled_cc_date = date("Y-m-d H:i:s",$arrtudentsProg[scheduled_cc_date]); 
			if(count($rscheckavailability))
			{
				
				// {$arrtudentsProg[enrollment_date]},{$scheduled_cc_date} 
				$update = "update  student_education set  program_id ='{$arrtudentsProg[program_id]}', centre_id ='{$arrtudentsProg[centre_id]}',enrollment_id = '{$arrtudentsProg[enrollment_id]}', is_fasttrack ='{$arrtudentsProg[is_fasttrack]}'  where student_id = '{$arrtudentsProg[student_id]}' and program_id = 		{$arrtudentsProg[program_id]}";
			$excuteUpdate = $DB->Execute($update);
			}
			else
			{
				
				// scheduled_cc_date , '{$scheduled_cc_date}',enrollment_date, '{$arrtudentsProg[enrollment_date]}',
				$insert = "insert into student_education (student_id,program_id,centre_id,enrollment_id,payment_status_id,graduation_status,cc_issued,is_fasttrack)  values('{$arrtudentsProg[student_id]}','{$arrtudentsProg[program_id]}',
		'{$arrtudentsProg[centre_id]}','{$arrtudentsProg[enrollment_id]}','8' ,'N','N','{$arrtudentsProg[is_fasttrack]}')";
		$excuteInsert = $DB->Execute($insert);
			}
			
		}
		
		
		if($DB->Affected_Rows())
		return true;
		else 
		return false;
	}
	function approveStudent($arrStudent){
		global $DB;
		$updateStatus = "update studentmaster set  status = '{$arrStudent[status]}' where  id = '{$arrStudent[student_id]}'";
		$DB->Execute($updateStatus);
	$updateenrollmentid = "update student_education set  enrollment_id = '{$arrStudent[enrollment_id]}' ,enrollment_date='{$mysql_datetime}' where student_id = '{$arrStudent[student_id]}' 
		and program_id ='{$arrStudent[program_id]}'";
		$DB->Execute($updateenrollmentid);
		if($DB->Affected_Rows())
		return true;
		else 
		return false;
	}
	function checkWhetherexamassigned($studentID){
		global $DB;
		$examAsigned ="select * from assign_exam  where student_id = '{$studentID}' ";
		
		$excuteexamAsigned  = $DB->Execute($examAsigned);
		//echo $DB->Affected_Rows();
		return $DB->Affected_Rows(); 
	}
	function mailStudentDetails($arrStudentDetails){
		/*$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "From:customersupport@alagappaarts.com  \r\n";
$headers1 .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers1 .= "CC: damu@inqtechnologies.com" . "\r\n";
$x=mail("damuslm@gmail.com",$subject1,$message1,$headers1);*/
//echo $x;exit;
			$from=$arrStudentDetails['from'];
					$to = $arrStudentDetails['mailto'];
					$subject =$arrStudentDetails['subject'];
					 $message = '<br/>Dear '. $arrStudentDetails['firstName'].' '.$arrStudentDetails['lastName'].',';
					  $message .= "<br/>Your request  for enrolling under the <strong>".$arrStudentDetails['programname']."</strong> through the dance center – <strong>".$arrStudentDetails['centername']."</strong> has been approved. Please use the following user credentials on the APAA Website to obtain further details.";
					   $message .= "<br/><br/>Login url:".STUDENT_LOGIN_URL;
					  $message .= "<br/><br/>Username: {$arrStudentDetails['username']}";
					  if($arrStudentDetails['password']) $message .= "<br/>Password: {$arrStudentDetails['password']}"; 
					  $message .= "<br/><br/>After logging in using the above mentioned user credentials, click on <strong>PROFILE</strong> link and reset the password by clicking <strong>Change Password</strong> link.";  
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>Apaa Team.";  
					  $header = "From: customersupport@alagappaarts.com\r\n";
 $header .= "Bcc: customersupport@alagappaarts.com,krithiga@alagappaarts.com,damuslm@gmail.com"."\r\n";
					 $header .= 'MIME-Version: 1.0' . "\r\n";
					$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$from = "customersupport@alagappaarts.com";
				
$data=array('from'=>$from,'to'=>$to,'cc'=>$cc,'bcc'=>$bcc,'subject'=>$subject,'message'=>$message,'header'=>$header);
$ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "http://inqtechnologies.com/alagappaarts/mailing.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $data1 = curl_exec($ch);
    curl_close($ch);echo true;
	//print_r($ch)	;exit;			
//$subject1= 'Hi';
	//$message1="Test";
				
/*$from="customersupport@alagappaarts.com";
	// Always set content-type when sending HTML email
		$mail = new PHPMailer();  
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
				echo true;
			}
			else
			{	
				echo true; 
			
			}*/

	// $mail = new PHPMailer();  
//$to = 'gopi@inqtechnologies.com';
//$subject = "Assign Exam";
//$message = "Test mail";
              /*  $mail->IsSMTP();  // telling the class to use SMTP
        $mail->SMTPDebug=0;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPKeepAlive = true;
        $mail->Mailer = "mail";
$mail->Host = "mail.alagappaarts.com";   
$mail->Port = "587"; 	
$mail->Username = "alagappausers@alagappaarts.com"; // SMTP username
$mail->Password = "Ala&@001"; // SMTP password	
$mail->SMTPAuth = true; 	
$mail->From = $from;
$mail->FromName = $from; 
$mail->AddAddress($to); 
$mail->addBCC("customersupport@alagappaarts.com");
$mail->AddReplyTo($from);
$mail->Subject  = $subject;
$mail->Body     = $message;
$mail->IsHTML(true);
$mail->WordWrap = 50; */
                 //$mail->Send();
                 /*
if($mail->Send())
{
echo true;
}
else
{	
echo true;
}
*/
		
			
		}
		function getStudentprofiledetails($userid)
		{
		global $DB;
		$getStudentprofile ="select * from studentmaster sm JOIN student_education se ON sm.id = se.student_id where sm.id='{$userid}'";
		//echo $getStudentprofile;
		$excuteStudent = $DB->Execute($getStudentprofile);
		return $excuteStudent;
		}
		function getStudentProfileprogram($programid){
			global $DB;
			$getStudentprogram ="select * from programmaster pm where id= '{$programid}'";
			//echo $getStudentprogram;
			$excuteStudentprogram = $DB->Execute($getStudentprogram);
			return $excuteStudentprogram;
		}
		function getStudentProfilecentre($centreid){
			global $DB;
			$getStudentcentre ="select * from centremaster cm where id= '{$centreid}'";
			$excuteStudentcentre = $DB->Execute($getStudentcentre);
			return $excuteStudentcentre;
		}
		function updatestudentprofile($arrstudent,$userid){
		global $DB;
		$update = "update studentmaster set dob='{$arrstudent[dob]}',mobile = '{$arrstudent[mobile]}', email_id ='{$arrstudent[email_id]}', address='{$arrstudent[address]}',
		city = '{$arrstudent[city]}', state ='{$arrstudent[state]}', country ='{$arrstudent[country]}', zipcode = '{$arrstudent[zipcode]}' where id = '{$userid}' ";
		//echo $update;
		$excuteUpdate= $DB->Execute($update);
		//echo $excuteUpdate;
		if($DB->Affected_Rows())
		return true;
		else
		return false;
		}
		function getEnrollmentID($studentarray){
			global $DB;
			$getEnrollmentID ="select min(id) as studenteducationid,enrollment_id,program_id   from student_education where student_id= '{$studentarray[student_id]}'";
			$excuteEnrollmentID = $DB->Execute($getEnrollmentID);
			return $excuteEnrollmentID;
		}
		function getStudentdetailsforProg($studentarray){
			global $DB;
		
			$getStudentDetail ="select sm.first_name ,se.enrollment_id ,DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as enrollment_date ,cm.academy_name,pm.name, pm.total_fee from  student_education   se  join  studentmaster sm on sm.id=se.student_id 
			 join programmaster pm on se.program_id = pm.id join centremaster cm on cm.id =se.centre_id 
			        where se.student_id= '{$studentarray[student_id]}' and se.program_id = '{$studentarray[program_id]}' ";
			
			$excuteStudentDetail= $DB->getArray($getStudentDetail);
			return $excuteStudentDetail;
		}
		function getStudentdPayment($studentarray){
			global $DB;
		
			$getStudentdPayment ="select sp.amount ,km.value as paymentoption ,DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , pp.transaction_no, km1.value as paymentstatus  ,sp.comments
			from  student_payment  sp join keywordmaster km on km.id=sp.payment_option_id  join keywordmaster km1 on km1.id=sp.payment_status_id  
			 join payment_paypal pp on pp.payment_id=sp.id 
			  where sp.student_id= '{$studentarray[student_id]}' and sp.program_id = '{$studentarray[program_id]}' ";
			echo $getStudentdPayment;
			$excuteStudentdPayment = $DB->getArray($getStudentdPayment);
			return $excuteStudentdPayment;
		}
		function studentStats()
		{
			global $DB;
			$studentCountSQL = "select count(id) as totalstudent, (select count(id) from studentmaster where status=(select id from keywordmaster where code='studentstatus' and value='Active')) as activestudent, (select count(id) from studentmaster where status=(select id from keywordmaster where code='studentstatus' and value='Inactive')) as inactivestudent, (select count(id) from studentmaster where status=(select id from keywordmaster where code='studentstatus' and value='Waiting for Approval')) as unapprovedstudent from studentmaster";
			$rsCount = $DB->getArray($studentCountSQL);
			return $rsCount[0];
			
		}
		function resetPassword($studentid,$programid,$loginid){
			global $DB;
			$mysql_datetime = date('Y-m-d H:i:s');
			$isStudentinlogintable = "select id  from loginmaster where role_id=(select id from rolemaster where rolename='Student' ) and user_id 	= '{$studentid}'";
			$rsCount = $DB->getArray($isStudentinlogintable);
			 $random_id_length = 10;
						$rnd_id = crypt(uniqid(rand(),1)); 
						$rnd_id = strip_tags(stripslashes($rnd_id)); 
						$rnd_id = str_replace(".","",$rnd_id); 
						$rnd_id = strrev(str_replace("/","",$rnd_id)); 
						$rnd_id = substr($rnd_id,0,$random_id_length); 
						$password =md5($rnd_id);
			 if($rsCount[0][id] )
			 {
				 $updatePassword = "update loginmaster set  password  = '{$password}'  , modified_by ='{$loginid}' ,
				 modified_on = '$mysql_datetime' , ip_address ='{$_SERVER['REMOTE_ADDR']}' 
				 where user_id  = '{$studentid}' and role_id=(select id from rolemaster where rolename='Student' )";
				$DB->Execute($updatePassword);
				//echo  $updatePassword;
			}else 
			{
				$inserLogindetail = "insert into  loginmaster values 
				('',$studentid,(select enrollment_id  from student_education where  student_id = '{$studentid}' and  program_id  ='{$programid}'),'{$password}',
				(select id from rolemaster where rolename='Student' ),'Y','{$loginid}',
				'$mysql_datetime','{$_SERVER['REMOTE_ADDR']}')";
				$DB->Execute($inserLogindetail);
				//echo $inserLogindetail ;
				}
				$rsEnrollmentid =  "select lm.username , sm.first_name ,sm.last_name 	 from student_education se 
				join studentmaster sm on se.student_id = sm.id
				join loginmaster lm on lm.user_id = sm.id where  student_id = '{$studentid}' and  program_id  ='{$programid}'  and lm.role_id = 2";
				$getEnrollmentid = $DB->Execute($rsEnrollmentid);
				$enrollmentid = $getEnrollmentid->fields[username];
				$studentdetail  = $this->getStudentdetails($studentid);
			$from=ADMIN_EMAIL;
					$to = $studentdetail->fields[email_id];
					$subject = "APAA User Credentials";
					 $message = "Dear ".$getEnrollmentid->fields[first_name]." ".$getEnrollmentid->fields[last_name] ."<br/><br/>

							Please note that we have modified your username and password for access to our website. <br/><br/>
							
							Username: {$enrollmentid}<br/>
							Password: {$rnd_id }<br/><br/>
							
							Login with the below mentioned URL and check your personalized details such as online exam schedules, exam results, online fees payment, etc.<br/><br/>
							http://alagappaarts.com/dance/registration/students-log-in/<br/><br/>
							
							If the above link is not working, Please copy and paste the link into new browser window.<br/><br/>

							If you are still having difficulties contact us at customersupport@alagappaarts.com<br/><br/>

							";  
//echo $message ;
                                           // echo "iam here "; exit;
					  $message .= "Thank you,<br/><br/>";  
					   $message .= "Sincerely yours<br/><br/>"; 
					  $message .= "Team APAA.";  
					  $header = "From: Customer Support <".$from.">\r\n";
                                          $header .= "Bcc: customersupport@alagappaarts.com,krithiga@alagappaarts.com,damuslm@gmail.com"."\r\n";
					 $header .= 'MIME-Version: 1.0' . "\r\n";
					$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$from = "customersupport@alagappaarts.com";
				
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
			
			/* $mail = new PHPMailer();  
$from = "customersupport@alagappaarts.com";

                $mail->IsSMTP();  // telling the class to use SMTP
        $mail->SMTPDebug=0;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPKeepAlive = true;
        $mail->Mailer = "mail";
$mail->Host = "mail.alagappaarts.com";   
$mail->Port = "587"; 	
$mail->Username = "alagappausers@alagappaarts.com"; // SMTP username
$mail->Password = "Ala&@001"; // SMTP password	
$mail->SMTPAuth = true; 	
$mail->From = $from;
$mail->FromName = $from; 
$mail->AddAddress($to); 
$mail->addBCC("customersupport@alagappaarts.com");
$mail->AddReplyTo($from);
$mail->Subject  = $subject;
$mail->Body     = $message;
$mail->IsHTML(true);
$mail->WordWrap = 50; 
                 //$mail->Send();
if($mail->Send())
{
echo true;
}
else
{	
echo true;
}*/
         		/*if (mail($to, $subject, $message,  $header) )
					return  true;
					else
				return false;*/
		 
		}
		function getStudentsonrpoet($arrStudentreport){
			$label =false;
			/*echo "<pre>";
			print_r($arrStudentreport);
			exit;
			foreach (	$arrStudentreport[searchContion]  as  $value )
			{   
				
				if(  $value == 'Payment Status' ) 
				{
					
					$label =true;
				}
			}*/
			$getStudentsonrpoet ="
			
				
					select   distinct(sm.id), se.student_id ,se.enrollment_id as EnrollmentID ,sm.first_name as FirstName ,sm.last_name  as LastName
					 ,sm.age as Age ,sm.gender as Gender ,sm.address as Address ,sm.state as State ,
					sm.country as Country  ,sm.zipcode as Zipcode,sm.phone  as PhoneNo,sm.email_id as EmailID ,km.value as Status ,cm.academy_name as Center , 
					cd.director_name as Director   ,se.graduation_status as GraduationStatus 
					  from 
					studentmaster sm   
					join student_education se on se.student_id =    sm.id
					join programmaster pm on  pm.id =  se.program_id
					join centremaster cm on  cm.id =  se.centre_id 	
					join centre_director cd on  cm.id =  cd.centre_id
					join keywordmaster km on  km.id =  sm.status where 1=1
					";//where status='Y'
	/*	if($label)
			$getStudentsonrpoet .=" 
						where 1=1";
		else 
			$getStudentsonrpoet .= "where 1=1";*/
		//echo $getStudentsonrpoet;	
		
		
		return $getStudentsonrpoet;
		}
		
		function getProgramsforStudent($studentid){
		global $DB;
		$getProgramsforStudent ="select  se.program_id as id, pm.name as name, se.is_fasttrack
		 from  student_education  se join programmaster pm  ON se.program_id = pm.id 
		where  se.student_id= '{$studentid}'";
		$excuteProgramsforStudent  = $DB->getArray($getProgramsforStudent);
		return $excuteProgramsforStudent; 
		}
		
		function compareProgramsforUpdate($studentid,$arrNewPrograms){
			global $DB;
			$getProgramsforStudent ="select  se.program_id as id 
		 from  student_education  se join programmaster pm   ON se.program_id = pm.id 
		where  se.student_id= '{$studentid}'";
		$oldPrograms  = $DB->getArray($getProgramsforStudent);
		foreach($oldPrograms as $oldProgram)
		{
			$arrOldPrograms[] = $oldProgram[id];
		}
		 $arrDiffPrograms = array_diff($arrOldPrograms,$arrNewPrograms );
		return $arrDiffPrograms;
			
		}
		
}

?>