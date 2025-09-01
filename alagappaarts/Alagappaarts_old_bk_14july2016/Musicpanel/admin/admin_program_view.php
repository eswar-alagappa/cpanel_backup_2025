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

?>

<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="programs_listing.html">programs</a></li>
        <li class="last"> &nbsp; View program</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>View Program</h2>
      <div class="addProgramForm">
      <ul>
     
         <li>
        <label>Program Name : </label>
		<span><?php echo $programdetail->fields[name];?></span>  </li> 
          
         <li>
        <label>Program Description : </label>
		<span class="description"><?php echo $programdetail->fields[description];  ?></span>  </li> 
        <li>
        <label>Duration  : </label>
		<span class="year" >Year :</span><span class="year"><?php echo $programdetail->fields[duration_year];  ?>  </span> 
        <span class="year">Month : </span><span class="year"><?php echo $programdetail->fields[duration_month];  ?></span></li> 
        <li>
        <label>Grace Period    : </label>
		<span class="year" >Year :</span><span class="year"><?php echo $programdetail->fields[grace_period_year];  ?> </span> 
        <span class="year">Month : </span><span class="year"> <?php echo $programdetail->fields[grace_period_month];  ?>  </span></li> 
        
        <li>
        <label>Fast Track Duration : </label>
		<span class="description"><?php echo $programdetail->fields[fasttrack_duration];  ?></span>  </li> 
        <li>
        <label>Status : </label>
         <span class="p0">
         <?php if( $programdetail->fields[status] == 'Y' ) echo 'Active'; else   echo 'Inactive';?>
         
		</span>
		</li> 
      

         <li class="btn"><a href="admin_program_listing.php" class="saveBtn">Back</a>
         <!--<a href="admin_program_listing.php"><input name="btnCancelprog" value="Back" type="submit" class="saveBtn" /></a>-->
        </li>
      
      </ul>
      </div>
      
      
    </div> 
  </div>
<?php 
include('adminfooter.php');
}
?>