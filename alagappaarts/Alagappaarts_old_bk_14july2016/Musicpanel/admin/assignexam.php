<?php
include("../config/config.inc.php");
include("../config/classes/exammaster.class.php");
if(isset($_GET['program_id']) && isset($_GET['student_id'])){
	$studentarray =array('student_id'=>$_GET['student_id'],'program_id'=>$_GET['program_id']);
  		$exammaster  = new exammaster();
 $studentdetail = $exammaster -> getStudentdetailsforProg($studentarray);
$studentPayments = $exammaster -> getStudentdPayment($studentarray);
$studentCourses = $exammaster -> getCoursesforstudent($studentarray); 
$studentexamassignedCourses = $exammaster -> getexamassignedCourses($studentarray);
?>
<script type="text/javascript">
$(document).ready(function(){
	$(".datepicker").datepick({
        /*buttonImage: '../web/images/calendar-img.gif',*/
        buttonImageOnly: true,
      /*  showOn: 'button',*/
		/*minDate: 0, */
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate:0, 
		maxDate: '+3M'
,
		//yearRange: "-60:+0",
		//onClose: function() { $(".datepicker").focus(); }
}); 
if( $(".dynamicfields tbody>tr:last  select.course option").length == 2)
		{
			$('.addMore').remove();
		}});
</script>
<?php 
	         echo "<fieldset>
        <legend>Enrollment details </legend>
        <ul class='w660'>
          <li>
            <label>Student ID :</label>
            <span>{$studentdetail[0][enrollment_id]}</span></li>
          <li><label>Student Name  :</label><span>{$studentdetail[0][first_name]} {$studentdetail[0][last_name]}</span></li>
          <li><label>Center Name :</label><span>{$studentdetail[0][academy_name]}  </span></li>
          <li><label>Program Enrolled :</label><span>{$studentdetail[0][name]}</span></li>
          <li><label>Date of joining : </label><span> {$studentdetail[0][enrollment_date]}</span></li>
            </ul>
      
      </fieldset>
         
         <fieldset>
        <legend>Payment details</legend>
        <ul class='w660'>
          <li>
            <label>Program fee  :</label>
            <span>$ {$studentdetail[0][total_fee]}</span></li>";
			 if($studentPayments ) {
          echo "<li class='mB8'>
            <label><strong>Full payment   </strong></label>
          </li>"
;
			 }
     echo " </ul>";
	  if($studentPayments){
 
            echo " <div class='paymentTable'>
          <table cellspacing='0' cellpadding='0' border='0'>
            <tbody>
              <tr>
                <th>Amount  paid </th>
                <th>Payment  mode</th>
                <th> Paid  on </th>
                
                <th>Check No </th>
                <th>Transaction  Ref No </th>
                <th>Status</th>
                <th > Remarks</th>
              </tr>";
               
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
 				 }
              
              
        
              
           echo "</tbody>
          </table>
          
     </div>";
             } else {echo "<div class='warning'>Not yet paid</div>";}
      
      echo "</fieldset>";
      
     echo " <fieldset>
        <legend>Approve Online Exam</legend>";
		 if($studentCourses) { 
      echo "<ul class='w660'>
          <li>
           <span class='titleSub'>(Allowed period / duration to attend   online exam )</span></li>
           <li>
          
           <table width='100%' border='0' cellspacing='0' cellpadding='0' class='dynamicfields'>
  <tr>
    <td><strong>Course</strong></td>
    <td><strong>Scheduled from</strong></td>
   <td><strong>Scheduled to</strong></td>
    </tr>
  <tr >";
  if($studentexamassignedCourses) {
		$i=0;
    foreach ($studentexamassignedCourses as $studentexamassignedCourse)
 				{  
				echo "<tr>";
				echo " <td class='courselist1'>
   <label>{$studentexamassignedCourse[code ]}</label>
      <input type='hidden' value='{$studentexamassignedCourse[course_id ]}' name='existingvalue[{$studentexamassignedCourse[id]}][course]''/>
      </td>";
	  echo " <td height='38' class='schfromdate'><input name='existingvalue[{$studentexamassignedCourse[id]}][txtschdate1]' type='text' value='{$studentexamassignedCourse[exam_date_starttime]}' class='datepicker examfromDate required date' title='Enter from date'/> </td>
    <td height='38' class='schtodate'><input name='existingvalue[{$studentexamassignedCourse[id]}][txtschdate2]' type='text' value='{$studentexamassignedCourse[exam_date_endtime ]}'  class='datepicker examtoDate required date' title='Enter to date'/> </td>";
	  echo " </tr> ";   $i++ ;} 
	

 
 } 
    
     if($studentCourses ) { echo "<tr><td class='courselist1'>"; echo '<select name="assignExam[0][ddlcourse]"  class="course" title="Select Course">  <option value="">Select</option>';  
	 foreach ($studentCourses as $studentCourse)
 				{ echo "<option value='{$studentCourse[id]}'>{$studentCourse[code]}</option>"; } 
	echo "</select>";
      
   echo "</td>
    <td height='38' class='schfromdate'><input name='assignExam[0][txtschdate1]' type='text' value=''  class='datepicker examfromDate date' title='Enter from date'/> </td>
    <td height='38' class='schtodate'><input name='assignExam[0][txtschdate2]' type='text' value=''  class='datepicker examtoDate date'  title='Enter to date'/> </td>";
	 } 
 
 echo " </tr>
  
</table>";
 if($studentCourses ) { echo " <span class='addMore'><a>+ Add More</a></span>";}
 echo "</li>
        </ul>";
		
		}  else {
		   echo "<div class='warning'>No courses found to assign the exam</div>";
		  
		  }
		echo "</fieldset> ";
		 if($studentCourses ) { 
		echo " <li class='btn'><input type='submit' class='assignBtn fl' value='Assign exam' name='assginExam'>
        <a href='admin_student_listing.php' class='cancelBtn'>Cancel</a>
        </li>";
		 }

 }
?>