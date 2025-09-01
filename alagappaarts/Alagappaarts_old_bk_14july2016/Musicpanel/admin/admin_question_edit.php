<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[userinfo][role_id];
$userid = $_SESSION[userinfo][user_id];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$admin  = $loginmaster->isadmin($arrlogin);
if(!$admin)
{
	header('location:index.php?msg=Enter username password');
}
else
{
include('adminheader.php');
include("../config/classes/questiontypemaster.class.php");
include("../config/classes/coursemaster.class.php");
include("../config/classes/questionmaster.class.php");
$questionTypeMaster = new questiontypemaster();
 $courseMaster = new coursemaster();
 $questionMaster = new questionmaster();
 $questionid = $_GET[ questionid ];
 $getQuestion = $questionMaster -> viewquestion($questionid);
 $getQuestionCourse = $questionMaster -> getquestioncourse($questionid);
 if($getQuestion->fields['controllid']=='multiple-choice')
 {
	 $getMultipleAnswer = $questionMaster -> getmultipleanswers($questionid);
 }
 if(isset($_REQUEST['btnSubmit']))
 {  // $questionType = $_REQUEST['ddlquestiontype'];
 	$mysql_datetime = date('Y-m-d H:i:s');
	$multipleAnswer = $_REQUEST['chkans'];
	$macount = count($multipleAnswer);
	$k=1;
 foreach($multipleAnswer as $ma)
 {
	 if($k==$macount)
	 $manswers .=  $ma;
	 else
	 $manswers .=  $ma.",";
	 $k++;
 }
	 $arrquestion = array('addfor'=>$getQuestion->fields['controllid'],'question_id'=>$questionid ,'question_type_id'=>$_REQUEST['ddlquestiontype'],'courses'=>$_REQUEST['chkcourses'],'status'=>$_REQUEST['rdstatus'],'modified_on'=>$mysql_datetime,'modified_by'=>$userid);
	 switch($getQuestion->fields['controllid'])
	 {
		 case 'match-the-following':
		  $arrquestion = array_merge($arrquestion,array('question'=>$_REQUEST['txtMatchQuestion'],'answer'=>$_REQUEST['txtMatchAnswer']));
		 						break;
		 case 'multiple-choice':
		 $arrquestion = array_merge($arrquestion,array('question'=>$_REQUEST['txtchoicequestion'],'multipleanswer'=>$_REQUEST['txtMultipleAnswer'],'answer'=>$manswers));
		 						break;
		 case 'true-false': 
		  $arrquestion = array_merge($arrquestion,array('question'=>$_REQUEST['txtboolquestion'],'answer'=>$_REQUEST['rdbool']));
		 						break;
		 case 'subjective':
		  $arrquestion = array_merge($arrquestion,array('question'=>$_REQUEST['txtquestion']));
		  
								 break;
		 case 'fill-blank':
		 if($_REQUEST['txtfillCheck'] == 'answer2')
			$fillAnswer = 	$_REQUEST['txtfillAnswer'].','.$_REQUEST['txtfillAnswer2'] ;
			else 
			$fillAnswer =  $_REQUEST['txtfillAnswer'];
		  $arrquestion = array_merge($arrquestion,array('question'=>$_REQUEST['txtfillquestion'],'answer'=>$fillAnswer));
		 	 break;
		
	 }
	
	
	
		 $ackmsg = $questionMaster -> updatequestion($arrquestion);
		 if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Question updated successfully';
			header("location:admin_question_listing.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	 
	
	
 }
?>
<script type="text/javascript" src="../web/validation/questions.validate.js"></script>
<script>
$(document).ready(function() {
	$('div.multipleChoice').each(function(){
			$(this).hide();
			});
			
		selection = $("#questionType option:selected").attr('class');
		selectiontext = $("#questionType option:selected").text();
		$("#"+selection).show();
		selectiontext ="<span class='title'>"+selectiontext+"<strong class='star'>*</strong></span>";
		$("#"+selection).find('span.title').replaceWith(selectiontext);

$(".selectall").click(function() {
	
				var checked_status = this.checked;
				var checkbox_name = this.name;
				$("input."+this.name).each(function() {
					this.checked = checked_status;
				});
			});
			$("#anotherAnswer").click(function() {
	//alert( $(this).is(':checked'));
	if( $(this).is(':checked')  )
	  $('#anotherAnswershow').show(); 
	else $('#anotherAnswershow').hide();

});
});

</script>

<div class="studentViewContent">
      <h2>Add Question  </h2>
      <form id="questionform" method="post">
      
      <div class="addProgramForm question">
        <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
      <ul class="w90p">
     <li>
        <label>Question type :<strong class="star">*</strong> </label>
		<!--<input name="" type="text" />-->  
        <?php
		$getQuestionType = $questionTypeMaster -> activequestiontypes();
		echo '<select class="questionType" id="questionType" name="ddlquestiontype" disabled>';
		echo '<option value="">--Select--</option>';
		foreach($getQuestionType as $questiontype)
			{
				echo "<option value='{$questiontype[id]}' class='{$questiontype[controller]}'";
				if($getQuestion->fields['question_type_id']==$questiontype[id])
				{
					echo 'selected';
				}
				echo ">{$questiontype[name]}</option>";
			}
		echo '</select>';
		?>
         </li>
          
          <fieldset>
        <legend>Course Details</legend>
         <?php 
		$getPrograms = $courseMaster -> getprograms_havecourses();
		$countP = count($getPrograms);
		if($countP)
		{
			echo ' <table class="questionDetails" width="100%" border="0"><tr>';
			$i=1;
			foreach($getPrograms as $program)
			{
				$strname = split(' ',$program[name]);
				
				echo '<th width="21%" align="left" scope="col"><input type="checkbox" name="'.$strname[0].'" id="checkbox" class="selectall" /><label for="checkbox">'.$program[name].'</label></th>';
				if($i==$countP)
				{
					echo '</tr><div class="checkboxpgm"></div>';
				}
				$i++;
										
			}
			echo '<tr>';
			foreach($getPrograms as $program)
			{
				$strname = split(' ',$program[name]);
			$getCourses = $courseMaster -> getcourseprogram($program[id]);
			$countC = count($getCourses);
				if($countC)
				{ 		echo '<td>';		
				$j=0;   
					foreach($getCourses as $course)
					{
						
					echo"<label>
            <input type='checkbox' name='chkcourses[]' value='{$course[id]}' id='{$program[name]}_{$j}' class='{$strname[0]}' ";
					foreach($getQuestionCourse as $coursemapped)
					{
						if($coursemapped['course_id']== $course['id'])
						{
							echo 'checked';
						}
					}
			echo "/>{$course[code]}
           </label> <br />";
					
						$j++;
					}
					echo '</td>';	
				   
				}
			}
			echo '</tr></table>';
		}
		
		?> 
        
     </fieldset>
         <fieldset>
        <legend>Question Details</legend>
        
        <div class="multipleChoice" id="multiple-choice">
        <span class="title">Multiple Choice Question<strong class="star">*</strong></span>
        
          <ul>
            <li> <input name="txtchoicequestion" type="text" value="<?php
		  echo $getQuestion->fields['question'];
		  
		   ?>" /></li>
            <li class="pL45"><span class="titleQuestion">Answers</span><span class="titlecorrectAnswer multipleanswers">Correct Answer</span></li>
           <?php 
		    if($getMultipleAnswer)
          	{
				$j=1;
				foreach($getMultipleAnswer as $answer)
				{
					echo "<li><div class='optans{$j}'></div><span class='option'>{$j}</span>";
					echo "<textarea rows='3' cols='28' name='txtMultipleAnswer[]' id='txtAns{$j}' class='required' title='Enter the first optional answer'>{$answer['choice']}</textarea>";
					echo "<span class='correctAnswer'><input class='radiobtn' name='chkans[]' type='checkbox' value='{$answer['answerindex']}'";
					$mAnswers = explode(',',$getQuestion->fields['answer']);
					foreach($mAnswers as $mAnswer)
					{
						if($answer['answerindex']==$mAnswer)
						{
							echo 'checked';
						}
					}
					
					echo" /></span></li>";
					$j++;
				}
            }
            ?>
        
          </ul>
        </div>
        <div class="multipleChoice"  style="display:none;" id="true-false">
         <span class="title">True / False Question<strong class="star">*</strong></span>
        <ul>
        <li><input name="txtboolquestion" type="text" value="<?php
		  echo $getQuestion->fields['question'];
		  
		   ?>"/></li>
     <li><div class="boolstatus"><strong>Answers :</strong> <input type="radio" class="radiobtn" name="rdbool" value="True" <?php
		  if($getQuestion->fields['answer']=='True')
		  {
			  echo 'checked';
		  }
		  ?>>True
		 <input type="radio" class="radiobtn" name="rdbool" value="False" <?php
		  if($getQuestion->fields['answer']=='False')
		  {
			  echo 'checked';
		  }
		  ?>>False</div></li>  
        </ul>
        </div>
        <div class="multipleChoice" style="display:none;" id="match-the-following">
        <span class="title">Match the following<strong class="star">*</strong></span>
        <ul>
        
        <li class="pL45"><span class="titleQuestion">Question</span><span class="titlecorrectAnswer"> Answer</span></li>
        <li id="frmMatch">
        <div class="dynamicfields">
        <div class="matchthefollowing">
       <span class="option">1</span>
      <div class="fl">  <textarea rows="3" cols="28" name="txtMatchQuestion" class="required matchQuestion" title="Enter Question"><?php echo $getQuestion->fields['question']; ?></textarea></div>
        <div class="fl">  <textarea rows="3" cols="28"  name="txtMatchAnswer" class="answerBox required" title="Enter Answer" ><?php echo $getQuestion->fields['answer']; ?></textarea></div>
    </div>
     </div>
     
      </li> 
          </ul>
        </div>
   
        <div class="multipleChoice" style="display:none;"  id="subjective">
        <span class="title">Subjective 50 Words<strong class="star">*</strong></span>
        <ul class="briefanswer">
            
        <li>
          <textarea rows="3" cols="28" class="enterQuestion" name="txtquestion"><?php
		  echo $getQuestion->fields['question'];
		  
		   ?></textarea>
        </li>
        </ul>
        </div>
        <div class="multipleChoice"  style="display:none;" id="fill-blank">
         <span class="title">Fill in the blank<strong class="star">*</strong></span>
        <ul>
        <li><div class="boolstatus"><div>Question<strong class="star">*</strong></div><textarea name="txtfillquestion"   ><?php
		  echo $getQuestion->fields['question'];
		  
		   ?></textarea></div>
            <span class="fillQuestionpanel" >
                <?php //echo $getQuestion->fields['answer'];?>
        <?php  $answers =   explode(',',$getQuestion->fields['answer']); ?>
        <label>If two answers</label>
        <input name="txtfillCheck"  id="anotherAnswer" type="checkbox"  <?php if($answers[1]) echo  'checked="checked"'; ?> value="answer2"   class="radiobtn"/>
        </span></li>
    
		
        <?php if($answers[0]) {?>
        <li><div class="boolstatus"><div  >Answers 1<strong class="star">*</strong></div>  
     <input name="txtfillAnswer" type="text" value="<?php echo $answers[0] ; ?>" />
     </div></li>  
     <?php } ?>
      
     <li id="anotherAnswershow" <?php if(!$answers[1]) {?> style="display:none;" <?php } ?>  ><div class="boolstatus"><div  >Answers 2<strong class="star">*</strong></div>  
     <input name="txtfillAnswer2" type="text"  value="<?php echo $answers[1] ; ?>"/>
     </div></li>
     
      
    <?php /*?> <?php
	 $answers =  split($getQuestion->fields['answer'], ',');
	 if($answers ){
		  echo $getQuestion->fields['answer'];
		  ?>
          <input name="txtfillAnswer" type="text" value=""/>
          <input name="txtfillAnswer2" type="text" value=""/>
     <?php  }
	else{ 
	?>
     <input name="txtfillAnswer" type="text" value=""/>
     <?php ?><?php */?>
   
        </ul>
        </div>
         </fieldset>
         
         <fieldset >
        <legend>Student Status  </legend>
       <ul>
                <li class="w100 fL">
        <label>Status :<strong class="star">*</strong> </label>
         
		</li>  
        <li><div class="questionstatus"> <input type="radio" class="radiobtn"  name="rdstatus" value="Y" <?php if($getQuestion->fields['status'] =='Y') echo 'checked';?>>Active
		 <input type="radio" class="radiobtn" name="rdstatus" value="N" <?php if($getQuestion->fields['status'] =='N') echo 'checked';?>>Inactive</div></li>
                </ul>
         <ul>
         
</ul>
        </fieldset>
           <li class="btn"><input name="btnSubmit" value="Update" type="submit" class="saveBtn" />
       <a href="admin_question_listing.php"> <input name="resetbtn" value="Cancel" type="button" class="cancelBtn" /></a>
        </li>
      
      </ul>
      </div> 
      </form>   
    </div>
<?php 
include('adminfooter.php');
}
?>