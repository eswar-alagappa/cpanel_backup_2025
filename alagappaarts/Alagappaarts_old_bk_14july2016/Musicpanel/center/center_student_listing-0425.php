<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[centerinfo][role_id];
$userid = $_SESSION[centerinfo][user_id];
$username = $_SESSION[centerinfo][academy_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$iscenter  = $loginmaster->iscenter($arrlogin);

if(!$iscenter)
{
	header('location:index.php?msg=Enter username password');
}
else{
define( MAX_NO_OF_ROWS_PAGINATION,20);
include('centerheader.php');
include("../config/classes/programmaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/keywordmaster.class.php");
global $DB;
$programmaster  = new programmaster();
$programname = $programmaster->getProgramname();
$centremaster  = new centremaster();
$centrenames = $centremaster->getcentrenames();
$keywordmaster  = new keywordmaster();
$studentstatus = $keywordmaster->getkeyword('studentstatus');
$pagename='student_listing';
if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchStudent']);
}
if($_REQUEST['btnStudentsearch']){
$arrStudent =array('sm.first_name'=>$_REQUEST['txtName'],'sm.status'=>$_REQUEST['ddlStatus'],'se.program_id'=>$_REQUEST['ddlProgram'],'se.centre_id'=>$userid);
$_SESSION['searchStudent'] = $arrStudent;
	header('location:center_student_listing.php');
}else if($_SESSION['searchStudent']){
		$arrStudent = array('sm.first_name'=>$_SESSION['searchStudent']['sm.first_name'],'sm.status'=>$_SESSION['searchStudent']['sm.status'],
	'se.program_id'=>$_SESSION['searchStudent']['se.program_id'],'se.centre_id'=>$userid);
}
else  {
	$arrStudent = array('se.centre_id'=>$userid);
	}
$studentmaster  = new studentmaster();
$getStudents = $studentmaster -> getStudents().$filterObj->applyFilter($arrStudent,$pagename);
//echo $getStudents ." order by student_id  desc";
$rsStudents = $DB -> execute( $paginationObj->getQuery($getStudents ." order by student_id  desc"));
/*echo "<pre>";
print_r($rsStudents);*/

$countofStudents = count($rsStudents -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getStudents);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}


if( isset ($_POST['btnDownload'])){
	
include_once('../config/libs/adodb/toexport.inc.php');
include_once('../config/libs/adodb/adodb.inc.php');
$path = "../downloads/reports.CSV";
$forcount = $DB->execute("select   se.enrollment_id as EnrollmentID ,sm.first_name as FirstName ,sm.last_name  as LastName
					 ,sm.age as Age ,sm.gender as Gender ,sm.address as Address ,sm.state as State ,
					sm.country as Country  ,sm.zipcode as Zipcode,sm.phone  as PhoneNo,sm.email_id as EmailID ,km.value as Status ,pm.name as Program,cm.academy_name as Center , 
					cd.director_name as Director   ,se.graduation_status as GraduationStatus 
					  from 
					studentmaster sm   
					join student_education se on se.student_id =    sm.id
					join programmaster pm on  pm.id =  se.program_id
					join centremaster cm on  cm.id =  se.centre_id 	
					join centre_director cd on  cm.id =  cd.centre_id
					join keywordmaster km on  km.id =  sm.status where 1=1 and se.centre_id= {$userid}" );
$forcount->MoveFirst();
$fp = fopen($path, "w");
if ($fp) {
 rs2csvfile($forcount, $fp); # write to file (there is also an rs2tabfile function)
 fclose($fp);
}
header('location:../downloads/reports.CSV');
}

?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
<div class="headerBottom">

      <div class="admiTitle">Welcome  <?php  echo $username; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class=""><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class=" wrapper">

<div class="content">

    <div class="studentViewContent">
    <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
     <h2><span>students </span>
     
<div class="downloadbtn">
        <span>
         <form id="form" method="post">
		<input name="btnDownload" class="exceldownloadBtn"  value="" type="submit" ></form>  </span>
         <!--<span> <form id="form" method="post">
		<input name="btnDownloadword" class="worddownloadBtn"  value="" type="submit" ></form> </span>-->
      </div>
</h2>
<div class="searchBox">
<form method="post" id="frmStudentsearch"  >
<div class="searchBoxInner">


        <label>Search By Name :</label>
        <input type="text"    class="required_group" name="txtName" value="<?php  if($_SESSION['searchStudent']['sm.first_name']) echo  $_SESSION['searchStudent']['sm.first_name']; ?>" />
        <label class="statusTxt">Status :</label>
        <select class="mR10 studentListing required_group" name="ddlStatus">
      <option value="">Select</option>
<?php foreach($studentstatus as $value)
 	{
		if($value[id] == $_SESSION['searchStudent']['sm.status'])
		echo "<option value='{$value[id]}'selected >{$value[value]}</option>";
		else 
	echo "<option value='{$value[id]}' >{$value[value]}</option>";
	 
	} ?>
    </select>
        
       </div>
       <div class="searchBoxInner">

         <label>Program :</label>
       <select class="studentListing required_group" name="ddlProgram">
      <option value="">Select</option>
<?php while(!$programname->EOF)
 	{
		if($_SESSION['searchStudent']['se.program_id'] == $programname->fields[id] )
		echo "<option value='{$programname->fields[id]}' selected>{$programname->fields[name]}</option>";
		else 
	echo "<option value='{$programname->fields[id]}' >{$programname->fields[name]}</option>";
	 $programname-> MoveNext();
	} ?>
    </select>
        
        <input name="btnStudentsearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchStudent']))
		{
			echo ' <input name="btnViewAll" value="View All Students" type="submit" class="viewAll" />';
		}
		 ?>
        </div>
        <div class="errorContainer" ></div>
       </form>
        </div> 
     
     
      <div class="studentList">
        
              <?php if($countofStudents)
		{ ?>
   		<div class="searchBox" style="display:none;">
        Search results for Aravind Kumar
      </div>
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Student Id </th>
                <th> Student Name</th>
                <th> Student Email ID</th>
                 <th> Status</th>
                <th width="75"> Actions</th>
              </tr>
               <?php  
			  $i =0;
			  while(!$rsStudents->EOF)
 				{
				
					$studentarray =  array('student_id'=>$rsStudents->fields[id]);
					$rsEnrollmentID= $studentmaster->getEnrollmentID($studentarray);
					$getEnrollmentID=$rsEnrollmentID->fields[enrollment_id];
					
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				   <td>{$getEnrollmentID}</td>
           
                <td> {$rsStudents->fields[first_name]} {$rsStudents->fields[last_name]}  </td>
                <td>{$rsStudents->fields[email_id]} </td>";
               echo "<td>{$rsStudents->fields[value]}";
			   echo "</td>";
			 
			   echo "<td><a href='center_student_view.php?studentid={$rsStudents->fields[student_id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			   
				echo "</td></tr>";
				   $rsStudents-> MoveNext();
				   $i++;
 				 }?>
            </tbody>
          </table>
        </div>
         <?php  }
	 ?>
      </div>
         <?php if($countofStudents)
		{ ?>
      <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getStudents ); ?></ul></div>
      </div>
        <?php  }
		else echo "<div class='centerError'>No Results Found</div>"; ?>
      
    </div>
   </div>
     </div>
<?php 
include('centerfooter.php');
}
?>