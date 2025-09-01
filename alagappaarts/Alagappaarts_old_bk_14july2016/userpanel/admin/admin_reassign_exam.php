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
$program_id = $_GET[ program ];
$courseid = $_GET[ course ];
$exammaster  = new exammaster();
$studentarray =array('student_id'=>$studentid,'program_id'=>$program_id);
$studentdetail = $exammaster -> getStudentdetailsforProg($studentarray);
$studentPayments = $exammaster -> getStudentdPayment($studentarray);
$getcourseCode = $exammaster -> getCoursecode($courseid);
$rsExamResult = $exammaster -> getExamResultforCourse($studentid,$courseid);
if(isset($_REQUEST['reassginBtn'])){
	$reassginarray = array('student_id'=>$studentid,'course_id'=>$courseid,'fromdate'=>$_REQUEST['txtschfromdate'],'todate'=>$_REQUEST['txtschtodate']);
	 $ackmsg  = $exammaster -> reassginExam($reassginarray);
	 if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Exam has  been reassigned successfully';
			header("location:admin_exam_list.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
?>
<script type="text/javascript">
$(document).ready(function(){
$(".datepicker").datepick({
        buttonImage: '../web/images/calendar-img.gif',
        buttonImageOnly: true,
        showOn: 'button',
		/*minDate: 0, */
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: 0, 
		maxDate: '+3M',
		//yearRange: "-60:+0",
		onClose: function() { $(".datepicker").focus(); }
});
$("#reassign-exam").validate({
	errorElement: 'div',
	errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="txtschfromdate")
	{
		error.appendTo( ".schfromdate");
	}
	else if((element).attr("name")=="txtschtodate")
	{
		error.appendTo( ".schtodate" );
	} 
}

	}});	
});
</script>
<div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="masters_dashboard.html">dashboard</a></li>
              <li><a  href="#" class="last">Online Exam</a></li>
      </ul>
    </div>
   
    <div class="studentViewContent">
   
      <h2>Reassign exam</h2>

     <div class="onlineExamContent">
      <div class="onlineExamContentTitle">
      	<ul class="w350">
        <li><span>Student ID 		</span>: <?php echo $studentdetail[0][enrollment_id]; ?>	</li>
        <li><span>Student Name  		</span>: <?php echo $studentdetail[0][first_name]. ' '. $studentdetail[0][last_name]; ?>	</li>
        <li><span>Centre Name 		</span>: <?php echo $studentdetail[0][academy_name]; ?> 	</li>
        </ul>
        <ul>
        <li><span>Program enrolled 		</span>:<?php echo $studentdetail[0][name]; ?>	</li>
        <li><span>Courses Name 		</span>: <?php echo $getcourseCode; ?></li>
       
        </ul>
        
      </div>
     
       <div class="addProgramForm onlineexammark">
        <form id="reassign-exam" action="" method="post">
      <ul class="w100p">
       <fieldset>
        <legend>Payment Details </legend>
        <li>
            <label>Program fee  :</label>
            <span>$ <?php echo $studentdetail[0][total_fee]; ?></span></li>
        <?php if($studentPayments ) {?>
        
          <li class="mB8">
            <label><strong>Full payment   </strong></label>
          </li>
          <?php } ?>
  
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
        <legend>Exam Details </legend>
        <div class="onlineExamMarkOuter">
       <?php if($rsExamResult)
		{ ?> 
      <table class="w700" cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Exam Date </th>
                <th> Mark Obtained</th>
                <th> Result</th>
                <th> Exam Status</th>
              </tr>
               <?php 
   $i =0;
  foreach ($rsExamResult  as $result){
	 if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>";
				  echo "<td>";
				  if($result[examDate])
                echo "{$result[examDate]}";
				else  echo  "-";
				echo "</td>";
				echo "<td>";
               if($result[total_mark])
                echo " {$result[total_mark]}" ;
					else  echo  "-"; echo "</td>";
				  echo  " <td> {$result[result]}  </td>
                <td>{$result[exam_status]} </td></tr>";
	 $i++; } ?>
            </tbody>
          </table>
     
  
      
        <?php  }
		else{
			echo "<div class='information'>Exam not taken / Result not published. </span></div>";}?>
        </div>
          </fieldset> 
              
      <fieldset>
        <legend>Approve Online Exam</legend>
        <ul class="reassignexam">
          <li>
           <span class="titleSub">(Allowed period / duration to attend   online exam )</span></li>
           <li>
           
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Scheduled from</td>
    <td >Scheduled to</td>
    </tr>
  <tr>
  <td height="38" class="schfromdate"><input name="txtschfromdate" type="text" value="" readonly="readonly" class="datepicker examfromDate required date" title="Enter from date"/> </td>
    <td height="38" class="schtodate"><input name="txtschtodate" type="text" value="" readonly="readonly" class="datepicker examtoDate required date"  title="Enter to date"/> </td>
  </tr>
</table>


           </li>
        </ul>
      
      </fieldset>
      
     </ul>
<ul><li class="button"><input name="reassginBtn" value="Reassign Exam" type="submit" class="reassignBtn fl" />
        <a href="admin_exam_list.php" class="cancelBtn">Cancel</a>
      </li></ul>   
        </form>
    </div>
    
     
      </div> 
     
       </div>
   
  </div>
<?php 
include('adminfooter.php');
}
?>
 
 
 
  


