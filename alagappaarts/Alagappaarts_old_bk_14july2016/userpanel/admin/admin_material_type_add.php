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
$adminMaterial = new materialtypemaster();
if(isset($_REQUEST['btnMaterialtypeadd']))
{
	$msg = "";
	$mysql_datetime = date('Y-m-d H:i:s');
	$arrMaterial = array('name'=> $_REQUEST['txtmaterialName'],'description'=>$_REQUEST['txtDescription'],'status'=>$_REQUEST['rdstatus'],'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] ,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
   
    $count = $adminMaterial -> checkMaterial($arrMaterial);
 if(!$count)
		{
			$ackmsg = $adminMaterial -> addmaterial($arrMaterial);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Material Type added successfully';
			header("location:admin_material_type_listing.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
	else
	{
		$msg = "Material Type already exists";
	}

}
?>
<script type="text/javascript" src="../web/validation/material-add.validate.js"></script>
  <div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="dashboard.php">dashboard</a></li>
        <li class="first">Masters</li>
        <li><a  href="programs_listing.html">programs</a></li>
        <li class="last"> &nbsp; Add program</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>Add material Type</h2>
      <div class="addProgramForm">
      <?php if( $msg)
	  {
		  echo "<span class='adminError'>$msg</span>";
	  }
	  ?>
     <form id="materialaddform" method="post" action="">
      <ul>
    
         <li>
        <label>Material type : </label>
        <input type="text" name="txtmaterialName">
         </li> 
        <li>
        <label>Description  : </label>
        <textarea rows="3" cols="28" name="txtDescription"></textarea>
        </li> 
        <li>
        <div class="status"><label>Status : </label>
         <span> <input type="radio" value="Y" name="rdstatus" class="radiobtn">
         Active
		 <input type="radio" value="N" name="rdstatus" class="radiobtn">
		 Inactive</span></div>
		</li> 
         <li class="btn"><input name="btnMaterialtypeadd" value="save" type="submit" class="saveBtn" />
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
