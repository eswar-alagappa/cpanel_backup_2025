<?php
class coursemaster
{
	function getcourses()
	{
		$getcourses = "select cm.id,cm.code, cm.name,cm.description,km.value as regulation from coursemaster cm join keywordmaster km on km.id = cm.regulation_id where km.code = 'regulation'";
		return $getcourses;
	}
	function getprograms()
	{  	global $DB;
		$getprograms = "select id,name from programmaster where status = 'Y'";
		$rsPrograms = $DB -> getArray($getprograms);
		return $rsPrograms;
		
	}
	function checkcourses($coursecode)
	{
		global $DB;
		$getcourses = "select id from coursemaster where code = '{$coursecode}'";
		$checkcourses = $DB->Execute($getcourses);
		$count = count($checkcourses->fields[0]);
		//echo $count ;
		return $count;
	}
	function addcourses($arrcourse)
	{
		global $DB;
	
		$sqlCourse = "insert into coursemaster (program_id, code, name, description, regulation_id, exam_attempt_limit, status, created_on, created_by, modified_by, modified_on,exam_duration_hour,exam_duration_minute) values ('{$arrcourse[program_id]}','{$arrcourse[code]}','{$arrcourse[name]}','{$arrcourse[description]}','{$arrcourse[regulation_id]}','{$arrcourse[exam_attempt_limit]}','{$arrcourse[status]}','{$arrcourse[created_on]}','{$arrcourse[created_by]}','{$arrcourse[modified_by]}','{$arrcourse[modified_on]}','{$arrcourse[exam_duration_hour]}','{$arrcourse[exam_duration_minute]}')";
		
		//$DB->Query($sqlCourse);
		$DB->Query($sqlCourse);
	$selectcourseid = "select cm.id, km.value as regulation from coursemaster cm join keywordmaster km on km.id = cm.regulation_id where cm.code='{$arrcourse[code]}'";
	$courseid = $DB->Execute($selectcourseid);
			$course_id = $courseid->fields[id];
			$regulation = $courseid->fields[regulation];
			
		if($course_id)
		{
			
		   if(strcmp($regulation,'Theory'))
		   {
			 
			foreach($arrcourse as $subkey=>$subarray)
			{	
				switch($subkey)
				{
					case 'partition':
					case 'questiontype_id':
					case 'no_of_questions':
					//case 'duration_minute':
					$i++;
					foreach($subarray as $key=>$value)
					{
					if($i==3)
					 $results[$key] .= $value;
					else
					  $results[$key] .= $value.',';
						
					}
	
				}
			}
				//print_r($results);
			
			
			if($results)
			{
				foreach($results as $rowkey=>$value)
				{
				 $insert = "insert into course_exam (course_id, partition,questiontype_id, no_of_questions)values((select id as course_id from coursemaster where code='{$arrcourse[code]}'),".$value.")";
				$DB->Execute($insert);
				}
			}
		   }
		}
		else
		{
			return false;
		}
		return true;	
	}
	function getcoursesbyid($courseid)
	{
		global $DB;
		$sqlCourse = "SELECT pm.name as program_name,pm.id as program_id, cm.code, cm.name, cm.description, km.value as regulation,km.id as regulation_id, cm.exam_attempt_limit, cm.status, cm.exam_duration_hour, cm.exam_duration_minute FROM coursemaster cm JOIN programmaster  pm on pm.id = cm.program_id JOIN keywordmaster  km on km.id = cm. regulation_id WHERE cm.id = {$courseid} AND km. code='regulation'";
		$rsCourse = $DB -> Execute($sqlCourse);
		return $rsCourse;
		
	}
	function getcourseexam($courseid)
	{
		global $DB;
		$sqlCourseexam = "SELECT QT.name as question_type,QT.id as questiontype_id, CE.id as courseexamid,CE.partition, CE.no_of_questions, CE.duration_minute FROM course_exam CE JOIN questiontype QT on QT.id = CE.questiontype_id WHERE CE.course_id = {$courseid} ORDER BY CE.partition";
		$rsCourseexam = $DB-> getArray($sqlCourseexam);
		return $rsCourseexam ;
	}
	function updatecourse($arrcourse)
	{
		global $DB;
		$sqlCourse = "UPDATE coursemaster set program_id = '{$arrcourse[program_id]}', code='{$arrcourse[code]}', name='{$arrcourse[name]}', description='{$arrcourse[description]}', regulation_id='{$arrcourse[regulation_id]}', exam_attempt_limit='{$arrcourse[exam_attempt_limit]}', status='{$arrcourse[status]}', modified_by='{$arrcourse[modified_by]}', modified_on='{$arrcourse[modified_on]}',exam_duration_hour='{$arrcourse[exam_duration_hour]}',exam_duration_minute='{$arrcourse[exam_duration_minute]}' where id='{$arrcourse[course_id]}'";
		$DB->Execute($sqlCourse);
		
		if($DB->Affected_Rows())
		{
			$delete = "delete from course_exam where course_id={$arrcourse[course_id]}";
			$DB->Execute($delete);
			foreach($arrcourse as $subkey=>$subarray)
			{	
				switch($subkey)
				{
					case 'partition':
					case 'questiontype_id':
					case 'no_of_questions':
					//case 'duration_minute':
					$i++;
					foreach($subarray as $key=>$value)
					{
					if($i==3)
					 $results[$key] .= $value;
					else
					  $results[$key] .= $value.',';
						
					}
		
				}
			}
			
			if(isset($results))
			{
							
			foreach($results as $rowkey=>$value)
			{
				 $insert = "insert into course_exam (course_id, partition, questiontype_id, no_of_questions)values((select id as course_id from coursemaster where code='{$arrcourse[code]}'),".$value.")";
				$DB->Execute($insert);
				
			}
			}
		return true;
		}
		else
		{
			return false;
		}
		}
		function getcourseprogram($programid)
		{
		global $DB;
		$getcourses = "select cm.id,cm.code,cm.name from coursemaster cm join keywordmaster km on km.id = cm.regulation_id  where cm.program_id={$programid} and cm.status='Y' and km.value='Theory'";
		$rsCourses = $DB -> getArray($getcourses);
		return $rsCourses;
			
		}
		function getprograms_havecourses()
		{ global $DB;
		$getprograms = "select distinct(pm.id),pm.name from programmaster pm join coursemaster cm on cm.program_id = pm.id where pm.status ='Y'";
		$rsPrograms = $DB -> getArray($getprograms);
		return $rsPrograms;
		
		}
}

?>