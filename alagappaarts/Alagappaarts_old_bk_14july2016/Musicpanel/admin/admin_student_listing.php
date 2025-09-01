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
include("../config/classes/programmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/keywordmaster.class.php");
define( MAX_NO_OF_ROWS_PAGINATION,20);
include('adminheader.php');
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
if(isset($_REQUEST['letter'])) { 
	if($_REQUEST['letter'] != "ALL")
	$_SESSION['letter'] = $_REQUEST['letter'];
	else  unset($_SESSION['letter']);
} if(isset($_SESSION['letter']))    $_SESSION['letter'] =   $_SESSION['letter'] ;
else   unset($_SESSION['letter']);
//echo $_SESSION['letter']	;
if($_REQUEST['btnStudentsearch']){
 unset ($_SESSION['letter']); 
$arrStudent =array('sm.first_name'=>$_REQUEST['txtName'],'sm.status'=>$_REQUEST['ddlStatus'],'se.program_id'=>$_REQUEST['ddlProgram'],'se.centre_id'=>$_REQUEST['ddlCenter']);
$_SESSION['searchStudent'] = $arrStudent;
	header('location:admin_student_listing.php');
}else if($_SESSION['letter']){
	unset($_SESSION['searchStudent']);
	$arrStudent =array('sm.first_nameonalpha'=>$_SESSION['letter']);
}else{
		$arrStudent = array('sm.first_name'=>$_SESSION['searchStudent']['sm.first_name'],'sm.status'=>$_SESSION['searchStudent']['sm.status'],
	'se.program_id'=>$_SESSION['searchStudent']['se.program_id'],'se.centre_id'=>$_SESSION['searchStudent']['se.centre_id']);
}
$studentmaster  = new studentmaster();
$getStudents = $studentmaster -> getStudents().$filterObj->applyFilter($arrStudent,$pagename);
$rsStudents = $DB -> execute( $paginationObj->getQuery($getStudents ." order by student_id  desc"));
$countofStudents = count($rsStudents -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getStudents);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}

?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
<div class="content">
<div class="topNav">
     <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li class="last"> &nbsp; students</li>
        
      </ul>
    
    </div>
    <div class="studentViewContent">
    <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
     <h2><span>students </span>
<span class="addFieldOuter"><a class="submitBtn" href="admin_student_add.php">Add Student</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>     

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
        <label class="statusTxt">Center :</label>
        <select class="studentListing required_group" name="ddlCenter">
