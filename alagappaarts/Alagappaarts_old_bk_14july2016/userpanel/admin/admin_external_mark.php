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
$studentCourses = $exammaster -> getCoursesforexternalmark($studentarray);
$studentExternalMarks = $exammaster -> getExternalMark($studentarray);
$results = $keywordmaster -> getkeywordforresult('result');
$grades =  $keywordmaster -> getkeywordforgrade('grade');
if(isset($_REQUEST['externalMarkbtn'])){

$mysql_date = date('Y-m-d H:i:s');
$examdate = date('Y-m-d', strtotime($_REQUEST['txtExamdate']));
$video1 = $_FILES["Uploadvideo1"]["name"];
if( $video1){
 $video1 = str_replace(" ", "-", $video1 );
$video1 = date('YmdHis') . "_" .$video1 ; 
}
$video2 = $_FILES["Uploadvideo2"]["name"];
if( $video2){
 $video2 = str_replace(" ", "-", $video2 );
$video2 = date('YmdHis') . "_" .$video2 ; 
}

$video3 = $_FILES["Uploadvideo3"]["name"];
if( $video3){
$video3 = str_replace(" ", "-", $video3 );
$video3 = date('YmdHis') . "_" .$video3 ; 
}
$target_path = "../uploads/student-videos/";

$target_path1 = $target_path . basename( $video1 ); 
			if($_FILES['Uploadvideo1']['name'] ) move_uploaded_file($_FILES['Uploadvideo1']['tmp_name'], $target_path1) ;
$target_path2 = $target_path . basename( $video2 ); 
			if($_FILES['Uploadvideo2']['name'] ) move_uploaded_file($_FILES['Uploadvideo2']['tmp_name'], $target_path2) ;
$target_path3 = $target_path . basename( $video3 ); 
			if($_FILES['Uploadvideo3']['name'] ) move_uploaded_file($_FILES['Uploadvideo3']['tmp_name'], $target_path3) ;
$externalmark = array ('student_id'=>$studentid,'course_id'=>$_REQUEST['ddlcourse'],'examdate'=>$examdate,'mark'=>$_REQUEST['txtExternalMark'],'comment'=>$_REQUEST['txtComments'],'video1'=>$video1,
				'video2'=>$video2,'video3'=>$video3,'result'=> $_REQUEST['result'],'grade'=> $_REQUEST['grade'],
				'created_on'=>$mysql_date,'created_by'=>$userid,'modified_by'=>$userid,'modified_on'=> $mysql_date);

$ackmsg =  $exammaster -> insertExternalmark($externalmark);
	
	if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'External mark has been added successfully';
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
	$('#selectProgram').change(function() {
	  var selctedval= $('#selectProgram').val();
	  var studentid = $('#studentid').val();	    
	 $.ajax({
                       type: "GET",
                       url: "externalmark.php",
                       data: {program_id: selctedval, student_id: studentid}, 
                       success: function(result){
						       $(".externalMark1").html(result);
						 }
                     });
  });
  	$("#externalMarkform").validate({
		 rules: {
 txtExternalMark:{
		required: true,
		number: true,
		min: 0,
		max: 100
		}/*,
	Uploadvideo1: {
		
		accept: 'avi|mpeg|mp4|flv|wmv',
                    maxFileSize: {
                        "unit": "KB",
                        "size": 1
                    }	 
	 }*/
	},
 messages:{
		txtExternalMark : {
			required: "Enter the exam mark",
			number: "Enter valid number",
			min: "Enter valid mark",
			max: "Enter not more then 100"
			}/*,
	Uploadvideo1: {
		accept: "hello acept",
		maxFileSize: "Upload file maximum size 10 kb",
	 }*/
 },
		errorElement: 'div',
		errorPlacement: function(error, element) { 
		if (element.is(":input") )
		{ 
		if((element).attr("name")=="txtExamdate")
			{
				error.appendTo(element.parent());
			}
		else
		error.insertAfter( element );
		}
	}
	});
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
<div class="content">
    <div class="topNav">
     <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a href="students_listing.html">students</a></li>
        <li class="last"> &nbsp; Edit student</li>
        
      </ul>
    </div>
    <form id="externalMarkform" action="" method="post" enctype="multipart/form-data">
    <input style="display:none" name="studentid" id="studentid" value="<?php echo $studentid;?>" />
    <div class="studentViewContent">
     
     <h2>external mark </h2>
     <div class="onlineExamContent">
     <?php if($msg)
	 {
		  echo '<div class="adminError">{$msg}</div>';
	 }
	 ?>
     <div class="addProgramForm question">
    <ul class="w90p">
      <?php if($studentPrograms){  ?>
      <fieldset>
        <legend>Program Enrolled</legend>
       <label> Select Program   : </label>
          <select name="selectProgram" id="selectProgram" class="w250"> 
         <?php    foreach($studentPrograms as $value)
            {  echo "<option value='{$value[id]}' selected  >{$value[name]}</option> "; }?>
             </select>
             </fieldset>
             <?php }?>
             </ul>
             </div>
      <div class="externalMark1">
     
     <div class="onlineExamContentTitle">
    <ul class="w350">
          <li><span>Student ID :</span> <?php echo $studentdetail[0][enrollment_id]; ?></li>
          <li><span>Student Name  :</span> <?php echo $studentdetail[0][first_name]. ' '. $studentdetail[0][last_name]; ?></li>
         
          </ul>
          <ul  class="w350">
          <li><span>Program Enrolled:</span> <?php echo $studentdetail[0][name]; ?></li>
           <li><span>Center Name :</span> <?php echo $studentdetail[0][academy_name]; ?> </li>
          </ul>
          
      </div>
       <div class="addProgramForm onlineexammark">
       <?php if($studentExternalMarks) {?>
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
            <th>Uploaded videos</th>
          </tr>
     <?php  $flag =0; foreach ($studentExternalMarks as $studentExternalMark){ 
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
  }?>
       </table></div>
          </fieldset>
          <?php } ?>
           <?php if($studentCourses){ ?>
          <ul class="w800">
<li class="reassignexam">
        <label>Course :<strong class="star">*</strong> </label>
		<span><select name="ddlcourse"   title="Select Course" class="required">  <option value="">Select</option>  
   <?php foreach ($studentCourses as $studentCourse) { echo "<option value='{$studentCourse[id]}'>{$studentCourse[code]}</option>"; }  ?>
                </select></span> </li>
          <li class="externalmark">
        <label> Mark   :<strong class="star">*</strong> </label>
		<input name="txtExternalMark" type="text"  class="w65 required" maxlength="3" title="Enter Mark" />   </li>
        <li >
        <label> Exam Date    :<strong class="star">*</strong> </label>
		<input name="txtExamdate" type="text"  class="w65 datepicker required" title="Enter exam date" />   </li>
        <li class="uploadvideo">
        <label> Performance Video 1 : </label>
        <input type="file" name="Uploadvideo1" accept='avi|mpeg|mp4|flv|wmv' value='1194304' Title="Upload the video"/>&nbsp;Accepted file formats avi/mpeg/mp4/flv/wmv
        </li>
        <li class="uploadvideo">
        <label> Performance Video 2 : </label>
        <input type="file" name="Uploadvideo2" accept='avi|mpeg|mp4|flv|wmv' value='1194304' Title="Upload the video"/>&nbsp;Accepted file formats avi/mpeg/mp4/flv/wmv
		</li>
        <li class="uploadvideo">
        <label> Performance Video 3 :</label>
        <input type="file" name="Uploadvideo3" accept='avi|mpeg|mp4|flv|wmv' value='1194304' Title="Upload the video"/>&nbsp;Accepted file formats avi/mpeg/mp4/flv/wmv
		</li>
        <li class="externalmarkError" >
        <label> Result: <strong class="star">*</strong></label>
       <select name='result' class='required' title='Result required'><option value=''>Select</option>
	   <?php foreach ($results as $result)
        echo "<option value='{$result[id]}'>{$result[value]}</option>"; ?>
      </select>
      </li>
	   <li class="externalmarkError">
        <label> Grade: <strong class="star">*</strong></label>
        <select name='grade'  class='required' title='Grade required'><option value=''>Select</option>
	  <?php foreach ($grades  as $grade)
	echo "<option value='{$grade[id]}'>{$grade[value]}</option>";  ?>
      </select>
      </li>
       <li>
          <label>Comments : </label>
          <textarea name="txtComments" cols="" rows=""></textarea>
        </li>
         <li class="btn"><input type="submit" class="saveBtn fl" value="update" name="externalMarkbtn">
             <a href="admin_student_listing.php" class="cancelBtn">Cancel</a>
         </li>
         </ul> 
          <?php }?>
         
           </div>
            
    </div>
     </div>
    </div>
</form>
  </div>
 <?php
include('adminfooter.php');
}
?>