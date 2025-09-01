<?php 
include_once('spmaster.class.php');

class onlineexamquestions
{
public static function examquestions($userid,$courseid,$queid,$quetypeid,$answers,$inc,$key,$seconds,$assignedexamID)
	{
	if($quetypeid==3){
	$answers='';
	}
	else
	{
	$answers=$answers;
	}
	//echo "CALL Bind_Exam_questions('".$userid."','".$courseid."','".$queid."','".$quetypeid."','".$answers."','2','".$key."','".$seconds."','".$assignedexamID."')";exit;
		return spmaster::GetArray("CALL Bind_Exam_questions('".$userid."','".$courseid."','".$queid."','".$quetypeid."','".$answers."','2','".$key."','".$seconds."','".$assignedexamID."')");
		
	}
	
public static function inserttempquestions($userid,$courseid,$assignedexamid)
	{
		//echo "CALL Temp_question_Insert('".$userid."','".$courseid."','".$assignedexamid."')";exit;
		spmaster::InsertSQL("CALL Temp_question_Insert('".$userid."','".$courseid."','".$assignedexamid."')");
	}
	
	public static function getanswersmatch($userid,$courseid)
	{
		//echo "SELECT (SELECT answer FROM questionmaster WHERE id=tq.QuestionID) FROM tbl_temp_questions tq WHERE tq.Question_Type='3' AND StudentID='".$userid."' AND CourseID='".$courseid."' ORDER BY RAND()";exit;
		return spmaster::GetArray("SELECT QuestionID as correctqueid,(SELECT answer FROM questionmaster WHERE id=tq.QuestionID) as answers FROM tbl_temp_questions tq WHERE tq.Question_Type='3' AND StudentID='".$userid."' AND CourseID='".$courseid."' ORDER BY RAND()");
	}
	
	public static function getcoursecodebyid($courseid)
	{
		//echo "SELECT (SELECT answer FROM questionmaster WHERE id=tq.QuestionID) FROM tbl_temp_questions tq WHERE tq.Question_Type='3' AND StudentID='".$userid."' AND CourseID='".$courseid."' ORDER BY RAND()";exit;
		return spmaster::ReturnSQL("SELECT (SELECT answer FROM questionmaster WHERE id=tq.QuestionID) FROM tbl_temp_questions tq WHERE tq.Question_Type='3' AND StudentID='".$userid."' AND CourseID='".$courseid."' ORDER BY RAND()");
	}
	
	public static function updateanswers($userid,$courseid,$rowID,$typeID)
	{
		if($rowID=='' && $typeID=='3')
		{
			spmaster::InsertSQL("UPDATE tbl_temp_questions SET IsAttend='1' WHERE Question_Type='".$typeID."' AND StudentID='".$userid."' AND CourseID='".$courseid."'");
		}
		else
		{
		spmaster::InsertSQL("UPDATE tbl_temp_questions SET IsAttend='1' WHERE ID='".$rowID."' AND StudentID='".$userid."' AND CourseID='".$courseid."'");
		}
	}
	public static function getexamdetails($courseid,$userid)
	{
		//echo "SELECT ae.id,ae.course_id,cm.code as coursename,((cm.exam_duration_hour*60) + cm.exam_duration_minute) as totalexamduration ,ce.questiontype_id, qt.name as questiontype_name,qt.marks_per_question,ce.partition,ce.no_of_questions,ce.duration_minute,ae.exam_date_starttime,ae.exam_date_endtime,DATE_FORMAT(ae.exam_date_starttime,'%d-%b-%Y %T') as start_date ,DATE_FORMAT(ae.exam_date_endtime,'%d-%b-%Y %T') as end_date,ae.exam_status,ae.examkey,ae.currenttiming FROM assign_exam ae join coursemaster cm on cm.id = ae.course_id join course_exam ce on ce.course_id = ae.course_id join questiontype qt on qt.id = ce.questiontype_id where ae.student_id = '".$userid."' and ae.course_id='".$courseid."' and (ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Assigned') or  ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Reassigned') or ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Processing'))";exit;
		return spmaster::GetArray("SELECT ae.id,ae.course_id,cm.code as coursename,((cm.exam_duration_hour*60) + cm.exam_duration_minute) as totalexamduration ,ce.questiontype_id, qt.name as questiontype_name,qt.marks_per_question,ce.partition,ce.no_of_questions,ce.duration_minute,ae.exam_date_starttime,ae.exam_date_endtime,DATE_FORMAT(ae.exam_date_starttime,'%d-%b-%Y %T') as start_date ,DATE_FORMAT(ae.exam_date_endtime,'%d-%b-%Y %T') as end_date,ae.exam_status,ae.examkey,ae.currenttiming FROM assign_exam ae join coursemaster cm on cm.id = ae.course_id join course_exam ce on ce.course_id = ae.course_id join questiontype qt on qt.id = ce.questiontype_id where ae.student_id = '".$userid."' and ae.course_id='".$courseid."' and (ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Assigned') or  ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Reassigned') or ae.exam_status = (select id from keywordmaster where code='examstatus' and value='Processing'))");
	}
	
	public static function updateallvalues($userid,$courseid,$key,$typeID,$queid,$seconds,$answers)
	{
	//echo "CALL updateallvalues('".$userid."','".$courseid."','".$key."','".$typeID."','".$queid."','".$seconds."','".$answers."')";exit;
		spmaster::InsertSQL("CALL updateallvalues('".$userid."','".$courseid."','".$key."','".$typeID."','".$queid."','".$seconds."','".$answers."')");
	}
	public static function insertExamDetails($arrexamdetails)
	{
		
		spmaster::InsertSQL("CALL InsertMatchdetails('".$arrexamdetails["key"]."','".$arrexamdetails["question_id"]."','".$arrexamdetails["question_type_id"]."','".$arrexamdetails["answers"]."','".$arrexamdetails["mark"]."','".$arrexamdetails["matchanswer"]."')");
		
			  
	}
	}
	?>