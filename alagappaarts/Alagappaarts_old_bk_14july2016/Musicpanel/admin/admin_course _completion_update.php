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
$grades =  $keywordmaster -> getkeywordforgrade('grade');
$studentPrograms =$exammaster -> getProgramsforStudent($studentid  );
foreach($studentPrograms as $value)
 	{ 
	 $program_id = $value[id];  }
$studentarray =array('student_id'=>$studentid,'program_id'=>$program_id);
$studentdetail = $exammaster -> getStudentdetailsforProg($studentarray);
$studentPayments = $exammaster -> getStudentdPayment($studentarray);
$studentExam = $exammaster -> getExamResultByProgram($studentarray);
if(isset($_REQUEST['btnUpdate']))
{
	//echo $_REQUEST['txtGraduationDate'];
/**/	if($_REQUEST['txtGraduationDate'] && $_REQUEST['rdGraduationStatus'] == "Y")
		$graduationDate = date('Y-m-d', strtotime($_REQUEST['txtGraduationDate']));

	else $graduationDate ="";
	$programid =  $_REQUEST['selectProgram'];
	$arrStudentGraduation = array('student_id'=>$studentid,'program_id'=>$programid,'graduation_status'=>$_REQUEST['rdGraduationStatus'],'graduation_status_comments'=>$_REQUEST['txtCommentsAboutStudent'],'completion_date'=>$graduationDate,'grade'=>$_REQUEST['ddlGrade']);
	$updateGraduation = $exammaster -> updateGraduation($arrStudentGraduation);
	if($updateGraduation)
	{
		$_SESSION['ackmsg'] = 'Course completion updates done successfully';
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
});
$("input[name$='rdGraduationStatus']").live('click',function(){
	//alert("dfgg");
var radio_value = $(this).val();
if(radio_value=='Y') {
 $(this).parent().parent().parent().parent().next().next().show();
}
else  if(radio_value=='N'  ) 
{
 $(this).parent().parent().parent().parent().next().next().hide();
}
});
$('#frmCCUpdates').validate({
	rules:{
		txtGraduationDate:{  required: true }},
messages:{
		txtGraduationDate : "Enter Graduation Date"},
		ignore:':hidden',
		errorElement :'div',
		errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="txtGraduationDate")
	{
		error.appendTo( element.parent());
	}
else
error.insertAfter( element );
}
}

});
	$('#selectProgram').change(function() {
		  $('.datepicker').datepick('destroy');
	  var selctedval= $('#selectProgram').val();
	  var studentid = $('#studentid').val();
	 $.ajax({
                       type: "GET",
                       url: "coursecompletion.php",
                       data: {program_id: selctedval, student_id: studentid}, 
                       success: function(result){
						       $(".coursecompletion").html(result);
							
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
    
    <input style="display:none" name="studentid" id="studentid" value="<?php echo $studentid;?>" />
    <div class="studentViewContent">
     
      
     <h2>Course Completion Update</h2>
     <div class="detailedReportContent">
      <?php if($msg)
	 {
		  echo "<div class='adminError'>{$msg}</div>";
	 }
	 ?>
      <form name="frmCCUpdates" method="post" id="frmCCUpdates">
       <div class="detailedReportContentBottom">
        <fieldset>
        <legend><strong>Program Enrolled</strong></legend>
       <label> Select Program   : </label>
       
          <?php if($studentPrograms){  ?>
      
           
      <select name="selectProgram" id="selectProgram" class="w250"> 
         <?php    foreach($studentPrograms as $value)
            {  
			echo "<option value='{$value[id]}' ";
			if($studentdetail[0][programid]==$value[id])
			{
				echo "selected='selected'";
			}
			echo ">{$value[name]}</option> ";
			
			 }?>
             </select>	
          <?php }?>
       </fieldset>
       </div>
     <div class="coursecompletion">
      <div class="detailedReportContentTitle">
      	<ul>
        <li><span>Student ID 		</span>: <?php echo $studentdetail[0][enrollment_id]; ?></li>
        <li><span>Student Name  		</span>: <?php echo $studentdetail[0][first_name]. ' '. $studentdetail[0][last_name]; ?>	</li>
        <li><span>Centre Name 		</span>: <?php echo $studentdetail[0][academy_name]; ?> 		</li>
        </ul>
        <ul>
    
    
      
        <li><span>Date of joining</span>: <?php echo $studentdetail[0][enrollment_date]; ?>	</li>
        <li><span>Program fee </span>: $ <?php echo $studentdetail[0][total_fee]; ?></li>
       
         
        </ul>
     </div> 
     
      <div class="detailedReportContentBottom">
   
      <div id="Certificate">
      <h2><?php echo $studentdetail[0][name]; ?></h2>
      <?php if($studentPayments ) {?>
      <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
            <tr >
                <td class="title" colspan="10"><h3>Payments</h3></td>
              </tr>
              <tr>
               
              
                <th width="98">  Amount Paid</th>
                <th width="150"> Payment Type</th>
                <th width="119">Payment MOde</th>
               
                 <th width="85"> Paid on</th>
                 <th width="195"> Check /Transaction No.</th>
                
                  <th width="65"> Status </th> 
                  <th width="195"> Remarks</th>
              </tr>
                <?php  
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
 				 }?>
            
           
            </tbody>
          </table>
            <?php } else {echo "<div class='warning'>Not yet paid</div>";}?>
            <?php if($studentExam) { ?>
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
            <tr>
                <td class="title" colspan="7"><h3>Exam</h3></td>
              </tr>
              <tr>
                <th>Exam Date</th>
                <th> Course</th>
                <th> Marks Obtained</th>
                  <th>  Result	</th> 
                  <th> Grade</th>
              </tr>
               <?php 
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
	 $i++; } ?>
          
            </tbody>
          </table>
           <?php } else {echo "<div class='warning'>No Exam taken</div>";}?>
         </div> 
        <div class="approvalStudentForm">
    
         
      <fieldset>
        <legend>Course Completetion Update</legend>
        <ul>
      <li class="CCstatus">
        <label>Graduated :</label>
         <span class="status"> <label><input class="radiobtn" name="rdGraduationStatus" type="radio" value="Y" <?php if($studentdetail[0][graduation_status]=="Y"){ echo 'checked'; }  ?> />
         Yes </label>
		<label> <input class="radiobtn" name="rdGraduationStatus"  type="radio" value="N" <?php if($studentdetail[0][graduation_status]=="N"){ echo 'checked'; }  ?>/>
		 No</label></span>
        </li>
           </ul>
            <ul >
              <?php /*?><li class="CC-Comments"><label>Grade : </label>
      
	<?php   echo "<select name='ddlGrade'   class='course required' title='Grade required'><option value=''>Select</option>"; foreach ($grades  as $grade) echo "<option value='{$grade[id]}'>{$grade[value]}</option>";
      echo "</select></td>"; ?>
      </li><?php */?>
      <li class="CC-Comments"><label>Comments : </label>
        <textarea name="txtCommentsAboutStudent"><?php echo $studentdetail[0][graduation_status_comments]; ?></textarea>
      </li></ul>
     <?php // echo $studentdetail[0][completion_date];  ?>
      <ul  class="gradeUpdate" <?php  if(!$studentdetail[0][completion_date] || $studentdetail[0][graduation_status]=="N")  echo 'style="display:none"' ;?>  >
      <li>
        <label>Graduation Date :</label> 
            <input   name="txtGraduationDate"  type="text"  id="datepicker" class='required'  value="<?php  if( $studentdetail[0][completion_date]  != '00/00/0000')  echo $studentdetail[0][completion_date]; ?>"   />
          
        </li>
        <li class="CC-Comments"><label>Grade : </label>
      
	<?php   echo "<select name='ddlGrade'   class='course required' title='Grade required'><option value=''>Select</option>"; foreach ($grades  as $grade) {
		if( $studentdetail[0][grade] ==$grade[id] )
			 echo "<option value='{$grade[id]}' selected='selected'>{$grade[value]}</option>";
	else echo "<option value='{$grade[id]}'>{$grade[value]}</option>";
	}
      echo "</select></td>"; ?>
      </li>
           </ul>
          
      </fieldset>
      
      
     <ul><li class="button"><input name="btnUpdate" value="Update" type="submit" class="submitBtn" />
        <a href="admin_student_listing.php"><input name="resetBtn" value="Cancel" type="button" class="resetBtn cancelBtn" /></a>
        </li></ul>
      

      </div>    
       </div>  
       
        
         
     </div> 
     </form>
      </div> 
    </div>
   
  </div>
 <?php 
include('adminfooter.php');
}
?>