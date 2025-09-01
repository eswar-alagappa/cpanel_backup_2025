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
else{
include('adminheader.php');
include("../config/classes/questiontypemaster.class.php");
include("../config/classes/keywordmaster.class.php");
 $keywordMaster = new keywordmaster();
if(isset($_REQUEST['btnaddquestiontype']))
{
		
		$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrquestiontype = array('name'=> $_REQUEST['txtName'],'description'=>$_REQUEST['txtDescription'],'marks_per_question'=>$_REQUEST['txtMarks'],'controller_id'=>$_REQUEST['ddlController'],'status'=>$_POST['rdStatus'],'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] 
		,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$questiontypemaster  = new questiontypemaster();
		$count = $questiontypemaster -> checkquestiontype($arrquestiontype);
		
		if(!$count){
		$ackmsg = $questiontypemaster -> addquestiontype($arrquestiontype);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Question Type added successfully';
			header("location:admin_questiontype_listing.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
	else
	{
		$msg = "Question Type already exists";
	}
		/*if($count){
			$msg = "Question Type Already Exsist";
		}
		else{
			 $questiontypemaster -> addquestiontype ($arrquestiontype);
			header('location:admin_questiontype_listing.php');
		}*/
}
?>
<script type="text/javascript" src="../web/validation/question-type.validate.js"></script>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Online Exam </li>
           <li><a href="question_types_listing.html">Question Types</a></li>
        <li class="last"> &nbsp; Add Question TYpe </a></li>
        
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>Add Question Type </h2>
        
      <form id="question-type"  name="frmQuestiontypeAdd"  method="post">
     <div class="addProgramForm editquestion">
     <span class="adminquestionTypeError"><?php echo $msg ;?></span>
      <ul class="w90p">
      <li>
        <label> Name :<strong class="star">*</strong> </label>
		<input name="txtName" type="text" value=""/>  </li> 
        <li>
        <label>Description :<strong class="star">*</strong>  </label>
		<textarea name="txtDescription" cols="28" rows="3"></textarea>  </li>
        
      </ul>
      <ul class="addquestion">
        <li>
          <label>Marks Per Question :<strong class="star">*</strong>  </label>
          <input name="txtMarks" type="text" value="" maxlength="2"/></li> 
          <li>
           <label>Controller Type:<strong class="star">*</strong>  </label>
          <?php 
          $getRegulation = $keywordMaster -> getkeyword('controller');
		$countR = count($getRegulation);
		if($countR)
		{
			echo '<select name="ddlController" id="ddlController" class="flNone">';
			echo '<option value="">--Select--</option>';
			foreach($getRegulation as $regulation)
			{
				echo "<option value='{$regulation[id]}'>{$regulation[value]}</option>";
			}
			echo '</select>';
		}
		?>
          </li>
        <li>
        <label>Status :<strong class="star">*</strong>  </label>
         <div class="statusnew"><span> <input class="radiobtn" name="rdStatus" type="radio" value="Y" />
         Active
		 <input class="radiobtn" name="rdStatus" type="radio" value="N" />
		 Inactive</span></div>
		</li> 
        <li class="btn"><input name="btnaddquestiontype" value="save" type="submit" class="saveBtn" />
        <a href="admin_questiontype_listing.php" class="cancelBtn">Cancel</a>
        <!--<input name="resetbtn" value="Cancel" type="reset" class="cancelBtn" />-->
        </li>
      
      </ul>
      </div> 
      </form>   
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>