<?php
include("../config/config.inc.php");
?>
<script type="text/javascript" src="../web/scripts/jquery.countdown.js"></script>

<?php
/*include("../config/classes/loginmaster.class.php");*/
include("../config/classes/onlineexam.class.php");
include("../config/classes/exam.class.php");
//print_r($_SESSION);
$roleid = $_SESSION[studentinfo]['role_id'];
$userid = $_SESSION[studentinfo]['user_id'];
$username = $_SESSION[studentinfo]['first_name'];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$assignedexamID = $_SESSION['userexaminfo']['assignedid'];
$courseid=$_SESSION['userexaminfo']['course_id'];
$pos=$_REQUEST['pos'];
$inc=$_REQUEST['inc'];
$queid=$_REQUEST['queid'];
//echo "ggg".$pos;exit;
$option=$_REQUEST['option'];//echo $userid; exit;
//echo "ddd".$courseid; exit;
$Type=$_REQUEST['Type'];
$typeID=$_REQUEST['typeID'];
$key=$_REQUEST['examkey'];
$seconds=$_REQUEST['seconds'];
$answers=$_REQUEST['answers'];
$answers = str_replace("'", '', $answers);
$answers = str_replace('"', '', $answers);

//echo $answers;exit;
//echo $inc."hhh";
//echo "fdfdg".$key;exit;
/*if($Type=='UA')
{
	$updateanswers=onlineexamquestions::updateanswers($userid,$courseid,$rowID,$typeID);
}*/

if($typeID=='3')
{

					$strmatchvalue=$answers;
					$arrmatchquestval=explode("!~@",$strmatchvalue);

					foreach($arrmatchquestval as $arrvalue)
					{
						$correctanswer = 0;
						$arrmatchquest=explode("#@",$arrvalue);
							 $matchanswer= $arrmatchquest[0];
							 $answeredvalue=$arrmatchquest[1];
							 $matchquestionid=$arrmatchquest[2];
							 $mchquestionid=$arrmatchquest[3];
							 $mchanswerindex=$arrmatchquest[4];
							 $mchanswer=$arrmatchquest[5];
					

						if($arrmatchquest[2]==$arrmatchquest[5])
						{

							$correctanswer = 1;
						}
					

				//$questiontypeid=$onlineexam->getquestiontypeid(3);
				$arrexamdetails = array('key'=>$key,'question_id'=>$mchquestionid,'question_type_id'=>'3','answers'=>$matchanswer,'mark'=>$correctanswer,'matchanswer'=>$answeredvalue);
				$insert = onlineexamquestions::insertExamDetails($arrexamdetails);
				}
}
$examquestions=onlineexamquestions::examquestions($userid,$courseid,$queid,$typeID,$answers,$inc,$key,$seconds,$assignedexamID);

//echo "<pre>";print_r($examquestions);exit;
$_SESSION['userexaminfo']['currenttiming']=$examquestions[0]['CurrentTime'];
//echo $examquestions[0]['CurrentTime']."dddd";

//echo $examquestions[0]['CurrentTime'];

//echo $examquestions[0]['chkcomplete'];
//echo '<input type="hidden" id="hdnmatchcnt" value="'.$examquestions[0]["matchcount"].'">';
	//echo '<input type="hidden" id="hdnquetype" value="'.$examquestions[0]["quetypeid"].'">';


					
