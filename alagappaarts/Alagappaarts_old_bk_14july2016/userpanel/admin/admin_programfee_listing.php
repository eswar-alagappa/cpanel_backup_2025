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
define( MAX_NO_OF_ROWS_PAGINATION,20);
include('adminheader.php');
global $DB;
$programMaster = new programmaster();
$pagename='programfee_listing';
$getProgramfees = $programMaster -> getprogramfees();
$programFeeRs  = $DB->Execute( $paginationObj->getQuery($getProgramfees));
$countofProgramfees = count($programFeeRs -> fields[program_id]);

$forcount = $DB->Execute($getProgramfees);
$recordcount=0;
while(!$forcount->EOF)
{	$recordcount++;
//echo $recordcount;
	$forcount -> MoveNext();
}
//exit;
/*$rsProgramfees = $DB -> execute( $paginationObj->getQuery($getProgramfees));

$countofProgramfees = count($rsProgramfees -> fields[id]);
static $recordcount=0;
	$forcount = $DB->execute($getProgramfees);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}
*/
?>


<script type="text/javascript" src="../web/scripts/jquery.colorbox.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$(".popupIframe").colorbox({width:"414px", height:"257px", iframe:true});
	
	
});
</script>
<div class="content">
       <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li class="last"> &nbsp; programs</li>
        
      </ul>
    </div>
    <div class="studentViewContent">
     <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
     <h2><span>Programs Fee</span>
     
     <span class="addFieldOuter"><a class="submitBtn" href="admin_programfee_add.php">Add Program Fee</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>

</h2>
 <?php if($countofProgramfees){ ?>
      <div class="studentList">
          
       
        <div class="studentListInner">
        <?php echo '<table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Id </th>
                <th>Program Name</th>
                <th>Regulation Fee ($)</th>
                <th>Graduation Fee ($)</th>
                <th>Penalty Fee ($) </th>
                <th>Total Fee($)</th>
                <th> Actions</th>
              </tr>';
			  $i =0;
        while(!$programFeeRs->EOF)
				{
					
				 	$getProgramfeesdeiail = $programMaster ->  getprogramfeedetails($programFeeRs -> fields[program_id ]);
					if($i % 2) 	$classname="altRows";
					else $classname="";
				    echo "";
					echo "<tr class='{$classname}'>";
					echo '<td>'.$programFeeRs-> fields[program_id]."</td>" ;					
					echo '<td>'.$programFeeRs-> fields[name]."</td>" ;
					echo '</td>';
					
					while(!$getProgramfeesdeiail->EOF)
					{
						//if($i == 4)
						//continue;
						if($getProgramfeesdeiail-> fields[fee_detail] == 'Registration Fee' || $getProgramfeesdeiail-> fields[fee_detail] == 'Graduation Fee'  ||
						$getProgramfeesdeiail-> fields[fee_detail] == 'Penalty Fee' ){
						echo '<td>';	
             			echo $getProgramfeesdeiail-> fields[amount];					
						//echo $getProgramfeesdeiail-> fields[fee_detail]."<br/>" ;
						echo '</td>';
						}
						
						$getProgramfeesdeiail -> MoveNext();
					}
					echo '<td>'.$programFeeRs-> fields[amounttotal].'</td>';
					 
					echo "<td><a href='admin_programfee_view.php?programid={$programFeeRs->fields[program_id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a> 
					<a href='admin_programfee_edit.php?programid={$programFeeRs->fields[program_id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a> </td>";
					echo '</tr>';
					$i++;
					$programFeeRs -> MoveNext();
				}
				echo '</tbody>
          </table>';
			?>
          
        </div>
      </div>
     <div class="paginationContent">
       
        <div class="paginationLeft">Shows  <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?>  <?php // echo $recordcount?> of <?php echo $recordcount ?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getProgramfees ); ?></ul></div>
      </div>
      
<?php  }
		else{
			echo "<p><span>No Results Found</span></p>";}?>
    </div>   
   </div>
<?php 
include('adminfooter.php');
}
?>