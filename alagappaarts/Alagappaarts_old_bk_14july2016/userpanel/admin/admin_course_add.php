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
 $courseMaster = new coursemaster();
 $keywordMaster = new keywordmaster();
 $questionTypeMaster = new questiontypemaster();
 if(isset($_REQUEST['btnSubmit']))
 {
	$mysql_datetime = date('Y-m-d H:i:s');
	$count = $courseMaster -> checkcourses(trim($_REQUEST['txtCode']));
	if(!$count)
	{
		$arrcourse = array('program_id'=>$_REQUEST['ddlProgram'], 'code'=>$_REQUEST['txtCode'], 'name'=>$_REQUEST['txtName'], 'description'=>$_REQUEST['txtDescription'], 'regulation_id'=>$_REQUEST['ddlRegulation'], 'exam_attempt_limit'=>$_REQUEST['txtlimit'], 'status'=>$_REQUEST['rdstatus'], 'created_on'=>$mysql_datetime, 'created_by'=>$userid, 'modified_by'=>$userid,'modified_on'=> $mysql_datetime,'exam_duration_hour'=>$_REQUEST['txthour'],'exam_duration_minute'=>$_REQUEST['txtmin'],'partition'=>$_REQUEST['ddlPartition'],'questiontype_id'=>$_REQUEST['ddlQuestionType'],'no_of_questions'=>$_REQUEST['txtNoofQuestion']);
		//'duration_minute'=>$_REQUEST['txtDurationMinute']
		$ackmsg = $courseMaster -> addcourses($arrcourse);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Course added successfully';
			header("location:admin_course_listing.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
	else
	{
		$msg = "Course code already exists";
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
   //required validation
   	var dynamicfields = ".dynamicfields tbody>tr:last ";
 	var partitionSelected = $(dynamicfields+ "select.classPartition option:selected").val();
 	var questionTypeSelected = $(dynamicfields+ "select.classQuestionType option:selected").val();

  	if(partitionSelected && questionTypeSelected)
	{
		$('.customError').remove();
		$(".classPartition").attr("disabled", true);
		$(".classQuestionType").attr("disabled", true);
		$(dynamicfields).clone(true).insertAfter(".dynamicfields tbody>tr:last");
		$(dynamicfields+ "select.classPartition option[value="+ partitionSelected +"]").remove();	
		$(dynamicfields+ "select.classPartition").attr("disabled", false);
		//$(dynamicfields+ "select.classPartition").attr("name", "ddlPartition["+addFieldNo+"][]");
		$(dynamicfields+ "select.classQuestionType option[value="+ questionTypeSelected +"]").remove();	 
		$(dynamicfields+ "select.classQuestionType").attr("disabled", false);		
		//$(dynamicfields+ "select.classQuestionType").attr("name", "ddlQuestionType["+addFieldNo+"][]");
		//$(dynamicfields+ "input.classNoofQuestion").attr("name", "txtNoofQuestion["+addFieldNo+"][]");
		//$(dynamicfields+ "input.classDurationMinute").attr("name", "txtDurationMinute["+addFieldNo+"][]");
		$(dynamicfields).find("select").addClass('required');
		$(dynamicfields).find("input").addClass('required');
		$(dynamicfields).find("input").addClass('number');
		$(dynamicfields).find('div.error').remove();
		
		addFieldNo++;
	if( $(dynamicfields+ "select.classQuestionType option").length == 2)
		{
			$('.addMore').hide();
		}
		/*$(".dynamicfields tr").find(".deleteCourse img").attr({src:"../web/images/delete-btn.png"}).addClass('delete');
		$(dynamicfields).find(".deleteCourse img").attr("src","../web/images/delete-btn-inactive.png").removeClass('delete');*/	
	}

	else
	{
		$('.customError').remove();
		$(".dynamicfields").after("<div class='customError'>Please fill the details</div>");
	}
	});
	
	
	$('.removeField').click(function(){
		var i=0;
	 $('.removeField').each(function(){
		i++;
		 });
		if(i<=1){
		var preventClick = false;
	 $('.removeField').click(function(){
		 $(this)
		 .css('cursor','default')
		 if(!preventClick){
			 }
			 preventClick = true;
			 return false;
		 });
			}else{
		$(this).parent().parent().remove();
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
         <li class="last"> &nbsp; Add course</a></li>
      </ul>
    </div>
    
    <div class="studentViewContent">
      <h2>Add course</h2>
      <div class="addProgramForm">
      <form id="frmCourses"  method="post" name="frmCourses">
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
				echo "<option value='{$program[id]}'>{$program[name]}</option>";
			}
			echo '</select>';
		}
		?>
  </li> 
        
         <li>
        <label>Course Code :<strong class="star">*</strong> </label>
		<input name="txtCode" type="text" />   </li> 
        <li>
        <label>Course Name :<strong class="star">*</strong> </label>
		<input name="txtName" type="text" />   </li>
        <li>
        <label>Course Description  : </label>
		<textarea rows="3" cols="28" name="txtDescription"></textarea>  </li>
        
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
				echo "<option value='{$regulation[id]}'>{$regulation[value]}</option>";
			}
			echo '</select>';
		}
		?>
		 </li>
       <fieldset class="w97p" id="examquestion">
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
                <input type="text" size="8" name="txtNoofQuestion[]" class="classNoofQuestion required number"></td>
               <!-- <td valign="top" align="left"><input type="text" size="8" name="txtDurationMinute[]" class="classDurationMinute required number"></td>-->
               <!-- <td valign="top"><span class="deleteCourse"> <img src="../web/images/delete-btn-inactive.png" width="20" height="18" /></span></td>-->
              </tr>
              
              
            </tbody>
          </table>
          <span class="addMore"><a>+ Add More</a></span>
          <br />
<br />

        </fieldset>
         <li>
        <label> Exam duration  :<strong class="star">*</strong> </label>
		<div class="durationyear"><span class="year">Hours </span><input type="text" class="w65 fL mR10" name="txthour"></div>
        <div class="durationmonth"><span class="year">Mins   </span><input type="text" class="w65" name="txtmin"></div> </li>
        <li>
        <label>Exam attempt limit    :<strong class="star">*</strong> </label>
		<input name="txtlimit" type="text" />  </li>
        <li>
        <div class="statusnew"><label>Status	 :<strong class="star">*</strong> </label>
         <span> <input class="radiobtn" name="rdstatus" type="radio" value="Y" />
         Active
		 <input class="radiobtn" name="rdstatus" type="radio" value="N" />
		 Inactive</span></div>
		</li>
      <li class="btn"><input name="btnSubmit"id="btnSubmit" value="save" type="submit" class="saveBtn" />
        <input name="btnCancel" value="Cancel" type="reset" class="cancelBtn" />
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