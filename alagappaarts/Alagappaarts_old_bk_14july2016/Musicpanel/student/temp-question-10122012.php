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



$usertestid = $_SESSION['usertest'];



$arrayfin = $_SESSION['questionarray'];

$examdetails = $_SESSION['userexaminfo'];

$i = $_SESSION['questCount'];

$answerselected = $_REQUEST['selected'];



$option = $_REQUEST['option'];



$flag =1;



if(($i > -1))

{

	

	$answerselected = addslashes($answerselected);

	$currentQuestion = $_SESSION[ 'currentQuestion' ];		

	$currentQuestionType = $_SESSION['currentQuestiontype'];

	$correctAnswer = $onlineexam->getAnswer($currentQuestion);

	$correctanswer=0;

	/*if($currentQuestionType  == 6){

	$answerselected = str_replace(' ', '', $answerselected);

	$answerselected = strtolower($answerselected);

	$correctAnswer->fields['answer'] = str_replace(' ', '', $correctAnswer->fields['answer']);

	$correctAnswer->fields['answer'] = strtolower($correctAnswer->fields['answer']);

        }*/

	if($answerselected == $correctAnswer->fields['answer'])

	{

		$correctanswer=1;

			

	}

	if($option=='NEXT')

	{

					

					if(isset($_REQUEST['matchquestionid'])){

					$matchquestionid=$_REQUEST['matchquestionid'];

					$matchanswer=$_REQUEST['matchanswer'];

					$answeredvalue=$_REQUEST['answeredvalue'];

					$matchCorrectanswers = $_SESSION['MatchCorrectQuestAnswer'];

					foreach ($matchCorrectanswers as $key=>$value ){

						if($matchquestionid == $key){

							if($matchanswer == $value ){

								$correctanswer = 1;

							}

							else  {

								$correctanswer = 0;

							}

							 $questiontypeid = $_SESSION['MatchQuestiontypeid'] ;

						$arrexamdetails = array('assign_exam_id'=>$usertestid,'question_id'=>$matchquestionid,'question_type_id'=>$questiontypeid,'answers'=>$matchanswer,'mark'=>$correctanswer,'matchanswer'=>$answeredvalue);

						if($matchanswer)

						$insert = $onlineexam -> insertExamDetails($arrexamdetails);

							}

						}

				$flag =0;

					}

					else

					{

						$flag = 1;

						$arrexamdetails = array('assign_exam_id'=>$usertestid,'question_id'=>$currentQuestion,'question_type_id'=>$currentQuestionType,'answers'=>$answerselected,'mark'=>$correctanswer,'matchanswer'=>'');

						if($currentQuestionType == 4 && $answerselected == "" )

						{}else $insert = $onlineexam -> insertExamDetails($arrexamdetails);

					}

				

	}

	

	

}

$totalQuestion = count($arrayfin);



			switch($option)

			{

				case 'NEXT':

				case 'SKIP': $i++;

							break;

				case 'BACK': $i--;

							break;

			   case 'MATCHSKIP':

								$countmatch = $onlineexam->getmatchcount($examdetails['course_id'],$arrayfin[$i]['question_type_id']);

								$i = $i + $countmatch;

								$flag =0;

								break;

			 case 'MATCHBACK':

								$countmatch = $onlineexam->getmatchcount($examdetails['course_id'],$arrayfin[$i-1]['question_type_id']);

								//echo $countmatch;

								$i = $i - $countmatch;

								//$i--;

							

								break;

								

			

			  default : $i++;

			             break;

			}

			//echo $i;



$_SESSION['questCount'] = $i;



$arrayIndex = $_SESSION['questCount'];



$arrayDisp = $arrayIndex+1;



$_SESSION['currentQuestion'] = $arrayfin[$arrayIndex]['questionid'];

$_SESSION[ 'currentQuestiontype' ] = $arrayfin[$arrayIndex]['question_type_id'];



if($arrayfin[$arrayIndex]['questiontype'] == "match-the-following"){

	if(isset ($_SESSION['MatchQuestion']))

	$getQuestion = $_SESSION['MatchQuestion'];

	else 

	{

	$getQuestion = $onlineexam -> getNextSetofQuestion($arrayfin);

	$_SESSION['MatchQuestion'] = $getQuestion;

	}



	 }

$currentseconds =  $_REQUEST['seconds'];



if($option=='NEXT')

{

$sqlcurrentQuestion = "update assign_exam set currentquestion='{$_SESSION[ currentQuestion ]}', currenttiming = '{$currentseconds}' where examkey='{$_SESSION[uniqueTestKey]}'";

$DB->Execute( $sqlcurrentQuestion );	

}

else

{

	$sql = "update assign_exam set currenttiming = '{$currentseconds}' where examkey='{$_SESSION[uniqueTestKey]}'";

    $DB->Execute( $sql );

}



if($arrayDisp <= $totalQuestion)

