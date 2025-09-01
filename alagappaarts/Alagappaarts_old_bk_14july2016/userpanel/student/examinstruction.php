<?php 
include("../config/config.inc.php");
include("../config/classes/onlineexam.class.php");
function date_check_in_range($startdate,$enddate,$todaydate)
{
	 $start_ts = strtotime($startdate);
	   $end_ts = strtotime(date("Y-m-d", strtotime($enddate)) . " +1 day");
 //$end_ts = strtotime($enddate);
  $today_ts = strtotime($todaydate);

  // Check that user date is between start & end
  return (($today_ts >= $start_ts) && ($today_ts <= $end_ts));

}

if(isset($_GET['course_id']) && isset($_GET['student_id']))
{
	
	
	$arrInput = array('course_id'=>$_GET['course_id'],'student_id'=>$_GET['student_id']);
	$onlineexam = new onlineexam();
	$getExamDetails = $onlineexam->getexamdetails($arrInput);
	if($getExamDetails[0]['examkey'])
	$examtaken = 1;
	else
	$examtaken = 0;
        //echo '<pre>';
        // print_r($getExamDetails);
	//echo 	$examtaken;exit;
	$arrInput['examtaken'] = $examtaken;
	$arrInput['assignedid'] = $getExamDetails[0]['id'];
	$durationseconds = $getExamDetails[0]['totalexamduration'];
	$arrInput['examduration'] = $durationseconds * 60;
	$arrInput['currenttiming'] = $getExamDetails[0]['currenttiming'];
	$instruction = "<div class='title'>{$getExamDetails[0][coursename]}</div>";
	$instruction.= "<div class='subTitle'>Instructions</div><div class='onlineExamsContent'><div class='onlineExamsContentTop'><div class='onlineExamsContentTopLeft'>There are part of questions<br/><br/>";
	$i=1;
	// $mysql_datetime = date('Y-m-d H:i:s');
	$mysql_datetime = date('Y-m-d H:i:s',strtotime('-5 hours 0 minutes'));
	$isvaliddate = date_check_in_range($getExamDetails[0]['exam_date_starttime'],$getExamDetails[0]['exam_date_endtime'],$mysql_datetime);
	foreach($getExamDetails as $key=>$value)
	{
		$instruction.= $i .'. '.$value['questiontype_name'] .'<br/>';
		$marks += $value['marks_per_question'] * $value['no_of_questions'] ;
		$duration += $value['no_of_questions'] * $value['duration_minute'];
		$partition .= "<ul><span>Part {$value[partition]}</span>
<li>This part contains the <strong><i> {$value[questiontype_name]}</i></strong>.</li>

<li>You have {$value[no_of_questions]} number of questions in this part.</li>";
if($value['questiontype_id'] == 6)
$partition .="<li>For the question contains more than one answer, provide your answer using comma like answer 1,answer 2</li>";
$partition .= "</ul>";
		$arrquestiontype[] = $value['questiontype_id'];
		$arrquestioncount[]= $value['no_of_questions'];
		$i++;
	}
	$arrInput['questiontypeid'] = $arrquestiontype;
	$arrInput['questioncount'] = $arrquestioncount;
	$_SESSION['userexaminfo'] = $arrInput;
	$instruction.= "</div><div class='onlineExamsContentTopRight'><span>Marks</span>:{$marks}<br />
<span>Duration </span>:{$durationseconds} mins</div></div>{$partition}";
 
	  $instruction.= '  <div class="examInstruction">
<div class="examInstructionTitle"><img src="../web/images/alert-icon.gif" width="32" height="32" alt=" " />
<h3>Please read carefully the procedure to take on line examinations<span>(Make certain that you have received the Username & Password from APAA)</span></h3></div>
<div class="examInstructionContent">
<ol>';
/*$instruction.='<li>Log in to: <a href="http:alagappaarts.com/dance/registration/students-log-in/">http:alagappaarts.com/dance/registration/students-log-in/</a></li>
<li>Enter your username and password </li>
<li>Online exam page will open</li>
<li>You will see the exam schedule box</li>';*/
//$instruction.=' <li>Click on to CEB 01/02 icon (or) ADB01/02 icon</li>';
//$instruction.=' <li>You will see an instruction page.</li>';
$instruction.='<li>Click on start exam icon</li>';
/*$instruction.= '<p><span>IMPORTANT:</span> Make note of unique key (<span>example:</span> APAA-KAT54)</p>
<li>Click on to start test option </li>';*/
$instruction.= '<li>Start your exams , when you finish first question click on to next icon to move on to the next question</li>';
/* $instruction.= '<li>Skip icon will allow you to skip the questions</li>
<p><span>NOTE:</span> (If you skipped a question you can go back and view the Question/Answers what you have done. Please note that you can only view the previous answers, but you cannot do any changes once the answers are filled out.)</p>';*/
$instruction.= '<li>On completion of exam  click complete icon</li>
<li>You will get a message "successful"</li>
</ol>

<ol>
<span>While doing exams, if you get locked out of that page please perform following:</span>';
/*$instruction.= '<li>Log in and go to exams menu</li>
<li>Click on to online exams</li>
<li>You will get instruction page</li>';*/
$instruction.= '<li>Click start exam</li>';
/*$instruction.= '<li>Enter the unique key,</li>';*/
$instruction.='<li>Click on to continue</li>';
$instruction.='<li>You will be restored to the same page to continue the exams</li>
</ol>
<p>In case of difficulties please state your name, refer to exam date and email
<a href="mailto:customersupport@alagappaarts.com" >customersupport@alagappaarts.com </a></p>
</div>


</div>';
   if($isvaliddate)
   {
	   if(!$_SESSION['userexaminfo']['examtaken'])
	{
		$instruction.= "<div><div class='browserWarningLeft'>Students must not stop the exam session and then return to it. Closing the browser window or refreshing or navigating the browser Back will interrupt the online exam.</div><div class='browserWarningRight'><a href='online_exam_questions.php'><img src='../web/images/start-quiz-btn.gif' width='164' height='115' /></a></div></div>";
   	}
	else
	{
		$instruction.= "<div><div class='browserWarningLeft'>Students should not refresh or press browser back button and it will interrupt the online exam.
</div><div class='browserWarningRight'><a href='online_exam_questions.php'><img src='../web/images/start-quiz-btn.gif' width='164' height='115' /></a></div></div>";
	}
   }
	else
	$instruction.= "<div class='error'>You haven't taken the exam on the scheduled period between {$getExamDetails[0]['start_date']} to {$getExamDetails[0]['end_date']}. Please send a request mail to APAA team to reassign the exam.</div>";
     
$instruction.= "</div>";
	  echo $instruction;
	 
}

?>
