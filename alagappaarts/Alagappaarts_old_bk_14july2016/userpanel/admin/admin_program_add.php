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
include("../config/classes/programmaster.class.php");
include('adminheader.php');
if(isset($_REQUEST['btnaddprogram']))
{
		$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrprogram = array('name'=> $_REQUEST['txtName'],'description'=>$_REQUEST['txtDescription'],'duration_year'=>$_REQUEST['txtDurationyear'],
		'duration_month'=>$_POST['txtDurationmonth'],'fasttrack_duration'=>$_POST['txtFasttrack'],'grace_period_year'=>$_POST['txtGraceyear'],'grace_period_month'=>$_POST['txtGracemonth'],'status'=>$_POST['rdStatus'],'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] ,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$programmaster  = new programmaster();
		$count = $programmaster -> checkprogram($arrprogram);
		if(!$count)
		{
			$ackmsg = $programmaster -> addprogram($arrprogram);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Program added successfully';
			header("location:admin_program_listing.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
	else
	{
		$msg = "Program already exists";
	}
		/*if(!$count){
			$msg = "Program Already Exsist";
		}
		else{
			$addprogram = $programmaster -> addprogram ($arrprogram);
			header('location:admin_program_listing.php');
		}*/
}
?>

<script type="text/javascript" src="../web/validation/program.validate.js"></script>

<div class="content">
        <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
        <li class="first">Masters</li>
        <li><a  href="programs_listing.html">programs</a></li>
        <li class="last"> &nbsp; Add program</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>Add Program</h2>
      
      <div class="addProgramForm">
       <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
     
      <form id="prgmaddform" name="frmprogramAdd" method="post" >
      <ul>
     
        <li><label>Program Name :<strong class="star">*</strong> </label>
		<input name="txtName" type="text" />  </li> 
          
         <li>
        <label>Program Description : </label>
		<textarea name="txtDescription" cols="28" rows="3"></textarea>  </li> 
        <li>
        <label>Duration  : <strong class="star">*</strong> </label>
		<div class="durationyear"><span class="year">Year</span><input name="txtDurationyear" type="text"  class="w65 fL mR10"/>  </div>
          <div class="durationmonth">  <span class="year">Month </span><input name="txtDurationmonth" type="text"  class="w65"/></div> </li> 
       
        <li>
        <label>Grace Period     :<strong class="star">*</strong>  </label>
		<div class="graceyear"><span class="year">Year</span><input name="txtGraceyear" type="text"  class="w65 fL mR10"/> </div>
        <div class="gracemonth"><span class="year">Month </span><input name="txtGracemonth" type="text"  class="w65"/></div> </li>
        <li>
        <label>Fast Track Duration     :  </label>
		<div class="durationmonth"><input name="txtFasttrack" type="text"  class="w65 fL"/><span class="year">Month </span></div>
         </li>
       
        
        <li>
        <label>Status :<strong class="star">*</strong>  </label>
         <div class="status"><span> <input class="radiobtn" name="rdStatus" type="radio" value="Y" />
         Active
		 <input class="radiobtn" name="rdStatus" type="radio" value="N" />
		 Inactive</span></div>
		</li> 
      

         <li class="btn"><input name="btnaddprogram" value="save" type="submit" class="saveBtn" />
        <a href="admin_program_listing.php" class="cancelBtn">Cancel</a>
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