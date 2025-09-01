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
$programid = $_GET[ programid ];
$programmaster  = new programmaster();
$programdetail = $programmaster -> getprogramdetails($programid);
$msg = "";
if(isset($_REQUEST['btneditprogram']))
{
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrprogram = array('id'=>$programid,'name'=> $_REQUEST['txtName'],'description'=>$_REQUEST['txtDescription'],'duration_year'=>$_REQUEST['txtDurationyear'],'fasttrack_duration'=>$_POST['txtFasttrack'],'duration_month'=>$_POST['txtDurationmonth'],'grace_period_year'=>$_POST['txtGraceyear'],'grace_period_month'=>$_POST['txtGracemonth'],'status'=>$_POST['rdStatus'],'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		//$count = $programmaster -> checkprogram($arrprogram);
		$ackmsg = $programmaster -> updateprogram($arrprogram);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Program updated successfully';
			header("location:admin_program_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
		
		//}
}

?>

<script type="text/javascript" src="../web/validation/program.validate.js"></script>

<div class="content">
        <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="programs_listing.html">programs</a></li>
        <li class="last"> &nbsp; Edit program</li>
      </ul>
    </div>
    <div class="studentViewContent">
    <h2>Edit Program </h2>
      <div class="addProgramForm">
        <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
      <form id="prgmaddform" name="frmprogramEdit" method="post" >
      <ul>
     
        <li><label>Program Name :<strong class="star">*</strong> </label>
		<input name="txtName" type="text" value="<?php echo $programdetail->fields[name]; ?>" />  </li> 
          
         <li>
        <label>Program Description : </label>
		<textarea name="txtDescription" cols="28" rows="3"><?php echo $programdetail->fields[description]; ?></textarea>  </li> 
        <li>
        <label>Duration  : <strong class="star">*</strong> </label>
		<div class="durationyear"><span class="year">Year</span><input name="txtDurationyear" type="text" value="<?php echo $programdetail->fields[duration_year]; ?>"   class="w65 fL mR10"/>  </div>
          <div class="durationmonth">  <span class="year">Month </span><input name="txtDurationmonth" type="text" value="<?php echo $programdetail->fields[duration_month]; ?>"  class="w65"/></div> </li> 
        
        <li>
        <label>Grace Period     :<strong class="star">*</strong>  </label>
		<div class="graceyear"><span class="year">Year</span><input name="txtGraceyear" type="text"  value="<?php echo $programdetail->fields[grace_period_year]; ?>"  class="w65 fL mR10"/> </div>
        <div class="gracemonth"><span class="year">Month </span><input name="txtGracemonth" type="text" value="<?php echo $programdetail->fields[grace_period_month]; ?>"  class="w65"/></div> </li>
        <li>
        <label>Fast Track Duration     :  </label>
		<div class="durationmonth"><input name="txtFasttrack" type="text"  class="w65 fL" value="<?php echo $programdetail->fields[fasttrack_duration]; ?>"/><span class="year">Month </span></div>
         </li>
        <li>
        <label>Status :<strong class="star">*</strong>  </label>
         <div class="status"><span> <input class="radiobtn" name="rdStatus" type="radio"  value="Y"  <?php if( $programdetail->fields[status] == 'Y' ) echo "CHECKED";  ?>/>
         Active
		 <input class="radiobtn" name="rdStatus" type="radio" value="N" <?php if( $programdetail->fields[status] == 'N' ) echo "CHECKED";  ?> />
		 Inactive</span></div>
		</li> 
      

         <li class="btn"><input name="btneditprogram" value="save" type="submit" class="saveBtn" />
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