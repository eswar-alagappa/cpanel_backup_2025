<?php
include_once("class.phpmailer.php");

class exammaster
{
			function getStudentdetailsforProg($studentarray){
			global $DB;
		
			$getStudentDetail ="select sm.first_name , sm.last_name ,se.enrollment_id ,DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as enrollment_date ,cm.academy_name,pm.id as programid, pm.name, pm.total_fee,se.graduation_status, se.graduation_status_comments ,DATE_FORMAT(se.completion_date,'%m/%d/%Y') as completion_date ,se.grade,km.value as programgrade  from  student_education   se  join  studentmaster sm on sm.id=se.student_id 
			 join programmaster pm on se.program_id = pm.id join centremaster cm on cm.id =se.centre_id 
			 left join keywordmaster km on km.id= se.grade
			        where se.student_id= '{$studentarray[student_id]}' and se.program_id = '{$studentarray[program_id]}' ";
					
			
			$excuteStudentDetail= $DB->getArray($getStudentDetail);
			return $excuteStudentDetail;
		}
		function getStudentdPayment($studentarray){
			global $DB;
		
			$getStudentdPayment ="select sp.amount ,km.value as paymentmode, km2.value as paymentoption, DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on , km1.value as paymentstatus 
			,sp.comments ,
			(select transaction_no  from payment_paypal where payment_id = sp.id) as transaction_no, 
			(select check_no from payment_check where payment_id=sp.id) as check_no 
			from student_payment sp join keywordmaster km on km.id=sp.payment_mode_id join keywordmaster km1 on km1.id=sp.payment_status_id 
			join keywordmaster km2 on km2.id=sp.payment_option_id 
			  where sp.student_id= '{$studentarray[student_id]}' and sp.program_id = '{$studentarray[program_id]}' ";
			
			$excuteStudentdPayment = $DB->getArray($getStudentdPayment);
			return $excuteStudentdPayment;
		}
		function getCoursesforstudent($studentarray){
			global $DB;
		
			$getCourses = "select cm.id ,cm.code from coursemaster  cm 
			where cm.program_id ={$studentarray[program_id]}  and cm.status='Y'  and cm.id  not in (select course_id from assign_exam where  student_id ={$studentarray[student_id]}) and 
			cm.regulation_id  =(select id from keywordmaster where code ='regulation' and value ='Theory')";
			
			$excuteCourses = $DB->getArray($getCourses);
			return $excuteCourses;
		}
		function getProgramsforStudent($studentid){
		global $DB;
		$getProgramsforStudent ="select  se.program_id as id,	pm.name as name
		 from  student_education  se join programmaster pm   ON se.program_id = pm.id 
		where  se.student_id= '{$studentid}'";
		$excuteProgramsforStudent  = $DB->getArray($getProgramsforStudent);
		
		return $excuteProgramsforStudent; 
		}
		
		function assignexam($arrassginExams){
		
		global $DB;
		
  		foreach ($arrassginExams['assignExam'] as $arrassginExam){
			if(isset($arrassginExam[ddlcourse]) && $arrassginExam[txtschdate1] != "" && $arrassginExam[txtschdate2] != ""){
				$from =date('Y-m-d', strtotime($arrassginExam['txtschdate1']));
						$to =date('Y-m-d', strtotime($arrassginExam['txtschdate2']));
		$insert = "insert into assign_exam (student_id ,course_id ,exam_date_starttime,exam_date_endtime,no_of_attempt,exam_status,result,grade,publish
		) values('{$arrassginExams[student_id]}','{$arrassginExam[ddlcourse]}','{$from}','{$to}','1',
		(select id from keywordmaster where value='Assigned' and code = 'examstatus'),(select id from keywordmaster where value='Unpublished' and code = 'result')
		,(select id from keywordmaster where value='O' and code = 'grade'),'N');";
		
		$excuteInset = $DB->Execute($insert);
		$arrassginExam['student_id']=$arrassginExams[student_id];
		$this->mailAssignExam($arrassginExam);
			}
		}
	