//}		
//print_r($examquestions);exit;			
if($examquestions[0]['quetypeid']==1)
{
			  echo "<div class='onlineExamsBottom'><div class='questionTitle'>
		  <div class='questionTitleLeft'>".$examquestions[0]['quetype']." - Question ".($examquestions[0]['mcposition']+1)." of ".$examquestions[0]['mccount']."</div>
		  </div>
		  
		  <form name='frmQuestion' method='post'>
		  <div class='part1Content'><span>".$examquestions[0]['que']."</span>";
		  $choice = $examquestions[0]['answers'];
			$options=explode(",",$choice);
$ch=0;
		  foreach ($options as $choices ){
		echo  " <label><input type='radio' class='choices' name='questAnswer' id='".$examquestions[0]['ID']."' value='".$ch."' {$disabled} />".$choices."</label>";
		$ch++;
			 }
		  echo "</div>";
 echo "<div class='questionTitle'>
      ";
	  if($examquestions[0]['chkcomplete']=='Y')
	  {
echo"<div class='questionBtnLeft'> ";
echo "<input type='button' name='btnComplete'  class='btnContinue' queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' value='Complete' alt='txtAnswer' /></div>";
	  }
	  else
	  {
echo"<div class='questionBtnLeft'>";
echo"<div class='nextd'  >
<img src='../web/images/next-btn-disable.png' width='61' height='25'  /></div>";
echo "<div class='next' style='display:none;'> <a href='#' class='nxt'><img src='../web/images/next-btnf.png' width='61' height='25' class='btnrdoselected' id='".$examquestions[0]['quetypeid']."' queid='".$examquestions[0]['QuestionID']."' alt='questAnswer' /></a></div>";
	  echo "</div>";
	  }
	echo"
      </div>";
}
elseif($examquestions[0]['quetypeid']==6)
{
	
	$totatl= $examquestions[0]['position'] - $examquestions[0]['mccount'];
	
	echo "<div class='onlineExamsBottom'>
<div class='questionTitle'>
<div class='questionTitleLeft'>".$examquestions[0]['quetype']." - Question ".($examquestions[0]['fillposition']+1)." of ".$examquestions[0]['fillcount']."</div></div>
<form name='frmQuestion' method='post'>
      <div class='part2Content'><span>".$examquestions[0]['que']."</span>
	   <input type='text' name='questAnswer' value='' id='fill' que='".$examquestions[0]['ID']."'  class='fillquestAnswer'  autocomplete='off'  onpaste='return false'   maxlength='50'  />
	  </div>";
echo "<div class='questionTitle'>";
	   if($examquestions[0]['chkcomplete']=='Y')
	  {
		   echo"<div class='questionBtnLeft'> ";
echo "<input type='button' name='btnComplete'  class='btnContinue' queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' value='Complete' alt='txtAnswer' /></div>";
	  }
	  else
	  {
echo"<div class='questionBtnLeft'>";
echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'/></div>";
echo "<div class='next' style='display:none;'><a href='#' class='nxt'> <img src='../web/images/next-btnf.png' width='61' height='25' class='fillAnswer' id='".$examquestions[0]['quetypeid']."'  queid='".$examquestions[0]['QuestionID']."' alt='questAnswer' /></a></div>";
echo "</div>";
	  }
	echo"
</form>
</div>";
}
elseif($examquestions[0]['quetypeid']==3)
{
	
$match=	$examquestions[0]['answers'];

//$matchanswers=shuffle($match);
//print_r($matchanswers);

	echo "<div class='onlineExamsBottom'>

<script type='text/javascript'>

</script>

<div class='questionTitle'>
<div class='questionTitleLeft'>".$examquestions[0]['quetype']." - Question 1 of 1</div>
";
echo"
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
  $answercode=1;
  	
$answer = onlineexamquestions::getanswersmatch($userid,$courseid);
//echo "<pre>";print_r($answer);
$i=0;
foreach ($examquestions as $matchthefollowing){

 //echo "<pre>";print_r($matchthefollowing);
	if($option == 'MATCHBACK')
				$disabled='disabled' ;
				else  $disabled='' ;
	echo "<li id='frmMatch'>
        <div class='dynamicfields'>
        <div>
       <span class='option'>{$answercode}</span>

        <textarea title='Enter question' class='required questionbox' name='txtMatchQuestion' id='".$matchthefollowing['QuestionID']."' cols='28' rows='3' disabled='disabled'>".$matchthefollowing['que']."</textarea>

        <textarea title='Enter answer' class='required answerBox' name='txtAddress' id='".$matchthefollowing['QuestionID']."' cols='28' rows='3' disabled='disabled'>".$answer[$i][1]."</textarea>";
	/*if(count($cur_nextquestion) >= 10)
	$maxlength = 2;
	else $maxlength = 1;*/
	
	
	
   echo "<input type='text' value='' name='txtCorrectanswer[]'  id ='".$answer[$i][0]."'  class='required number matchAnswer' title='Please fill the value'  maxlength='{$maxlength}' />";
   
    echo "<input type='hidden' id='' value='".($i+1)."'";
    echo "</div>
     </div>
      </li>";
	  $answercode++;
	  $i++;
}

echo '</ul>';
echo "</div>";

	  
echo"<div class='questionBtnLeft'>";
echo"<div class='nextd'><img src='../web/images/next-btn-disable.png' width='61' height='25'/></div>";
echo "<div class='next' style='display:none;' ><a href='javascript:;' id='".$examquestions[0]['quetypeid']."' class='nxtmatch'><img src='../web/images/next-btnf.png' width='61' height='25'/></a></div>";
echo "</div>";

echo "</form>";
echo "</div>";
echo "</div>";
}
elseif($examquestions[0]['quetypeid']==4)
{
	echo "
<div class='onlineExamsBottom'>
<div class='questionTitle'>
 <div class='questionTitleLeft'>".$examquestions[0]['quetype']." - Question ".($examquestions[0]['subj5position']+1)." of ".$examquestions[0]['subj5count']."</div>
</div>
<form name='frmQuestion' method='post' >
<div class='part4Content'><span class='question'>".$examquestions[0]['que']."</span>
<textarea name='txtAnswer' class='txtsubjective' que='".$examquestions[0]['ID']."' cols='50' rows='10' ></textarea>";
 /*?><script>$(document).ready(function() {getckeditor();});</script> <?php */
echo "</div>"; 
echo "<div class='questionTitle'>";
if($examquestions[0]['chkcomplete']=='Y')
{
echo"<div class='questionBtnLeft'> ";
echo "<input type='button' name='btnComplete'  class='btnContinue' queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' value='Complete' alt='txtAnswer' /></div>";	
}
else 
{
echo"<div class='questionBtnLeft'>";
echo "<div class='next'><a href='javascript:;'><img src='../web/images/next-btnf.png' width='61' height='25'  queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' class='subjectiveanswer' alt='txtAnswer' /></a></div>";
echo "</div>";
}
echo"</div>
</form>
</div>";

}
elseif($examquestions[0]['quetypeid']==5)
{
	echo "
<div class='onlineExamsBottom'>
<div class='questionTitle'>
 <div class='questionTitleLeft'>".$examquestions[0]['quetype']." - Question ".($examquestions[0]['subj4position']+1)." of ".$examquestions[0]['subj4count']."</div>
</div>
<form name='frmQuestion' method='post' >
<div class='part4Content'><span class='question'>".$examquestions[0]['que']."</span>
<textarea name='txtAnswer' class='txtsubjective' que='".$examquestions[0]['ID']."' cols='50' rows='10' ></textarea>";
 /*?><script>$(document).ready(function() {getckeditor();});</script> <?php */
echo "</div>"; 
echo "<div class='questionTitle'>";
if($examquestions[0]['chkcomplete']=='Y')
{
echo"<div class='questionBtnLeft'> ";
echo "<input type='button' name='btnComplete'  class='btnContinue' queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' value='Complete' alt='txtAnswer' /></div>";	
}
else 
{
echo"<div class='questionBtnLeft'>";
echo "<div class='next'><a href='javascript:;'><img src='../web/images/next-btnf.png' width='61' height='25'  queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' class='subjectiveanswer' alt='txtAnswer' /></a></div>";
echo "</div>";
}
echo"</div>
</form>
</div>";

}
elseif($examquestions[0]['quetypeid']==7)
{
	echo "
<div class='onlineExamsBottom'>
<div class='questionTitle'>
 <div class='questionTitleLeft'>".$examquestions[0]['quetype']." - Question ".($examquestions[0]['subj6position']+1)." of ".$examquestions[0]['subj6count']."</div>
</div>
<form name='frmQuestion' method='post' >
<div class='part4Content'><span class='question'>".$examquestions[0]['que']."</span>
<textarea name='txtAnswer' class='txtsubjective' que='".$examquestions[0]['ID']."' cols='50' rows='10' ></textarea>";
 /*?><script>$(document).ready(function() {getckeditor();});</script> <?php */
echo "</div>"; 
echo "<div class='questionTitle'>";
if($examquestions[0]['chkcomplete']=='Y')
{
echo"<div class='questionBtnLeft'> ";
echo "<input type='button' name='btnComplete'  class='btnContinue'  queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' value='Complete' alt='txtAnswer' /></div>";	
}
else 
{
echo"<div class='questionBtnLeft'>";
echo "<div class='next'><a href='javascript:;'><img src='../web/images/next-btnf.png' width='61' height='25'  queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' class='subjectiveanswer' alt='txtAnswer' /></a></div>";
echo "</div>";
}
echo"</div>
</form>
</div>";

}
elseif($examquestions[0]['quetypeid']==8)
{
	echo "
<div class='onlineExamsBottom'>
<div class='questionTitle'>
 <div class='questionTitleLeft'>".$examquestions[0]['quetype']." - Question ".($examquestions[0]['subj8position']+1)." of ".$examquestions[0]['subj8count']."</div>
</div>
<form name='frmQuestion' method='post' >
<div class='part4Content'><span class='question'>".$examquestions[0]['que']."</span>
<textarea name='txtAnswer' class='txtsubjective' que='".$examquestions[0]['ID']."' cols='50' rows='10' ></textarea>";
 /*?><script>$(document).ready(function() {getckeditor();});</script> <?php */
echo "</div>"; 
echo "<div class='questionTitle'>";
if($examquestions[0]['chkcomplete']=='Y')
{
echo"<div class='questionBtnLeft'> ";
echo "<input type='button' name='btnComplete'  class='btnContinue' value='Complete'  queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' alt='txtAnswer' /></div>";	
}
else 
{
echo"<div class='questionBtnLeft'>";
echo "<div class='next'><a href='javascript:;'><img src='../web/images/next-btnf.png' width='61' height='25'  queid='".$examquestions[0]['QuestionID']."' id='".$examquestions[0]['quetypeid']."' class='subjectiveanswer' alt='txtAnswer' /></a></div>";
echo "</div>";
}
echo"</div>
</form>
</div>";

}

