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
	 $getQuestiontype = $questionTypeMaster -> getquestiontype_controller($_REQUEST['ddlquestiontype']);
	 $arrquestion = array('addfor'=>$getQuestiontype[0][controller],'question_type_id'=>$_REQUEST['ddlquestiontype'],'courses'=>$_REQUEST['chkcourses'],'status'=>$_REQUEST['rdstatus'],'created_on'=>$mysql_datetime,'created_by'=>$userid,'modified_on'=>$mysql_datetime,'modified_by'=>$userid);
	 
		
	 switch($getQuestiontype[0][controller])
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
		//echo $_REQUEST['txtfillCheck'];
			if($_REQUEST['txtfillCheck'] == 'answer2')
			$fillAnswer = 	$_REQUEST['txtfillAnswer'].','.$_REQUEST['txtfillAnswer2'] ;
			else 
			$fillAnswer =  $_REQUEST['txtfillAnswer'];
			
		  $arrquestion = array_merge($arrquestion,array('question'=>$_REQUEST['txtfillquestion'],'answer'=>$fillAnswer));
		 
								 break;
								 
		
	 }
	
	 $count = $questionMaster -> checkquestion($arrquestion);
	 
	 /*echo "<pre>";
print_r(!$count);
echo "</pre>";exit;*/
	 if(!$count)
	 {
		 
		 $ackmsg = $questionMaster -> addquestion($arrquestion);
		 
		 
		 if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Question added successfully';
			header("location:admin_question_listing.php");
			
		}
		else
		{
			$msg = "Question already exists or internal error.Try again.";
		}
	 }
	 else
		{
			$msg = "Question already exists under this question type";
		}
	
	
 }
?>
<script type="text/javascript" src="../web/validation/questions.validate.js"></script>
<script>
$(document).ready(function() {
$('#questionType').change(function() {

		$('div.multipleChoice').each(function(){
			$(this).hide();
			});
			
		selection = $("#questionType option:selected").attr('class');
		selectiontext = $("#questionType option:selected").text();
		$("#"+selection).show();
		selectiontext ="<span class='title'>"+selectiontext+"<strong class='star'>*</strong></span>";
		$("#"+selection).find('span.title').replaceWith(selectiontext);
	
		
		
});
$(".selectall").click(function() {
	
				var checked_status = this.checked;
				var checkbox_name = this.name;
				$("input."+this.name).each(function() {
					this.checked = checked_status;
				});
			});
});

