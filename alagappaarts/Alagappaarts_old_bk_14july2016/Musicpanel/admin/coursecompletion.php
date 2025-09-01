<?php
include("../config/config.inc.php");
include("../config/classes/exammaster.class.php");
include("../config/classes/keywordmaster.class.php");
if(isset($_GET['program_id']) && isset($_GET['student_id'])){
$studentid = $_GET[ student_id ];
$programid = $_GET[ program_id ];
?>
<script type="text/javascript">
$(document).ready(function(){
$("#datepicker").datepick({
      
        buttonImage: '../web/images/calendar-img.png',
        buttonImageOnly: true,
       showOn: 'button',
		/*minDate: 0, */
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		/*minDate:0, */
		maxDate: 0
,
		yearRange: "-10:+0",
		onClose: function() { $(".datepicker").focus(); }
,
		//onClose: function() { $(".datepicker").focus(); }
});});
</script>
<?php 
$exammaster  = new exammaster();
$keywordmaster  = new keywordmaster();
$grades =  $keywordmaster -> getkeywordforgrade('grade');
$studentarray =array('student_id'=>$studentid,'program_id'=>$programid);
$studentdetail = $exammaster -> getStudentdetailsforProg($studentarray);
$studentPayments = $exammaster -> getStudentdPayment($studentarray);
$studentExam = $exammaster -> getExamResultByProgram($studentarray);



echo "<div class='detailedReportContentTitle'>
      	<ul>
        <li><span>Student ID 		</span>: {$studentdetail[0][enrollment_id]}</li>
        <li><span>Student Name  		</span>: {$studentdetail[0][first_name]} {$studentdetail[0][last_name]}	</li>
        <li><span>Centre Name 		</span>: {$studentdetail[0][academy_name]}		</li>
        </ul>
        <ul>
		  <li><span>Date of joining</span>: {$studentdetail[0][enrollment_date]}	</li>
        <li><span>Program fee </span>: $ {$studentdetail[0][total_fee]}</li>
        </ul>
     </div> <div class='detailedReportContentBottom'><div id='Certificate'>
      <h2>{$studentdetail[0][name]}</h2>";
      if($studentPayments ) {
     echo "<table cellspacing='0' cellpadding='0' border='0'>
            <tbody>
            <tr>
                <td class='title' colspan='10'><h3>Payments</h3></td>
              </tr>
              <tr>
                <th width='98'>  Amount Paid</th>
                <th width='150'> Payment Type</th>
                <th width='119'>Payment MOde</th>
               
                 <th width='85'> Paid on</th>
                 <th width='195'> Check /Transaction No.</th>
                
                  <th width='65'> Status </th> 
                  <th width='195'> Remarks</th>
              </tr>";
               
			  $i =0;
			  foreach ($studentPayments as $studentPayment)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "<tr class='{$classname}'>
                <td>{$studentPayment[amount]}</td>
				<td> {$studentPayment[paymentoption]}  </td>
				<td> {$studentPayment[paymentmode]}  </td>
                <td>{$studentPayment[paid_on]} </td>";
				echo "<td>";
				if($studentPayment[check_no ])
				{
					 echo $studentPayment[check_no];
				}
				if($studentPayment['transaction_no'])
				{
					echo $studentPayment[transaction_no];
				}
				echo "</td>";
				
				
             
			    echo "<td>{$studentPayment[paymentstatus]}</td>";
				 echo "<td>";
				 if($studentPayment[comments])
				 echo $studentPayment[comments];
				 else
				 echo '-';
				 echo"</td>";
			   echo "</tr>";
				  
				   $i++;
 				 }
            
           echo  " </tbody> </table>";
            } else {echo "<div class='warning'>Not yet paid</div>";}
           if($studentExam) { 
          echo "<table cellspacing='0' cellpadding='0' border='0'>
            <tbody>
            <tr>
                <td class='title' colspan='7'><h3>Exam</h3></td>
              </tr>
              <tr>
                <th>Exam Date</th>
                <th> Course</th>
                <th> Marks Obtained</th>
                  <th>  Result	</th> 
                  <th> Grade</th>
              </tr>";
             
   $i =0;
  foreach ($studentExam  as $result){
	 if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				  <td>{$result[examdate]}</td>
                <td>{$result[code]}</td>
              
				 <td> {$result[total_mark]}  </td>
				   <td> {$result[result]}  </td>
                <td>{$result[grade]} </td></tr>";
	 $i++; }
          
            echo "</tbody>
          </table>";
           } else {echo "<div class='warning'>No Exam taken</div>";}
       echo "</div><div class='approvalStudentForm'>
     
         
      <fieldset>
        <legend>Course Completetion Update</legend>
        <ul>
      <li class='CCstatus'>
        <label>Graduated :</label>
         <span class='status'> <label><input class='radiobtn' name='rdGraduationStatus' type='radio' value='Y'";
		 if($studentdetail[0][graduation_status]=='Y'){ echo 'checked'; }  
		 echo "/> Yes </label>
		<label> <input class='radiobtn' name='rdGraduationStatus'  type='radio' value='N' ";
		if($studentdetail[0][graduation_status]=='N'){ echo 'checked'; }  
		echo "/>
		 No</label></span>
        </li>
           </ul>
            <ul>
      <li class='CC-Comments'><label>Comments : </label>
        <textarea name='txtCommentsAboutStudent' cols='' rows=''>{$studentdetail[0][graduation_status_comments]}</textarea>
      </li></ul>";
 
          echo "<ul   class='gradeUpdate'  "; if(!$studentdetail[0][completion_date]  || $studentdetail[0][graduation_status]=="N" )  echo 'style="display:none"' ; echo ">";
     echo " <li >
        <label>Graduation Date :</label>";
		if($studentdetail[0][completion_date]  == '00/00/0000')
		echo "<input   name='txtGraduationDate'  type='text'  id='datepicker' class='required'  value=' ' />";
		else
		echo "<input   name='txtGraduationDate'  type='text'  id='datepicker' class='required'  value='".  $studentdetail[0][completion_date] . "' />";
		echo "</li>";
		echo "<li class='CC-Comments'><label>Grade : </label>
      
	  <select name='ddlGrade'   class='course required' title='Grade required'><option value=''>Select</option>";
	   foreach ($grades  as $grade) {
		if( $studentdetail[0][grade] ==$grade[id] )
			 echo "<option value='{$grade[id]}' selected='selected'>{$grade[value]}</option>";
	else echo "<option value='{$grade[id]}'>{$grade[value]}</option>";
	}
      echo "</select></td>"; 
     echo " </li>";
        echo "   </ul>";
		
		/* else 
		 echo " <input   name='txtGraduationDate'  type='text'  id='datepicker' class='required'  value='' />";
          */
        echo "
      </fieldset>
      
      
     <ul><li class='button'><input name='btnUpdate' value='Update' type='submit' class='submitBtn' />
        <a href='admin_student_listing.php'><input name='resetBtn' value='Cancel' type='button' class='resetBtn cancelBtn' /></a>
        </li></ul>
      
    
      </div>
	   
	   
	   
	   </div>";
}

?>