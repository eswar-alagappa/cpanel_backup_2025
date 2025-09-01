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
include("../config/classes/keywordmaster.class.php");
include("../config/classes/feedbackmaster.class.php");
include('adminheader.php');
define( MAX_NO_OF_ROWS_PAGINATION,10);
global $DB;
$getfeedback  = new feedbackmaster();
$keywordmaster  = new keywordmaster();
$feedbackStatus = $keywordmaster->getIdforvalue(array('code'=>'feedbackstatus','value'=>'unread'));

$pagename='admin_feedback_listing';
$getFeedbackMessage=$getfeedback->getFeedbacklisting();
$rsFeedback = $DB -> execute( $paginationObj->getQuery($getFeedbackMessage ." order by id desc"));
$countofMessage = count($rsFeedback -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getFeedbackMessage);
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
        <li class="last"> &nbsp; Feedback</li>
        
      </ul>
    </div>
    <div class="studentViewContent">
     <h2>Feedback </h2>
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
                <th> Date</th>
                <th>Student</th>
                <th>Subject</th>
                <th width="95"> Actions</th>
              </tr>
             <?php 
			   $i =0;
			  while(!$rsFeedback->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
					if($rsFeedback->fields[status]==$feedbackStatus) $newclassname="unreadstatus";else $newclassname="";
				  echo "
				  <tr class='{$classname} {$newclassname}'>
				    <td>{$rsFeedback->fields[id]}</td>
				 <td>{$rsFeedback->fields[mail_date]} </td>
                <td> {$rsFeedback->fields[first_name]}  </td>
                <td>{$rsFeedback->fields[subject]} </td>";
				
                echo "</td>";
			   echo "<td><a href='admin_feedback_view.php?id={$rsFeedback->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			     echo "  <a href='admin_feedback_reply.php?id={$rsFeedback->fields[id]}'><img src='../web/images/reply-icon.png' width='26' height='17' title='View'/></a>";
			   
			 echo "	 </td>
              </tr>";
				   $rsFeedback-> MoveNext();
				   $i++;
 				 } 
			 ?>
          
            </tbody>
          </table>
        </div>
      </div>
     <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getFeedbackMessage ); ?></ul></div>
      </div>
  <?php  }
		else echo "<p class='warning'>No Results Found</div>"; ?>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>