//if(!$_SESSION['userexaminfo'])
//{
//$arrInput = array('course_id'=>$_REQUEST['CourseID'],'student_id'=>$_REQUEST['StudentID']);

//}
//print_r($_SESSION);
if($_SESSION['questCount']=='-1')
{
	//echo "sdsdsd".$_SESSION['userexaminfo']['examduration'];
			echo "<script type='text/javascript'>
			$('.addFieldOuter').remove();
		var texttimer = \"<span class='addFieldOuter'><span id='timer'></span></span>\";
		$('#appendTimer').append(texttimer);
		$('#timer').countdown({until: {$_SESSION['userexaminfo']['examduration']}, expiryUrl: 'online_exam_complete.php',compact: true}); 
		</script>";
}
else
{//echo "sdsdsd".$_SESSION['userexaminfo']['currenttiming'];
	echo "<script type='text/javascript'>
			$('.addFieldOuter').remove();
		var texttimer = \"<span class='addFieldOuter'><span id='timer'></span></span>\";
		$('#appendTimer').append(texttimer);
		$('#timer').countdown({until: {$_SESSION['userexaminfo']['currenttiming']}, expiryUrl: 'online_exam_complete.php',compact: true}); 
		</script>";
}
	  ?>  
<script type="text/javascript">

$(document).ready(function () {
$.validator.addMethod("noDecimal", function(value, element) {
    return !(value % 1);
}, "No decimal numbers");

$('#frmMatch').validate({
rules:{
	 "txtCorrectanswer[]":{
		 number: true,
		 noDecimal: true,
		 min: 1,
		 maxlength: 2 
			}
},
			messages:{	
			"txtCorrectanswer[]":{
			number: "Please enter valid answer",
			noDecimal: "Please enter no decimals",
			min :"Please do not enter zero value",
			maxlength: "Enter valid answer"
        }
},
		highlight: function(element) {
        $(element).parent('div').addClass("has-error");
    	},
    		unhighlight: function(element) {
        $(element).parent('div').removeClass("has-error");
    	},
		errorClass: "matchError",
		errorElement: 'span',
		ignore:":hidden",	
		errorPlacement: function(error, element){error.insertAfter(element);}
	});

 var $input = $('#frmMatch input:text'),
        $register = $('.next');
    $register.attr('disabled', true);

    $input.keyup(function () {
        var trigger = false;
        $input.each(function () {
            if (!$(this).val()) {
                trigger = true;
            }
        });
        //trigger ? $('.next').hide();$('.nextd').show() : $('.next').show();$('.nextd').hide();
		if (trigger) {$('.next').hide();$('.nextd').show();} else {$('.next').show();$('.nextd').hide();}
    });
	});
