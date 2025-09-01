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
include("../config/classes/exammaster.class.php");
include("../config/classes/keywordmaster.class.php");
include('adminheader.php');
$studentid = $_GET[ studentid ];
$exammaster  = new exammaster();
$keywordmaster  = new keywordmaster();
$studentPrograms =$exammaster -> getEnrollProgramsforStudent($studentid  );
foreach($studentPrograms as $value)
 	{ 
	 $program_id = $value[id];  }
$studentarray =array('student_id'=>$studentid,'program_id'=>$program_id);
$studentdetail = $exammaster -> getStudentdetailsforProg($studentarray);
$getStudentMarkDetails= $exammaster -> getStudentMarkDetail($studentarray);

$results = $keywordmaster -> getkeywordforresult('result');
$grades =  $keywordmaster -> getkeywordforgrade('grade');
if(isset($_REQUEST['resultPublish'])){
	/*echo "<pre>";
	print_r($_REQUEST);*/
	$results = $_REQUEST['result'];
	$ackmsg = $exammaster -> updatereult($results);
	if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Exam results has been published successfully';
			header("location:admin_student_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#publishResult").validate({
		errorElement: 'div'
	});
	$('#selectProgram').change(function() {
	  var selctedval= $('#selectProgram').val();
	  var studentid = $('#studentid').val();
	 $.ajax({
                       type: "GET",
                       url: "publishresult.php",
                       data: {program_id: selctedval, student_id: studentid}, 
                       success: function(result){
						       $(".publishResult").html(result);
							
                       }
                     });
  });

});
</script>
<div class="content">
    <div class="topNav">
     <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a href="students_listing.html">students</a></li>
        <li class="last"> &nbsp; Edit student</li>
        
      </ul>
    </div>
    <form id="publishResult" action="" method="post">
    <input style="display:none" name="studentid" id="studentid" value="<?php echo $studentid;?>" />
    <div class="studentViewContent">
     
      
     <h2>Publish result</h2>
     <div class="onlineExamContent">
     <div class="addProgramForm question">
    <ul class="w90p">
      <?php if($studentPrograms){  ?>
      <fieldset>
        <legend>Select Program</legend>
       <label> Program   : </label>
          <select name="selectProgram" id = "selectProgram" class="w250"> 
         <?php    foreach($studentPrograms as $value)
            {  echo "<option value='{$value[id]}' selected  >{$value[name]}</option> "; }?>
             </select>
             </fieldset>
             <?php }?>
             </ul>
             </div>
      <div class="onlineExamContentTitle">
      	<ul>
          <li><span>Student ID :</span> <?php echo $studentdetail[0][enrollment_id]; ?></li>
          <li><span>Student Name  :</span> <?php echo $studentdetail[0][first_name]. ' '. $studentdetail[0][last_name]; ?></li>
          <li><span>Center Name :</span> <?php echo $studentdetail[0][academy_name]; ?> </li>
          </ul>
          <ul>
          <li><span>Program Enrolled:</span> <?php echo $studentdetail[0][name]; ?></li>
          <li><span>Date of joining:</span> <?php echo $studentdetail[0][enrollment_date]; ?></li>
          </ul>
      </div>
      <div class="publishResult">
      <?php if($getStudentMarkDetails) {?>
      <div class="addProgramForm onlineexammark"> 
     
      <ul class="w100p">
      <fieldset>
        <legend>Mark Details </legend>
        <div class="onlineExamMarkOuter">
       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="w850">
          <tr>
            <th>Course COde</th>
            <th>Regulation</th>
            <th>Marks Obtained</th>
            <th>Result</th>
            <th>Grade</th>
          </tr>
     <?php $i =0; $flag =0; foreach ($getStudentMarkDetails as $getStudentMarkDetail){ 
  echo "<tr>";
   echo "<td>{$getStudentMarkDetail[code]}</td>";
    echo "<td>{$getStudentMarkDetail[regulation]}</td>";
    echo "<td>{$getStudentMarkDetail[total_mark ]}</td>";
	if($getStudentMarkDetail[result] == 'Unpublished'){
		$flag =1;
	echo "<td><select name='result[{$i}][ddlResult]' id='select1{$i}' class='course required' title='Result required'><option value=''>Select</option>";
	foreach ($results as $result)
	echo "<option value='{$result[id]}'>{$result[value]}</option>";
      echo '</select></td>';
	  echo "<td><select name='result[{$i}][ddlGrade]' id='select2{$i}' class='course required' title='Grade required'><option value=''>Select</option>";
	foreach ($grades  as $grade)
	echo "<option value='{$grade[id]}'>{$grade[value]}</option>";
      echo "</select><input type='hidden' name='result[{$i}][examId]' value='{$getStudentMarkDetail[examid]}'/></td>";
	  }
	else {
	   echo "<td>{$getStudentMarkDetail[result]}</td>";
    echo "<td>{$getStudentMarkDetail[grade]}</td>";
	}
 echo " </tr>";
  $i++; }?>
  
       </table></div>
          </fieldset>
     <li class="button">
    <?php  if($flag == 1) { ?><input name="resultPublish" value="Publish" type="submit" class="submitBtn fl" /> <?php }?>
        <a href="admin_student_listing.php" class="cancelBtn">Cancel</a>
  </li>   
    </ul> 
    </div>
   <?php }  else  echo "<p><span class='warning'><strong>No exams assigned/attended</strong></span></p>" ;?>
     </div> 
     </div>
    </div>
    </form>
  </div>
 <?php 
include('adminfooter.php');
}
?>