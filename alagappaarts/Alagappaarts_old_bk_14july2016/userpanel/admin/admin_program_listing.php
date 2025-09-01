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

$pagename='program_listing';

$getPrograms = $programMaster -> getprograms();

$rsPrograms = $DB -> execute( $paginationObj->getQuery($getPrograms));

$countofPrograms = count($rsPrograms -> fields[id]);
static $recordcount=0;
	$forcount = $DB->execute($getPrograms);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}

	
?>
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
     <h2><span>Programs </span>
     <span class="addFieldOuter"><a class="submitBtn" href="admin_program_add.php">Add Program</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>

</h2>
<?php if($countofPrograms)
		{ ?>
	 <div class="studentList">
        
          
        
        <div class="studentListInner">
        
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Id </th>
                <th> Program Name</th>
                <th> Program Description</th>
                <th width="95">Duration</th>
                <th>Grace Period </th>
                <th>Fee($)</th>
                <th width="95"> Actions</th>
              </tr>
              <?php  
			  $i =0;
			  while(!$rsPrograms->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsPrograms->fields[id]}</td>
                <td> {$rsPrograms->fields[name]}  </td>
                <td>{$rsPrograms->fields[description]} </td>";
               echo "<td>";
			   if ($rsPrograms->fields[duration_year] != 0)
			   echo $rsPrograms->fields[duration_year]." Year ";
			   if($rsPrograms->fields[duration_month] != 0 )
			   echo $rsPrograms->fields[duration_month]." Month";
			   echo "</td>";
			   echo "<td>";
			   if ($rsPrograms->fields[grace_period_year] != 0)
			   echo "{$rsPrograms->fields[grace_period_year]} Year ";
			   if ($rsPrograms->fields[grace_period_month] != 0)
			   echo "{$rsPrograms->fields[grace_period_month]} Month";
			   echo "</td>";
			   echo "<td>{$rsPrograms->fields[total_fee]}</td>
                <td><a href='admin_program_view.php?programid={$rsPrograms->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a> <a href='admin_program_edit.php?programid={$rsPrograms->fields[id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a> </td>
              </tr>";
				   $rsPrograms-> MoveNext();
				   $i++;
 				 }?>
             
              
              
        
              
            </tbody>
          </table>
          
        </div>
      </div>
     <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getPrograms ); ?></ul></div>
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