$('.btnrdoselected').click(function(){
	<?php $_SESSION['questCount']='2';?>
	var periods = $('#timer').countdown('getTimes');
var currentseconds = $.countdown.periodsToSeconds(periods);

var quetypeID=$(this).attr('id');
var rowID=$(".choices").attr('id');
var courseid='<?php echo $courseid; ?>';
var queid=$(this).attr('queid');
var examkey='<?php echo $_SESSION['uniqueTestKey']; ?>';
var i=1+1;
var answers=$(".choices:checked").val();
//alert(answers);
updateanswers(quetypeID,queid,courseid,examkey,currentseconds,i,answers);
//questions();

});
$('.fillAnswer').click(function(){
	<?php $_SESSION['questCount']='2';?>
	var periods = $('#timer').countdown('getTimes');
var currentseconds = $.countdown.periodsToSeconds(periods);
var typeID=$(this).attr('id');
var rowID=$(".fillquestAnswer").attr('que');
var courseid='<?php echo $courseid; ?>';
var examkey='<?php echo $_SESSION['uniqueTestKey']; ?>';
var queid=$(this).attr('queid');
var i=1+1;
var answers=$(".fillquestAnswer").val();
updateanswers(typeID,queid,courseid,examkey,currentseconds,i,answers);
//questions();

});


