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
include("../config/classes/centremaster.class.php");
define( MAX_NO_OF_ROWS_PAGINATION,20);
include('adminheader.php');
global $DB;
$centremaster = new centremaster();
$pagename='centre_listing';
if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchCentre']);
}
if($_REQUEST['btnSearch']){
	$arrSearch = array('cm.academy_name'=>$_REQUEST['txtName'],'cm.country'=>$_REQUEST['selectCountry']);
	$_SESSION['searchCentre'] = $arrSearch;

}else {
		$arrSearch = array('cm.academy_name'=>$_SESSION['searchCentre']['cm.academy_name'],'cm.country'=>$_SESSION['searchCentre']['cm.country']);
}
$getCentres = $centremaster -> getcentres().$filterObj->applyFilter($arrSearch,$pagename);
$rsCentres = $DB -> execute( $paginationObj->getQuery($getCentres ." order by cm.id desc"));
$countofCentres = count($rsCentres -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getCentres);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}
$getCountries =  $centremaster -> getCountries();
?>
<script type="text/javascript" src="../web/validation/centre.validate.js"></script>
<div class="content">
        <div class="topNav">
      <ul>
      <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li class="last"> &nbsp; centre</li>
        
      </ul>
    </div>
    <div class="studentViewContent">
      <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
     <h2><span>center </span>
<span class="addFieldOuter"><a class="submitBtn" href="admin_centre_add.php">Add Center</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>
</h2><div class="searchBox">
        <form method="post" name="formCentrelist" id = "formCentrelist" >
        <div class="searchDiv">
        <label>Search By Name:</label>
       <input type="text" class="required_group" value="<?php if($_SESSION['searchCentre']) echo $_SESSION['searchCentre']['cm.academy_name'];  ?>"  name="txtName">
         
        <label class="">Country :</label>
      <select name="selectCountry" class="mR10 required_group"><option value="">Select</option>
     <?php  while(!$getCountries->EOF)
			{
				if($getCountries->fields[country] == $_SESSION['searchCentre']['cm.country'])
				echo "<option value='{$getCountries->fields[country]}' selected  >{$getCountries->fields[country]}</option>";
					else 
				echo "<option value='{$getCountries->fields[country]}'  >{$getCountries->fields[country]}</option>";
				$getCountries -> MoveNext();
			} ?>
           </select>
        <input name="btnSearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchCentre']))
		{
			echo ' <input name="btnViewAll" value="View All Centers" type="submit" class="viewAll" />';
		} ?>
        </div>
        <div class="errorContainer"></div>
        </form>
      </div>
<?php if($countofCentres)
		{ ?>
	   
      <div class="studentList">
       <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Center Id </th>
                <th> Center Name</th>
                <th>  Email ID</th>
                <th> Director </th>
                <th width="95"> Actions</th>
              </tr>
               <?php  
			  $i =0;
			  while(!$rsCentres->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsCentres->fields[centreid]}</td>
                <td> {$rsCentres->fields[academy_name]}  </td>
                <td>{$rsCentres->fields[email_id]} </td>";
               echo "<td>{$rsCentres->fields[director_name]}";
			   echo "</td>";
			   echo "<td><a href='admin_centre_view.php?centreid={$rsCentres->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			  echo "  <a href='admin_centre_edit.php?centreid={$rsCentres->fields[id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a>";
			  if($rsCentres->fields[centreid]){
			 echo "	<a href='javascript:;'><img src='../web/images/approve-btn-inactive.png' width='20' height='18' title='Approve'/></a>";

			 echo "<a href='admin_center_resetpassword.php?centerid={$rsCentres->fields[id]}'><img width='20' height='18' title='Reset Password' alt='Reset Password' src='../web/images/reset-password-icon.png' /></a>";
			  }
			 else {
			 echo "	<a href='admin_centre_approve.php?centreid={$rsCentres->fields[id]}'><img src='../web/images/approve-btn.png' width='20' height='18' title='Approve'/></a>";
						 echo "<a href='javascript:;'><img width='20' height='18' title='Reset Password' alt='Reset Password' src='../web/images/reset-password-inactive-icon.png' /></a>";
			 }
			 echo "	 </td>
              </tr>";
				   $rsCentres-> MoveNext();
				   $i++;
 				 }?>
           </tbody>
          </table>
        </div>
      </div>
      <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getCentres ); ?></ul></div>
      </div>
       <?php  }
		else echo "<div class='adminError'>No Results Found</div>"; ?>
     </div>
   </div>
<?php 
include('adminfooter.php');
}
?>