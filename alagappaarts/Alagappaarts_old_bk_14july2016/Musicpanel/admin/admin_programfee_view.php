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
$getProgramfeesdeiailrs = $programmaster ->  getprogramfeedetails($programid );
$getProgramname = $programmaster ->  getProgramnamebyid($programid );

?>

<div class="content">
   <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="programsfee_listing.html">fee</a></li>
        <li class="last"> &nbsp; View program Fee</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>View Program Fee</h2>
      <div class="addProgramForm">
      <ul>
  <?php 
  echo '<li>';
  echo '<label>Program Name</label>';
  echo '<span>'.$getProgramname-> fields[name].'</span>';	
   echo '</li>';
  $totalfee= 0;
  while(!$getProgramfeesdeiailrs->EOF)
					{
						echo '<li>';	
             							
						echo '<label>'.$getProgramfeesdeiailrs-> fields[fee_detail].'</label>' ;
						echo '<span>$'.$getProgramfeesdeiailrs-> fields[amount].'</span>';	
						echo '</li>';
						$totalfee += $getProgramfeesdeiailrs-> fields[amount];

						$getProgramfeesdeiailrs -> MoveNext();
					} ?>
     <li>
       <label>Total Fee : </label>
         <span>$<?php echo $totalfee;?></span>  
		</li> 
         
         <li class="btn"><a href="admin_programfee_listing.php" class="saveBtn">Back</a>
         
      
      </ul>
      </div>
      
      
    </div>
  
  </div>
<?php 
include('adminfooter.php');
					}
?>