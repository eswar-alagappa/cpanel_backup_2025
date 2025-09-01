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
$questiontypeid = $_GET[ questiontypeid ];
$questiontypemaster  = new questiontypemaster();
$questiontypedetail = $questiontypemaster -> getquestiontypedetail($questiontypeid);
 $keywordMaster = new keywordmaster();
if(isset($_REQUEST['btneditquestiontype']))
{
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrquestiontype = array('id'=>$questiontypeid,'name'=> $_REQUEST['txtName'],'description'=>$_REQUEST['txtDescription'],'marks_per_question'=>$_REQUEST['txtMarks'],'controller_id'=>$_REQUEST['ddlController'],'status'=>$_POST['rdStatus'],'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$questiontypemaster -> updatequestiontype ($arrquestiontype);
		//header('location:admin_questiontype_listing.php');
		$ackmsg = $questiontypemaster -> updatequestiontype ($arrquestiontype);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Question Type updated successfully';
			header("location:admin_questiontype_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
}
?>
<script type="text/javascript" src="../web/validation/question-type.validate.js"></script>
<div class="content">
       <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
        <li class="first">Online Exam </li>
             <li><a href="question_types_listing.html">Question Types</a></li>
        <li class="last"> &nbsp; Edit Question type</a></li>
      </ul>
    </div>
    <div class="studentViewContent">
     
      
     <h2>Edit Question type    </h2>
     <form id="question-type" name="frmquestiontypeEdit"  method="post">
     <div class="addProgramForm editquestion">
      <ul class="w90p">
      <li>
      
          <label> Name :<strong class="star">*</strong> </label>
          <input name="txtName" type="text" value="<?php echo $questiontypedetail->fields[name]; ?>"/>  </li> 
        <li>
        <label>Description :<strong class="star">*</strong> </label>
		<textarea name="txtDescription" cols="28" rows="3"><?php echo $questiontypedetail->fields[description]; ?></textarea>  </li>
        
      </ul>
      <ul class="addquestion">
        <li>
          <label>Marks Per Question :<strong class="star">*</strong> </label>
          <input name="txtMarks" type="text" value="<?php echo $questiontypedetail->fields[marks_per_question]; ?>" maxlength="2"/></li> 
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
				echo "<option value='{$regulation[id]}'";
				if($questiontypedetail->fields[controller_id]==$regulation[id])
				echo ' selected';
				echo">{$regulation[value]}</option>";
			}
			echo '</select>';
		}
		?>
          </li>
        <li>
        <label>Status :<strong class="star">*</strong> </label>
         <div class="statusnew"><span> <input class="radiobtn" name="rdStatus" type="radio" value="Y" <?php if( $questiontypedetail->fields[status] == 'Y' ) echo "CHECKED";  ?> />
         Active
		 <input class="radiobtn" name="rdStatus" type="radio" value="N" <?php if( $questiontypedetail->fields[status] == 'N' ) echo "CHECKED";  ?> />
		 Inactive</span></div>
		</li> 
        <li class="btn"><input name="btneditquestiontype" value="save" type="submit" class="saveBtn" />
       <a href="admin_questiontype_listing.php" class="cancelBtn">Cancel</a>
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