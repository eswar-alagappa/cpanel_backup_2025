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
	include("../config/classes/messagemaster.class.php");
    include('adminheader.php');
define( MAX_NO_OF_ROWS_PAGINATION,10);
global $DB;
$sendMessage  = new messagemaster();
$pagename='alert_announcement_listing';
$getSendMessage=$sendMessage->getMessage();
$rsMessage = $DB -> execute( $paginationObj->getQuery($getSendMessage ." order by id desc"));
$countofMessage = count($rsMessage -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getSendMessage);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}
?>
<script type="text/javascript" src="../web/validation/send-announcement.validate.js"></script>
  <div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
        
        <li><a  href="javascript:;">Messages</a></li>
        <li class="last"> &nbsp;  Annoucements</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2><span>Announcements</span>
       
     <span class="sendannounceOuter"><a href="admin_announcement_send.php">Send Announcement</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span></h2>
     <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
      <?php if($countofMessage)
		{ ?>
      <div class="studentList">
      
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Id </th>
                <th> Subject</th>
                <th>Message</th>
                <th>Mailed on</th>
                <th width="95"> Actions</th>
              </tr>
             <?php 
			   $i =0;
			  while(!$rsMessage->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsMessage->fields[id]}</td>
                <td> {$rsMessage->fields[subject]}  </td>
                <td>{$rsMessage->fields[message]} </td>
				 <td>{$rsMessage->fields[mail_date]} </td>";
				
                echo "</td>";
			   echo "<td><a href='admin_announcement_view.php?id={$rsMessage->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			 echo "	 </td>
              </tr>";
				   $rsMessage-> MoveNext();
				   $i++;
 				 } 
			 ?>
              
            </tbody>
          </table>
        </div>
      </div>
      
      
    <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getSendMessage ); ?></ul></div>
      </div>
  <?php  }
		else echo "<p class='warning'>No Results Found</div>"; ?>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>