		return true;
		}
		function getexamassignedCourses($studentarray){
			global $DB;
		
			$getexamassignedCourses ="select ae.id, ae.course_id ,cm.code, DATE_FORMAT( ae.exam_date_starttime,'%m/%d/%Y')  as exam_date_starttime
			,DATE_FORMAT( ae.exam_date_endtime,'%m/%d/%Y')  as exam_date_endtime from assign_exam ae 
			join  coursemaster  cm on  cm.id= ae.course_id 
			where cm.program_id ={$studentarray[program_id]} and ae.student_id 	= {$studentarray[student_id]} 
			and ae.exam_status =((select id from  keywordmaster where code ='examstatus' and value='Assigned' )) and ae.publish ='N' 
			and ae.result =  (select id from  keywordmaster where code ='result' and value='Unpublished') ";
			$excuteCourses = $DB->getArray($getexamassignedCourses);
			return $excuteCourses;
		
		}
		function updateassignexam($arrexistingvalues){
		global $DB;
		
  		foreach ($arrexistingvalues['existingvalue'] as $key =>$arrexistingvalue){
			if(isset($arrexistingvalue[course]) && $arrexistingvalue[txtschdate1] != "" && $arrexistingvalue[txtschdate2] != ""){
				$from =date('Y-m-d', strtotime($arrexistingvalue['txtschdate1']));
						$to =date('Y-m-d', strtotime($arrexistingvalue['txtschdate2']));
		$update = "update  assign_exam set  exam_date_starttime ='{$from}',
		exam_date_endtime = '{$to}'  where student_id  = {$arrexistingvalues[student_id]} and  course_id = {$arrexistingvalue[course]} and id={$key};";
		$excuteupdate = $DB->Execute($update);
		
			}
		}
	
		return true;
		}
		
		function getCourseforonlineexammark($studentid){
			global $DB;
		$getcourseforStudent ="select  ae.course_id as id,	cm.code as code ,ae.id as examid ,ae.exam_startdate ,ae.exam_completiondate 
		 from  assign_exam ae join coursemaster  cm    ON ae.course_id = cm.id 
		where  ae.student_id= '{$studentid}' and ae.exam_status =( (select id from  keywordmaster where code ='examstatus' and value='Completed' )) and ae.publish ='N'  
		and ae.result =  (select id from  keywordmaster where code ='result' and value='Unpublished') ";
			
		$excutecourseforStudent  = $DB->getArray($getcourseforStudent);
		
		return $excutecourseforStudent; 
			}
		function getStudentdetailsforCourse($studentarray){
			global $DB;
		$getStudentDetail ="select sm.first_name ,  sm.last_name, se.enrollment_id ,cm.academy_name,pm.name as programname, (select name from coursemaster where id = {$studentarray[course_id]} ) as coursename from  student_education   se  join  studentmaster sm on sm.id=se.student_id 
			 join programmaster pm on se.program_id = pm.id join centremaster cm on cm.id =se.centre_id 
			        where se.student_id= '{$studentarray[student_id]}' and se.program_id =(select program_id from coursemaster where id = '{$studentarray[course_id]}' )";
	
			$excuteStudentDetail= $DB->getArray($getStudentDetail);
			return $excuteStudentDetail;
			}
		function getStudentexamdetailforonemark($studentarray){
			global $DB;
		$getStudentexamdetailforonemark ="select ce.course_id , ce.questiontype_id ,qt.name , ce.no_of_questions, ce.partition, 

(select count(*) from  online_exam_details  oed    join assign_exam ae on oed.assign_exam_id =  ae.id where oed.question_type_id 	= ce.questiontype_id  and ae.student_id 	= {$studentarray[student_id]} and  ae.course_id	= {$studentarray[course_id]} and oed.assign_exam_id ={$studentarray[assign_exam_id]} and oed.answers !='' ) as questioned_attended,
( select SUM(oed.mark) from  online_exam_details  oed    join assign_exam ae on oed.assign_exam_id =  ae.id where oed.question_type_id 	= ce.questiontype_id  and ae.student_id 	= {$studentarray[student_id]}  and  ae.course_id	={$studentarray[course_id]}  and oed.assign_exam_id ={$studentarray[assign_exam_id]}  ) as answered_correctly
 from course_exam ce 
join  questiontype qt on  qt.id= ce.questiontype_id where ce.course_id = {$studentarray[course_id]}  and  qt.controller_id != (select id from  keywordmaster where code ='controller' and value='subjective' )";
			//echo $getStudentexamdetailforonemark;
			$excuteStudentexamdetailforonemark= $DB->getArray($getStudentexamdetailforonemark);
			return $excuteStudentexamdetailforonemark;
			}
		function getStudentexamdetailforSubjective($studentarray){
				global $DB;
		$getStudentexamdetailforSubjective ="select ce.course_id , ce.questiontype_id ,qt.name , ce.no_of_questions,  ce.partition, qt.name as questiontypename,
		( select SUM(oed.mark) from  online_exam_details  oed    join assign_exam ae on oed.assign_exam_id =  ae.id where ae.student_id 	= {$studentarray[student_id]}  and  ae.course_id	= {$studentarray[course_id]} and oed.assign_exam_id ={$studentarray[assign_exam_id]}) as totalmark
			from course_exam ce 
		join  questiontype qt on  qt.id= ce.questiontype_id where ce.course_id = {$studentarray[course_id]}  and  qt.controller_id = (select id from  keywordmaster where code ='controller' and value='subjective' ) ";
			
			$excuteStudentexamdetailforSubjective= $DB->getArray($getStudentexamdetailforSubjective);
			return $excuteStudentexamdetailforSubjective;
			}
			function getsubjectiveanswer($studentarray){
					global $DB;
		$getsubjectiveanswer ="select  oed.answers  ,oed.id, oed.question_type_id ,(select qm.question  from questionmaster  qm where qm.id= oed.question_id 	 ) as question,oed.question_id,oed.comments  ,
		oed.mark
					from assign_exam ae 
		join  online_exam_details oed on  ae.id= oed.assign_exam_id 
		where oed.question_type_id 	={$studentarray[questiontype_id]}    and ae.student_id 	= {$studentarray[student_id]}  and  ae.course_id	={$studentarray[course_id]} and oed.assign_exam_id ={$studentarray[assign_exam_id]} ";
		
			//echo $getsubjectiveanswer;
			$excutesubjectiveanswer= $DB->getArray($getsubjectiveanswer);
			return $excutesubjectiveanswer;
				}
			function getmarksubtotal($markdetail){
					global $DB;
					if( $markdetail[controller] == 'onemark') 
		$getsubtotal =" select SUM(oed.mark) as total from  online_exam_details  oed    join assign_exam ae on oed.assign_exam_id =  ae.id  join  questiontype qt on  qt.id= oed.question_type_id 	where ae.student_id 	= {$markdetail[student_id]} and  ae.course_id	= {$markdetail[course_id]} and oed.assign_exam_id ={$markdetail[assign_exam_id]}
and  qt.controller_id != (select id from  keywordmaster where code ='controller' and value='subjective' )  ";
					else if( $markdetail[controller] == 'subjective') 
		$getsubtotal =" select SUM(oed.mark) as total from  online_exam_details  oed    join assign_exam ae on oed.assign_exam_id =  ae.id  join  questiontype qt on  qt.id= oed.question_type_id 	where ae.student_id 	= {$markdetail[student_id]} and  ae.course_id	= {$markdetail[course_id]} and oed.assign_exam_id ={$markdetail[assign_exam_id]}
and  oed.question_type_id 	={$markdetail[questiontype_id]} ";
					else if( $markdetail[controller] == 'grandtotal') 
					$getsubtotal =" select SUM(oed.mark) as total from  online_exam_details  oed    join assign_exam ae on oed.assign_exam_id =  ae.id 
					 where ae.student_id 	= {$markdetail[student_id]} and  ae.course_id	= {$markdetail[course_id]} and oed.assign_exam_id ={$markdetail[assign_exam_id]}";
				//echo 	$getsubtotal ;	
		$excutesubtotal = $DB->getArray($getsubtotal );
		return $excutesubtotal[0][total];
				}
		function gettotalforeachpart($studentarray) {
			global $DB;
				$gettotal ="select ce.partition,(select SUM(oed.mark) from  online_exam_details  oed    join assign_exam ae on oed.assign_exam_id =  ae.id  
							 where ae.student_id = {$studentarray[student_id]}   and  ae.course_id= {$studentarray[course_id]} and oed.assign_exam_id ={$studentarray[assign_exam_id]}  and oed.question_type_id 	=ce.questiontype_id) as totalmark
							from course_exam ce 
							 where ce.course_id = {$studentarray[course_id]} ";
							
					$excutetotal = $DB->getArray($gettotal);
					
					return $excutetotal;
			}
			 function updateMarks($markforQuestion){
				 	global $DB;
					foreach($markforQuestion as $key=>$value )
					{
						$updatemark = "update online_exam_details set comments ='{$value[comments]}', mark = '{$value[mark]}' where id={$key}";;
						 $DB->Execute($updatemark);
				}
			 	return true;
		}
		function getExamidforStudent($studentarrayforexamid){
			global $DB;
		$getExamid ="select ae.id as examid 
		 from  assign_exam ae  
		where  ae.student_id= '{$studentarrayforexamid[student_id]}' and ae.exam_status =((select id from  keywordmaster where code ='examstatus' and value='Completed' )) and ae.publish ='N'
		and
		ae.course_id= '{$studentarrayforexamid[course_id]}'
		and  ae.result =  (select id from  keywordmaster where code ='result' and value='Unpublished')";
		
		$excuteExamid  = $DB->getArray($getExamid);
		
		return $excuteExamid[0][examid]; 
			}
	function getStudentMarkDetail($studentarray){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,cm.regulation_id ,km.value as regulation,km1.value as result,km2.value as grade,
		(select SUM(oed.mark) from  online_exam_details  oed  
		  join assign_exam ae1 on oed.assign_exam_id =  ae1.id   
		  	where ae1.student_id = {$studentarray[student_id]}   and oed.assign_exam_id = ae.id  )as total_mark from 
		assign_exam  ae  join coursemaster cm  on  cm.id=ae.course_id  
		join keywordmaster km on km.id= cm.regulation_id 
		join keywordmaster km1 on km1.id= ae.result 	 
		join keywordmaster km2  on km2.id= ae.grade 
		where cm.program_id = {$studentarray[program_id]} and ae.student_id = {$studentarray[student_id]} 
		 and ae.exam_status= (select id from  keywordmaster where code ='examstatus' and value='Completed') ";
		//echo 	$getStudentMarkDetail;
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
	function updatereult($results){
		global $DB; 
		foreach ($results as $result ){
		$updateresult = "update assign_exam set  result ={$result[ddlResult]} , grade={$result[ddlGrade]} ,publish ='Y' where id ={$result[examId]} ";
		//echo $updateresult;
		 $DB->Execute($updateresult);}
		return true;
		}
		function getExamschedule($userid)
		{
		global $DB;
		$getexams ="select ase.id, ase.student_id, ase.course_id,cm.code,cm.id as courseid, DATE_FORMAT(ase.exam_date_starttime,'%d-%b-%Y') as startDate , DATE_FORMAT(ase.exam_date_endtime,'%d-%b-%Y') as endDate 
		from assign_exam ase JOIN coursemaster cm ON ase.course_id=cm.id 
		where ase.student_id= '{$userid}' and ase.result =(select id from keywordmaster where code='result' and value='Unpublished')
		 and (ase.exam_status =(select id from keywordmaster where code='examstatus' and value='Processing')
		  or ase.exam_status =(select id from keywordmaster where code='examstatus' and value='Assigned') or
		   ase.exam_status =(select id from keywordmaster where code='examstatus' and value='Reassigned'))";
		
		return $getexams;
		}
		function getExamResult($student_id){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,km1.value as result,km2.value as grade, km3.value as  regulation , 
               (select SUM(oed.mark) from  online_exam_details  oed  
                 join assign_exam ae1 on oed.assign_exam_id =  ae1.id  
                         where ae1.student_id = {$student_id}   and oed.assign_exam_id = ae.id  )as total_mark, DATE_FORMAT(ae.exam_completiondate,'%d-%b-%Y') as examdate from
               assign_exam  ae  join coursemaster cm  on  cm.id=ae.course_id  
               join keywordmaster km1 on km1.id= ae.result          
               join keywordmaster km2  on km2.id= ae.grade
			    join keywordmaster km3  on km3.id= cm.regulation_id
			    	
               where  ae.student_id = {$student_id}
                and ae.exam_status= (select id from  keywordmaster where code ='examstatus' and value='Completed') and ae.publish='Y'
and ae.result != (select id from keywordmaster where code ='result' and value='Admin reassign') ORDER BY ae.id DESC";
				
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function getExamDetail(){
		global $DB; 
		$getExamDetail = "select ae.id,se.enrollment_id as studentid, se.centre_id ,sm.first_name ,sm.last_name , pm.name as programname ,pm.id as programid ,cem.academy_name as centrename ,
				cm.code as  coursecode ,ae.no_of_attempt ,km.value as result,km1.value as examstatus ,ae.exam_date_starttime ,
				ae.exam_date_endtime ,ae.exam_startdate,ae.exam_completiondate,ae.examkey ,ae.student_id , ae.course_id 
				 from assign_exam ae
				 join  coursemaster cm on cm.id= ae.course_id 	 
				join studentmaster sm  on sm.id=ae.student_id
				 join  programmaster pm on pm.id= cm.program_id
				 join  keywordmaster km on km.id= ae.result
				join  keywordmaster km1 on km1.id= ae.exam_status
				join  student_education se on se.student_id= ae.student_id
				 and se.program_id =cm.program_id  	
				join  centremaster cem on cem.id= se.centre_id
				where 
				ae.id = (select max(ae1.id) from assign_exam ae1    where ae1.course_id  = cm.id 
				and ae1.student_id  = sm.id )
				
					and (ae.result =(select id from keywordmaster where code ='result' and 
				value='Fail') or  ae.result =(select id from keywordmaster where code ='result' and 
				value='Admin reassign')
				or  ae.exam_status= (select id from keywordmaster where code ='examstatus' and 
				value='Not attended'))
				";
			
		//$studentDetail = $DB->getArray($getExamDetail);
		return 	$getExamDetail;
		}
		function updateExamStatus(){
		global $DB; 
		$updateExamStatus = "update assign_exam  set exam_status = (select id from keywordmaster  where code ='examstatus' and 
							value='Not attended' )
							 where DATE(exam_date_endtime ) < DATE(NOW())
							and (exam_status = (select id from keywordmaster  where code ='examstatus' and 
							value='Assigned') or exam_status = (select id from keywordmaster  where code ='examstatus' and 
							value='Reassigned' )
							or exam_status = (select id from keywordmaster  where code ='examstatus' and 
							value='Processing' ) )";
		$DB->Execute($updateExamStatus);
		return true ;
		}
		function getExamResultforCourse($student_id,$courseid){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,km1.value as result,km2.value as exam_status,  DATE_FORMAT(ae.exam_completiondate,'%d-%b-%Y') as examDate,
               (select SUM(oed.mark) from  online_exam_details  oed  
                 join assign_exam ae1 on oed.assign_exam_id =  ae1.id  
                         where ae1.student_id = {$student_id}   and  ae1.course_id  = {$courseid} and oed.assign_exam_id = ae.id  )as total_mark from
               assign_exam  ae  join coursemaster cm  on  cm.id=ae.course_id  
               join keywordmaster km1 on km1.id= ae.result          
               join keywordmaster km2  on km2.id= ae.exam_status
			   
               where  ae.student_id = {$student_id} and  ae.course_id  = {$courseid}
                ";
		//echo $getStudentMarkDetail ;
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function reassginExam($reassginarray)
		{
			global $DB; 
			$query = "select no_of_attempt 	from assign_exam where id = (select max(id) from  assign_exam  where student_id ={$reassginarray[student_id]}  and course_id = {$reassginarray[course_id]})" ;  
			$noofattempt  = $DB->getArray($query);
				
			$noofattempt = $noofattempt[0][no_of_attempt] + 1;
			
			$from =date('Y-m-d', strtotime($reassginarray['fromdate']));
			$to =date('Y-m-d', strtotime($reassginarray['todate']));
			$insert = "insert into assign_exam (student_id ,course_id ,exam_date_starttime,exam_date_endtime,no_of_attempt,exam_status,result,grade,publish
		) values('{$reassginarray[student_id]}','{$reassginarray[course_id]}','{$from}','{$to}','{$noofattempt}',
		(select id from keywordmaster where value='Reassigned' and code = 'examstatus'),(select id from keywordmaster where value='Unpublished' and code = 'result')
		,(select id from keywordmaster where value='O' and code = 'grade'),'N');";
		//echo $insert; 	exit;
		 $DB->Execute($insert);	
		if($DB->Affected_Rows())
		{
			$this->mailReassignExam($reassginarray);
		return true;
		}
		else 
		return false;
		}
		function getCoursecode($courseid)
		{
			global $DB; 
		$getCoursecode = "select code from   coursemaster where id  = {$courseid}";
		//echo $getStudentMarkDetail ;
		$coursecode = $DB->getArray($getCoursecode);
		return  $coursecode[0][code] ;
		}
		function  getCoursesforexternalmark($studentarray){
				global $DB; 
			$getCourses = "select cm.id, cm.code from   coursemaster cm  where cm.program_id  = {$studentarray['program_id']} and cm.status='Y' 
			 and cm.id  not in (select course_id from external_mark where  student_id ={$studentarray[student_id]}) and 
			(cm.regulation_id  =(select id from keywordmaster where code ='regulation' and value ='Practical') 
			or cm.regulation_id  =(select id from keywordmaster where code ='regulation' and value ='Project') )";
			
			$rsCourse = $DB->getArray($getCourses);
			return  $rsCourse ;
			}
		function  insertExternalmark($externalmark){
				global $DB; 
			$insert = "insert into external_mark (student_id, course_id, exam_date, mark, comment, video1, video2, video3, result, grade, created_on, created_by, modified_by, modified_on) values ('{$externalmark[student_id]}','{$externalmark[course_id]}','{$externalmark[examdate]}','{$externalmark[mark]}','{$externalmark[comment]}',
			'{$externalmark[video1]}','{$externalmark[video2]}','{$externalmark[video3]}','{$externalmark[result]}'
		,'{$externalmark[grade]}','{$externalmark[created_on]}','{$externalmark[created_by]}',
			'{$externalmark[modified_by]}','{$externalmark[modified_on]}');";
			$DB->Execute($insert);	
			if($DB->Affected_Rows())
			return true;
			else 
			return false;
			}
		function getExternalMark($studentarray){
		global $DB; 
		$getExternalMark = "select em.id as examid, em.course_id ,cm.code ,cm.regulation_id ,km.value as regulation,km1.value as result,km2.value as grade, em.mark as total_mark
        from 
		external_mark  em  join coursemaster cm  on  cm.id=em.course_id  
		join keywordmaster km on km.id= cm.regulation_id 
		join keywordmaster km1 on km1.id= em.result 	 
		join keywordmaster km2  on km2.id= em.grade 
		where cm.program_id = {$studentarray[program_id]} and em.student_id = {$studentarray[student_id]} 
		 ";
			$externalMark = $DB->getArray($getExternalMark);
		return $externalMark;
		}
		
		function getRecentExamResult($student_id){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,km1.value as result,km2.value as grade,
               (select SUM(oed.mark) from  online_exam_details  oed  
                 join assign_exam ae1 on oed.assign_exam_id =  ae1.id  
                         where ae1.student_id = {$student_id}   and oed.assign_exam_id = ae.id  )as total_mark from
               assign_exam  ae  join coursemaster cm  on  cm.id=ae.course_id  
               join keywordmaster km1 on km1.id= ae.result          
               join keywordmaster km2  on km2.id= ae.grade
               where  ae.student_id = {$student_id}
                and ae.exam_status= (select id from  keywordmaster where code ='examstatus' and value='Completed') and ae.publish='Y' and ae.id IN (SELECT max(id) from assign_exam GROUP BY course_id)";
				
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function getExamResultByProgram($studentarray){
		global $DB; 
		$getStudentMarkDetail = "select ae.id as examid, ae.course_id ,cm.code ,km1.value as result,km2.value as grade,
               (select SUM(oed.mark) from  online_exam_details  oed  
                 join assign_exam ae1 on oed.assign_exam_id =  ae1.id  
                         where ae1.student_id = {$studentarray[student_id]}   and oed.assign_exam_id = ae.id  )as total_mark,DATE_FORMAT(ae.exam_completiondate,'%d-%b-%Y') as examdate from
               assign_exam  ae  join coursemaster cm  on  cm.id=ae.course_id  
               join keywordmaster km1 on km1.id= ae.result          
               join keywordmaster km2  on km2.id= ae.grade
               where  ae.student_id = {$studentarray[student_id]} and cm.program_id = {$studentarray[program_id]}
                and ae.exam_status= (select id from  keywordmaster where code ='examstatus' and value='Completed') and ae.publish='Y' and ae.id IN (SELECT max(id) from assign_exam where  student_id = {$studentarray[student_id]} GROUP BY course_id)";
		//echo $getStudentMarkDetail;	
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function updateGraduation($studentarray)
		{
			global $DB;
			//print_r($studentarray);
			if($studentarray[graduation_status] == 'Y')
			$updateCCSql = "update student_education set graduation_status='{$studentarray[graduation_status]}',graduation_status_comments='{$studentarray[graduation_status_comments]}'  ,completion_date ='{$studentarray[completion_date]}'  , grade ='{$studentarray[grade]}'  where student_id='{$studentarray[student_id]}' and program_id='{$studentarray[program_id]}'";
			else 
			$updateCCSql = "update student_education set graduation_status='{$studentarray[graduation_status]}',graduation_status_comments='{$studentarray[graduation_status_comments]}'  where student_id='{$studentarray[student_id]}' and program_id='{$studentarray[program_id]}'";
			
			
			//echo $updateCCSql;
			////exit;
			$DB->Execute($updateCCSql);
			if($DB->Affected_Rows())
			return true;
			else 
			return false;
		}
		function mailAssignExam($arrassginExam){
		global $DB;
		$getStudentDetail = "
		select sm.first_name,sm.last_name,sm.email_id from studentmaster sm join student_education se on sm.id = se.student_id where sm.id = {$arrassginExam[student_id]}";
		
		$studentDetail = $DB->getArray($getStudentDetail);
		$courseName = "select code from coursemaster where id ={$arrassginExam[ddlcourse]}";
		$courseDetail = $DB->getArray($courseName);
		$fromdate =date('d-M-Y', strtotime($arrassginExam['txtschdate1']));
			$todate =date('d-M-Y', strtotime($arrassginExam['txtschdate2']));
			$from = ADMIN_EMAIL;
					$to = $studentDetail[0]['email_id'];
					$subject = "Assign Exam";
					 $message = '<br/>Dear '. $studentDetail[0]['first_name'].' '.$studentDetail[0]['last_name'].',';
					  $message .= "<br/>This is to notify you in advance on the time and date of the ".$courseDetail[0]['code']." examination. Kindly log in with the user name and password and access the examination anytime during the scheduled dates of ".$fromdate." and ".$todate.". Feel free to take online sample tests to get familiar with the format.  ";
					  
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>The Apaa Team.";  
					  $header = "From: Customer Support <".$from.">\r\n";
//$header .= "Bcc: customersupport@alagappaarts.com"."\r\n";
					 $header .= 'MIME-Version: 1.0' . "\r\n";
					$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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
				return  true;
			}
			else
			{	
				return false;
			
			}
         		//mail($to, $subject, $message,  $header);
		}
		function mailReassignExam($reassginarray){
		global $DB;
		$getStudentDetail = "
		select sm.first_name,sm.last_name,sm.email_id from studentmaster sm join student_education se on sm.id = se.student_id where sm.id = {$reassginarray[student_id]}";
		
		$studentDetail = $DB->getArray($getStudentDetail);
		$courseName = "select code from coursemaster where id ={$reassginarray[ddlcourse]}";
		$courseDetail = $DB->getArray($courseName);
		$fromdate =date('d-M-Y', strtotime($reassginarray['fromdate']));
			$todate =date('d-M-Y', strtotime($reassginarray['todate']));
			$from = ADMIN_EMAIL;
					$to = $studentDetail[0]['mailto'];
					$subject ="Re-assign exam";
					 $message = '<br/>Dear '. $studentDetail[0]['first_name'].' '.$studentDetail[0]['last_name'].',';
					  $message .= "<br/>You have missed/failed to complete the exam online for the course ".$courseDetail[0]['code']." on the previously scheduled dates. Based on your request, we are allowing you to take the exam again ".$fromdate." and ".$todate.". ";
					  $message .= "<br/>You can also try the sample exam before doing your exams.";
					  $message .= "<br/><br/>Regards,";  
					  $message .= "<br/>The Apaa Team.";  
					  $header = "From: Customer Support <".$from.">\r\n";
//$header .= "Bcc: customersupport@alagappaarts.com"."\r\n";
					 $header .= 'MIME-Version: 1.0' . "\r\n";
					$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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
				return  true;
			}
			else
			{	
				return false;
			
			}
         		//mail($to, $subject, $message,  $header);
		}
		function getEnrollProgramsforStudent($studentid){
		global $DB;
		$getProgramsforStudent ="select se.program_id as id, pm.name as name
		from student_education se join programmaster pm ON se.program_id = pm.id
		where se.student_id= '{$studentid}' and se.graduation_status !='Y'";
		$excuteProgramsforStudent = $DB->getArray($getProgramsforStudent);
		
		return $excuteProgramsforStudent;
		}
		function getExternalmarkdetail($studentarray){
		global $DB;
			$getStudentMarkDetail = "select em.id as id, em.course_id ,cm.code ,km1.value as result,km2.value as grade,
              DATE_FORMAT(em.exam_date 	,'%d-%b-%Y') as examdate ,em.mark  from
               external_mark  em  join coursemaster cm  on  cm.id=em.course_id  
               join keywordmaster km1 on km1.id= em.result          
               join keywordmaster km2  on km2.id= em.grade
               where  em.student_id = {$studentarray[student_id]} and cm.program_id = {$studentarray[program_id]}";
		//echo $getStudentMarkDetail;	
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function getExternalresult($student_id){
		global $DB;
			$getStudentMarkDetail = "select em.id as id, em.course_id ,cm.code ,km1.value as result,km2.value as grade,  km3.value as regulation,
              DATE_FORMAT(em.exam_date 	,'%d-%b-%Y') as examdate ,em.mark  from
               external_mark  em  join coursemaster cm  on  cm.id=em.course_id  
               join keywordmaster km1 on km1.id= em.result          
               join keywordmaster km2  on km2.id= em.grade
			     join keywordmaster km3  on km3.id= cm.regulation_id
               where  em.student_id = {$student_id} ";
		//echo $getStudentMarkDetail;	
		$studentDetail = $DB->getArray($getStudentMarkDetail);
		return $studentDetail;
		}
		function getonemarkanswer($studentarray){
		global $DB;
		switch ($studentarray[questiontype_id]){
		case 1 : 
		$getonemarkanswer
		 ="select oed.id, oed.question_type_id ,(select qm.question  from questionmaster  qm where qm.id= oed.question_id ) as  		  					                       question,oed.question_id,oed.comments  ,oed.mark  , mca.choice  as  answers from assign_exam ae 
		join  online_exam_details oed on  ae.id= oed.assign_exam_id 
	 	join multiple_choice_answer mca   ON  mca.question_id = oed.question_id  and  mca.answerindex = oed.answers
		where oed.question_type_id 	={$studentarray[questiontype_id]}   
		 and ae.student_id 	= {$studentarray[student_id]}  and  ae.course_id	={$studentarray[course_id]}
		  and oed.assign_exam_id ={$studentarray[assign_exam_id]} ";
		 break ;
		 case 3: 
		$getonemarkanswer
		 ="select  oed.answers  ,oed.matchanswer ,oed.id, oed.question_type_id ,oed.question_id,oed.comments , oed.mark from assign_exam ae 
		 join  online_exam_details oed on  ae.id= oed.assign_exam_id 
		where oed.question_type_id 	={$studentarray[questiontype_id]}    and ae.student_id 	= {$studentarray[student_id]}  
		and  ae.course_id	={$studentarray[course_id]} and oed.assign_exam_id ={$studentarray[assign_exam_id]}";
		 break ;
		 default : 
		 $getonemarkanswer ="select  oed.answers  ,oed.id, oed.question_type_id ,(select qm.question  from questionmaster  qm where qm.id= oed.question_id 	 ) as question,oed.question_id,oed.comments  ,
		oed.mark
					from assign_exam ae 
		join  online_exam_details oed on  ae.id= oed.assign_exam_id 
		where oed.question_type_id 	={$studentarray[questiontype_id]}    and ae.student_id 	= {$studentarray[student_id]}  and  ae.course_id	={$studentarray[course_id]} and oed.assign_exam_id ={$studentarray[assign_exam_id]} ";
		 		}
		 //echo $getonemarkanswer;
			//echo $getsubjectiveanswer;
			$excutegetanswer= $DB->getArray($getonemarkanswer);
			return $excutegetanswer;
		}
		function getMatchanswer($studentarray){
			global $DB;
			$selectQuery = "select questions_assigned,position  from assign_exam where id = {$studentarray[assign_exam_id]}  ";
			$question = $DB->getArray($selectQuery);
			$questionids  = explode(",",$question[0][questions_assigned]);
			$positions  = explode(",",$question[0][position]);
			 $i =0;
			foreach ($questionids as $key=>$questionid){
				$selectQueryTypeid = "select * from questionmaster where id  = {$questionid} and   question_type_id ={$studentarray[questiontype_id]} ";
				$questionTypeid = $DB->getArray($selectQueryTypeid);
				if($questionTypeid){if($positions[$key] == 1) 	$i =0;
				 $questionAns[$i][0]= $questionTypeid[0]['question'];
				 $i++;
				}
				 
			}
			//print_r($questionAns);
	 		$selectQuery = "select answers,matchanswer from  online_exam_details where 	assign_exam_id ={$studentarray[assign_exam_id]} 
						and  question_type_id = {$studentarray[questiontype_id]} ";
			$questions = $DB->getArray($selectQuery);
			 $i =0;
			foreach ($questions  as $quest){
					$questionAns[$i][1] =$quest[answers];
					$questionAns[$i][2] =$quest[matchanswer];
					$i++;
			 
			}
			return $questionAns ;
		}
}
?>