<?php
include("../config/config.inc.php");
include("../config/classes/exammaster.class.php");
include("../config/classes/keywordmaster.class.php");

if(isset($_GET['program_id']) && isset($_GET['student_id'])){
$studentid = $_GET[ student_id ];
$programid = $_GET[ program_id ];

$exammaster  = new exammaster();
$keywordmaster  = new keywordmaster();
$results = $keywordmaster -> getkeywordforresult('result');
$grades =  $keywordmaster -> getkeywordforgrade('grade');
$studentarray =array('student_id'=>$studentid,'program_id'=>$programid);

$studentdetail = $exammaster -> getStudentdetailsforProg($studentarray);
$studentCourses = $exammaster -> getCoursesforexternalmark($studentarray);
$studentExternalMarks = $exammaster -> getExternalMark($studentarray);
?>
<script type="text/javascript">
$(document).ready(function(){

$(".datepicker").datepick({
        buttonImage: '../web/images/calendar-img.gif',
        buttonImageOnly: true,
        showOn: 'button',
		/*minDate: 0, */
		dateFormat:'dd-M-yy',
		buttonText:'Select date',
		minDate: new Date(2000, 12-1, 01), 
		maxDate: new Date(2050,01-1,01),
		//yearRange: "-60:+0",
		onClose: function() { $(".datepicker").focus(); }
     });

});
</script>
<?php 
echo " <div class='onlineExamContentTitle'>
    <ul class='w350'>
          <li><span>Student ID :</span> {$studentdetail[0][enrollment_id]}</li>
          <li><span>Student Name  :</span>{$studentdetail[0][first_name]} {$studentdetail[0][last_name]}</li>
         
          </ul>
          <ul class='w350'>
          <li><span>Program Enrolled:</span>{$studentdetail[0][name]}</li>
           <li><span>Center Name :</span>{$studentdetail[0][academy_name]} </li>
          </ul>";
          
echo "  </div>
       <div class='addProgramForm onlineexammark'>";
	    if($studentExternalMarks) {
      echo "<fieldset>
        <legend>Mark Details </legend>
        <div class='onlineExamMarkOuter'>
       <table width='100%' border='0' cellspacing='0' cellpadding='0' class='w850'>
          <tr>
            <th>Course COde</th>
            <th>Regulation</th>
            <th>Marks Obtained</th>
            <th>Result</th>
            <th>Grade</th>
			<th>Uploaded videos</th>
          </tr>";
      $flag =0; foreach ($studentExternalMarks as $studentExternalMark){ 
  echo "<tr>";
   echo "<td>{$studentExternalMark[code]}</td>";
    echo "<td>{$studentExternalMark[regulation]}</td>";
    echo "<td>{$studentExternalMark[total_mark ]}</td>";

	   echo "<td>{$studentExternalMark[result]}</td>";
	   if($studentExternalMark[grade] != 'O')
    echo "<td>{$studentExternalMark[grade]}</td>
	<td><a href='../uploads/student-videos/{$studentExternalMark[video1]}' target='blank' id='' title='click to download'>{$studentExternalMark[video1]}</a>&nbsp;<a href='../uploads/student-videos/{$studentExternalMark[video2]}' target='blank' id='' title='click to download'>{$studentExternalMark[video2]}</a>&nbsp;<a href='../uploads/student-videos/{$studentExternalMark[video3]}' target='blank' id='' title='click to download'>{$studentExternalMark[video3]}</a></td>";
	else 
	echo "<td>-</td>";
	
 echo " </tr>";
  }
  
    echo   " </table></div>
          </fieldset>";
        } 
           if($studentCourses){
  echo "
          <ul class='w800'>
    
<li class='reassignexam'>
        <label>Course :<strong class='star'>*</strong> </label>
		<span><select name='ddlcourse'   title='Select Course' class='required'>  <option value=''>Select</option>  ";
    foreach ($studentCourses as $studentCourse) { echo "<option value='{$studentCourse[id]}'>{$studentCourse[code]}</option>"; } 
           echo "</select></span> </li>";
          
       echo "<li class='externalmark'>
        <label> Mark   :<strong class='star'>*</strong> </label>
		<input name='txtExternalMark' type='text'  class='w65 required' maxlength='2'  title='Enter Mark' />   </li>
		<li >
        <label> Exam Date :<strong class='star'>*</strong> </label>
		<input name='txtExamdate' type='text'  class='w65 datepicker required' title='Enter exam date' />   </li>
        <li class='uploadvideo'>
        <label> Performance Video 1 : </label>
        <input type='file' name='Uploadvideo1' accept='avi|mpeg|mp4|flv|wmv' value='1194304' Title='Upload the video'/>&nbsp;Accepted file formats avi/mpeg/mp4/flv/wmv
        </li>
        <li class='uploadvideo'>
        <label> Performance Video 2 : </label>
        <input type='file' name='Uploadvideo2' accept='avi|mpeg|mp4|flv|wmv' value='1194304' Title='Upload the video'/>&nbsp;Accepted file formats avi/mpeg/mp4/flv/wmv
		</li>
        <li class='uploadvideo'>
        <label> Performance Video 3 :</label>
        <input type='file' name='Uploadvideo3' accept='avi|mpeg|mp4|flv|wmv' value='1194304' Title='Upload the video'/>&nbsp;Accepted file formats avi/mpeg/mp4/flv/wmv
		</li>";
         echo "<li class='externalmarkError' >
        <label> Result: <strong class='star'>*</strong></label>
       <select name='result' class='required' title='Result required'><option value=''>Select</option>";
	    foreach ($results as $result)
        echo "<option value='{$result[id]}'>{$result[value]}</option>"; 
      echo "</select>";
      echo "</li>
	   <li class='externalmarkError' >
        <label> Grade: <strong class='star'>*</strong></label>";
       echo " <select name='grade'  class='required' title='Grade required'><option value=''>Select</option>";
	   foreach ($grades  as $grade) echo "<option value='{$grade[id]}'>{$grade[value]}</option>";  
    echo "  </select>
      </li>";
      echo " <li>
          <label>Comments : </label>
          <textarea name='txtComments' cols='' rows=''></textarea>
        </li>
         <li class='btn'><input type='submit' class='saveBtn fl' value='update' name='externalMarkbtn'>
             <a href='admin_student_listing.php' class='cancelBtn'>Cancel</a>
         </li>
         </ul> ";
           }
         
          echo " </div>
            
    </div>";
}?>

 