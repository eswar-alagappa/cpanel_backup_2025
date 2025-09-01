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
$adminid=$_GET[id];
$adminMaster  = new adminmaster();
$admindetail = $adminMaster -> getadmins($adminid);
//echo '<pre>';
//print_r($admindetail);

if(isset($_REQUEST['btnAdminedit']))
{
	$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$arradmin = array('id'=>$adminid,'name'=> $_REQUEST['txtAdminname'],'email_id'=>$_REQUEST['txtAdminemail'],'telephone'=>$_REQUEST['txtTelno'],'mobile'=>$_REQUEST['txtContact'],
		'status'=>$_REQUEST['rdstatus'],'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] ,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$adminMaster -> updateadmin ($arradmin);
		$arrusername = array('user_id'=>$adminid,'username'=>$_REQUEST['txtUsername'],'password'=>md5($_REQUEST['txtPassword']),'status'=>$_REQUEST['rdstatus']);
		$adminMaster -> updateuser($arrusername);
		foreach($_REQUEST['chkmoldule'] as $chkmodule){
		$userrole.=$chkmodule.',';
		}
		$arrmastermodule= array('admin_id'=>$adminid,'responsibility'=>$userrole,'status'=>$_REQUEST['rdstatus']);
		$finalmodule=$adminMaster->updateuserrole($arrmastermodule);
		
		if($finalmodule)
		{
			$_SESSION['ackmsg'] = 'Admin updated successfully';
			header("location:admin_admin_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
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
        <li> &nbsp;Edit Admin</li>
      </ul>
    </div>
    <div class="studentViewContent">
     
      
     <h2>Edit Admin </h2>
     <div class="addProgramForm">
    <?php if( $msg)
	  {
		  echo "<span class='adminError'>$msg</span>";
	  }
	  ?>
       <form id="editadminform" method="post" action="">
      <ul class="w90p">
      <fieldset>
        <legend>Admin Details</legend>
      <li>
        <label>Name  :<strong class="star">*</strong> </label>
<input name="txtAdminname" type="text" value="<?php echo $admindetail->fields[adminName]; ?>" />   </li> 
         <li>
        <label>Email Id  :<strong class="star">*</strong></label>
		<input name="txtAdminemail" type="text" value="<?php echo $admindetail->fields[email_id]; ?>" />  </li> 
        <li>
        <label>User Name 	 :<strong class="star">*</strong> </label>
        <input name="txtUsername" type="text" value="<?php echo $admindetail->fields[username]; ?>" /> 
		</li>
	<li>
    <label>Password   : </label>
<input name="txtPassword" type="" value=""  id="adminpassword" />   </li> 
         <li>
         <label>Confirm Password   :</label>
<input name="txtConfirmpwd" type="" value="" />   </li> 
<li>
         <label>Telephone Number    : </label>
<input name="txtTelno" type="text" value="<?php echo $admindetail->fields[telephone]; ?>" />   </li>
<li>
         <label>Mobile Number     :<strong class="star">*</strong> </label>
<input name="txtContact" type="text" value="<?php echo $admindetail->fields[mobile]; ?>" />   </li>
</fieldset>
<fieldset>
        <legend>Responsibility</legend><div class="adminresponsibility"></div>
<?php $x=$admindetail->fields[responsibility]; 
$strn=split(',', $x);
$arrmodule =array('parent_id' => 0);
$getmainModules= $adminMaster -> addmoduleuser($arrmodule);
$countP = count($getmainModules);
if($countP){
foreach($getmainModules as $mainModules)
{
$strname = split(',',$mainModules[name]);
echo "<ul class='modules'>";
$chkd = '';
	foreach($strn as $strns)
	if($strns==$mainModules[id]) $chkd = 'checked';
	echo "<li><label><input type='checkbox' name= '{$mainModules[name]}' value='{$mainModules[id]}' id='' class='selectall' {$chkd}/><strong>{$mainModules[name]}</strong></label></li>"; 
$arrmodule =array('parent_id' => $mainModules[id]);
$getsubModules= $adminMaster -> addmoduleuser($arrmodule);
$countC = count($getsubModules);
foreach($getsubModules  as $subModules)
{	
    $chkd = '';
	foreach($strn as $strns)
	if($strns==$subModules[id]) $chkd = 'checked';
	echo "<li><label><input type='checkbox' name='chkmoldule[]' value='{$subModules[id]}' id='' class='{$mainModules[name]}' {$chkd}/>{$subModules[name]}</label></li>  ";
	
}
echo "</ul>";
}
}
?> 
<br />
</fieldset>

<fieldset >
        <legend> Status  </legend>
       <ul class="experience">
                <li class="w100 fL">
        <label>Status : <strong class="star">*</strong></label>
         
		</li>  
        <li><div class="status1"> <input type="radio" class="radiobtn" name="rdstatus" value="Y" <?php if( $admindetail->fields['status'] == 'Y' ) echo "CHECKED";  ?>>
         Active
		 <input type="radio" class="radiobtn" name="rdstatus" value="N" <?php if( $admindetail->fields['status'] == 'N' ) echo "CHECKED";  ?>>
		 Inactive</div></li>
                </ul>
         <ul>
         
</ul>
        </fieldset>
       
        
         <li class="btn"><input name="btnAdminedit" value="Update" type="submit" class="submitBtn fL" />
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