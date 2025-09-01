<?php
include_once("class.phpmailer.php");

class centremaster
{
	function checkcentre($arrcentre)
	{
		global $DB;
		$centrename  = $arrcentre[academy_name];
		$checkcentrename = "select academy_name from centremaster where academy_name='$centrename'";
		$checkcentrenamers = $DB->Execute($checkcentrename);
		$count = count($checkcentrenamers->fields[0]);
		//echo $count ;
		return $count;
	}
	
	function addcentre($arrcentre){
		global $DB;
		$insert = "insert into centremaster values('','{$arrcentre[centreid]}','{$arrcentre[academy_name]}','{$arrcentre[address]}','{$arrcentre[city]}','{$arrcentre[state]}',
		'{$arrcentre[country]}','{$arrcentre[zipcode]}','{$arrcentre[email_id]}','{$arrcentre[website]}','{$arrcentre[contact]}',
		'{$arrcentre[alternate_contact]}','{$arrcentre[year_of_establishment]}','{$arrcentre[no_of_arangetram]}','{$arrcentre[status]}',
		'{$arrcentre[created_on]}','{$arrcentre[created_by]}','{$arrcentre[modified_by]}','{$arrcentre[modified_on]}')";
		$excuteInsert = $DB->Execute($insert);
		if($excuteInsert){
			$getLastinsertedIdquery = "select max(id) as id from centremaster";
			$getLastinsertedId = $DB->Execute($getLastinsertedIdquery);
		}
		$lastid =  $getLastinsertedId->fields[id];
		$insertstudent_enrollmentid = "insert into student_enrollmentid  values('','{$lastid}','501','500')";
		 $DB->Execute($insertstudent_enrollmentid);
		return $lastid ;
	}
	function addDirectordetail($arrcentredirector){
		global $DB;
		$insert = "insert into centre_director values('','{$arrcentredirector[centre_id]}','{$arrcentredirector[director_name]}','{$arrcentredirector[director_dob]}','{$arrcentredirector[address]}',
		'{$arrcentredirector[city]}','{$arrcentredirector[state]}','{$arrcentredirector[country]}','{$arrcentredirector[zipcode]}','{$arrcentredirector[email_id]}',
		'{$arrcentredirector[special_qualification]}','{$arrcentredirector[bharathanatyam_experience]}','{$arrcentredirector[events_performed]}','{$arrcentredirector[awards_title]}',
		'{$arrcentredirector[ballets_choreographed]}','{$arrcentredirector[name_of_guru]}','{$arrcentredirector[guru_location]}','{$arrcentredirector[other_info]}')";
		$excuteInsert = $DB->Execute($insert);
		return true;
	}
	function getcentres($arrCentre)
	{
		$getcentres ="select cm.id,cm.centreid ,cm.academy_name,cm.email_id,cd.director_name from centremaster cm  JOIN centre_director cd ON cm.id = cd.centre_id ";//where status='Y'
		return $getcentres;
	}
	function getcentredetails($centreid)
	{
		global $DB;
		$getcentre ="select *,cd.address as directorAdress,cd.city as directorCity,cd.state as directorState,cd.country as directorCountry,cd.zipcode as directorZipcode,
						cd.email_id as directorEmail_id  ,cm.email_id as centreEmail_id from centremaster cm  JOIN centre_director cd ON cm.id = cd.centre_id where cm.id=$centreid";
		$excuteCentre  = $DB->Execute($getcentre);
		return $excuteCentre; 
	}
	function updatecentre($arrcentre){
		global $DB;
		$update = "update centremaster set  academy_name= '{$arrcentre[academy_name]}',centreid= '{$arrcentre[centreid]}', address='{$arrcentre[address]}',city='{$arrcentre[city]}', state ='{$arrcentre[state]}',
					country ='{$arrcentre[country]}', zipcode='{$arrcentre[zipcode]}', email_id = '{$arrcentre[email_id]}',
					website ='{$arrcentre[website]}', contact='{$arrcentre[contact]}', alternate_contact = '{$arrcentre[alternate_contact]}',
					year_of_establishment ='{$arrcentre[year_of_establishment]}', no_of_arangetram='{$arrcentre[no_of_arangetram]}',
					modified_by='{$arrcentre[modified_by]}', modified_on='{$arrcentre[modified_on]}'  , status= '{$arrcentre[status]}'
					where  id ='{$arrcentre[id]}' ";
				//	echo $update ;exit;
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
	function updateDirectordetail($arrcentredirector){
		global $DB;
		$update = "update centre_director set  director_name= '{$arrcentredirector[director_name]}',address='{$arrcentredirector[address]}',city='{$arrcentredirector[city]}',
		             state ='{$arrcentredirector[state]}',country ='{$arrcentredirector[country]}', zipcode='{$arrcentredirector[zipcode]}', email_id = '{$arrcentredirector[email_id]}',
					director_dob ='{$arrcentredirector[director_dob]}', special_qualification='{$arrcentredirector[special_qualification]}',
					 bharathanatyam_experience = '{$arrcentredirector[bharathanatyam_experience]}',events_performed ='{$arrcentredirector[events_performed]}', 
					 awards_title='{$arrcentredirector[awards_title]}',ballets_choreographed ='{$arrcentredirector[ballets_choreographed]}',
					 name_of_guru ='{$arrcentredirector[name_of_guru]}',guru_location ='{$arrcentredirector[guru_location]}',other_info ='{$arrcentredirector[other_info]}'
					 where  centre_id='{$arrcentredirector[centre_id]}' ";
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
	function approveCentre($arrcentreApproval){
		global $DB;
		$update = "update centremaster set   centreid 	= '{$arrcentreApproval[centreid]}', status  = '{$arrcentreApproval[status]}'
					 where id='{$arrcentreApproval[id]}' ";
		$excuteUpdate = $DB->Execute($update);
		return true;
		
	}
	function getcentrenames()
	{
		global $DB;
		$getCentrename ="select id,academy_name from centremaster where status  ='Y' order by academy_name asc";
		$excuteCentrename  = $DB->Execute($getCentrename);
		return $excuteCentrename;
	}
	function getCountries(){
		global $DB;
		$getCountries ="SELECT distinct(country) FROM centremaster";
		$excuteCountries  = $DB->Execute($getCountries);
		return $excuteCountries;
	}
	function centerStats()
		{
			global $DB;
			$studentCountSQL = "select count(id) as totalcenter,(select count(id) from centremaster where status='Y') as activecenter, (select count(id) from centremaster where status='N' )as inactivecenter from centremaster";
			$rsCount = $DB->getArray($studentCountSQL);
			return $rsCount[0];
			
		}
		function resetPassword($centreid,$loginid){
			global $DB;
			$mysql_datetime = date('Y-m-d H:i:s');
			$isCenterinlogintable = "select id  from loginmaster where role_id=(select id from rolemaster where rolename='Center' ) and user_id 	= '{$centreid}'";
			$rsCount = $DB->getArray($isCenterinlogintable);
			 $random_id_length = 10;
						$rnd_id = crypt(uniqid(rand(),1)); 
						$rnd_id = strip_tags(stripslashes($rnd_id)); 
						$rnd_id = str_replace(".","",$rnd_id); 
						$rnd_id = strrev(str_replace("/","",$rnd_id)); 
						$rnd_id = substr($rnd_id,0,$random_id_length); 
						$password =md5($rnd_id);
			 if($rsCount[0][id] )
			 {
				 $updatePassword = "update loginmaster set  password  = '{$password}'  ,modified_by ='{$loginid}' , 
				 modified_on = '$mysql_datetime' , ip_address ='{$_SERVER['REMOTE_ADDR']}' where user_id  = '{$centreid}' and role_id=(select id from rolemaster where rolename='Center' )";
				$DB->Execute($updatePassword);
				//echo $updatePassword; exit;
				//echo  $updatePassword;
			}else 
			{
				$Centerusername = "select centreid  from centremaster where  id = '{$centreid}'";
				$rsCenterusername = $DB->getArray($Centerusername);
				$centername = $rsCenterusername[0][centreid];
				$inserLogindetail = "insert into  loginmaster values ('',$centreid,'{$centername}','{$password}',(select id from rolemaster where rolename='Center'),'Y','{$loginid}',
				'$mysql_datetime','{$_SERVER['REMOTE_ADDR']}')";
				//echo $inserLogindetail; exit;
				$DB->Execute($inserLogindetail);
				}
			
				
				$centredetail  = $this->getcentredetails($centreid);
				$username = $centredetail->fields[centreid];
			$from=ADMIN_EMAIL;
					$to =  $centredetail->fields[centreEmail_id];
					$subject = "Apaa User Credentials";
					 $message = "Geetings from APAA.<br/><br/>

							We have changed your center section access as below<br/><br/>
							
							Username: {$username }<br/>
							Password: {$rnd_id }<br/><br/>
							
							You can login in the below URL and check your online exam schedules, exam results, online fees payment.<br/>
							http://alagappaarts.com/dance/center-log-in/<br/><br/>
							
							If the above link is not working, Please copy and paste the link  into new browser window.<br/>
							<br/>
							
							";  
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>Apaa Team.";  
					  $header = "From: Customer support <".$from.">\r\n";
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
				 /*$mail = new PHPMailer();  
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
         	/*	if (mail($to, $subject, $message,  $header) )
					return  true;
					else
				return false;*/
		 
		}
		function getRecentExamResult(){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,km1.value as result,km2.value as grade,
               (select SUM(oed.mark) from  online_exam_details  oed  
                 join assign_exam ae1 on oed.assign_exam_id =  ae1.id  
                         where oed.assign_exam_id = ae.id  )as total_mark from
               assign_exam  ae  join coursemaster cm  on  cm.id=ae.course_id  
               join keywordmaster km1 on km1.id= ae.result          
               join keywordmaster km2  on km2.id= ae.grade
               where  ae.student_id = {$student_id}
                and ae.exam_status= (select id from  keywordmaster where code ='examstatus' and value='Completed') and ae.publish='Y' and ae.id IN (SELECT max(id) from assign_exam GROUP BY course_id)";
			
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function getExamschedule($centerid)
		{
		global $DB;
		$getexams ="select distinct(ase.id), ase.student_id, ase.course_id,cm.code,cm.id as courseid, DATE_FORMAT(ase.exam_date_starttime,'%d-%b-%Y') as startDate ,     																        DATE_FORMAT(ase.exam_date_endtime,'%d-%b-%Y')  	as endDate,sm.first_name , sm.last_name ,pm.name from assign_exam   ase
		JOIN coursemaster cm ON ase.course_id=cm.id 
		JOIN studentmaster sm ON ase.student_id =sm.id 
		JOIN student_education se ON ase.student_id = se.student_id
		JOIN programmaster pm ON cm.program_id  = pm.id
		where  ase.result =(select id from keywordmaster where code='result' and value='Unpublished')
		and (ase.exam_status =(select id from keywordmaster where code='examstatus' and value='Processing')
		or ase.exam_status =(select id from keywordmaster where code='examstatus' and value='Assigned') or
		ase.exam_status =(select id from keywordmaster where code='examstatus' and value='Reassigned')) and se.centre_id = {$centerid} 
		order by startDate desc ";
		
		return $getexams;
		}
		function getPaymentDetail($centerid)
		{
		global $DB;
		$getpaymentinfo = "select pm.name , km.value as paymentoption , DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , sp.amount ,kp.value as paymentmode ,ks.value as paymentstatus			        ,sm.first_name,sm.last_name from student_payment sp 
		join studentmaster sm on  sp.student_id  =  sm.id
		join programmaster pm on  sp.program_id  =  pm.id
		join keywordmaster km on sp.payment_option_id =  km.id
		join student_education se on se.student_id  =  sp.student_id  and se.program_id  =   sp.program_id 
		join keywordmaster 	 kp on sp.payment_mode_id =  kp.id 
		join keywordmaster ks on sp.payment_status_id  =  ks.id
		where se.centre_id = {$centerid}  and sp.payment_status_id = (select id from keywordmaster where code = 'paymentstatus' and value ='Done')
		order by sp.id  desc";
	
		
		$excutePaymentInfo  = $DB->getArray($getpaymentinfo);
		return $excutePaymentInfo; 
		}
		function getExamResult($centerid){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,km1.value as result,km2.value as grade,sm.first_name,sm.last_name,pm.name  as programenrolled,
				 DATE_FORMAT(ae.exam_startdate,'%d-%b-%Y')  	as examstartDate , DATE_FORMAT(ae.exam_completiondate ,'%d-%b-%Y')  	as examendDate,
               (select SUM(oed.mark) from  online_exam_details  oed  
                 join assign_exam ae1 on oed.assign_exam_id =  ae1.id  
                         where ae1.student_id = ae.student_id  and oed.assign_exam_id = ae.id  )as total_mark from
               assign_exam  ae
			   join coursemaster cm  on  cm.id=ae.course_id  
			   join student_education se  on  se.student_id =ae.student_id   
               join keywordmaster km1 on km1.id= ae.result          
               join keywordmaster km2  on km2.id= ae.grade
			   join studentmaster sm on  ae.student_id  =  sm.id
			   join programmaster pm on  cm.program_id  =  pm.id
               where  se.centre_id ={$centerid} and
                 ae.exam_status= (select id from  keywordmaster where code ='examstatus' and value='Completed') and ae.publish='Y' ORDER BY ae.id DESC";
				//echo $getStudentMarkDetail ;
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function getExamscheduleview($centerid)
		{
		global $DB;
		$getexams ="select distinct(ase.id), ase.student_id, ase.course_id,cm.code,cm.id as courseid, DATE_FORMAT(ase.exam_date_starttime,'%d-%b-%Y') as startDate ,     																        DATE_FORMAT(ase.exam_date_endtime,'%d-%b-%Y')  	as endDate,sm.first_name , sm.last_name ,pm.name ,km.value as examstatus,se.enrollment_id   from assign_exam   ase
		JOIN coursemaster cm ON ase.course_id=cm.id 
		JOIN studentmaster sm ON ase.student_id =sm.id 
		JOIN student_education se ON ase.student_id = se.student_id
		JOIN programmaster pm ON cm.program_id  = pm.id
		JOIN keywordmaster km ON ase.exam_status=km.id
		where  se.centre_id = {$centerid} 
			 ";
		//echo $getexams ;
		return $getexams;
		}
		function getPaymentDetailonView($centerid)
		{
		global $DB;
		$getpaymentinfo = "select sp.id,pm.name , km.value as paymentoption , DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , sp.amount ,kp.value as paymentmode ,ks.value as paymentstatus			        ,sm.first_name,sm.last_name from student_payment sp 
		join studentmaster sm on  sp.student_id  =  sm.id
		join programmaster pm on  sp.program_id  =  pm.id
		join keywordmaster km on sp.payment_option_id =  km.id
		join student_education se on se.student_id  =  sp.student_id  and se.program_id  =   sp.program_id 
		join keywordmaster 	 kp on sp.payment_mode_id =  kp.id 
		join keywordmaster ks on sp.payment_status_id  =  ks.id
		where se.centre_id = {$centerid}  
		";
	
		
		//$excutePaymentInfo  = $DB->getArray($getpaymentinfo);
		return $getpaymentinfo ; 
		}
		function getExamResultonview($centerid){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,km1.value as result,km2.value as grade,sm.first_name,sm.last_name,pm.name  as programenrolled,
				 DATE_FORMAT(ae.exam_startdate,'%d-%b-%Y')  as examstartDate , DATE_FORMAT(ae.exam_completiondate ,'%d-%b-%Y')  	as examendDate,
               (select SUM(oed.mark) from  online_exam_details  oed  
                 join assign_exam ae1 on oed.assign_exam_id =  ae1.id  
                         where ae1.student_id = ae.student_id  and oed.assign_exam_id = ae.id  )as total_mark from
               assign_exam  ae
			   join coursemaster cm  on  cm.id=ae.course_id  
			   join student_education se  on  se.student_id =ae.student_id   
               join keywordmaster km1 on km1.id= ae.result          
               join keywordmaster km2  on km2.id= ae.grade
			   join studentmaster sm on  ae.student_id  =  sm.id
			   join programmaster pm on  cm.program_id  =  pm.id
               where  se.centre_id ={$centerid} and
                 ae.exam_status= (select id from  keywordmaster where code ='examstatus' and value='Completed') and ae.publish='Y' ";
				//echo $getStudentMarkDetail ;
		//$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $getStudentMarkDetail;
		}
		function getStudentPayment($studentarray){
			global $DB;
		
			$getStudentdPayment ="select sp.amount ,km.value as paymentmode, km2.value as paymentoption, DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , km1.value as paymentstatus 
			,sp.comments , pm.name as programname , pm.total_fee  as programfee,
			(select transaction_no  from payment_paypal where payment_id = sp.id) as transaction_no, 
			(select check_no from payment_check where payment_id=sp.id) as check_no 
			from student_payment sp 
			join keywordmaster km on km.id=sp.payment_mode_id
			 join keywordmaster km1 on km1.id=sp.payment_status_id 
			join keywordmaster km2 on km2.id=sp.payment_option_id 
			 join programmaster pm on pm.id=sp.program_id 
			  where sp.student_id= '{$studentarray[student_id]}'   ";
			
			$excuteStudentdPayment = $DB->getArray($getStudentdPayment);
			return $excuteStudentdPayment;
		}
		function getStudentMarkDetail($studentarray){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,cm.regulation_id ,km.value as regulation,km1.value as result,km2.value as grade,km3.value  as examstatus,
		ae.publish,
		(select SUM(oed.mark) from  online_exam_details  oed  
		  join assign_exam ae1 on oed.assign_exam_id =  ae1.id   
		  	where ae1.student_id = {$studentarray[student_id]}   and oed.assign_exam_id = ae.id  )as total_mark from 
		assign_exam  ae  join coursemaster cm  on  cm.id=ae.course_id  
		join keywordmaster km on km.id= cm.regulation_id 
		join keywordmaster km1 on km1.id= ae.result 	 
		join keywordmaster km2  on km2.id= ae.grade 
		join keywordmaster km3  on km3.id= ae.exam_status 
		where  ae.student_id = {$studentarray[student_id]} 
		 ";
		//echo 	$getStudentMarkDetail;
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
}

?>