<option  value="">Select</option>

 <?php while(!$centrenames->EOF)
 	{
		if($centrenames->fields[id] ==  $_SESSION['searchStudent']['se.centre_id'])
		echo "<option value='{$centrenames->fields[id]}' selected >{$centrenames->fields[academy_name]}</option>";
		else 
	echo "<option value='{$centrenames->fields[id]}'  >{$centrenames->fields[academy_name]}</option>";
	 $centrenames-> MoveNext();
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
        <div class="studentNameTitle">
        <ul>
        
        <?php 
		
        $alphabet = array('ALL','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'); 
			foreach ($alphabet as $letter) { 
		
			if($_SESSION['letter'] ==  $letter)
					echo "<li class='arrowBg'><a class='allBtn' href=".$_SERVER['PHP_SELF']."?letter=" . $letter . ">" . $letter . "</a></li>"; 
			else if($letter == 'ALL' && !($_SESSION['letter']))
				echo "<li class='arrowBg'><a class='allBtn' href=".$_SERVER['PHP_SELF']."?letter=" . $letter . ">" . $letter . "</a></li>";
			else echo "<li><a href=".$_SERVER['PHP_SELF']."?letter=" . $letter . ">" . $letter . "</a></li>"; }
        ?>
        </ul>
         
        </div>
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
                <th width="220"> Actions</th>
              </tr>
               <?php  
			  $i =0;
			  while(!$rsStudents->EOF)
 				{
				
					$studentarray =  array('student_id'=>$rsStudents->fields[id]);
					$rsEnrollmentID= $studentmaster->getEnrollmentID($studentarray);
					$getEnrollmentID=$rsEnrollmentID->fields[enrollment_id];
					$programIDforstudent= $rsEnrollmentID->fields[program_id];
					$checkWhetherexamassigned = $studentmaster->checkWhetherexamassigned($rsStudents->fields[student_id]) ;
					
					if ($rsStudents->fields[value] == "Waiting for Approval" )
					$studentIcondecider= "Waiting for Approval";
					else 	if ($rsStudents->fields[value] == "Inactive" )
					$studentIcondecider= "Inactive";
					else if($checkWhetherexamassigned)
						$studentIcondecider= "Assign Exam";
					else 
						$studentIcondecider= "default";
					
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				   <td>{$getEnrollmentID}</td>
           
                <td> {$rsStudents->fields[first_name]} {$rsStudents->fields[last_name]}  </td>
                <td>{$rsStudents->fields[email_id]} </td>";
               echo "<td>{$rsStudents->fields[value]}";
			   echo "</td>";
			 
			   echo "<td><a href='admin_student_view.php?studentid={$rsStudents->fields[student_id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>
			    <a href='admin_student_edit.php?studentid={$rsStudents->fields[student_id]}'><img src='../web/images/edit-btn.png' width='20' height='18' title='Edit'/></a>
				 ";
			switch ($studentIcondecider){
				case "Waiting for Approval":{
			echo "<a href='admin_student_approve.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' title='Approve Student' alt='Approve Student' src='../web/images/approver-student-icon.png' /></a><a href='javascript:;'><img width='20' height='18' title='Reset Password' alt='Reset Password' src='../web/images/reset-password-inactive-icon.png' /></a>
			<a href='javascript:;'><img width='20' height='18' title='Assign Exam' alt='Assign Exam' src='../web/images/assign-exam-icon-inactive.png' /></a>
				 <a href='javascript:;'><img width='20' height='18' title='Online Exam Mark ' alt='Online Exam Mark ' src='../web/images/online-exam-mark-icon-inactive.png' /></a>
				 <a href='javascript:;'><img width='20' height='18' title='External Mark' alt='External Mark' src='../web/images/external-mark-icon-inactive.png' /></a> 
				<a href='javascript:;'><img width='20' height='18' align='Publish Result' title='Publish Result' src='../web/images/publish-result-inactive.png' /></a> 
				<a href='javascript:;'><img width='20' height='18' title='Course Completion Update' alt='Course Completion Update' src='../web/images/course-completion-update-icon-inactive.png'/></a> ";
				break;}
			 case  "Inactive":{
				echo "
				<a href='javascript:;'><img width='20' height='18' title='Approve Student' alt='Approve Student' src='../web/images/approver-student-icon-inactive.png'></a>";
				echo "<a href='javascript:;'><img width='20' height='18' title='Reset Password' alt='Reset Password' src='../web/images/reset-password-inactive-icon.png' /></a>";
				echo "<a href='javascript:;'><img width='20' height='18' title='Assign Exam' alt='Assign Exam' src='../web/images/assign-exam-icon-inactive.png'></a>
							<a href='javascript:;'><img width='20' height='18' title='Online Exam Mark ' alt='Online Exam Mark ' src='../web/images/online-exam-mark-icon-inactive.png'></a>
				          <a href='javascript:;'><img width='20' height='18' title='External Mark' alt='External Mark' src='../web/images/external-mark-icon-inactive.png'></a> 
				      	 <a href='javascript:;'><img width='20' height='18' align='Publish Result' title='Publish Result' src='../web/images/publish-result-inactive.png'></a> 
				       	 <a href='javascript:;'><img width='20' height='18' title='Course Completion Update' alt='Course Completion Update' src='../web/images/course-completion-update-icon-inactive.png'></a> ";
						 break;}
				case "Assign Exam":{
					echo "
				<a href='javascript:;'><img width='20' height='18' title='Approve Student' alt='Approve Student' src='../web/images/approver-student-icon-inactive.png'></a><a href='admin_student_resetpassword.php?studentid={$rsStudents->fields[student_id]}&programid={$programIDforstudent}'><img width='20' height='18' title='Reset Password' alt='Reset Password' src='../web/images/reset-password-icon.png' /></a>
				<a href='admin_assign_exam.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' title='Assign Exam' alt='Assign Exam' src='../web/images/assign-exam-icon.png'></a>
							<a href='admin_internal_mark.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' title='Online Exam Mark ' alt='Online Exam Mark ' src='../web/images/online-exam-mark-icon.png'></a>
				          <a href='admin_external_mark.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' title='External Mark' alt='External Mark' src='../web/images/external-mark-icon-.png'></a> 
				      	 <a href='admin_publish_result.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' align='Publish Result' title='Publish Result' src='../web/images/publish-result.png'></a> 
				       	 <a href='admin_course _completion_update.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' title='Course Completion Update' alt='Course Completion Update' src='../web/images/course-completion-update-icon.png'></a> ";
						 break;
					}
				case  "default":{
				echo "
				<a href='javascript:;'><img width='20' height='18' title='Approve Student' alt='Approve Student' src='../web/images/approver-student-icon-inactive.png'></a>";
				echo "<a href='admin_student_resetpassword.php?studentid={$rsStudents->fields[student_id]}&programid={$programIDforstudent}'><img width='20' height='18' title='Reset Password' alt='Reset Password' src='../web/images/reset-password-icon.png' /></a>";
				echo "<a href='admin_assign_exam.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' title='Assign Exam' alt='Assign Exam' src='../web/images/assign-exam-icon.png'></a>
				 <a href='javascript:;'><img width='20' height='18' title='Online Exam Mark ' alt='Online Exam Mark ' src='../web/images/online-exam-mark-icon-inactive.png'></a>
				 <a href='javascript:;'><img width='20' height='18' title='External Mark' alt='External Mark' src='../web/images/external-mark-icon-inactive.png'></a> 
				<a href='javascript:;'><img width='20' height='18' align='Publish Result' title='Publish Result' src='../web/images/publish-result-inactive.png'></a> 
				<a href='admin_course _completion_update.php?studentid={$rsStudents->fields[student_id]}'><img width='20' height='18' title='Course Completion Update' alt='Course Completion Update' src='../web/images/course-completion-update-icon.png'></a> ";
				break;}
				}
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
		else echo "<div class='adminError'>No Results Found</div>"; ?>
      
    </div>
   </div>
<?php 
include('adminfooter.php');
}
?>