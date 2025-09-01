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
include('adminheader.php');
include("../config/classes/materialtypemaster.class.php");
define( MAX_NO_OF_ROWS_PAGINATION,10);
global $DB;
$adminMaterial = new materialtypemaster();
$pagename='materialType_listing';

$getmaterialtype=$adminMaterial->getMaterial();
//echo $getmaterialtype;
$rsMaterial = $DB -> execute( $paginationObj->getQuery($getmaterialtype ." order by id desc"));
//echo $rsMaterial;
$countofMaterial = count($rsMaterial -> fields[id]);
//echo $countofMaterial;
static $recordcount=0;
$forcount = $DB->execute($getmaterialtype);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}
?>
<script type="text/javascript" src="../web/validation/material-add.validate.js"></script>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="dashboard.php">dashboard</a></li>
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
     <h2><span>material Types</span>
     <span class="addFieldOuter"><a class="submitBtn" href="admin_material_type_add.php">Add Material Type</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>
 
</h2>
       <?php if($countofMaterial)
		{ ?>
     
      <div class="studentList">
              
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>ID </th>
                <th>  Material Type</th>
                <th>Description</th>
               <th width="95"> Actions</th>
              </tr>
              <?php 
			   $i =0;
			  while(!$rsMaterial->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsMaterial->fields[id]}</td>
                <td> {$rsMaterial->fields[name]}  </td>
                <td>{$rsMaterial->fields[description]} </td>";
                echo "</td>";
			   echo "<td><a href='admin_material_type_view.php?id={$rsMaterial->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			  echo "  <a href='admin_material_type_edit.php?id={$rsMaterial->fields[id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a>";
			 echo "	 </td>
              </tr>";
				   $rsMaterial-> MoveNext();
				   $i++;
 				 } 
			 ?>
            </tbody>
          </table>
        </div>
      </div>
     <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getAdmin ); ?></ul></div>
      </div>
  <?php  }
		else echo "<p><span>No Results Found</span></p>"; ?>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>

