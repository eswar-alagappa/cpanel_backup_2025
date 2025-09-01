<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[centerinfo][role_id];
$userid = $_SESSION[centerinfo][user_id];
$username = $_SESSION[centerinfo][academy_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$iscenter  = $loginmaster->iscenter($arrlogin);
/*echo $iscenter ;
exit;*/
if(!$iscenter)
{
	header('location:index.php?msg=Enter username password');
}
else{
include('centerheader.php');
define( MAX_NO_OF_ROWS_PAGINATION,20);
include("../config/classes/centremaster.class.php");
include("../config/classes/keywordmaster.class.php");
$pagename='exam_listing';
global $DB;
$centremaster = new centremaster();
$keywordmaster = new keywordmaster;

$examstatus = $keywordmaster->getkeyword('examstatus');

if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchExamSchedule']);
}
if($_REQUEST['btnExamsearch']){
$arrExam =array('sm.first_name'=>$_REQUEST['txtName'],'se.enrollment_id'=>$_REQUEST['txtEnrollmentid'],'ase.exam_status'=>$_REQUEST['ddlExamStatus']);
$_SESSION['searchExamSchedule'] = $arrExam;
	
}else {
		$arrExam = array('sm.first_name'=>$_SESSION['searchExamSchedule']['sm.first_name'],'se.enrollment_id'=>$_SESSION['searchExamSchedule']['se.enrollment_id'],
	'ase.exam_status'=>$_SESSION['searchExamSchedule']['ase.exam_status']);
}
$getExamschedule = $centremaster -> getExamscheduleview($userid).$filterObj->applyFilter($arrExam,$pagename);
//echo  $getExamschedule ;
$rsExams = $DB -> execute( $paginationObj->getQuery($getExamschedule ." order by ase.exam_date_starttime desc "));

/*$getExamschedule = $centremaster -> getExamschedule($userid);

$rsExams = $DB -> execute( $getExamschedule);*/

$countofExams = count($rsExams -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getExamschedule);
while(!$forcount->EOF)
{
		$recordcount++;
		$forcount -> MoveNext();
}

?>
<script type="text/javascript" src="../web/validation/centerpanel.validate.js"></script>
<div class="headerBottom">

      <div class="admiTitle">Welcome  To <?php  echo $username; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
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
      <h2>Exam Schedule</h2>
      
      <div class="contentInner">
    <div class="searchBox">
<form method="post" id="frmStudentsearch"  >
<div class="searchBoxInner">
<label>Search By ID :</label>
<input type="text"  class="required_group" name="txtEnrollmentid" value="<?php  if($_SESSION['searchExamSchedule']['se.enrollment_id']) echo  $_SESSION['searchExamSchedule']['se.enrollment_id']; ?>" />
  <label> First  Name :</label>
 <input type="text" class="required_group" name="txtName" value="<?php  if($_SESSION['searchExamSchedule']['sm.first_name']) echo  $_SESSION['searchExamSchedule']['sm.first_name']; ?>" />   
 </div>
  <div class="searchBoxInner">
  <label> Exam Status  :</label>
   <select class="mR10 studentListing required_group" name="ddlExamStatus">
      <option value="">Select</option>
<?php foreach($examstatus as $value)
 	{
		if($value[id] == $_SESSION['searchExamSchedule']['ase.exam_status'])
		echo "<option value='{$value[id]}'selected >{$value[value]}</option>";
		else 
	echo "<option value='{$value[id]}' >{$value[value]}</option>";
	 
	} ?>
    </select>
          <input name="btnExamsearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchExamSchedule']))
		{
			echo ' <input name="btnViewAll" value="View All Exam" type="submit" class="viewAll" />';
		}
		 ?>
        </div>
        <div class="errorContainer" ></div>
       </form>
        </div>
   
       <?php if($countofExams)
		{ ?> 
  <!--  <p>Your Exam dates are scheduled. You can write the online exam at any time  on the allowed period.</p>-->
      <table class="" cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
              <th>Student Id </th>
              <th>Student Name</th>
                <th>Program Enrolled</th>
                <th>Course </th>
                <th> From</th>
                <th> Till</th>
                <th> Exam Status </th>
              </tr>
              <?php  
			  $i =0;
			  while(!$rsExams->EOF)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				  <td>{$rsExams->fields[enrollment_id]}</td>
				   <td>{$rsExams->fields[first_name]} {$rsExams->fields[last_name]}</td>
				    <td>{$rsExams->fields[name]}</td>
                <td>{$rsExams->fields[code]}</td>
                 <td> {$rsExams->fields[startDate]}  </td>
                <td>{$rsExams->fields[endDate]} </td>
				 <td>{$rsExams->fields[examstatus]} </td>";
                
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
			echo "<div class='information'>Exam not yet assigned/ No Result Found</div>";}?>
            
         </div>
            
         
    </div>
  </div>

</div>

<?php 
include('studentfooter.php');
}
?>