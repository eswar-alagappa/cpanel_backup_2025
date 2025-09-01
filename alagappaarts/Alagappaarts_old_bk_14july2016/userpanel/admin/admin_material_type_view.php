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
?>
  <div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="dashboard.php">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="programs_listing.html">programs</a></li>
        <li class="last"> &nbsp; View program</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>View material Type</h2>
      <div class="addProgramForm">
      <ul>
     
         <li>
        <label>Material type : </label>
		<span><?php echo $materialDetail->fields[name]; ?></span>  </li> 
          
          
        <li>
        <label>Description  : </label>
		<span><?php echo $materialDetail->fields[description]; ?></span>  </li> 
        <li>
        <label>Status : </label>
         <span class="p0">
        <?php if( $materialDetail->fields[status] == 'Y' ) echo 'Active'; else   echo 'Inactive';?>
		</span>
		</li> 
          <li class="btn"><a href="admin_material_type_listing.php"><input name="" value="Back" type="submit" class="saveBtn" /></a>
        </li>
      
      </ul>
      </div>
      
      
    </div>
  </div>

<?php 
include('adminfooter.php');
}
?>