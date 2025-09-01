<?php 
include_once("class.phpmailer.php");

class onlineexam
{
	function sample_listassignedexamcourse()
	{
		global $DB;
		$samplelistSQL = "SELECT ae.id, ae.course_id, cm.code FROM sample_assign_exam ae join coursemaster cm on cm.id = ae.course_id WHERE ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Assigned')";
		
		$samplelistAssignedCourse = $DB->getArray($samplelistSQL);
		return $samplelistAssignedCourse;
	}
	
	function sample_getexamdetails($arrinput)
	{
		global $DB;
		
		$getSampleExamSQL = "SELECT ae.id,ae.course_id,cm.code as coursename,((cm.exam_duration_hour*60) + cm.exam_duration_minute) as totalexamduration ,ce.questiontype_id, qt.name as questiontype_name,qt.marks_per_question,ce.partition,ce.no_of_questions,ce.duration_minute,ae.exam_status,ae.examkey,ae.currenttiming FROM sample_assign_exam ae join coursemaster cm on cm.id = ae.course_id join course_exam ce on ce.course_id = ae.course_id join questiontype qt on qt.id = ce.questiontype_id where  ae.course_id={$arrinput[course_id]} and ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Assigned')";
		
		$getSampleExamDetails = $DB->getArray($getSampleExamSQL);
		return $getSampleExamDetails;
	}
	function sample_retrieveQuestionNew($usertestkey,$courseid)
	{
		global $DB;
		
		$retrieveQuestion = "select id,examkey,questions_assigned,position,currentquestion from sample_assign_exam where examkey = '$usertestkey' and course_id='$courseid'
 ";
	  			
		$execretrieveQuestion = $DB -> getArray($retrieveQuestion);
		
		return $execretrieveQuestion;
	}
	function listassignedexamcourse($studentid)
	{
		global $DB;
		$listSQL = "SELECT ae.id, ae.student_id, ae.course_id, cm.code FROM assign_exam ae join coursemaster cm on cm.id = ae.course_id WHERE cm.status ='Y' and ae.student_id = {$studentid} and (ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Assigned') or  ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Reassigned') or ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Processing')) order by ae.exam_date_starttime";
		
		$listAssignedCourse = $DB->getArray($listSQL);
		return $listAssignedCourse;
	}
	function getexamdetails($arrinput)
	{
		global $DB;
		$getExamSQL = "SELECT ae.id,ae.course_id,cm.code as coursename,((cm.exam_duration_hour*60) + cm.exam_duration_minute) as totalexamduration ,ce.questiontype_id, qt.name as questiontype_name,qt.marks_per_question,ce.partition,ce.no_of_questions,ce.duration_minute,ae.exam_date_starttime,ae.exam_date_endtime,DATE_FORMAT(ae.exam_date_starttime,'%d-%b-%Y %T') as start_date ,DATE_FORMAT(ae.exam_date_endtime,'%d-%b-%Y %T') as end_date,ae.exam_status,ae.examkey,ae.currenttiming FROM assign_exam ae join coursemaster cm on cm.id = ae.course_id join course_exam ce on ce.course_id = ae.course_id join questiontype qt on qt.id = ce.questiontype_id where ae.student_id = {$arrinput[student_id]} and ae.course_id={$arrinput[course_id]} and (ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Assigned') or  ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Reassigned') or ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Processing'))";
		
		 
		$getExamDetails = $DB->getArray($getExamSQL);
		return $getExamDetails;
	}
	function generateQuestion($arrquestiontype)
	{
		global $DB;
			
			$getquestions = "select qm.id from questionmaster  qm join question_course qc  on qm.id= qc.question_id   where qm.question_type_id = '{$arrquestiontype[id]}'  and qc.course_id = '{$arrquestiontype[courseid]}'   and qm.status = 'Y'";
			
		$execgetquestions = $DB -> Execute($getquestions);
		$questionArray = $this -> bindarray($execgetquestions,$arrquestiontype['no_of_questions']);
		for($i=0;$i<count($questionArray);$i++)
		{ $j= $i +1;
			$questionArray[$i][0]['postion'] = $j;
		}
		return $questionArray;
	}
	function querytoArray($questionDetail)
	{
		$i=0;
	
		while(!$questionDetail -> EOF)
		{
			
			$arrayOld[] = array('questionid' => $questionDetail -> fields['id']);
		
			$i++;
		
			$questionDetail -> MoveNext();
		}
		return $arrayOld;
	}
	
