<?php
include("../config/config.inc.php");
include("../config/classes/exammaster.class.php");
include("../config/classes/keywordmaster.class.php");
if(isset($_GET['program_id']) && isset($_GET['student_id'])){
$studentid = $_GET[ student_id ];
$programid = $_GET[ program_id ];

$exammaster  = new exammaster();
$keywordmaster  = new keywordmaster();


$studentarray =array('student_id'=>$studentid,'program_id'=>$programid);

$getStudentMarkDetails = $exammaster -> getStudentMarkDetail($studentarray);

$results = $keywordmaster -> getkeywordforresult('result');
$grades =  $keywordmaster -> getkeywordforgrade('grade');

?>

  <?php if($getStudentMarkDetails) {
      echo "<div class='addProgramForm onlineexammark'> 
      <ul class='w100p'>
      <fieldset>
        <legend>Mark Details </legend>
        <div class='onlineExamMarkOuter'>
       <table width='100%' border='0' cellspacing='0' cellpadding='0' class='w850'>
          <tr>
            <th>Course COde</th>
            <th>Regulation</th>
            <th>Marks Obtained</th>
            <th>Result</th>
            <th>Grade</th>
          </tr>";
    $i =0; $flag =0;foreach ($getStudentMarkDetails as $getStudentMarkDetail){ 
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
  $i++; }
  
      echo " </table></div>
          </fieldset>
     <li class='button'>";
	  if($flag == 1)  echo "<input name='resultPublish' value='Publish' type='submit' class='submitBtn fl' />";
       echo "<a href='admin_student_listing.php' class='cancelBtn'>Cancel</a>
  </li>   
    </ul> </div>"; 
	}  else echo "<p><span class='noRecord'><strong>Not Yet Attened Any Exam</strong></span></p>" ;
}