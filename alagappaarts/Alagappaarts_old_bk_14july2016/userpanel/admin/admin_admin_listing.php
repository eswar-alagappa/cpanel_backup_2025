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
define( MAX_NO_OF_ROWS_PAGINATION,10);
include('adminheader.php');
global $DB;
$adminmaster  = new adminmaster();
$pagename='admin_listing';
if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchAdmin']);
}
if($_REQUEST['btnSearch']){
	$arrSearch = array('ad.name'=>$_REQUEST['txtname'],'ad.status'=>$_REQUEST['selectStatus']);
	
	$_SESSION['searchAdmin'] = $arrSearch;

}else {
$arrSearch = array('ad.name'=>$_SESSION['searchAdmin']['ad.name'],'ad.status'=>$_SESSION['searchAdmin']['ad.status']);
//print_r($arrSearch);
}
$getAdmin = $adminmaster -> getAdmin().$filterObj->applyFilter($arrSearch,$pagename);
//echo $getAdmin;
$rsAdmin = $DB -> execute( $paginationObj->getQuery($getAdmin ." order by id desc"));
$countofAdmin = count($rsAdmin -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getAdmin);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}
?>
<script type="text/javascript" src="../web/validation/admin-add.validate.js"></script>
<div class="content">
    <div class="topNav">
     
       <ul>
      <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li class="last"> &nbsp; Admin</li>
        
      </ul>
    </div>
    <div class="studentViewContent">
       <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
     <h2><span>Admin </span>
     <span class="addFieldOuter"><a class="submitBtn" href="admin_admin_add.php">Add Admin</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>

</h2>
<div class="searchBox">
<form method="post" name="formadminlist" id ="formadminlist" >
        <div class="searchDiv">
        <label>Search By :</label>
        
        <input type="text" class="required_group" value="<?php if($_SESSION['searchAdmin']) echo $_SESSION['searchAdmin']['ad.name'];  ?>" name="txtname">
        <label class="statusTxt">Status :</label>
        <select class="mR10 studentListing required_group" name="selectStatus">
        <option value="">Select</option>
          <option  <?php if($_SESSION['searchAdmin']['ad.status'] == 'Y') echo "selected";  ?>  value="Y">Active</option>
          <option <?php if($_SESSION['searchAdmin']['ad.status'] == 'N') echo "selected";  ?>  value="N">Inactive</option>
       </select>
        <input name="btnSearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchAdmin']))
		{
			echo ' <input name="btnViewAll" value="View All Admin" type="submit" class="viewAll" />';
		} ?>
         </div>
        <div class="errorContainer"></div>
        </form>
      </div>
      
   <?php if($countofAdmin)
		{ ?>
    
      <div class="studentList">
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Admin Id </th>
                <th>  Name</th>
                <th> Email ID</th>
                <th> Isactive</th>
                <th width="95"> Actions</th>
              </tr>
              <?php 
			   $i =0;
			  while(!$rsAdmin->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsAdmin->fields[id]}</td>
                <td> {$rsAdmin->fields[name]}  </td>
                <td>{$rsAdmin->fields[email_id]} </td>";
               echo "<td>{$rsAdmin->fields[status]}";
			   echo "</td>";
			   echo "<td><a href='admin_admin_view.php?id={$rsAdmin->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			  echo "  <a href='admin_admin_edit.php?id={$rsAdmin->fields[id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a>";
			 echo "	 </td>
              </tr>";
				   $rsAdmin-> MoveNext();
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
		else echo "<div class='adminError'>No Results Found</div>"; ?>
     </div>
   </div>
<?php 
include('adminfooter.php');
}
?>