<?php 
include("../config/config.inc.php");
include("../config/classes/onlineexam.class.php");


if(isset($_GET['course_id']))
{
	
		
	$arrInput = array('course_id'=>$_GET['course_id'],'student_id'=>$_GET['student_id']);
	$onlineexam = new onlineexam();
	$getExamDetails = $onlineexam->sample_getexamdetails($arrInput);
	$arrInput['examtaken'] = 0;
	$arrInput['assignedid'] = $getExamDetails[0]['id'];
	$durationseconds = $getExamDetails[0]['totalexamduration'];
	//echo $durationseconds;
	$arrInput['examduration'] = $durationseconds * 60;
	$arrInput['currenttiming'] = $getExamDetails[0]['currenttiming'];
	$instruction = "<div class='title'>{$getExamDetails[0][coursename]}</div>";
	$instruction.= "<div class='subTitle'>Instructions</div><div class='onlineExamsContent'><div class='onlineExamsContentTop'><div class='onlineExamsContentTopLeft'>There are part of questions<br/><br/>";
	$i=1;
	$mysql_datetime = date('Y-m-d H:i:s');
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
	$_SESSION['sampleuserexaminfo'] = $arrInput;
	$instruction.= "</div><div class='onlineExamsContentTopRight'><span>Marks</span>:{$marks}<br />
<span>Duration </span>:{$durationseconds} mins</div></div>{$partition}";
  
	 
		$instruction.= "<div><div class='browserWarningLeft'>Students must not stop the exam session and then return to it. Closing the browser window or navigating the browser Back will interrupt the online exam.</div><div class='browserWarningRight'><a href='sample_exam_questions.php'><img src='../web/images/start-quiz-btn.gif' width='164' height='115' /></a></div></div>";
	 
    
 
      $instruction.= "</div>";
	  echo $instruction;
	 
}

?>