	function bindarray($questionDetail,$questioncount)
	{
		
		
		$arrayOld = $this -> querytoArray($questionDetail);
		
		$countQuest = count($arrayOld);
		if($countQuest<$questioncount)
		{
			$questioncount = $countQuest;
		}
		
		for($i = 0 ; $i < $questioncount ; $i++ )
		{
			
			$randomquest = rand(0,$countQuest);
			$counting = 0;
			for($j = 0; $j<=$i;$j++)
			{
				
				if($arrayNew[$j][0]['questionid'] == $arrayOld[$randomquest]['questionid'])
				{
				  $counting++;			
				}
			}
			if($counting == 0)
			{		
				$arrayNew[$i] = array($arrayOld[$randomquest]);
			}
			else
			{
				$i--;
			}
		}
		
		return $arrayNew;
	}
	function getQuestion($questionid,$position)
	{


		global $DB;
		$checkquestiontype = "select id from questiontype where id = (select question_type_id from questionmaster where id = {$questionid}) and controller_id 	=(select id from keywordmaster where code='controller' and value='multiple-choice')";

		
		$execcheckquestiontype = $DB->Execute($checkquestiontype);
		
		$getquestion = "select qm.id as questionid, qm.question, qm.answer, qm.question_type_id, qt.name as question_type_name, km.value as questiontype from questionmaster qm join questiontype qt on qt.id = qm.question_type_id join keywordmaster km on km.id = qt.controller_id where qm.status = 'Y' and qm.id = '$questionid'";


		
		
		$execgetquestion = $DB -> getArray($getquestion);
		
		if($execcheckquestiontype->fields['id'])
		{
			
			$getchoices = "select choice,answerindex from multiple_choice_answer  where  question_id = $questionid";
			$execgetchoices = $DB -> getArray($getchoices);
			$arrOptions = $this->arrayMultipleChoice($execgetchoices);
			$execgetquestion = array_merge($execgetquestion[0], $arrOptions);
			$arrayOld = $this -> querytoArrayMultipleChoice($execgetquestion);
			
			
		}
		else
		{
			$arrayOld = $execgetquestion;
		}
		$arrayOld[0]['position'] = $position;
		
		
		return $arrayOld;		
	}
	
	function getQuestionType($questionid,$position)
	{
		
		global $DB;
		$checkquestiontype = "select id from questiontype where id = (select question_type_id from questionmaster where id = {$questionid}) and controller_id 	=(select id from keywordmaster where code='controller' and value='multiple-choice')";
		$execcheckquestiontype = $DB->Execute($checkquestiontype);
		$getquestion = "select qm.id as questionid, qm.question_type_id, qt.name as question_type_name, km.value as questiontype from questionmaster qm join questiontype qt on qt.id = qm.question_type_id join keywordmaster km on km.id = qt.controller_id where qm.status = 'Y' and qm.id = '$questionid'";
		$execgetquestion = $DB -> getArray($getquestion);
			$arrayOld = $execgetquestion;		
		$arrayOld[0]['position'] = $position;
		return $arrayOld;		
	}
	function arrayMultipleChoice($multiplechoices)
	{
		$i = 1;
		foreach($multiplechoices as $option)
		{
			$arrChoices['choices'][$i]['choice'] = $option['choice'];
			$arrChoices['choices'][$i]['answerindex'] = $option['answerindex'];
			$i++;
		}
		return $arrChoices;
	}
	function querytoArrayMultipleChoice($questionDetail)
	{
		
		
			$arrayOld[] = array('questionid' => $questionDetail['questionid'],
									'question' => $questionDetail['question'],
									'answer' => $questionDetail['answer'],
									'question_type_id' => $questionDetail['question_type_id'],
									'questiontype' => $questionDetail['questiontype'],
									'question_type_name' => $questionDetail['question_type_name'],
									'choices' => $questionDetail['choices']);
									 
		
		

		return $arrayOld;
	}
	
	function getNewUniqueRef( )
	{

	$length = 10; //Excluding the starting letter
	$done = 0;
	while( ! $done )
	{
		$uniqueRef = "APAA-"; //Starting Letter "W"
		//srand( ( double ) microtime() * 1000000 );

		$data = "ABCDE123IJKLMN67QRSTUVWXYZ";
		$data .= "ABCDEFGHIJKLMN123OPQ45RS67TUV89WXYZ";
		$data .= "0FGH45OP89";

		for( $i = 0; $i < $length; $i++ )
		{
			$uniqueRef .= substr($data, (rand()%(strlen($data))), 1);
		}

		//echo $uniqueRef;

		if( ! $this->checkUniqueRefExists( $uniqueRef ))$done = 1;

	}

	return $uniqueRef;
	
	
}
	
