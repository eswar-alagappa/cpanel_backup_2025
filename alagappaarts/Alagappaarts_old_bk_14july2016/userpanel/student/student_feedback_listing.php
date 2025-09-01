<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[studentinfo][role_id];
$userid = $_SESSION[studentinfo][user_id];
$username = $_SESSION[studentinfo][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);
if(!$student)
{
	header('location:index.php?msg=Enter username password');
}
else{
include('studentheader.php');
include("../config/classes/studentmaster.class.php");
include("../config/classes/feedbackmaster.class.php");
define( MAX_NO_OF_ROWS_PAGINATION,10);
global $DB;
$sendFeedback  = new feedbackmaster();
$pagename='feedback_listing';
$getSendFeedback=$sendFeedback->getStudentFeedback($userid);
$rsStudFeedback = $DB -> execute( $paginationObj->getQuery($getSendFeedback ." order by id desc"));
$countofMessage = count($rsStudFeedback -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getSendFeedback);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}
?>

  <div class="headerBottom">
      <div class="admiTitle">Welcome <?php echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
        <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenavactive"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
      
    </div>
    <div class="wrapper">
  <div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Feedback </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2><span>Feedback</span>
       
      <span class="feedbackbtn"><a class="submitBtn" href="student_feedback_send.php">Send Feedback</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span> 
      </h2>
      <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="success">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
       <?php if($countofMessage)
		{ ?>
      <div class="contentInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th> Feedback ID</th>
                <th> Date	 </th>
                <th>Subject</th>
                <th width="95"> Actions</th>
              </tr>
              <?php 
			   $i =0;
			  while(!$rsStudFeedback->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsStudFeedback->fields[id]}</td>
				 <td>{$rsStudFeedback->fields[mail_date]} </td>
                <td> {$rsStudFeedback->fields[subject]}  </td>";
				
                echo "</td>";
			   echo "<td><a href='student_feedback_view.php?id={$rsStudFeedback->fields[id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			 echo "	 </td>
              </tr>";
				   $rsStudFeedback-> MoveNext();
				   $i++;
 				 } 
			 ?>
          
            </tbody>
          </table>
        </div>
     
 <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getSendFeedback ); ?></ul></div>
      </div>
  <?php  }
		else echo "<div class='warning'>No Results Found</div>"; ?>
    </div>
  </div>
  </div>
<?php 
include('studentfooter.php');
}
?>