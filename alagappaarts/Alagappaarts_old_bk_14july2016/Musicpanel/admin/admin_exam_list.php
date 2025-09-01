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
include('adminheader.php');
define( MAX_NO_OF_ROWS_PAGINATION,20);
$pagename = "exam_listing";
include("../config/classes/exammaster.class.php");
include("../config/classes/programmaster.class.php");
$programmaster  = new programmaster();
$programname = $programmaster->getProgramname();
$exammaster = new exammaster();
 $exammaster -> updateExamStatus();
 
 if(isset($_REQUEST['btnViewAll']))
{

	unset($_SESSION['searchExam']);
}
if($_REQUEST['btnSearchexam']){
	
	$arrSearch = array('sm.first_name'=>$_REQUEST['txtName'],'cm.program_id'=>$_REQUEST['ddlProgram']);
	$_SESSION['searchExam'] = $arrSearch;

}else {
		$arrSearch = array('sm.first_name'=>$_SESSION['searchExam']['sm.first_name'],'cm.program_id '=>$_SESSION['searchExam']['cm.program_id']);
}
$getExamDetailquery =  $exammaster -> getExamDetail().$filterObj->applyFilter($arrSearch,$pagename);

$getExamDetails = $DB -> getArray( $paginationObj->getQuery($getExamDetailquery));
$count = count($getExamDetails);

$forcount = $DB->execute($getExamDetailquery);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}

?>
<script type="text/javascript" >
$(document).ready(function(){
 $.validator.addMethod('required_group', function(val, el) {
	var $module = $(el).parents('div.searchBox');
     return $module.find('.required_group:filled').length;
});
$.validator.addClassRules('required_group', {
        'required_group' : true
});
$.validator.messages.required_group = 'Please fill out at least one of these fields.';
$('#frmSearchexam').validate({
	errorPlacement: function(error, element) {
		if(element.attr("name") == 'ddlProgram' )
		  $("#frmSearchexam").find(".errorContainer").append(error);
}});

});
</script>
<div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="masters_dashboard.html">dashboard</a></li>
              <li><a  href="#" class="last">Online Exam</a></li>
      </ul>
    </div>
   
    <div class="studentViewContent">
   <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
      <h2>Reassign exam</h2>
            <div class="searchBox">
<form method="post" id="frmSearchexam"  >
<div class="searchBoxInner">


        <label>Search By Name :</label>
        <input type="text"    class="required_group" name="txtName" value="<?php  if($_SESSION['searchExam']['sm.first_name']) echo  $_SESSION['searchExam']['sm.first_name']; ?>" />
       
        
        <label>Program :</label>
       <select class="studentListing required_group" name="ddlProgram">
      <option value="">Select</option>
<?php while(!$programname->EOF)
 	{
		if($_SESSION['searchExam']['cm.program_id'] == $programname->fields[id] )
		echo "<option value='{$programname->fields[id]}' selected>{$programname->fields[name]}</option>";
		else 
	echo "<option value='{$programname->fields[id]}' >{$programname->fields[name]}</option>";
	 $programname-> MoveNext();
	} ?>
    </select>
      
        <input name="btnSearchexam" value="go" type="submit" class="goBtn" />

        </div>  <?php if(isset($_SESSION['searchExam']))
		{
			echo ' <input name="btnViewAll" value="View All" type="submit" class="viewAll" />';
		}
		 ?>
        <div class="errorContainer" ></div>
       </form>
        
       
        </div>
     
      <?php  if($count)
		{ ?>
      <div class="studentList">
             
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
        <th>Student Id </th>
                <th> Student Name</th>
                <th>Program enrolled</th>
                <th>Centre</th>
                <th>Course</th>
                <th>Exam Attempt</th>
                <th>Result</th>
                <th> Actions</th>
              </tr>
              <?php foreach ( $getExamDetails as $detail){
				  echo "<tr>
                <td>{$detail[studentid]}</td>
                <td>{$detail[first_name]} {$detail[last_name]}</td>
                <td>{$detail[programname]}</td>
                <td>{$detail[centrename]}</td>
                <td><label>{$detail[coursecode]}</label></td>
                <td>{$detail[no_of_attempt]} </td>";
				if($detail[result] == 'Fail' || $detail[result] == 'Admin reassign' )
                echo "<td>{$detail[result]}</td>";
				else 
				 echo "<td>{$detail[examstatus]}</td>";
               echo " <td><a href='admin_reassign_exam.php?studentid={$detail[student_id]}&course={$detail[course_id]}&program={$detail[programid]}'><img src='../web/images/reassign-exam.png' width='20' height='18' alt='Reassign Exam' title='Reassign Exam'/></a></td>
              </tr>";
				  }?>
              
            
               
            </tbody>
          </table>
        </div>
      </div>
      <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getExamDetailquery); ?></ul></div>
      </div>
     <?php  }
		else echo "<div class='adminError'>No Results Found</div>"; ?>
       </div>
   
  </div>
<?php 
include('adminfooter.php');
}
?>
 
 
 
  


