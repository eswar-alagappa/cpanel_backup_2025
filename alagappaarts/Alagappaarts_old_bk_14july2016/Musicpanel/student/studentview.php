<?php
include("../config/config.inc.php");
include("../config/classes/exammaster.class.php");
include("../config/classes/keywordmaster.class.php");
if(isset($_GET['program_id']) && isset($_GET['student_id'])){
$studentid = $_GET[ student_id ];
$programid = $_GET[ program_id ];
?>

<?php 
$exammaster  = new exammaster();

$studentarray =array('student_id'=>$studentid,'program_id'=>$programid);
$studentenrollment = $exammaster -> getStudentdetailsforProg($studentarray);
$studentPayments = $exammaster -> getStudentdPayment($studentarray);
$studentExam = $exammaster -> getExamResultByProgram($studentarray);
$studentExternal = $exammaster -> getExternalmarkdetail($studentarray);



      
      echo "<fieldset class='w100'>
    
        
       
      	<ul>
        <li> <label>Student ID : ". $studentenrollment[0][enrollment_id] ."</li>
        </label>
        <li> <label>Centre Name : ".$studentenrollment[0][academy_name]  ." </li> </label>
        </ul>
        <ul>
    
    
      
        <li> <label>Date of joining : ". $studentenrollment[0][enrollment_date]    ."</label></li>
        <li> <label>Program fee : $ ".  $studentenrollment[0][total_fee]  ."</label></li> 
       
         
        </ul>
     </fieldset>";
	 
	 echo '  
     <fieldset class="w100">
        <legend><strong>Program Detail</strong></legend>
      <h2><?php //echo $studentenrollment[0][name]; ?></h2>';
	  
      if($studentPayments ) { 
      echo '<div class="paymentTable">
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
              </tr>';
                
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
            
           
            echo ' </tbody>
          </table>  </div>';
		  
		   } else {echo "<div class='warning'>Not yet paid</div>";} 
          echo '</fieldset>';
		   
         echo '  <fieldset class="w100">
        <legend><strong>Exam  Detail</strong></legend>';
		
             
              if($studentExam) { 
          echo '<div class="paymentTable"> 
          <table cellspacing="0" cellpadding="0" border="0"  width="100%" class="tabelView">
            <tbody>
            
              <tr>
                <th>Exam Date</th>
                <th> Course</th>
                <th> Marks Obtained</th>
                  <th>  Result	</th> 
                  <th> Grade</th>
              </tr>';
			  
     
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
          
           echo ' </tbody>
          </table>
          </div>';
		  
           } else {echo "<div class='warning'>No Exam taken</div>";} 
      
     
         echo '</fieldset>';
		     if($studentExternal) {  
         echo '<fieldset class="w100">
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
              </tr>';
               
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
	 $i++; } 
          
           echo ' </tbody>
          </table>
          </div>';
          
      
     
        echo ' </fieldset>';   }       
        
		echo '
      <fieldset class="w100">
        <legend>Course Completetion Status</legend>
     
        <ul>
      <li class="CCstatus">
        <label>Graduated : ';
		
        if($studentenrollment[0][graduation_status]=="Y"){ echo 'Yes'; } else  echo 'No';   
		
        echo "</label></li>
           </ul>
            <ul>
      <li class='CC-Comments'><label>Comments : 
        ";
		 if($studentenrollment[0][graduation_status_comments])
		 { echo  $studentenrollment[0][graduation_status_comments]; 
		 } 
		 else   echo '-'  ;
		 echo " </label></li></ul>
      
      <ul   >
      <li >
        <label>Graduation Date :
           ";
		   if($studentenrollment[0][completion_date])
		 { echo  $studentenrollment[0][completion_date]; 
		 } 
		 else   echo '-'  ;
          
       echo " </label>  </li>
	   <li>
        <label>Grade: ";
           
		  if($studentenrollment[0][programgrade]){ echo $studentenrollment[0][programgrade]; } else  echo '-';
		  
		    echo " 
         </label>  
        </li>
           </ul>
          
      </fieldset>   ";
   }

?>