	function checkUniqueRefExists( $uniqueRef ){
		global $DB;
		$sql = "select examkey from assign_exam where examkey='$uniqueRef'";								
		$result = $DB -> Execute($sql);		
		if( $result->_numOfRows != 0 )
			return true;
		else
			return false;
	}
	
	function updateExamBegin($assignid,$examkey,$questionsassigned,$position)
	{
		global $DB;
		
		$examstatusProgressSQL = "select id from keywordmaster where code='examstatus' and value='Processing'";
		
		$rsexamstatusid  = $DB->getArray($examstatusProgressSQL);
		$examstatusid = $rsexamstatusid[0][id];
		
		$datenow=time();
		$datetimenow=date("Y-m-d H:i:s",strftime($datenow));
		
		$beginexam = "update assign_exam set examkey = '$examkey',questions_assigned='$questionsassigned',exam_status='$examstatusid',exam_startdate='$datetimenow',position='$position' where id = $assignid";
			
		$execbeginexam = $DB -> Execute($beginexam);
		
		$gettestdetail = "select id,examkey from assign_exam where id = '$assignid' and examkey = '$examkey'";

		$execgettestdetail = $DB -> Execute($gettestdetail);
		
		return $execgettestdetail;
	}
	function getcoursecodebyid($courseid)
	{
		global $DB;
		$sql = "select 	code from coursemaster where id = {$courseid}";
		$rsCourseCode = $DB->getArray($sql);
		
		return $rsCourseCode[0][code];
	}
	function getAnswer($questionid)
	{
		global $DB;
		$getanswer = "select id,answer from questionmaster where id = '$questionid'";
		$execgetanswer = $DB -> Execute($getanswer);
		return $execgetanswer;
	}
	function insertExamDetails($arrexamdetails)
	{
		global $DB;
		$answerquery = "select answers from online_exam_details where assign_exam_id= {$arrexamdetails[assign_exam_id]} and  question_id =  {$arrexamdetails[question_id]}";
		
	$answer = $DB->getArray($answerquery);
	if(!$answer){
				 
		$insertexamdetails = "insert into online_exam_details (assign_exam_id,question_id,question_type_id,answers,mark,matchanswer) values ('{$arrexamdetails[assign_exam_id]}','{$arrexamdetails[question_id]}','{$arrexamdetails[question_type_id]}','{$arrexamdetails[answers]}','{$arrexamdetails[mark]}','{$arrexamdetails[matchanswer]}')";

		$execinsertexamdetails = $DB -> Execute($insertexamdetails);
		
		if($execinsertexamdetails)
		{
			return true;			
		}
		else
		{
			//echo $insertexamdetails;
			//exit;
			return false;
		}
			  }
	}
	function userTestComplete($usertestid)
	{
		global $DB;
		$examstatusCompletedSQL = "select id from keywordmaster where code='examstatus' and value='Completed'";
		
		$execstatusCompleted = $DB->getArray($examstatusCompletedSQL);
		$examstatusCompleted = $execstatusCompleted[0][id];
		$datenow=time();
		$datetimenow=date("Y-m-d H:i:s",strftime($datenow));
		
		
		$completetest = "update assign_exam set exam_status = '$examstatusCompleted',exam_completiondate = '$datetimenow' where id = $usertestid";
		$execcompletetest = $DB -> Execute($completetest);

		if($execcompletetest)
		{
			$this->mailExamCompletion($usertestid);
			return true;
		}
		else
		{
			return false;
		}		
	}
	function retrieveQuestionNew($userid,$usertestkey,$courseid)
	{
		global $DB;
		
		$retrieveQuestion = "select id,examkey,questions_assigned,position,currentquestion from assign_exam where student_id = '$userid'   and exam_status = (select id from keywordmaster where code = 'examstatus' and value='Processing') and course_id='$courseid'
 ";
	  					
		$execretrieveQuestion = $DB -> getArray($retrieveQuestion);
		
		return $execretrieveQuestion;
	}
	function getNextSetofQuestion($arrayfin){
		global $DB;
		$i=0;
		foreach ($arrayfin  as $value){
		if($value['questiontype'] == 'match-the-following') 
			{
				$matchthefollowingquestions[$i]= $value; $i++;
				
		}}
	
		$j=0;$k=1;
		foreach ($matchthefollowingquestions as $matchthefollowing ){
				$matchthefollowingquestions[$j][answercode] =$k;
				
				$matchthefollowingcorrectanswer[$matchthefollowing[questionid]] =$k;
				
				$matchthefollowinganswers[$j][answer] = $matchthefollowing[answer];
				$matchthefollowinganswers[$j][correctquestionid] = $matchthefollowing[questionid];
				$questiontypeid =$matchthefollowing[question_type_id];
				$j++;$k++;
		}
		
		shuffle($matchthefollowinganswers);
		$j=0;
		foreach ($matchthefollowingquestions as $matchthefollowing){
			
$arrquestion=$this->getQuestion($matchthefollowing[questionid],$matchthefollowing[position]);
			
			$matchthefollowinganswerstodisplay[$j][id] = $matchthefollowing[questionid];
			$matchthefollowinganswerstodisplay[$j][question] = $arrquestion[0][question];
			$matchthefollowinganswerstodisplay[$j][question_type_id] =$matchthefollowing[question_type_id];
			$matchthefollowinganswerstodisplay[$j][questiontype] = $matchthefollowing[questiontype];
			$matchthefollowinganswerstodisplay[$j][answer] = $arrquestion[0][answer];
			$matchthefollowinganswerstodisplay[$j][answercode] = $matchthefollowing[answercode];
			$matchthefollowinganswerstodisplay[$j][correctquestionid] = $matchthefollowinganswers[$j][correctquestionid];
			$j++;
		}
		$_SESSION['MatchQuestiontypeid'] = $questiontypeid;
		$_SESSION['MatchCorrectQuestAnswer']= $matchthefollowingcorrectanswer;
		return  $matchthefollowinganswerstodisplay ;
	}
	function getmatchcount($courseid,$questiontypeid)
	{
		global $DB;
		$matchcountsql = "select no_of_questions from course_exam where course_id={$courseid} and questiontype_id={$questiontypeid}";
		$rsmatchcount = $DB->getArray($matchcountsql);
		return $rsmatchcount[0]['no_of_questions'];
	}
	function mailExamCompletion($usertestid){
		global $DB;
		$getStudentDetail = "
		select sm.first_name,sm.last_name,sm.email_id,cm.code from assign_exam ae join coursemaster cm on cm.id = ae.course_id join studentmaster sm on sm.id = ae.student_id where ae.id = {$usertestid}";
		//echo $getStudentDetail;
		
		$studentDetail = $DB->getArray($getStudentDetail);
		
		    	$from = ADMIN_EMAIL;
					$to = $studentDetail[0]['email_id'];
					$subject ="Exam completion";
					 $message = '<br/>Dear '. $studentDetail[0]['first_name'].' '.$studentDetail[0]['last_name'].',';
					  $message .= "<br/>You have successfully completed the exam for the course ".$studentDetail[0]['code'].". The result will be published as soon as the evaluation has been completed and will be posted on your user panel. Please allow 4 to 6  weeks from completion of examination for the posting of your results.";
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>The Apaa Team.";  
					  $header = "From: Customer Support <".$from.">\r\n";
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
         		//mail($to, $subject, $message,  $header);
		}
			function answerforquestion( $usertestid ,$questionid){
				global $DB;
				$answerquery = "select answers  
				from online_exam_details ae
			  where assign_exam_id 	  = {$usertestid} and  question_id =  {$questionid}";
			  $answer = $DB->getArray($answerquery);
			  return $answer[0][answers];
	 
			}
				 function mailUniqueKey($arrDetails)
		{
			
					$from = ADMIN_EMAIL;
					$to = $arrDetails['email_id'];
					$subject ="Online exam Unique Key" ;
					 $message = '<br/>Dear '. $arrDetails['student_name'].',';
					  $message .= "<br/><br/>Your Unique exam Key is : ".$arrDetails['unique_key'];
					   $message .= "<br/>If any communications error occurs during this session, or you need to resume the assessment, you can login again and  return to the Online exam page, enter this Unique exam Key to continue incomplete exam, and begin where you left off.";
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>The Masc Team.";  
					  $header = "From: Customer Support <".$from.">\r\n";
					 $header .= 'MIME-Version: 1.0' . "\r\n";
					$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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
					//mail($to, $subject, $message,  $header);
		}
	function getstudentemail($studentid)
	{
		global $DB;
		$sqlEmail = "select email_id from studentmaster where id='{$studentid}'";
		$execSelect = $DB->Execute($sqlEmail);
		return $execSelect->fields[email_id];
		
	}
	
	function getquestiontypeid($questionid)
	{
		global $DB;
		$sqlEmail = "select question_type_id from questionmaster where id='{$questionid}'";
		$execSelect = $DB->getArray($sqlEmail);
		return $execSelect;
		
	}
	function getmatchanswer($questionid)
	{
		global $DB;
		$sqlanswer = "select answer from questionmaster where id='{$questionid}'";
		$execSelect = $DB->getArray($sqlanswer);
		return $execSelect;
		
	}

}



?>