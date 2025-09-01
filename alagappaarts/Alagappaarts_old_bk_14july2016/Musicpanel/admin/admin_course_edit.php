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
	header('location:index.php?msg=Login again');
}
else{
include('adminheader.php');
include("../config/classes/coursemaster.class.php");
include("../config/classes/keywordmaster.class.php");
include("../config/classes/questiontypemaster.class.php");
 $courseid = $_GET[courseid];
 $courseMaster = new coursemaster();
 $keywordMaster = new keywordmaster();
 $questionTypeMaster = new questiontypemaster();
$getCourse = $courseMaster -> getcoursesbyid($courseid);

 if(isset($_REQUEST['btnSubmit']))
 {
	$mysql_datetime = date('Y-m-d H:i:s');
	
$arrcourse = array('course_id'=>$_REQUEST['courseid'],'program_id'=>$_REQUEST['ddlProgram'], 'code'=>$_REQUEST['txtCode'], 'name'=>$_REQUEST['txtName'], 'description'=>$_REQUEST['txtDescription'], 'regulation_id'=>$_REQUEST['ddlRegulation'], 'exam_attempt_limit'=>$_REQUEST['txtlimit'], 'status'=>$_REQUEST['rdstatus'],'modified_by'=>$userid,'modified_on'=> $mysql_datetime,'exam_duration_hour'=>$_REQUEST['txthour'],'exam_duration_minute'=>$_REQUEST['txtmin'],'partition'=>$_REQUEST['ddlPartition'],'questiontype_id'=>$_REQUEST['ddlQuestionType'],'no_of_questions'=>$_REQUEST['txtNoofQuestion'],'duration_minute'=>$_REQUEST['txtDurationMinute']);

		$ackmsg = $courseMaster -> updatecourse($arrcourse);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Course updated successfully';
			header("location:admin_course_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	
	
 }
 ?>
 <script type="text/javascript" src="../web/validation/course.validate.js"></script>
<script type="text/javascript">
 $(document).ready(function() { 
	 var addFieldNo = 1;
	 $("#ddlRegulation").change(function(){
		 var trimstr = $.trim($("#ddlRegulation option:selected").text());
		 
		 if(trimstr != 'Theory')
		 {
			
			 $("#examquestion").hide();
		 }
		 else
		 {
			  $("#examquestion").show();
		 }
		 });
	 
 	  $('.addMore').click(function() { 
	  
		  
	//	alert($("select:hidden").length);
	
   //required validation
 
   	var dynamicfields = ".dynamicfields tbody>tr:last ";
	
 	var partitionLastSelected= $(dynamicfields+ "select.classPartition option:selected").val();
 	var questionTypeLastSelected = $(dynamicfields+ "select.classQuestionType option:selected").val();
	
	var partitionSelected ='';
			$(".dynamicfields").find(".classPartition").each(function() {
					 if($(this).val()  != 'null')
						 partitionSelected += $(this).val() || [];
						 partitionSelected =  partitionSelected  + ',';
			});
	
	 var  partitionSelectedArray = partitionSelected.split(','); 
	var questionTypeSelected ='';
			$(".dynamicfields").find(".classQuestionType").each(function() {
					 if($(this).val()  != 'null')
						 questionTypeSelected += $(this).val() || [];
						 questionTypeSelected =  questionTypeSelected  + ',';
			});
	
	 var  questionTypeSelectedArray = questionTypeSelected.split(','); 
	//alert(partitionLastSelected);	  
  	if(partitionLastSelected && questionTypeLastSelected)
	{
		
		$('.customError').remove();
		$(".classPartition").attr("disabled", true);
		$(".classQuestionType").attr("disabled", true);
		$(dynamicfields).clone(true).insertAfter(".dynamicfields tbody>tr:last");
		 $.each(partitionSelectedArray,function(i,v){
			 if(v != ''){
			//alert(v);
			$(dynamicfields+ "select.classPartition option[value="+ v +"]").remove();
			}
			 });
		//$(dynamicfields+ "select.classPartition option[value="+ partitionSelected +"]").remove();	
		$(dynamicfields+ "select.classPartition").attr("disabled", false);
		 $.each(questionTypeSelectedArray,function(i,v){
			 if(v != ''){
			//alert(v);
			$(dynamicfields+ "select.classQuestionType option[value="+ v +"]").remove();
			}
			 });
		//$(dynamicfields+ "select.classQuestionType option[value="+ questionTypeSelected +"]").remove();	 
		$(dynamicfields+ "select.classQuestionType").attr("disabled", false);
		$(dynamicfields).find("select").addClass('required');
		$(dynamicfields).find("input").addClass('required');
		$(dynamicfields).find("input").addClass('number');
		$(dynamicfields).find("input").addClass('digits');
		$(dynamicfields).find("input").attr('id',addFieldNo);
		$(dynamicfields).find('div.error').remove();

		addFieldNo++;
		if( $(dynamicfields+ "select.classQuestionType option").length == 2)
		{
			$('.addMore').remove();
		}
		//$(".dynamicfields tr").find(".deleteCourse img").attr({src:"../web/images/delete-btn.png"}).addClass('delete');
		//$(dynamicfields).find(".deleteCourse img").attr("src","../web/images/delete-btn-inactive.png").removeClass('delete');
			
	}
	else
	{
		
    		$('.customError').remove();
			$(".dynamicfields").after("<div class='customError'>Please fill the details</div>");
	
	}
	});
	
 // Make the dropdown enable on the form submit. *** Reason : It doesn't get the value from the disabled form field controls. 
$("#frmCourses").submit(function(){ 

	$(".classPartition").attr("disabled", false);
		$(".classQuestionType").attr("disabled", false);
	});

 
 });
 
 </script>
 <div class="content">
 <div class="topNav">
      <ul>
        <li><a  href="dashboard.php">dashboard</a></li>
         <li class="first">Masters</li>
        <li> &nbsp; courses</a></li>
         <li class="last"> &nbsp; Edit course</a></li>
      </ul>
    </div>
    
    <div class="studentViewContent">
      <h2>Edit course</h2>
      <div class="addProgramForm">
      <form id="frmCourses"  method="post" name="frmCourses" >
      <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
      <ul  class="w90p">
      <li class="programlist">
      
        <label>Select Program :<strong class="star">*</strong></label>
        <?php 
		$getPrograms = $courseMaster -> getprograms();
		$countP = count($getPrograms);
		if($countP)
		{
			echo '<select name="ddlProgram">';
			echo '<option value="">--Select--</option>';
			foreach($getPrograms as $program)
			{
				echo "<option value='{$program[id]}'";
				if($getCourse->fields['program_id']==$program[id])
				{
					echo "selected=";
				}
				echo">{$program[name]}</option>";
			}
			echo '</select>';
		}
		?>
  </li> 
        
         <li>
        <label>Course Code :<strong class="star">*</strong> </label>
		<input name="txtCode" type="text" value="<?php echo $getCourse->fields['code'];?>" />   </li> 
        <li>
        <label>Course Name :<strong class="star">*</strong> </label>
		<input name="txtName" type="text" value="<?php echo $getCourse->fields['name'];?>"/>   </li>
        <li>
        <label>Course Description  : </label>
		<textarea rows="3" cols="28" name="txtDescription"><?php echo $getCourse->fields['description'];?></textarea>  </li>
        
        <li class="programlist">
        <label>Regulation   :<strong class="star">*</strong> </label>
        <?php 
		
		$getRegulation = $keywordMaster -> getkeyword('regulation');
		$countR = count($getRegulation);
		if($countR)
		{
			echo '<select name="ddlRegulation" id="ddlRegulation">';
			echo '<option value="">--Select--</option>';
			foreach($getRegulation as $regulation)
			{
				echo "<option value='{$regulation[id]}'";
				if($getCourse->fields['regulation_id']==$regulation[id])
				{
					echo "selected";
				}
				echo">{$regulation[value]}</option>";
			}
			echo '</select>';
		}
		?>
		 </li>
          <?php 
		if(trim($getCourse->fields['regulation'])=='Theory')
		{
			$getCourseExam = $courseMaster -> getcourseexam($courseid);
			
			if($getCourseExam)
			{
				
		?>
       <fieldset class="w97p" id="examquestion">
        <legend>Exam & Question settings </legend> 
        <table cellspacing="0" cellpadding="0" border="0" class="vendartable wAuto dynamicfields">
  <tbody><tr>
    <th valign="top" align="left">Partition </th>
    <th valign="top" align="left">
      Question Type </th>
      <th valign="top" align="left">Num of Question </th>
     <!-- <th valign="top" align="left">Duration in minutes</th>-->


    </tr>
    <?php
	$countExistingRecord = count($getCourseExam);
	$l = 0; 
	foreach($getCourseExam as $courseexam)
	{
		 		
	?>
    <input type="hidden" size="8" name="txtCourseExam[]" value="<?php echo $courseexam['courseexamid'] ?>">
		<tr>
                <td valign="top" align="left" class="pl0">
                 <?php 
		
		$getQuestionType = $questionTypeMaster -> activequestiontypes();
		$countQT = count($getQuestionType);
		
		if($countQT)
		{
			echo '<select name="ddlPartition[]" class="classPartition">';
			echo '<option value="">--Select--</option>';
			for($i=1;$i<=$countQT;$i++)
			{
				echo "<option value='{$i}'";
				if($i==$courseexam['partition'])
				{
					echo "selected='selected'";
				}
				echo">Part - {$i}</option>";
			}
			
			echo '</select>';
		}
		?>
                
        </td>
                <td valign="top" align="left">
                <?php 
			
		if($countQT)
		{
			echo '<select name="ddlQuestionType[]" class="classQuestionType">';
			echo '<option value="">--Select--</option>';
			foreach($getQuestionType as $questiontype)
			{
				echo "<option value='{$questiontype[id]}'";
				if($questiontype['id']==$courseexam['questiontype_id'])
				{
					echo "selected='selected'";
				}
				echo ">{$questiontype[name]}</option>";
			}
			echo '</select>';
		}
		?>
                
                
               </td>
                <td valign="top" align="left">
                <input type="text" size="8" id="<?php echo $l ; ?>" name="txtNoofQuestion[]" class="classNoofQuestion required number digits" value="<?php echo $courseexam['no_of_questions'] ?>" maxlength="2" min="1"></td>
               <!-- <td valign="top" align="left"><input type="text" size="8" name="txtDurationMinute[]" class="classDurationMinute required number" value="<?php echo $courseexam['duration_minute'] ?>"></td>
                <td valign="top"><span class="deleteCourse"> <img src="../web/images/delete-btn-inactive.png" width="20" height="18" /></span></td>-->
              </tr>
    <?php $l++;	} 
	
		
	?>
    
 
    
</tbody></table>
<?php 
if($countQT>$countExistingRecord)
{
	echo "<span class='addMore'><a>+ Add More</a></span>";
}
?>
         
          <br />
<br />


        </fieldset>
        <?php 	
		}
		}
		else
		{
		?>
        <fieldset class="w97p" id="examquestion" style="display:none;">
        <legend>Exam & Question settings </legend> 
        <table cellspacing="0" cellpadding="0" border="0" class="vendartable w700 dynamicfields" >
            <tbody>
              <tr>
                <th valign="top" align="left" class="pl0">Partition </th>
                <th valign="top" align="left"> Question Type </th>
                <th valign="top" align="left">No of Question </th>
               <!-- <th valign="top" align="left">Duration in Minutes</th>-->
              </tr>
              <tr>
                <td valign="top" align="left" class="pl0">
                 <?php 
		
		$getQuestionType = $questionTypeMaster -> activequestiontypes();
		$countQT = count($getQuestionType);
		
		if($countP )
		{
			echo '<select name="ddlPartition[]" class="classPartition">';
			echo '<option value="">--Select--</option>';
			for($i=1;$i<=$countQT;$i++)
			{
				echo "<option value='{$i}'>Part - {$i}</option>";
			}
			
			echo '</select>';
		}
		?>
                
        </td>
                <td valign="top" align="left">
                <?php 
			
		if($countQT)
		{
			echo '<select name="ddlQuestionType[]" class="classQuestionType">';
			echo '<option value="">--Select--</option>';
			foreach($getQuestionType as $questiontype)
			{
				echo "<option value='{$questiontype[id]}'>{$questiontype[name]}</option>";
			}
			echo '</select>';
		}
		?>
                
                
               </td>
                <td valign="top" align="left">
                <input type="text" size="8" name="txtNoofQuestion[]" class="classNoofQuestion required number digits" maxlength="2" min="1"></td>
               <!--  <td valign="top" align="left"><input type="text" size="8" name="txtDurationMinute[]" class="classDurationMinute required number"></td>
               <td valign="top"><span class="deleteCourse"> <img src="../web/images/delete-btn-inactive.png" width="20" height="18" /></span></td>-->
              </tr>
              
              
              
            </tbody>
          </table>
          <span class="addMore"><a>+ Add More</a></span>
          <br />
<br />


        </fieldset>
        <?php } ?>
         <li>
        <label> Exam duration  :<strong class="star">*</strong> </label>
		<div class="durationyear"><span class="year">Hours </span><input type="text" class="w65 fL mR10" name="txthour" value="<?php echo $getCourse->fields['exam_duration_hour'];?>" maxlength="3"  min="0"></div>
        <div class="durationmonth"><span class="year">Mins   </span><input type="text" class="w65" name="txtmin" value="<?php echo $getCourse->fields['exam_duration_minute'];?>" maxlength="3"  min="0" ></div> </li>
        <li>
        <label>Exam attempt limit    :<strong class="star">*</strong> </label>
		<input name="txtlimit" type="text" value="<?php echo $getCourse->fields['exam_attempt_limit'];?>" maxlength="3"  min="1" />  </li>
        <li>
        <div class="statusnew"><label>Status	 :<strong class="star">*</strong> </label>
         <span> <input class="radiobtn" name="rdstatus" type="radio" value="Y" <?php if( $getCourse->fields['status'] == 'Y' ) echo "CHECKED";  ?> />
         Active
		 <input class="radiobtn" name="rdstatus" type="radio" value="N" <?php if( $getCourse->fields['status'] == 'N' ) echo "CHECKED";  ?>/>
		 Inactive</span></div>
		</li>
      <li class="btn"><input name="btnSubmit"id="btnSubmit" value="Update" type="submit" class="saveBtn" />
       <a href="admin_course_listing.php"> <input name="btnCancel" value="Cancel" type="button" class="cancelBtn" /></a>
        </li>
      </ul>
      </form>
      </div>
      
      
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>