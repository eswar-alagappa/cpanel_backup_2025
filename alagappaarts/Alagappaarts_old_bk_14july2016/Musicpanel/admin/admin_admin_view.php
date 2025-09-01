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

?>
  <div class="content">
    <div class="topNav">
    
    <ul>
      <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
         <li><a  href="admin_listing.html">Admin</a></li>
        <li> &nbsp;View Admin</li>
        
      </ul>
    
    </div>
    <div class="studentViewContent">
      <h2>View Admin</h2>
      <div class="addProgramForm">
      <ul class="w90p">
      <fieldset>
        <legend>Admin Details</legend>
      <li>
        <label>Name  : </label><span><?php echo $admindetail->fields[adminName]; ?></span>
  </li> 
         <li>
        <label>Email Id  : </label><span><?php echo $admindetail->fields[email_id]; ?></span>
		  </li> 
        <li>
        <label>User Name 	 : </label><span><?php echo $admindetail->fields[username]; ?></span>
       
		</li>
        <li>
         <label>Telephone Number    : </label><span><?php echo $admindetail->fields[telephone]; ?></span>
</li>
<li>
         <label>Mobile Number     : </label><span><?php echo $admindetail->fields[mobile]; ?></span>
  </li>

</fieldset>
<fieldset>
        <legend>Responsibility</legend>
<?php $x=$admindetail->fields[responsibility]; 
$strn=split(',', $x);
$arrmodule =array('parent_id' => 0);
$getmainModules= $adminMaster -> addmoduleuser($arrmodule);
foreach($getmainModules as $mainModules)
{
echo"<div>";	
$strname = split(',',$mainModules[name]);
foreach($strn as $strns)
	if($strns==$mainModules[id]){
	}
$arrmodule =array('parent_id' => $mainModules[id]);
$getsubModules= $adminMaster -> addmoduleuser($arrmodule);
foreach($getsubModules  as $subModules)
{	
   foreach($strn as $strns)
	if($strns==$subModules[id]) {
		echo "{$subModules[name]}<br>"; 
	}
}
echo "</div>";
}
?> 
<br />
</fieldset>

<fieldset >
        <legend> Status  </legend>
       <ul class="experience">
                <li class="w100 fL">
        <label>Status : </label>
         
		</li>  
        <li> 
       <span class="p0">
         <?php if( $admindetail->fields[status] == 'Y' ) echo 'Active'; else   echo 'Inactive';?>
         
		</span>
		 </li>
         
                </ul>
         <ul>
         
</ul>
        </fieldset>
         
         <li class="btn"><a href="admin_admin_listing.php"><input name="" value="back" type="submit" class="saveBtn" /></a>
        
        </li>
      </ul>
      </div>
      
      
    </div>
  </div>

<?php
include('adminfooter.php');
}
?>