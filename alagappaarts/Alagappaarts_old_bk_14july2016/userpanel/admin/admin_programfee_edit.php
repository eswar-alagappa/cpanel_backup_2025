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
if(isset($_REQUEST['btnProgramFeeedit']))
{
	$programfeedatail = $_REQUEST['feedetails'];
	$msg = "";
	$mysql_datetime = date('Y-m-d H:i:s');
	$programmaster -> updateprogramfee ($programfeedatail);
	$programmaster -> updateProgramFeeonProg($programid);
	//header('location:admin_programfee_listing.php');
	
	$ackmsg = $programmaster -> updateProgramFeeonProg($programid);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Program Fee updated successfully';
			header("location:admin_programfee_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	
}
?>
<script type="text/javascript" >
$(document).ready(function() {
	$("#frmProgramfeeedit").validate();
	
});
</script>
<div class="content">
   <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="programsfee_listing.html">fee</a></li>
        <li class="last"> &nbsp; Edit program Fee</li>
      </ul>
    </div>
    <div class="studentViewContent">
     <h2>Edit Program fee</h2>
     <div class="onlineExamContent">
       <div class="addProgramForm programfee">
       <form id="frmProgramfeeedit" method="post"  name="frmProgramfeeeditname">
        <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
         <ul class="w380">
         <?php 
		   echo '<li>';
		  echo '<label>Program Name</label>';
		  echo '<span>'.$getProgramname-> fields[name].'</span>';	
		   echo '</li>';

		 $i= 1;
		  while(!$getProgramfeesdeiailrs->EOF)
				{
					echo '<li>';	
             		echo '<label>'.$getProgramfeesdeiailrs-> fields[fee_detail].'</label>' ;
					echo '<input type="hidden" value="'.$getProgramfeesdeiailrs-> fields[id].'" name ="feedetails['.$i.'][0]" ></input>';
					echo '$<input type="text" value="'.$getProgramfeesdeiailrs-> fields[amount].'" name ="feedetails['.$i.'][1]" id="editProgramfee'.$i.'" class="required number" title="Fee is required"></input>';	
					echo '</li>';
					$getProgramfeesdeiailrs -> MoveNext();
					$i++;
				} ?>
         </ul>
<ul class="w380"><li class="btn"><input name="btnProgramFeeedit" value="Update" type="submit" class="submitBtn fl" />
         <a href="admin_programfee_listing.php" class="cancelBtn">Cancel</a>
        </li></ul> 
        </form>  
  </div>
    
     
      </div> 
    </div>
    
  
  </div>
<?php 
include('adminfooter.php');
					}
?>