</script>
<script type="text/javascript">
$(document).ready(function(){

$(".addField").click(function() {
var addFieldNo = parseInt($(".dynamicfields>div:last-child span.option").text());
$(".dynamicfields>div:first-child").clone(true).insertAfter(".dynamicfields>div:last-child");

$(".dynamicfields>div:last-child span.option").text(addFieldNo+1);
//$(".dynamicfields>div:last-child").find("#CategoryfeatureLabel").attr( "id", "CategoryfeatureLabel"+addFieldNo );

return false;
});
$(".removeField").click(function() {
if( $(".dynamicfields").children().size() > 1 )
$(this).parent().remove();
var i = 1;
$(".dynamicfields>div").find("span.option").each(function(){
	$(this).text(i);
	i++;
	});
})
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
		echo '<select class="questionType" id="questionType" name="ddlquestiontype">';
		echo '<option value="">--Select--</option>';
		foreach($getQuestionType as $questiontype)
			{
				echo "<option value='{$questiontype[id]}' class='{$questiontype[controller]}'>{$questiontype[name]}</option>";
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
            <input type='checkbox' name='chkcourses[]' value='{$course[id]}' id='{$program[name]}_{$j}' class='{$strname[0]}' />{$course[code]}
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
            <li> <input name="txtchoicequestion" type="text" /></li>
            <li class="pL45"><span class="titleQuestion">Answers</span><span class="titlecorrectAnswer multipleanswers">Correct Answer</span></li>
            <li>
            <div class="optans1"></div>
              <span class="option">A</span>
              <textarea rows="3" cols="28" name="txtMultipleAnswer[]" id="txtAns1" class="required" title="Enter the first optional answer"></textarea>
              <span class="correctAnswer"><input class="radiobtn" name="chkans[]" type="checkbox" value="0" /></span>
              </li>
            <li>
              <div class="optans2"></div>
              <span class="option">B</span>
              <textarea rows="3" cols="28" id="txtAns2" name="txtMultipleAnswer[]" class="required" title="Enter the second optional answer"></textarea>
              <span class="correctAnswer"><input class="radiobtn" name="chkans[]" type="checkbox" value="1" /></span>
              </li>
            <li>
            <div class="optans3"></div>
              <span class="option">C</span>
              <textarea rows="3" cols="28" id="txtAns3" name="txtMultipleAnswer[]" class="required" title="Enter the third optional answer"></textarea>
              <span class="correctAnswer"><input class="radiobtn" name="chkans[]" type="checkbox" value="2" /></span>
              </li>
            <li>
            <div class="optans4"></div>
              <span class="option">D</span>
              <textarea rows="3" cols="28" id="txtAns4" name="txtMultipleAnswer[]" class="required" title="Enter the forth optional answer"></textarea>
              <span class="correctAnswer"><input class="radiobtn" name="chkans[]" type="checkbox" value="3" /></span>
              </li>
          </ul>
        </div>
        <div class="multipleChoice"  style="display:none;" id="true-false">
         <span class="title">True / False Question<strong class="star">*</strong></span>
        <ul>
        <li><input name="txtboolquestion" type="text" /></li>
     <li><div class="boolstatus"><strong>Answers :</strong> <input type="radio" class="radiobtn" name="rdbool" value="True">True
		 <input type="radio" class="radiobtn" name="rdbool" value="False">False</div></li>  
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
      <div class="fl">  <textarea rows="3" cols="28" name="txtMatchQuestion[]" class="required matchQuestion" title="Enter Question"></textarea></div>
        <div class="fl">  <textarea rows="3" cols="28"  name="txtMatchAnswer[]" class="answerBox required" title="Enter Answer" ></textarea></div>
    <a class="removeField"><img src="../web/images/delete-btn.png" /></a></div>
     </div>
      <span class="cloneadd"><a class="addField"><img src="../web/images/add-btn.png" /><label>Add More</label></a></span>
      </li> 
          </ul>
        </div>
   
        <div class="multipleChoice" style="display:none;"  id="subjective">
        <span class="title">Subjective 50 Words<strong class="star">*</strong></span>
        <ul class="briefanswer">
            
        <li>
          <textarea rows="3" cols="28" class="enterQuestion" name="txtquestion"></textarea>
        </li>
        </ul>
        </div>
        
        <div class="multipleChoice"  style="display:none;" id="fill-blank">
         <span class="title">Fill in the blank </span>
        <ul>
        <li><div class="boolstatus"> <div  >Question<strong class="star">*</strong></div>
       <textarea name="txtfillquestion"   ></textarea>
        <span class="fillQuestionpanel" >
        <label>If two answers</label>
        <input name="txtfillCheck"  id="anotherAnswer" type="checkbox"   class="radiobtn"  value="answer2"/>
        </span>
        </div></li>
     <li><div class="boolstatus"><div  >Answers 1<strong class="star">*</strong></div>  
     <input name="txtfillAnswer" type="text" />
     </div></li>  
     <li id="anotherAnswershow" style="display:none;" ><div class="boolstatus"><div  >Answers 2<strong class="star">*</strong></div>  
     <input name="txtfillAnswer2" type="text" />
     </div></li>
        </ul>
        </div>
         </fieldset>
         
         <fieldset >
        <legend>Student Status  </legend>
       <ul>
                <li class="w100 fL">
        <label>Status :<strong class="star">*</strong> </label>
         
		</li>  
        <li><div class="questionstatus"> <input type="radio" class="radiobtn" name="rdstatus" value="Y">Active
		 <input type="radio" class="radiobtn" name="rdstatus" value="N">Inactive</div></li>
                </ul>
         <ul>
         
</ul>
        </fieldset>
           <li class="btn"><input name="btnSubmit" value="save" type="submit" class="saveBtn" />
        <input name="resetbtn" value="Cancel" type="reset" class="cancelBtn" />
        </li>
      
      </ul>
      </div> 
      </form>   
    </div>
<?php 
include('adminfooter.php');
}
?>