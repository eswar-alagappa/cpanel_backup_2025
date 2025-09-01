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
include("../config/classes/questiontypemaster.class.php");
define( MAX_NO_OF_ROWS_PAGINATION, 20);
include('adminheader.php');
$questiontypemaster = new questiontypemaster();

$pagename='program_listing';

$getQuestiontypes = $questiontypemaster -> getquestiontypes();

$rsQuestiontypes = $DB -> execute( $paginationObj->getQuery($getQuestiontypes));

$countQuestiontypes = count($rsQuestiontypes -> fields[id]);
static $recordcount=0;
	$forcount = $DB->execute($getQuestiontypes);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}
	
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
         <li class="first">Online Exam </li>
        <li class="last"> &nbsp; Question TYpes </a></li>
        
      </ul>
    </div>
    <div class="studentViewContent">
      <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
      <h2><span>Question TYpes </span>
<span class="addFieldOuter"><a class="submitBtn" href="admin_questiontype_add.php">Add Question Type </a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>

</h2>
<?php if($countQuestiontypes)
		{ ?>
    <div class="studentList">
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Id </th>
                <th>  Name </th>
                <th>Marks per question</th>
                <th> Description </th>
                <th width="95">status</th>
                <th width="95"> Actions</th>
              </tr>
                   <?php  
			  $i =0;
			  while(!$rsQuestiontypes->EOF)
 				{
				  $questiontypedesc = substr($rsQuestiontypes->fields[description], 0, 40);
				  if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsQuestiontypes->fields[id]}</td>
                <td> {$rsQuestiontypes->fields[name]}  </td>
                <td>{$rsQuestiontypes->fields[marks_per_question]} </td>
				<td>{$questiontypedesc}</td>";
				if($rsQuestiontypes->fields[status] == 'Y')
				echo "<td>Active</td>";
				else echo "<td>Inactive</td>";
				echo "
                <td><a href='admin_questiontype_view.php?questiontypeid={$rsQuestiontypes->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a> <a href='admin_questiontype_edit.php?questiontypeid={$rsQuestiontypes->fields[id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a> </td>
              </tr>";
				   $rsQuestiontypes-> MoveNext();
				   $i++;
				}?>
                </tbody>
          </table>
        </div>
      </div>
     <div class="paginationContent">
        
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getQuestiontypes ); ?></ul></div>
      </div>
      
     <?php } else{
			echo "<p><span>No Results Found</span></p>";}?>
    </div>
   </div>
<?php 
include('adminfooter.php');
}
?>