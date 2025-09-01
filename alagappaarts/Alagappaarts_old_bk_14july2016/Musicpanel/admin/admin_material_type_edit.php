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
include("../config/classes/materialtypemaster.class.php");
include('adminheader.php');
$materialid=$_GET[id];
$adminMaterial = new materialtypemaster();
$materialDetail = $adminMaterial -> getMaterialType($materialid);
/*echo "<pre>";
print_r($materialDetail);*/

if(isset($_REQUEST['btnMaterialedit']))
{
	$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrMaterial = array('id'=>$materialid,'name'=> $_REQUEST['txtmaterialName'],'description'=>$_REQUEST['txtDescription'],'status'=>$_REQUEST['rdstatus'],'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] ,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$finalResult= $adminMaterial -> updateMaterialtype($arrMaterial);
		if($finalResult)
		{
			$_SESSION['ackmsg'] = 'Material type updated successfully';
			header("location:admin_material_type_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		} 
	}

?>
<script type="text/javascript" src="../web/validation/material-add.validate.js"></script>
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
     
      
     <h2>Edit material Type</h2>
      <div class="addProgramForm">
      <?php if( $msg)
	  {
		  echo "<span class='adminError'>$msg</span>";
	  }
	  ?>
      <form id="materialaddform" action="" method="post">
      <ul>
     
        <li>
        <label>Material type : </label>
		<input name="txtmaterialName" type="text" value="<?php echo $materialDetail->fields[name]; ?>"/>  </li> 
        <li>
        <label>Description : </label>
		<textarea name="txtDescription" cols="28" rows="3"><?php echo $materialDetail->fields[description]; ?></textarea>  </li> 
         
        <li>
        <label>Status : </label>
         <div class="status"><span> <input class="radiobtn" name="rdstatus" type="radio" value="Y" <?php if( $materialDetail->fields['status'] == 'Y' ) echo "CHECKED";  ?> />
         Active
		 <input class="radiobtn" name="rdstatus" type="radio" value="N" <?php if( $materialDetail->fields['status'] == 'N' ) echo "CHECKED";  ?>/>
		 Inactive</span></div>
		</li> 
        <li class="btn"><input name="btnMaterialedit" value="save" type="submit" class="saveBtn" />
       <a href="admin_material_type_listing.php" class="cancelBtn">Cancel</a></li>
      
      </ul>
      </form>
      </div>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>