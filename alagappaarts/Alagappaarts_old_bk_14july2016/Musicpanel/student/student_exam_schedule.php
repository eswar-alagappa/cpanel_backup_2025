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
include("../config/classes/exammaster.class.php");
$studentexamschedule = new exammaster();
define( MAX_NO_OF_ROWS_PAGINATION,10);
include('adminheader.php');
global $DB;
$pagename='examschedule_listing';

$getExamschedule = $studentexamschedule -> getExamschedule($userid);
//echo $getExamschedule;
$rsExams = $DB -> execute( $paginationObj->getQuery($getExamschedule));
/*echo $rsExams;
exit;*/
$countofExams = count($rsExams -> fields[id]);
static $recordcount=0;
	$forcount = $DB->execute($getExamschedule);
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
<div class=" wrapper">
  <div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Schedule </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2>Schedule</h2>
    
      <div class="contentInner">
     
       <?php if($countofExams)
		{ ?> 
         <p>Your Exam dates are scheduled. You can write the online exam at any time  on the allowed period.</p>
      <table class="w700" cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Course </th>
                <th> From</th>
                <th> Till</th>
              </tr>
              <?php  
			  $i =0;
			  while(!$rsExams->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$rsExams->fields[code]}</td>
                 <td> {$rsExams->fields[startDate]}  </td>
                <td>{$rsExams->fields[endDate]} </td>";
                
				   $rsExams-> MoveNext();
				   $i++;
 				 }?>
            </tbody>
          </table>
          <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getExamschedule ); ?></ul></div>
      </div>
     
    
        <?php  }
		else{
			echo "<div class='information'>Exams not yet assigned</div>";}?>
            
         </div>
            
         
    </div>
  </div>

</div>

<?php 
include('studentfooter.php');
}
?>