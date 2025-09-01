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
;

define( MAX_NO_OF_ROWS_PAGINATION,20);
include("../config/classes/centremaster.class.php");
include("../config/classes/keywordmaster.class.php");
$pagename='exam_listing';
global $DB;
$centremaster = new centremaster();
$keywordmaster = new keywordmaster;

$result = $keywordmaster->getkeywordforresult('result');

if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchResult']);
}
if($_REQUEST['btnExamsearch']){
$arrResult =array('sm.first_name'=>$_REQUEST['txtName'],'se.enrollment_id'=>$_REQUEST['txtEnrollmentid'],'ae.result'=>$_REQUEST['ddlResult']);
$_SESSION['searchResult'] = $arrResult;
	
}else {
		$arrResult = array('sm.first_name'=>$_SESSION['searchResult']['sm.first_name'],'se.enrollment_id'=>$_SESSION['searchResult']['se.enrollment_id'],
	'ae.result'=>$_SESSION['searchResult']['ae.result']);
}
$getExamResult = $centremaster -> getExamResultonview($userid).$filterObj->applyFilter($arrResult,$pagename);
/*echo  $getExamResult ;*/
$rsExamResult = $DB -> execute( $paginationObj->getQuery($getExamResult ."  ORDER BY ae.id DESC"));



$countofResult = count($rsExamResult -> fields[examid ]);
static $recordcount=0;
$forcount = $DB->execute($getExamResult);
while(!$forcount->EOF)
{
		$recordcount++;
		$forcount -> MoveNext();
}



/*global $DB;
$centremaster = new centremaster();

$rsExamResult = $centremaster -> getExamResult($userid);
*/



?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
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
        <li class="last"> &nbsp; Exam Results </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2>Exam Results</h2>
    
      <div class="contentInner">
 <div class="searchBox">
<form method="post" id="frmStudentsearch"  >
<div class="searchBoxInner">
<label>Search By ID :</label>
<input type="text"  class="required_group" name="txtEnrollmentid" value="<?php  if($_SESSION['searchResult']['se.enrollment_id']) echo  $_SESSION['searchResult']['se.enrollment_id']; ?>" />
  <label> First  Name :</label>
 <input type="text" class="required_group" name="txtName" value="<?php  if($_SESSION['searchResult']['sm.first_name']) echo  $_SESSION['searchResult']['sm.first_name']; ?>" />   
 </div>
  <div class="searchBoxInner">
  <label> Exam Status  :</label>
   <select class="mR10 studentListing required_group" name="ddlResult">
      <option value="">Select</option>
<?php foreach($result as $value)
 	{
		if($value[id] == $_SESSION['searchResult']['ae.result'])
		echo "<option value='{$value[id]}'selected >{$value[value]}</option>";
		else 
	echo "<option value='{$value[id]}' >{$value[value]}</option>";
	 
	} ?>
    </select>
          <input name="btnExamsearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchResult']))
		{
			echo ' <input name="btnViewAll" value="View All Results" type="submit" class="viewAll" />';
		}
		 ?>
        </div>
        <div class="errorContainer" ></div>
       </form>
        </div>
       <?php if($countofResult)
		{ ?> 
      <table class="" cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
               <th>Student Name</th>
                <th>Program Enrolled</th>
                <th>Course </th>
                <th>Exam Start Date </th>
                <th>Exam End Date </th>
                <th> Mark Obtained</th>
                <th> Result</th>
                <th> Grade</th>
              </tr>
               <?php 
   $i =0;
  foreach ($rsExamResult  as $result){
	 if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				     <td> {$result[first_name]} {$result[last_name]}  </td>
					 <td> {$result[programenrolled]}   </td>
                <td>{$result[code]}</td>
              <td>{$result[examstartDate]}</td>
			    <td>{$result[examendDate]}</td>
				 <td> {$result[total_mark]}  </td>
				   <td> {$result[result]}  </td>
                <td>{$result[grade]} </td></tr>";
	 $i++; } ?>
            </tbody>
          </table>
     
  <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $rsExamResult ); ?></ul></div>
      </div>
     
    
      
        <?php  }
		else{
			echo "<div class='information'>Exam not taken / Result not published. </span></div>";}?>
             </div>
            
         
    </div>
  </div>

</div>

<?php 
include('studentfooter.php');
}
?>