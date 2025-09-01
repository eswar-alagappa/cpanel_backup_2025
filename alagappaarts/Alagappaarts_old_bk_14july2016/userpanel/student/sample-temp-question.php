<?php

include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
include("../config/classes/onlineexam.class.php");
$roleid = $_SESSION[studentinfo][role_id];
$userid = $_SESSION[studentinfo][user_id];
$username = $_SESSION[studentinfo][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);
if(!$student)
{
	header('location:index.php?msg=Enter username password');
}
else{

$onlineexam = new onlineexam();

$usertestid = $_SESSION['sampleusertest'];

$arrayfin = $_SESSION['samplequestionarray'];
$examdetails = $_SESSION['sampleuserexaminfo'];
$i = $_SESSION['samplequestCount'];
$answerselected = $_REQUEST['selected'];
$option = $_REQUEST['option'];
$flag =1;

if(($i > -1))
{
	
	$answerselected = addslashes($answerselected);
	$currentQuestion = $_SESSION[ 'samplecurrentQuestion' ];		
	$currentQuestionType = $_SESSION['samplecurrentQuestiontype'];
	$correctAnswer = $onlineexam->getAnswer($currentQuestion);
	
	if($option=='NEXT')
	{
	
					if(isset($_REQUEST['matchquestionid']))
					{
					
						$flag =0;
					}
					else
					{
						$flag = 1;
						
					}
				
	}
	
	
}
$totalQuestion = count($arrayfin);

			switch($option)
			{
				case 'NEXT':
				case 'SKIP': $i++;
							break;
				
			   case 'MATCHSKIP':
								$countmatch = $onlineexam->getmatchcount($examdetails['course_id'],$arrayfin[$i]['question_type_id']);
								$i = $i + $countmatch;
								$flag =0;
								break;
			
			  default : $i++;
			             break;
			}

$_SESSION['samplequestCount'] = $i;

$arrayIndex = $_SESSION['samplequestCount'];

$arrayDisp = $arrayIndex+1;

$_SESSION['samplecurrentQuestion'] = $arrayfin[$arrayIndex]['questionid'];
$_SESSION[ 'samplecurrentQuestiontype' ] = $arrayfin[$arrayIndex]['question_type_id'];

if($arrayfin[$arrayIndex]['questiontype'] == "match-the-following"){
	$getQuestion = $onlineexam -> getNextSetofQuestion($arrayfin);

	 }
	 $currentseconds =  $_REQUEST['seconds'];
$sql = "update assign_exam set currentquestion='{$_SESSION[ currentQuestion ]}', currenttiming = '{$currentseconds}' where examkey='{$_SESSION[uniqueSampleTestKey]}'";

$DB->Execute( $sql );


if($arrayDisp <= $totalQuestion)
{
	
	if($arrayDisp==1)
	{
		
		echo "<script type='text/javascript'>
		var texttimer = \"<span class='addFieldOuter'><span id='timer'><img width='7' height='24' src='../web/images/add-right-bg.png'></span></span>\";
		$('#appendTimer').append(texttimer);
		$('#timer').countdown({until: {$examdetails['examduration']}, expiryUrl: 'sample_exam_complete.php',compact: true}); 
		</script>";
	}
	else
	{
		if($examdetails['examtaken'])
		{
			$diffseconds = $examdetails['examduration'] - $examdetails['currenttiming'];
			$remainingsecond = $examdetails['examduration'] - $diffseconds;
			echo "<script type='text/javascript'>
		var texttimer = \"<span class='addFieldOuter'><span id='timer'></span></span>\";
		$('#appendTimer').append(texttimer);
		$('#timer').countdown({until: {$remainingsecond}, expiryUrl: 'sample_exam_complete.php',compact: true}); 
		</script>";
		}
	}
	
	$last = 0;
	if($arrayDisp == $totalQuestion)
	{
		$last = 1;
	}
	$questiontypecount = count($examdetails['questiontypeid']);
	echo "<div class='navi'>
<ul>";

	for($j=0;$j<$questiontypecount;$j++)
	{
		$classname = "disableBtn";
		$questiontypeinfo[$examdetails['questiontypeid'][$j]] = $examdetails['questioncount'][$j];
		if($examdetails['questiontypeid'][$j]==$arrayfin[$arrayIndex]['question_type_id'])
		{
			$classname ="activebtn";
			
		}
		
		$part = $j+1;
		echo "<li class='{$classname}'><a href='javascript:;'><span>Part {$part}</span></a></li>";
	}
	
	echo "</ul> </div>";
	
	switch($arrayfin[$arrayIndex]['questiontype'])
	{
		case 'multiple-choice':
		
		  echo "<div class='onlineExamsBottom'><div class='questionTitle'>
      <div class='questionTitleLeft'>".$arrayfin[$arrayIndex]['question_type_name']." - Question {$arrayfin[$arrayIndex]['position']} of {$questiontypeinfo[$arrayfin[$arrayIndex]['question_type_id']]}</div>
      </div>
	  <form name='frmQuestion' method='post' >
      <div class='part1Content'><span>".$arrayfin[$arrayIndex]['question']."</span>";

		  foreach ($arrayfin[$arrayIndex]['choices'] as $choices ){
		echo  " <label><input type='radio' name='questAnswer' value='".$choices['answerindex']."' {$disabled} />".$choices['choice']."</label>";

		    
			 }

			

		  echo "</div>
<div class='questionTitle'>
      ";
	  if($last)
	  {
		   echo"
		   <div class='questionBtnLeft'><input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"btnradioselected('questAnswer');\" /></div>";
	  }
	  else
	  {
		    echo"<div class='questionBtnLeft'>";
			echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";
			 echo"<div class='next' style='display:none;'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>";
	   echo"</div>";
	 
	  }
	
	echo"
      </div>
	  </form>
 </div>";
		  break;
		case 'true-false':
	echo "
<div class='onlineExamsBottom'>

<div class='questionTitle'>
      <div class='questionTitleLeft'>".$arrayfin[$arrayIndex]['question_type_name'] ." - Question {$arrayfin[$arrayIndex]['position']} of {$questiontypeinfo[$arrayfin[$arrayIndex]['question_type_id']]}</div>
      </div>
	  <form name='frmQuestion' method='post'>
      <div class='part2Content'><span>".$arrayfin[$arrayIndex]['question']."</span>
	  <label><input type='radio' name='questAnswer' value='True' />True</label>
	   <label><input type='radio' name='questAnswer' value='False' />False</label>
	    
	  </div>
<div class='questionTitle'>
     ";
	  if($last)
	  {
		   echo"
		    <div class='questionBtnLeft'><input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"btnradioselected('questAnswer');\" /></div>";
	  }
	  else
	  {
		    echo" <div class='questionBtnLeft'>  <div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>  <div class='next' style='display:none;'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>
	  </div>";
	 
	  }
     
	echo"
      </form>
 </div>";
 break;
		case 'match-the-following':
	
		if($flag){
		echo "
<div class='onlineExamsBottom'>

<div class='questionTitle'>
      <div class='questionTitleLeft'>{$arrayfin[$arrayIndex][question_type_name]} - Question 1 of 1</div>
      </div>
	  
	 <div class='part2Content'>
	 <div class='questionTopTitle'>
      <ul>
      <li class='questiontitle'>question</li>
      <li class='answerTitle'>answer</li>
      <li class='correctAnswerTitle'>correct answer</li>
      </ul>
      </div>
<form action='' method='post' id='frmMatch' name='frmMatch' >
<div id='match' class='multipleChoice'>
  <ul>";
foreach ($getQuestion as $matchthefollowing){
	echo "<li id='frmMatch'>
        <div class='dynamicfields'>
        <div>
       <span class='option'>{$matchthefollowing[answercode]}</span>
        <textarea title='Enter question' class='required' name='txtMatchQuestion' cols='28' rows='3' disabled='disabled'>{$matchthefollowing[question]}</textarea>
        <textarea title='Enter answer' class='required answerBox' name='txtAddress' cols='28' rows='3' disabled='disabled'>{$matchthefollowing[answer]}</textarea>
        <input type='input' value='' name='txtCorrectanswer[]'  id ='{$matchthefollowing[correctquestionid]}' class='required number matchAnswer' title='Please fill the value' maxlength='2'>
    </div>
     </div>
       
      </li>";
	}
echo '</ul>';
echo "</div>";
if($last)
	  {
		   echo"
		    <div class='questionBtnLeft'><input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"matchthefollowing('txtCorrectanswer');\" /></div>";
	  }
	  else
	  {
		    echo" <div class='questionBtnLeft'> <div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div> <div class='next' style='display:none;'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"matchthefollowing('txtCorrectanswer');\" /></div>
	   </div>";
	  
	  }

echo "</form>";
echo "</div>";
 echo "</div>";
		}
 break;
		case 'subjective':
	
		echo "
<div class='onlineExamsBottom'>

<div class='questionTitle'>
      <div class='questionTitleLeft'>{$arrayfin[$arrayIndex][question_type_name]} - Question {$arrayfin[$arrayIndex]['position']} of {$questiontypeinfo[$arrayfin[$arrayIndex]['question_type_id']]}</div>
      </div>
	  <form name='frmQuestion' method='post' >
     <div class='part4Content'><span class='question'>".$arrayfin[$arrayIndex]['question']."</span>
	 <textarea name='txtAnswer' cols='50' rows='10' ></textarea>
	  <script>getckeditor();</script>  
	  </div>
<div class='questionTitle'>
     ";
	   if($last)
	  {
		   echo"
		    <div class='questionBtnLeft'><input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"subjectiveanswer('txtAnswer');\" /></div>";
	  }
	  else
	  {
		    echo" <div class='questionBtnLeft'>   <div class='next'  ><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"subjectiveanswer('txtAnswer');\" /></div>
	   </div>";
	  
	  }
     
	 echo"</div>
      </div>
	  </form>
 </div>";
 break;
 case 'fill-blank':
			 
					echo "
<div class='onlineExamsBottom'>
<div class='questionTitle'>
      <div class='questionTitleLeft'>".$arrayfin[$arrayIndex]['question_type_name'] ." - Question {$arrayfin[$arrayIndex]['position']} of {$questiontypeinfo[$arrayfin[$arrayIndex]['question_type_id']]}</div>
      </div>
	  <form name='frmQuestion' method='post'>
      <div class='part2Content'><span>".$arrayfin[$arrayIndex]['question']."</span>";
	   echo "    <input type='text' name='questAnswer' value='' class='fillquestAnswer'   autocomplete='off'   maxlength='50' />";
	 
	    
	 echo " </div>";
			
echo "<div class='questionTitle'>
     ";
	   if($last)
	  {
		   echo " <div class='questionBtnLeft'>";
	 
		   echo "<input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"fillAnswer('questAnswer');\" /></div>";
	  }
	   
	  else
	  {
		    echo"<div class='questionBtnLeft'>";
			 
			echo " <div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div> <div class='next' style='display:none;'> <img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"fillAnswer('questAnswer');\" /></div>";
	
	 echo "</div>";
	 
	  }
	
	echo"
      </form>
 </div>";
 break;
	}
	

}
else 
{
	echo "<script type='text/javascript'>$('.addFieldOuter').remove();</script>";
	
	
			echo '<div class="onlineExamsOuter"><div class="onlineExamContinueContent">Thank you for taking up the sample exam. <a href="sample_exam_instruction.php"> Go Back </a>to write the another exam</div></div>';
	         unset($_SESSION['sampleusertest']);
	         unset($_SESSION['samplequestionarray']);
	         unset($_SESSION['samplequestCount']);
	         unset($_SESSION['samplecurrentQuestion']);
	         unset($_SESSION['samplecurrentQuestiontype']);
	         unset($_SESSION['MatchCorrectQuestAnswer']);
	         unset($_SESSION['MatchQuestiontypeid']);
	         unset($_SESSION[ 'uniqueTestKey' ]);
	         unset($_SESSION[ 'uniqueTestKeyShown' ]);
	         unset($_SESSION['sampleuserexaminfo']);
		
	
}


}

?>