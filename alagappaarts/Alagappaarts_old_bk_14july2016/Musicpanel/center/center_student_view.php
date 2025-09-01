<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[centerinfo][role_id];
$userid = $_SESSION[centerinfo][user_id];
$username = $_SESSION[centerinfo][academy_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$iscenter  = $loginmaster->iscenter($arrlogin);

if(!$iscenter)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/studentmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/exammaster.class.php");
include('centerheader.php');
$studentid = $_GET[ studentid ];
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
							   
 /* Menu Onload Start*/	 
	var tabID = location.search.substring(1); 
	
	
		$('#'+1).addClass('activebtn');
		$(".content"+1).show();
			$(".content"+2).hide();
				$(".content"+3).hide();	$(".content"+4).hide();
	
	
	
	/* Menu Onload End */

      $("#navigation ul li").click(function(){
    $('#lblPageTitle').text($(this).text());
	var currentid=(this.id);
	for (var i=1;i<=10;i++)
	{
		if (currentid==i)
		{
        $(".content"+i).slideDown(500);
			
				$('#'+i).addClass('activebtn');
	
		}
		else
		{
				$(".content"+i).slideUp(500);
		
					$('#'+i).removeClass('activebtn');
				
    	}
	
	}
	});

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
          <li class="profilenav"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class=" wrapper">

<div class="content">
       
    <div class="studentViewContent">
      <h2>View Student</h2>
      
      <div class="registrationForm">
       <div id="navigation" class="tapMenu">
<ul>
<li class="last activebtn" id="1"><a href="javascript:;">Personal Details</a></li>
<li id="2"><a href="javascript:;">Enrollment Details</a></li>

</ul>
</div>
<div class="registrationFormStudents">  <input style="display:none" name="studentid" id="studentid" value="<?php echo $studentid;?>" />
   <div class="content1">
           
                <fieldset class="w100">
        <legend>Personal Details    </legend>
      <ul>
      
         
      <li>
        <label>First Name:<?php echo $studentdetail->fields[first_name]; ?>  </label>
		</li>
        
      <li>
        <label>Last Name: First Name:<?php if($studentdetail->fields[last_name]) echo $studentdetail->fields[last_name]; else '-'; ?>    </label>
		</li>
        
      <li>
        <label>D.O.B: <?php $dob =  split('-',$studentdetail->fields[dob]); 
	$dob[1].'/'.$dob[2].'/'.$dob[0];
	 $directorDOB =date('d-M-Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0]));
		 echo $directorDOB; ?> </label>
         </li>
         
       <li>
         <label> Age :<?php echo $studentdetail->fields[age]; ?></label>
		  </li>
        
        <li>
          <label> Gender : <?php echo $studentdetail->fields[gender]; ?></label>
		</li>
        
        <li>
           <label>Mobile: <?php echo $studentdetail->fields[mobile]; ?></label>
		 </li>
        
        <li>
           <label>Alternate Phone Number: <?php if($studentdetail->fields[phone] ) echo $studentdetail->fields[phone]; else echo '-'; ?></label>
		  </li>
      
      </ul>
     
      <ul>
      
<li><label>Address:  <?php if($studentdetail->fields[address] ) echo $studentdetail->fields[address]; else echo '-'; ?></label>
		</li>
        
        <li>
          <label>City: <?php echo $studentdetail->fields[city]; ?></label>
		 </li>
        <li>
          <label>State: <?php echo $studentdetail->fields[state]; ?></label>
		  </li>
        
        <li><label>Country: <?php echo $studentdetail->fields[country]; ?>  </label>
		</li>
        <li>
          <label>Zip: <?php echo $studentdetail->fields[zipcode]; ?></label>
		  </li>
         <li>
          <label>Email: <?php echo $studentdetail->fields[email_id]; ?></label>
		 </li>
      </ul>
      </fieldset>
           
           <fieldset class="w100">
        <legend>Programs Enrolled</legend>
        <ul> 
        <?php foreach($studentPrograms as $value)
            {  
			echo "<li>{$value[name]}</li>";
			
			 }?></ul>
         <ul>
         <li>
           <label> Center :
  <?php echo $studentCentre->fields[academy_name]; ?></label>
		 </li>
</ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Bharatanatyam Details </legend>
       <ul class="experience">
                <li>
                  <label>Experience in Bharathanatyam :  <?php echo $studentdetail->fields[bharathanatyam_experience]; ?> </label>
                   </li>
                     
                      <li><label>Special accomplishments (if any) : <?php if($studentdetail->fields[special_qualification] ) echo $studentdetail->fields[special_qualification]; else echo '-'; ?> </label></li>
              <li>
                <label>Name of your Guru :  <?php echo $studentdetail->fields[name_of_guru]; ?></label></li>
                  
                   <li><label>Located at 	: <?php if($studentdetail->fields[guru_location] ) echo $studentdetail->fields[guru_location]; else echo '-'; ?> </label></li>
                   <li>
                     <label>Other relevant info :  <?php if($studentdetail->fields[other_info] ) echo $studentdetail->fields[other_info]; else echo '-'; ?> </label>
                   </li>
                       </ul>
         <ul>
         
         </ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Student Status  </legend>
       <ul class="experience">
                <li class="w100">
        <label class="w100">Status : </label>
         
 

        <li> <?php   echo $studentdetail->fields[value];  ?>
		</li>
                </ul>
         <ul>
         
</ul>
        </fieldset>

      
      </div>
    
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
           </ul>
          
      </fieldset>
    </div>
     </div>
     </div>
      
      <ul> <li class="button"><a href="center_student_listing.php" class="backBtn">Back</a>        </li> </ul>
      </div>
      
    </div>
  </div>
    </div>
<?php 
include('centerfooter.php');
}
?>