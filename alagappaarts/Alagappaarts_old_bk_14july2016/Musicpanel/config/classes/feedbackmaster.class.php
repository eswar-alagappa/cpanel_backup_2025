<?php

class feedbackmaster
{    
     /*admin*/
	function getFeedbacklisting(){
		global $DB;
		$getFeedbackDetail ="select fb.id, subject , fb.student_id, sm.first_name, DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date, fb.status from feedback fb JOIN studentmaster sm ON sm.id=fb.student_id";
		//$excuteFeedback  = $DB->Execute($getFeedbackDetail);
		return $getFeedbackDetail; 
	}
	function SendReply($Feedbackid)
	{
		global $DB; 
		$getStudentquery ="select fb.id, fb.subject, fb.message, DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date, fb.reply, pm.name, sm.first_name from feedback fb JOIN student_education se ON fb.student_id=se.student_id JOIN studentmaster sm ON fb.student_id=sm.id JOIN programmaster pm ON se.program_id=pm.id  where fb.id=$Feedbackid";
    	$excuteFeedback  = $DB->Execute($getStudentquery);
		return $excuteFeedback;
	}
	function addAdminreply($arradminReply,$Feedbackid)
	{
		global $DB; 
		$update = "update feedback set reply = '{$arradminReply[reply]}', replied_on= '{$arradminReply[replied_on]}', replied_by='{$arradminReply[replied_by]}' , status='{$arradminReply[status]}' where id='{$Feedbackid}' ";
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
	function feedbackCount()
	{
		global $DB;
		$query="select status from feedback where status=(select id from keywordmaster where value ='unread' and code ='feedbackstatus')";
		$rsQuery = $DB -> getArray($query);
		$rsCount=count($rsQuery);
		return $rsCount; 
	}
	
	/*student*/
	
	function addStudentFeedback($arrFeedback){
		global $DB;
		$insert = "insert into feedback values('','{$arrFeedback[student_id]}','{$arrFeedback[subject]}','{$arrFeedback[message]}','{$arrFeedback[mailed_on]}','','','','{$arrFeedback[status]}')";
		$excuteInsert = $DB->Execute($insert);
		return true;
	}
	function getStudentFeedback($userid)
	{
		global $DB; 
		$getStudentFeedback ="select id, subject, DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date from feedback where student_id=$userid";
    	return $getStudentFeedback;
	}
	function getStudentFeedbackView($Feedbackid){
	global $DB;
		$getFeedbackinfo ="select subject, message ,DATE_FORMAT(mailed_on,'%d-%b-%Y') as mail_date, reply from feedback where id=$Feedbackid";
		$excuteFeedback  = $DB->Execute($getFeedbackinfo);
		return $excuteFeedback; 	
	}
	
}

?>