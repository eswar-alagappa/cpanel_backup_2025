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
include('adminheader.php');
$studentid = $_GET[ studentid ];
$exammaster  = new exammaster();

$studentPrograms = $exammaster -> getEnrollProgramsforStudent($studentid);
foreach($studentPrograms as $value)
 	{ 
	 $program_id = $value[id];  }
$studentarray =array('student_id'=>$studentid,'program_id'=>$program_id);
$studentdetail = $exammaster -> getStudentdetailsforProg($studentarray);
$studentPayments = $exammaster -> getStudentdPayment($studentarray);
$studentCourses = $exammaster -> getCoursesforstudent($studentarray);

$studentexamassignedCourses = $exammaster -> getexamassignedCourses($studentarray);
if(isset($_REQUEST['assginExam'])){

	$arrassginExams = array('student_id'=> $studentid,'assignExam'=>$_REQUEST['assignExam']);
	$exammaster -> assignexam($arrassginExams);
	$arrexistingvalues = array('student_id'=> $studentid,'existingvalue'=>$_REQUEST['existingvalue']);
	 $ackmsg = $exammaster ->updateassignexam($arrexistingvalues);
	 	if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Exam has  been assigned successfully';
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

 var addFieldNo = 1;
$('.addMore').live('click',function() { 

	var dynamicfields = ".dynamicfields tbody>tr:last ";
 	var courseSelected = $(dynamicfields+ "select.course option:selected").val();

  	if(courseSelected)
	{
		  $('.datepicker').datepick('destroy');
		$('.customError').remove();
			$(dynamicfields).find('div.error').remove();
		$(".course").attr("disabled", true);
		$(dynamicfields).clone(true).insertAfter(".dynamicfields tbody>tr:last");
		$(dynamicfields+ "select.course option[value="+ courseSelected +"]").remove();	
		$(dynamicfields+ "select.course").attr("disabled", false);
			$(dynamicfields+ "select.course").attr( "id", "courseDetail"+addFieldNo );
		$(dynamicfields+ "input.examfromDate").attr( "id", "examfromDate"+addFieldNo );
			$(dynamicfields+ "input.examtoDate").attr( "id", "examtoDate"+addFieldNo );
			$(dynamicfields+ "select.course").attr( "name", "assignExam["+addFieldNo+"][ddlcourse]" );
		$(dynamicfields+ "input.examfromDate").attr( "name", "assignExam["+addFieldNo+"][txtschdate1]");
			$(dynamicfields+ "input.examtoDate").attr( "name", "assignExam["+addFieldNo+"][txtschdate2]" );
			addFieldNo++;
		$(".datepicker").datepick({
       /* buttonImage: '../web/images/calendar-img.gif',*/
        buttonImageOnly: true,
      /*  showOn: 'button',*/
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: 0, 
		maxDate: '+3M'
,
		//onClose: function() { $(".datepicker").focus(); }
		});
		
		if( $(dynamicfields+ "select.course option").length == 2)
		{
			$('.addMore').remove();
		}
	}else
	{
			$(dynamicfields).find('div.error').remove();
		$('.customError').remove();
		$(".dynamicfields").after("<div class='customError'>Please fill the details</div>");
	}
		
	});


$("#assign-exam").validate({
	errorElement: 'div',submitHandler: function(form) {
		$(".dynamicfields").find('.course').attr("disabled", false);
        postForm();
		}
	});	
$(".datepicker").datepick({
      
        buttonImageOnly: true,
      	dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: 0, 
		maxDate: '+3M'
,
		//onClose: function() { $(".datepicker").focus(); }
});
$("#assign-exam").submit(function(){
	$('.customError').remove();
	
	
	});
$('#selectProgram').change(function() {
	  var selctedval= $('#selectProgram').val();
	  var studentid = $('#studentid').val();
		 $.ajax({
                       type: "GET",
                       url: "assignexam.php",
                       data: {program_id: selctedval, student_id: studentid}, 
                       success: function(result){
						       $(".programDetails").html(result);
							
                       }
                     });
  });

  if( $(".dynamicfields tbody>tr:last  select.course option").length == 2)
		{
			$('.addMore').remove();
		}
});
</script>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Online exam</li>
         <li><a href="question_listing.html">Questions</a> </li>
        <li class="last"> &nbsp; Add Question </li>
        
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>Assign Online exam </h2>
      <form id="assign-exam" action="" method="post">
      <input style="display:none" name="studentid" id="studentid" value="<?php echo $studentid;?>" />
      <div class="addProgramForm question">
       <ul class="w90p">
       <li>
      <?php if($studentPrograms){?>
      <fieldset>
        <legend>Program Enrolled</legend>
        <ul class="w660"><li>
       <label> Select Program : </label>
          <select name="selectProgram" id = "selectProgram" class="w250"> 
         <?php foreach($studentPrograms as $value)
            {  echo "<option value='{$value[id]}'selected >{$value[name]}</option>"; }?>
             </select>
             </li></ul>
             </fieldset>
             <?php }?>
             </li>
             </ul>
      <ul class="w90p programDetails">
        <li>
          <fieldset>
        <legend>Enrollment details </legend>
        <ul class="w660"> 
          <li>
            <label>Student ID :</label>
            <span><?php echo $studentdetail[0][enrollment_id]; ?></span></li>
          <li><label>Student Name  :</label><span><?php echo $studentdetail[0][first_name]. ' '. $studentdetail[0][last_name]; ?>  </span></li>
          <li><label>Center Name :</label><span><?php echo $studentdetail[0][academy_name]; ?>  </span></li>
          <li><label>Program Enrolled :</label><span><?php echo $studentdetail[0][name]; ?></span></li>
          <li><label>Date of joining : </label><span> <?php echo $studentdetail[0][enrollment_date]; ?></span></li>
            </ul>
      
      </fieldset>
         
          <fieldset>
        <legend>Payment details</legend>
        <ul class="w660">
          <li>
            <label>Program fee  :</label>
            <span>$ <?php echo $studentdetail[0][total_fee]; ?></span></li>
            
      </ul>
 			<?php if($studentPayments ) {?>
             <div class="paymentTable">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Amount  paid </th>
                <th>Payment  mode</th>
                <th> Paid  on </th>
                
                <th>Check No </th>
                <th>Transaction  Ref No </th>
                <th>Status</th>
                <th > Remarks</th>
              </tr>
              <?php  
			  $i =0;
			  foreach ($studentPayments as $studentPayment)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "<tr class='{$classname}'>
                <td>{$studentPayment[amount]}</td>
                <td> {$studentPayment[paymentmode]}  </td>
                <td>{$studentPayment[paid_on]} </td>";
				 echo "<td>{$studentPayment[check_no]}</td>";
             echo "<td>{$studentPayment[transaction_no]}</td>";
			    echo "<td>{$studentPayment[paymentstatus]}</td>";
				 echo "<td>{$studentPayment[comments]}</td>";
			   echo "</tr>";
				  
				   $i++;
 				 }?>
             
              
              
        
              
            </tbody>
          </table>
          
     </div>
            <?php } else {echo "<div class='warning'>Not yet paid</div>";}?>
      
      </fieldset>
      
      <fieldset>
        <legend>Approve Online Exam</legend>
         <?php  if($studentCourses) { ?>
        <ul class="w660">
          <li>
           <span class="titleSub">(Allowed period / duration to attend   online exam )</span></li>
           <li>
          
           <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dynamicfields">
  <tr>
    <td><strong>Course</strong></td>
    <td><strong>Scheduled from</strong></td>
   <td><strong>Scheduled to</strong></td>
    </tr>
    <?php  
	if($studentexamassignedCourses){
		$i=0;
    foreach ($studentexamassignedCourses as $studentexamassignedCourse)
 	{  
				echo "<tr>";
				echo " <td class='courselist1'>
   <label>{$studentexamassignedCourse[code ]}</label>
      <input type='hidden' value='{$studentexamassignedCourse[course_id ]}' name='existingvalue[{$studentexamassignedCourse[id]}][course]'/>
      </td>";
	  echo " <td height='38' class='schfromdate'><input name='existingvalue[{$studentexamassignedCourse[id]}][txtschdate1]' type='text' value='{$studentexamassignedCourse[exam_date_starttime]}' class='datepicker examfromDate required date' title='Enter from date'/> </td>
    <td height='38' class='schtodate'><input name='existingvalue[{$studentexamassignedCourse[id]}][txtschdate2]' type='text' value='{$studentexamassignedCourse[exam_date_endtime ]}'  class='datepicker examtoDate required date' title='Enter to date'/> </td>";
	  echo " </tr> ";   $i++ ; } 
	}
	 ?>

 

 <?php if($studentCourses ) { ?>
  <tr >
    <td class="courselist1">
<select name="assignExam[0][ddlcourse]"  class="course <?php if($studentexamassignedCourses){ echo ""; } else echo "required"; ?> " title="Select Course">  <option value="">Select</option>  
   <?php foreach ($studentCourses as $studentCourse) { echo "<option value='{$studentCourse[id]}'>{$studentCourse[code]}</option>"; }  ?>
                </select>
      
    </td>
    <td height="38" class="schfromdate"><input name="assignExam[0][txtschdate1]" type="text" value=""  class="datepicker examfromDate  <?php if($studentexamassignedCourses){ echo ""; } else echo "required"; ?> date" title="Enter from date"/> </td>
    <td height="38" class="schtodate"><input name="assignExam[0][txtschdate2]" type="text" value=""  class="datepicker examtoDate   <?php if($studentexamassignedCourses) { echo ""; } else echo "required"; ?> date"  title="Enter to date"/> </td>
 
  </tr>
  <?php }?>
  
</table>
<?php if($studentCourses ) { ?>
<span class="addMore"><a>+ Add More</a></span>  <?php }?>

 </li>
        </ul>
        
      <?php }  else {
		   echo "<div class='warning'>No courses found to assign the exam </div>";
		  
		  } ?>
          
      </fieldset>
      </li>
      		<?php  if($studentCourses ) { ?> 
      <li class="btn"><input type="submit" class="assignBtn fl" value="Assign exam" name="assginExam">
        <a href="admin_student_listing.php" class="cancelBtn">Cancel</a>
        </li>
        <?php }?>
      </ul>
      
      </div>   
      </form> 
    </div>
  </div>

<?php 
include('adminfooter.php');
}
?>