{

	if($examdetails['examtaken'])

		{  $remainingsecond= $currentseconds;

			if($option  == 'CONTINUE'){

			echo "<script type='text/javascript'>

			$('.addFieldOuter').remove();

		var texttimer = \"<span class='addFieldOuter'><span id='timer'></span></span>\";

		$('#appendTimer').append(texttimer);

		$('#timer').countdown({until: {$remainingsecond}, expiryUrl: 'online_exam_complete.php',compact: true}); 

		</script>";

			}

		 

		}

		else 

		{

			if($arrayDisp==1 && $option != 'BACK' )

			{

		echo "<script type='text/javascript'>

		$('.addFieldOuter').remove();

		var texttimer = \"<span class='addFieldOuter'><span id='timer'></span></span>\";

		$('#appendTimer').append(texttimer);

		$('#timer').countdown({until: {$examdetails['examduration']}, expiryUrl: 'online_exam_complete.php',compact: true}); 

		</script>";

			}

		}

	/*

	

	if($arrayDisp==1)

	{

		

		echo "<script type='text/javascript'>

		var texttimer = \"<span class='addFieldOuter'><span id='timer'></span></span>\";

		$('#appendTimer').append(texttimer);

		$('#timer').countdown({until: {$examdetails['examduration']}, expiryUrl: 'online_exam_complete.php',compact: true}); 

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

		$('#timer').countdown({until: {$remainingsecond}, expiryUrl: 'online_exam_complete.php',compact: true}); 

		</script>";

		}

	}

	*/

	$last = 0;

	$first = 0;



	if($arrayDisp == $totalQuestion)

	{

		$last = 1;

	}

	if(  $arrayDisp == 1) {$first = 1; }

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

	

	//$k= 0;

	switch($arrayfin[$arrayIndex]['questiontype'])

	{

		case 'multiple-choice':

		


				if($option == 'BACK')

				$disabled='disabled' ;

				else  $disabled='' ;

					

			  echo "<div class='onlineExamsBottom'><div class='questionTitle'>

		  <div class='questionTitleLeft'>".$arrayfin[$arrayIndex]['question_type_name']." - Question {$arrayfin[$arrayIndex]['position']} of {$questiontypeinfo[$arrayfin[$arrayIndex]['question_type_id']]}</div>

		  </div>

		  <form name='frmQuestion' method='post' >

		  <div class='part1Content'><span>".$arrayfin[$arrayIndex]['question']."</span>

		  <label><input type='radio' name='questAnswer' value='0' {$disabled} />".$arrayfin[$arrayIndex]['choice1']."</label>

		   <label><input type='radio' name='questAnswer' value='1'  {$disabled} />".$arrayfin[$arrayIndex]['choice2']."</label>

			<label><input type='radio' name='questAnswer' value='2'  {$disabled} />".$arrayfin[$arrayIndex]['choice3']."</label>

			

		  </div>";

			 

			

	 

 echo "<div class='questionTitle'>

      ";

	  if($last)

	  {

		   echo"

		   <div class='questionBtnLeft'>";

		 //  echo " <div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";

		   echo "<input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"btnradioselected('questAnswer');\" /></div>";

	  }

	  else if($first)

	  {

		echo"<div class='questionBtnLeft'>";

		//if($arrayfin[$arrayIndex]['questionid'] == $currentQuestion)

echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";
		 echo"<div class='next' style='display:none;' > <img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>";

	  //	echo"<div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

		echo "</div>";

	  }

	  else

	  {

		    echo"<div class='questionBtnLeft'>";

			//echo "<div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";

			//if ($arrayfin[$arrayIndex]['questionid'] == $currentQuestion)
echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";
			echo "<div class='next' style='display:none;'> <img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>";

	  //echo "<div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

	  echo "</div>";

	 

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

	  <label><input type='radio' name='questAnswer' value='True' {$disabled} />True</label>

	   <label><input type='radio' name='questAnswer' value='False' {$disabled} />False</label>

	    

	  </div>";

			 
echo "<div class='questionTitle'>

     ";

	   if($last)

	  {

		   echo"

		   <div class='questionBtnLeft'> ";

		   //echo "<div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";
 		   echo "<input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"btnradioselected('questAnswer');\" /></div>";

	  }

	  else if($first)

	  {

		 echo"<div class='questionBtnLeft'>";

		//if($arrayfin[$arrayIndex]['questionid'] == $getAnswer)
echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";
		 echo"<div class='next' style='display:none;'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>";

	  	//echo"<div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

		echo "</div>";

	  }

	  else

	  {

		    echo"<div class='questionBtnLeft'>";

			//echo "<div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";
echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";

			echo "<div class='next' style='display:none;'> <img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>";

	// echo " <div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

	 echo "</div>";

	 

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

	$answer = $onlineexam -> answerforquestion ($usertestid,$matchthefollowing[correctquestionid]);

	if($option == 'MATCHBACK')

				$disabled='disabled' ;

				else  $disabled='' ;

	echo "<li id='frmMatch'>

        <div class='dynamicfields'>

        <div>

       <span class='option'>{$matchthefollowing[answercode]}</span>

        <textarea title='Enter question' class='required' name='txtMatchQuestion' cols='28' rows='3' disabled='disabled'>{$matchthefollowing[question]}</textarea>

        <textarea title='Enter answer' class='required answerBox' name='txtAddress' cols='28' rows='3' disabled='disabled'>{$matchthefollowing[answer]}</textarea>";

			if(  count($getQuestion) >= 10)

		$maxlength = 2;

		else $maxlength = 1;

		 

       echo " <input type='input' value='' name='txtCorrectanswer[]'  id ='{$matchthefollowing[correctquestionid]}'   class='required number matchAnswer' title='Please fill the value'  maxlength='{$maxlength}' />";

	    
    echo "</div>

     </div>

       

      </li>";

	}

echo '</ul>';

echo "</div>";

  if($last)

	  {

		   echo"

		   <div class='questionBtnLeft'>";

		  // echo " <div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";

		   echo "<input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"matchthefollowing('txtCorrectanswer');\" /></div>";

	  }

	  else if($first)

	  {

		 echo"<div class='questionBtnLeft'>";
		 echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";
		 echo "<div class='next' style='display:none;' ><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>";

	 //echo " <div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('MATCHSKIP');\" /></div>";

	 echo "</div>";

	  }

	  else

	  {

		    echo"<div class='questionBtnLeft'>";

		//	echo "<div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";
 echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";
			echo "<div class='next' style='display:none;' > <img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"matchthefollowing('txtCorrectanswer');\" /></div>";

			//echo "<div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('MATCHSKIP');\" /></div>";

			echo "</div>";

	 

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

	  </div>"; 

	  

echo "<div class='questionTitle'>

     ";

			

	   if($last)

	  {

		   echo"

		   <div class='questionBtnLeft'> ";

		  // echo "<div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";

		   echo "<input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"subjectiveanswer('txtAnswer');\" /></div>";

	  }

	  else if($first)

	  {

		 echo"<div class='questionBtnLeft'><div class='next'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"btnradioselected('questAnswer');\" /></div>";

	//  echo " <div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

	  echo "</div>";

	  }

	  else if($arrayfin[$arrayIndex-1]['questiontype'] == "match-the-following" )

	  {

		    echo"<div class='questionBtnLeft'> ";

			//echo "<div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('MATCHBACK');\" /></div>";

			echo "<div class='next'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"subjectiveanswer('txtAnswer');\" /></div>";

	//echo " <div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

	 echo "</div>";

	 

	  }

	  else {

		  

		    echo"<div class='questionBtnLeft'>";

		//	echo " <div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";

			echo "<div class='next'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"subjectiveanswer('txtAnswer');\" /></div>";

			//echo "<div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

			echo "</div>";

		  }

		  

		 

     

	// echo"</div>";

       echo"</div>

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

      <div class='part2Content'><span>".$arrayfin[$arrayIndex]['question']."</span>

	   <input type='text' name='questAnswer' value=''  class='fillquestAnswer'    maxlength='50'  />

	    

	    

	  </div>";

			 
echo "<div class='questionTitle'>

     ";

	   if($last)

	  {

		   echo " <div class='questionBtnLeft'>";

		//   echo " <div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";

		   echo "<input type='button' name='btnComplete'  class='btnContinue' value='Complete' onclick=\"fillAnswer('questAnswer');\" /></div>";

	  }

	  else if($first)

	  {

		 echo"<div class='questionBtnLeft'>";

		
echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";

		 echo"<div class='next' style='display:none;'><img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"fillAnswer('questAnswer');\" /></div>";

	  	//echo"<div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

		echo "</div>";

	  }

	  else

	  {

		    echo"<div class='questionBtnLeft'>";

			//echo "<div class='back'><img src='../web/images/back-btn.png' width='61' height='25' onclick=\"backquestion('BACK');\" /></div>";
echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";

			echo "<div class='next' style='display:none;'> <img src='../web/images/next-btnf.png' width='61' height='25' onclick=\"fillAnswer('questAnswer');\" /></div>";

	//echo "  <div class='skip'><img src='../web/images/skip-btn.png' width='61' height='25' onclick=\"skipanswer('SKIP');\" /></div>";

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

	

	$testcomplete = $onlineexam->userTestComplete($usertestid);

	if($testcomplete)

	{

			echo '<div class="onlineExamsOuter"><div class="onlineExamContinueContent">You have successfully completed the exam. The result will be published as soon as the evaluation has been completed and will be posted on your user panel. Please allow 4 to 6  weeks from completion of examination for the posting of your results.  <a href="online_exam_instruction.php"> Go Back </a>to write the another exam</div></div>';

	         unset($_SESSION['usertest']);

	         unset($_SESSION['questionarray']);

	         unset($_SESSION['questCount']);

	         unset($_SESSION['currentQuestion']);

	         unset($_SESSION['currentQuestiontype']);

	         unset($_SESSION['MatchCorrectQuestAnswer']);

	         unset($_SESSION['MatchQuestiontypeid']);

	         unset($_SESSION[ 'uniqueTestKey' ]);

	         unset($_SESSION[ 'uniqueTestKeyShown' ]);

	         unset($_SESSION['userexaminfo']);

			  unset($_SESSION['MatchQuestion']);

			 

		

	}

}





}



?>