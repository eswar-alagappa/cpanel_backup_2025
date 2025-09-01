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
	include("../config/classes/adminmaster.class.php");
include('adminheader.php');
$adminMaster  = new adminmaster();
if(isset($_REQUEST['btnAdminadd']))
{
	$msg = "";
	
		$mysql_datetime = date('Y-m-d H:i:s');
		$arradmin = array('name'=> $_REQUEST['txtAdminname'],'email_id'=>$_REQUEST['txtAdminemail'],'telephone'=>$_REQUEST['txtTelno'],'mobile'=>$_REQUEST['txtContact'],
		'status'=>$_REQUEST['rdstatus'],'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] ,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
         $adminmaster  = new adminmaster();
		 $count = $adminmaster -> checkadmin($arradmin);
		 
		 if(!$count){
		 $output1 = $adminmaster -> addadmin($arradmin);
		
		 if($output1){
		 $arrusername = array('user_id'=> $output1, 'username'=>$_REQUEST['txtUsername'],'password'=>md5($_REQUEST['txtPassword']),'status'=>$_REQUEST['rdstatus']);
		 $output2=$adminmaster -> addusername($arrusername);
		 
		 foreach($_REQUEST['chkmoldule'] as $chkmodule){
		 $userrole.=$chkmodule.',';
		 }
		 $arrmastermodule= array('','admin_id'=>$output1,'responsibility'=>$userrole,'status'=>$_REQUEST['rdstatus']);
		 $finalmodule=$adminmaster->adduserrole($arrmastermodule);
		
		}
		
		if($output1)
		{
			$_SESSION['ackmsg'] = 'Admin added successfully';
			header("location:admin_admin_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
		 }
		else
	{
		$msg = "Admin already exists";
	}	 

}
?>

<script type="text/javascript" src="../web/validation/admin-add.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$(".selectall").click(function() {
	     		var checked_status = this.checked;
				var checkbox_name = this.name;
				$("input."+this.name).each(function() {
				this.checked = checked_status;
				});
			}); });
</script>
<div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
         <li><a  href="admin_listing.html">Admin</a></li>
        <li> &nbsp;Add Admin</li>
     </ul>
        
    </div>
    <div class="studentViewContent">
      <h2>Add Admin</h2>
      <div class="addProgramForm">
    <?php if( $msg)
	  {
		  echo "<span class='adminError'>$msg</span>";
	  }
	  ?>
      <form id="adminform" method="post" action="">
      <ul class="w90p">
      <fieldset>
        <legend>Admin Details</legend>
      <li>
        <label>Name  :<strong class="star">*</strong> </label>
<input name="txtAdminname" type="text" />   </li> 
         <li>
        <label>Email Id  :<strong class="star">*</strong> </label>
		<input name="txtAdminemail" type="text" />  </li> 
        <li>
        <label>User Name 	 :<strong class="star">*</strong></label>
        <input name="txtUsername" type="text" /> 
		</li>
	<li>
    <label>Password   :<strong class="star">*</strong> </label>
<input name="txtPassword" type="text" id="adminpassword"/>   </li> 
         <li>
         <label>Confirm Password   :<strong class="star">*</strong> </label>
<input name="txtConfirmpwd" type="text" />   </li> 
<li>
         <label>Telephone Number    : </label>
<input name="txtTelno" type="text" />   </li>
<li>
         <label>Mobile Number     :<strong class="star">*</strong> </label>
<input name="txtContact" type="text" />   </li>
</fieldset>
<fieldset>
<legend>Responsibility</legend><div class="adminresponsibility"></div>
<?php 
$arrmodule =array('parent_id' => 0);
$getmainModules= $adminMaster -> addmoduleuser($arrmodule);
//print_r($getmainModules);
$countP = count($getmainModules);
if($countP){
foreach($getmainModules as $mainModules)
{
	$strname = split(',',$mainModules[name]);
echo "<ul class='modules'>";
echo "<li><label><input type='checkbox' name= {$mainModules[name]} class='selectall'  value='{$mainModules[id]}'/><strong>{$mainModules[name]}</strong></label></li>";
$arrmodule =array('parent_id' => $mainModules[id]);

$getsubModules= $adminMaster -> addmoduleuser($arrmodule);
$countC = count($getsubModules);
 	
foreach($getsubModules  as $subModules)
{
echo "<li><label><input type='checkbox' name='chkmoldule[]' value='{$subModules[id]}' id='' class='{$mainModules[name]}' />{$subModules[name]}</label></li>";
}
	echo "</ul>";
}
}
?> 
</fieldset>   
      
<fieldset >
        <legend> Status  </legend>
       <ul class="experience">
                <li class="w100 fL">
        <label>Status :<strong class="star">*</strong> </label>
         
		</li>  
       
        <li> <div class="status1"> <input type="radio" class="radiobtn" name="rdstatus" value="Y">
         Active
		 <input type="radio" class="radiobtn" name="rdstatus" value="N">
		 Inactive</div></li>
                </ul>
         
        </fieldset>
         
         <li class="btn"><input name="btnAdminadd" value="save" type="submit" class="saveBtn" />
        <!--<a href="admin_admin_listing.php"><input name="cancelBtn" value="Cancel" type="reset" class="cancelBtn" /></a>-->
         <a href="admin_admin_listing.php" class="cancelBtn">Cancel</a>
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