$('.nxtmatch').click(function(){
if($('#frmMatch').valid()){
	<?php $_SESSION['questCount']='2';?>
var periods = $('#timer').countdown('getTimes');
var currentseconds = $.countdown.periodsToSeconds(periods);
var typeID=$(this).attr('id');
var courseid='<?php echo $courseid; ?>';
var examkey='<?php echo $_SESSION['uniqueTestKey']; ?>';
var i=1+1;
var flag = false ;
var countmatch =1;
	var matchquest='';

	$('.dynamicfields input.matchAnswer').each(function() {
		if( $(this).val() == '' || isNaN($(this).val()))
		flag = true ;
		return false;
	});
	if(!flag)
	{
	$('.dynamicfields input.matchAnswer').each(function() {
	 $(".onlineExamsBottom").html('<div class="ajax-loader"><img src="../web/images/ajax-loader.gif" /></div>');
	 //alert($(this).attr('id')+","+$(this).closest('ul').children('li').eq(parseInt($(this).val())-1).find('.questionbox').attr('id'));
			if(countmatch==1){
				matchquest=($(this).val()+'#@'+$(this).prev().val()+'#@'+$(this).attr('id')+'#@'+$(this).prev().attr('id')+'#@'+$(this).next().val()+'#@'+$(this).closest('ul').children('li').eq(parseInt($(this).val())-1).find('.questionbox').attr('id'));
				
			}
			else
			 {
				matchquest+='!~@'+($(this).val()+'#@'+$(this).prev().val()+'#@'+$(this).attr('id')+'#@'+$(this).prev().attr('id')+'#@'+$(this).next().val()+'#@'+$(this).closest('ul').children('li').eq(parseInt($(this).val())-1).find('.questionbox').attr('id'));
			 }
			countmatch++;

    });
	}
updateanswers(typeID,'',courseid,examkey,currentseconds,i,matchquest);
//questions();
}
});
$('.subjectiveanswer').click(function(){
	<?php $_SESSION['questCount']='2';?>
var periods = $('#timer').countdown('getTimes');
var currentseconds = $.countdown.periodsToSeconds(periods);
var typeID=$(this).attr('id');
var courseid='<?php echo $courseid; ?>';
var rowID=$(".txtsubjective").attr('que');
var queid=$(this).attr('queid');
var examkey='<?php echo $_SESSION['uniqueTestKey']; ?>';
var i=1+1;
var answers=$(".txtsubjective").val();
updateanswers(typeID,queid,courseid,examkey,currentseconds,i,answers);
//questions();

});

$('.btnContinue').click(function(){
	var periods = $('#timer').countdown('getTimes');
var currentseconds = $.countdown.periodsToSeconds(periods);
var typeID=$(this).attr('id');
var courseid='<?php echo $courseid; ?>';
var rowID=$(".txtsubjective").attr('que');
var queid=$(this).attr('queid');
var answers=$(".txtsubjective").val();
	//alert(courseid);
$.ajax({
    url: 'destroysession.php',
    type: 'post',	
    data: {typeID:typeID,rowID:rowID,queid:queid,answers:answers,currentseconds:currentseconds,courseid:courseid,userid:'<?php echo $userid; ?>'}, //send a value to make sure we want to destroy it.
    success: function(data){
    //alert(data);
		$('.addFieldOuter').remove();
      $(".onlineExamsBottom").html('<div class="onlineExamsOuter"><div class="onlineExamContinueContent">You have successfully completed the exam. The result will be published as soon as the evaluation has been completed and will be posted on your user panel. Please allow 4 to 6  weeks from completion of examination for the posting of your results.  <a href="online_exam_instruction.php"> Go Back </a>to write the another exam</div></div>');
    }
  });
});

/*$('.btnContinue').click(function(){
	
var courseid='<?php echo $courseid; ?>';

	//alert(courseid);
$.ajax({
    url: 'destroysession.php',
    type: 'post',	
    data: {courseid:courseid,userid:'<?php echo $userid; ?>'}, //send a value to make sure we want to destroy it.
    success: function(data){
		$('.addFieldOuter').remove();
      $(".onlineExamsBottom").html('<div class="onlineExamsOuter"><div class="onlineExamContinueContent">You have successfully completed the exam. The result will be published as soon as the evaluation has been completed and will be posted on your user panel. Please allow 4 to 6  weeks from completion of examination for the posting of your results.  <a href="online_exam_instruction.php"> Go Back </a>to write the another exam</div></div>');
    }
  });
});*/

$('.choices').click(function(){
	$('.next').show();
	$('.nextd').hide();
});

$("#fill").keydown(function(){
	
	$('.next').show();
	$('.nextd').hide();

});

</script>