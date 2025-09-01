<?php 
class questionmaster
{
	function checkquestion($arrquestion)
	{
		global $DB;
		$checkquestion = "select id from questionmaster where question='{$arrquestion[question]}' and question_type_id={$arrquestion[question_type_id]}";
		$existquestion = $DB->Execute($checkquestion);
		$count = count($existquestion->fields[0]);
		//echo $count ;
		return $count;
	}
	function addquestion($arrquestion)
	{
		global $DB;
		$sqlInsert = '';
		switch($arrquestion['addfor'])
		{
			case 'match-the-following':
							
						 	$matchQuesCount = count($arrquestion['question']);
							$i=0;
							 foreach($arrquestion['question'] as $key=>$value)
							 {
								 $sqlCheckDuplicate = "select id from questionmaster WHERE question ='{$value}' AND question_type_id = {$arrquestion['question_type_id']}";
								
								 $rsDuplicate = $DB->getArray($sqlCheckDuplicate);
								 if(!$rsDuplicate)
								 {
								  $sqlInsert = "INSERT INTO questionmaster (question_type_id,question,answer,status,created_on,created_by,modified_on,modified_by) VALUES ('{$arrquestion['question_type_id']}','{$value}','{$arrquestion['answer'][$key]}','{$arrquestion['status']}','{$arrquestion['created_on']}','{$arrquestion['created_by']}','{$arrquestion['modified_on']}','{$arrquestion['modified_by']}')";
								  $executeInsert=$DB->Execute($sqlInsert);
								  $sqlLastID = "select max(id) as id from questionmaster where question='{$value}'";
										$lastInsertID = $DB->Execute($sqlLastID);
										$lastid =  $lastInsertID->fields[id];
								 }
								   if($lastid)
								   { 		
								   		foreach($arrquestion['courses'] as $coursekey=>$coursevalue)
											{
												$sqlCourseQuestion = "INSERT INTO question_course (question_id,course_id) VALUES ('{$lastid}','{$coursevalue}')";
												
												$DB->Execute($sqlCourseQuestion);
											}
										
										$i++;
									}
									
								  
							 }
							
							 if($matchQuesCount==$i)
								return true;
							 else
							 return false;
					
		 						break;
		 
			 case 'multiple-choice':
						
						 $sqlInsert = "INSERT INTO questionmaster (question_type_id,question,answer,status,created_on,created_by,modified_on,modified_by) VALUES ('{$arrquestion['question_type_id']}','{$arrquestion['question']}','{$arrquestion['answer']}','{$arrquestion['status']}','{$arrquestion['created_on']}','{$arrquestion['created_by']}','{$arrquestion['modified_on']}','{$arrquestion['modified_by']}')";
						
						$executeInsert=$DB->Execute($sqlInsert);
						
						 if(mysql_insert_id())
						{
							$sqlLastID = "select max(id) as id from questionmaster";
							$lastInsertID = $DB->Execute($sqlLastID);
							$lastid =  $lastInsertID->fields[id];
							
							if($lastid )
							{
								foreach($arrquestion['courses'] as $coursekey=>$coursevalue)
								{
									$sqlCourseQuestion = "INSERT INTO question_course (question_id,course_id) VALUES ('{$lastid}','{$coursevalue}')";
									
									$DB->Execute($sqlCourseQuestion);
								}
								
								foreach($arrquestion['multipleanswer'] as $answerkey=>$answervalue)
								{
									$sqlMultipleChoice = "INSERT INTO multiple_choice_answer (question_id,choice,answerindex) VALUES ('{$lastid}','{$answervalue}','{$answerkey}')";
									$DB->Execute($sqlMultipleChoice);
								}
							}
							return true;
						}
						else
						{
							return false;
						}
		
		 break;					
		 case 'true-false': 
		 case 'subjective':
		 case 'fill-blank':
				$sqlInsert = "INSERT INTO questionmaster (question_type_id,question,answer,status,created_on,created_by,modified_on,modified_by) VALUES ('{$arrquestion['question_type_id']}','{$arrquestion['question']}','{$arrquestion['answer']}','{$arrquestion['status']}','{$arrquestion['created_on']}','{$arrquestion['created_by']}','{$arrquestion['modified_on']}','{$arrquestion['modified_by']}')";
							
					$executeInsert=$DB->Execute($sqlInsert);
					 if(mysql_insert_id())
					{
						$sqlLastID = "select max(id) as id from questionmaster";
						$lastInsertID = $DB->Execute($sqlLastID);
						$lastid =  $lastInsertID->fields[id];
						if($lastid )
						{
							foreach($arrquestion['courses'] as $coursekey=>$coursevalue)
							{
								$sqlCourseQuestion = "INSERT INTO question_course (question_id,course_id) VALUES ('{$lastid}','{$coursevalue}')";
								
								$DB->Execute($sqlCourseQuestion);
							}
						}
						return true;
					}
					else
					{
						return false;
					}
		break;
		
		}
		
	}
	function updatequestion($arrquestion)
	{
		global $DB;
		$sqlUpdateQuestion = "UPDATE questionmaster set question = '{$arrquestion[question]}', answer='{$arrquestion[answer]}', status='{$arrquestion[status]}', modified_on='{$arrquestion[modified_on]}', modified_by='{$arrquestion[modified_by]}' where id='{$arrquestion[question_id]}'";
		$DB->Execute($sqlUpdateQuestion);
		if($DB->Affected_Rows())
		{
			$delete = "delete from question_course where question_id={$arrquestion[question_id]}";
			$DB->Execute($delete);
			foreach($arrquestion['courses'] as $coursekey=>$coursevalue)
			{
			$sqlCourseQuestion = "INSERT INTO question_course (question_id,course_id) VALUES ('{$arrquestion[question_id]}','{$coursevalue}')";
			$DB->Execute($sqlCourseQuestion);
			}
			if($arrquestion['addfor']=='multiple-choice')
			{
				$deleteMultipleAnswer = "delete from multiple_choice_answer where question_id={$arrquestion[question_id]}";
				$DB->Execute($deleteMultipleAnswer);
				foreach($arrquestion['multipleanswer'] as $answerkey=>$answervalue)
				{
				$sqlMultipleChoice = "INSERT INTO multiple_choice_answer (question_id,choice,answerindex) VALUES ('{$arrquestion[question_id]}','{$answervalue}','{$answerkey}')";
				$DB->Execute($sqlMultipleChoice);
				}
				
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	function viewquestion($questionid)
	{
		global $DB;
		
			$sqlQuestion = "select qm.id,qm.question,qm.answer,qm.status,qm.question_type_id,qtm.name as questiontype,(select count(course_id) from question_course where question_id = {$questionid}) as coursecount,km.value as controllid  from questionmaster qm join questiontype qtm on qtm.id = qm.question_type_id join keywordmaster km on km.id = qtm.controller_id where qm.id={$questionid}";
		
		$rsQuestion = $DB -> Execute($sqlQuestion);
		return $rsQuestion;
		
	}
	function getquestioncourse($questionid)
	{
		
		global $DB;
		$sqlCourseQuestion = "SELECT cm.code,qc.course_id FROM question_course qc join coursemaster cm on cm.id = qc.course_id WHERE qc.question_id={$questionid}";
		$rsCourseQuestion = $DB-> getArray($sqlCourseQuestion);
		return $rsCourseQuestion;
	}
	
	function getmultipleanswers($questionid)
	{
		
		global $DB;
		$sqlMultipleAnswer = "SELECT choice,answerindex FROM multiple_choice_answer WHERE question_id={$questionid}";
		$rsMultipleAnswer = $DB-> getArray($sqlMultipleAnswer);
		return $rsMultipleAnswer;
	}
	function listquestions()
	{
		$getqusetions = "select qm.id,qm.question,qm.status, qtm.name as questiontype from questionmaster qm join questiontype qtm on qtm.id = qm.question_type_id where 1=1";
		return $getqusetions;
	}
}
?>