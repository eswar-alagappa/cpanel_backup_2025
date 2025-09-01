<?php include("../config/config.inc.php"); 

include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[studentinfo][role_id];
$userid = $_SESSION[studentinfo][user_id];
$username = $_SESSION[studentinfo][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);
if(!$student)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/studentmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/exammaster.class.php");
include('studentheader.php');
$studentid =$userid;
$studentmaster  = new studentmaster();
$exammaster  = new exammaster();
$studentdetail = $studentmaster -> getStudentdetails($studentid);
$studentProgram =$studentmaster -> getStudentprogram($studentdetail->fields[program_id]);
$studentCentre =$studentmaster -> getStudentcentre($studentdetail->fields[centre_id]);
$studentPrograms =$exammaster -> getProgramsforStudent($studentid  );
foreach($studentPrograms as $value)
{ 
	 $program_id = $value[id];  }
$studentarray =array('student_id'=>$studentid,'program_id'=>$program_id);
//print_r($studentarray);
$studentenrollment = $exammaster -> getStudentdetailsforProg($studentarray);
$studentPayments = $exammaster -> getStudentdPayment($studentarray);
$studentExam = $exammaster -> getExamResultByProgram($studentarray);
$studentExternal = $exammaster -> getExternalmarkdetail($studentarray);

?>
<script type="text/javascript" language="javascript">
   
    $(document).ready(function() {
							   

	

	$('#selectProgram').change(function() {
		
	  var selctedval= $('#selectProgram').val();
	  var studentid = $('#studentid').val();
	 $.ajax({
                       type: "GET",
                       url: "studentview.php",
                       data: {program_id: selctedval, student_id: studentid}, 
                       success: function(result){
						       $(".studentDetails").html(result);
							
                       }
                     });
  });
   });   </script>
<div class="headerBottom">

      <div class="admiTitle">Welcome To  <?php  echo $username; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class=" wrapper">

<div class="content">
       
    <div class="studentViewContent">
      <h2>Program Enrolled</h2>
      
      <div class="registrationForm">
      
<div class="registrationFormStudents">  <input style="display:none" name="studentid" id="studentid" value="<?php echo $studentid;?>" />
   
    
      <div class="content2">
           
                
           
         
     
         <fieldset class="w100">
        <legend><strong>Program Enrolled</strong></legend>
       <label> Select Program   : </label>
       
          <?php if($studentPrograms){  ?>
      
           
      <select name="selectProgram" id="selectProgram" class="w250"> 
         <?php   foreach($studentPrograms as $value)
            {  
			echo "<option value='{$value[id]}' ";
			if($studentenrollment[0][programid]==$value[id])
			{
				echo "selected='selected'";
			}
			echo ">{$value[name]}</option> ";
			
			 }?>
             </select>	
          <?php }?>
       </fieldset>
       <div class="studentDetails">
     <fieldset class="w100">
        <!--<legend><strong>Program Enrolled</strong></legend>-->
        
       
      	<ul>
        <li> <label>Student ID 	: <?php echo $studentenrollment[0][enrollment_id]; ?></label></li>
        
        <li> <label>Centre Name : <?php echo $studentenrollment[0][academy_name]; ?></label> </li>
        </ul>
        <ul>
    
    
      
        <li> <label>Date of joining : <?php echo $studentenrollment[0][enrollment_date]; ?></label>	</li>
        <li> <label>Program fee : $ <?php echo $studentenrollment[0][total_fee]; ?></label></li>
       
         
        </ul>
     </fieldset>
     
     <fieldset class="w100">
        <legend><strong>Payment Detail</strong></legend>
      <h2><?php //echo $studentenrollment[0][name]; ?></h2>
      <?php if($studentPayments ) {?>
      <div class="paymentTable">
      <table cellspacing="0" cellpadding="0" border="0" width="100%" class="tabelView">
            <tbody>
            
            
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
 				 }    ?>
            
           
            </tbody>
          </table> 
          </div>
          <?php } else {echo "<div class='warning'>Not yet paid</div>";}  ?> 
          </fieldset>
        
           <fieldset class="w100">
        <legend><strong>Exam  Detail</strong></legend>
        
            <?php if($studentExam) { ?>
            <div class="paymentTable"> 
          <table cellspacing="0" cellpadding="0" border="0"  width="100%" class="tabelView">
            <tbody>
            
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
          </div>
           <?php } else {echo "<div class='warning'>No Exam taken</div>";}?>
      
     
         </fieldset>
        <?php if($studentExternal) { ?>
         <fieldset class="w100">
        <legend><strong> Project  &amp; Partical   Detail</strong></legend>
        
             
            <div class="paymentTable"> 
          <table cellspacing="0" cellpadding="0" border="0"  width="100%" class="tabelView">
            <tbody>
            
              <tr>
                <th>Exam Date</th>
                <th> Course</th>
                <th> Marks Obtained</th>
                  <th>  Result	</th> 
                  <th> Grade</th>
              </tr>
               <?php 
   $i =0;
  foreach ($studentExternal  as $result){
	 if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				  <td>{$result[examdate]}</td>
                <td>{$result[code]}</td>
              
				 <td> {$result[mark]}  </td>
				   <td> {$result[result]}  </td>
                <td>{$result[grade]} </td></tr>";
	 $i++; } ?>
          
            </tbody>
          </table>
          </div>
          
      
     
         </fieldset> <?php }  ?>
      <fieldset class="w100">
        <legend>Course Completetion Status</legend>
        <?php  //echo "<pre>"; print_r( $studentenrollment[0] );?>
        <ul>
      <li class="CCstatus">
        <label>Graduated :
       <?php if($studentenrollment[0][graduation_status]=="Y"){ echo 'Yes'; } else  echo 'No';   ?> 
		</label>
        </li>
           </ul>
            <ul>
      <li class="CC-Comments"><label>Comments : 
      <?php if($studentenrollment[0][graduation_status_comments]){ echo $studentenrollment[0][graduation_status_comments]; } else  echo '-';   ?> 
       </label>
      </li></ul>
    
      <ul>
      <li>
        <label>Graduation Date :
          <?php  
		  if($studentenrollment[0][completion_date]){ echo $studentenrollment[0][completion_date]; } else  echo '-';
		  
		   ?>  
         </label>  
        </li>
        <li>
        <label>Grade:
          <?php  
		  if($studentenrollment[0][programgrade]){ echo $studentenrollment[0][programgrade]; } else  echo '-';
		  
		   ?>  
         </label>  
        </li>
           </ul>
          
      </fieldset>
    </div>
     </div>
     </div>
      
    
      </div>
      
    </div>
  </div>
    </div>
<?php 
include('studentfooter.php');
}

?>