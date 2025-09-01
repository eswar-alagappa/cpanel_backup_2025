<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[centerinfo][role_id];
$userid = $_SESSION[centerinfo][user_id];
$username = $_SESSION[centerinfo][academy_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$iscenter  = $loginmaster->iscenter($arrlogin);
/*echo $iscenter ;
exit;*/
if(!$iscenter)
{
	header('location:index.php?msg=Enter username password');
}
else{
include('centerheader.php');
define( MAX_NO_OF_ROWS_PAGINATION,20);
include("../config/classes/centremaster.class.php");


global $DB;
$centremaster = new centremaster();
$getExamschedule = $centremaster -> getExamschedule($userid);
$rsExams = $DB -> execute( $getExamschedule );

$rsExamResult = $centremaster -> getExamResult($userid);

$getPaymentDetails = $centremaster -> getPaymentDetail($userid);


?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
<div class="headerBottom">

      <div class="admiTitle">Welcome  To <?php  echo $username; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIcon"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class=" wrapper">
<div class="content">
<div class="dowmloadButton"> 
        <a  href="../downloads/program_ guidelines.pdf" target="_blank"><img src="../web/images/download-btn.gif"  /></a>
        </div>
    <div class="contentOuter">
    <div class="dashboardContent">
    
      <div class="dashboardDetails">
      <div class="dashboardDetailsTitle"><img src="../web/images/schedule-icon.gif" width="20" height="21" />Exam schedule</div>
      <div class="dashboardDetailsInner">
      
      <?php if(count($rsExams->fields[code]))
	  {
		  ?>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="22%" align="left" valign="top" scope="col">Student Name</th>
    <th width="34%" align="left" valign="top" scope="col">Course Code</th>
    <th width="44%" align="left" valign="top" scope="col">Exam From</th>
     <th width="44%" align="left" valign="top" scope="col">Exam To </th>
  </tr>
  
  
  
  <?php  
			  $i =0;
			  while(!$rsExams->EOF)
 				{
					if($i == 3) break;
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				   <td> {$rsExams->fields[first_name]} {$rsExams->fields[last_name]}  </td>
				    
                <td>{$rsExams->fields[code]}</td>
              
                <td>{$rsExams->fields[startDate]} </td>
				<td>{$rsExams->fields[endDate]} </td>
				</tr>";
                   $rsExams-> MoveNext();
				   $i++;
 				 }?>
  
</table>
<span class="moreBtn"><a href="center_exam_schedule.php">MOre</a></span>
<?php
	  }
	  else
	  {
		  echo "<span class='information'>Exam not yet assigned</span>";
	  }
	  ?>
      </div>
        
      </div>
      <div class="dashboardDetails ">
      <div class="dashboardDetailsTitle"><img src="../web/images/payment-icon.gif" width="20" height="21" />Payments</div>
      <div class="dashboardDetailsInner">
           <?php if($getPaymentDetails) { ?>
	<span>Payment History </span> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="33%" align="left" valign="top" scope="col">Student name</th>
    <th width="34%" align="left" valign="top" scope="col"> Program Name</th>
      <th width="34%" align="left" valign="top" scope="col">Amount($)</th>
 
  </tr>
  <?php  $i = 0;  //print_r($getPaymentDetails ); 
   foreach  ($getPaymentDetails as $getPaymentDetail)
 		{
			if($i == 3) break;
			if($i % 2) 	$classname="altRows";
			else $classname="";
			echo "<tr class='{$classname}'><td> {$getPaymentDetail['first_name']} {$getPaymentDetail['last_name']} </td>
			<td>{$getPaymentDetail[name]}</td>
			<td>". $getPaymentDetail['amount'] ."</td>
			
		  	</tr>";
		  $i++;
			}
  ?>
  
</table>

<span class="moreBtn"><a href="center_student_payments.php">MOre</a></span>
<?php } else {
		  
		  echo "<span class='warning'><strong>No payments made</strong></span>";
		  }?>
      </div>
      
        
      </div>
      
      <?php if(count($rsExamResult))
	  {
		  ?>
      <div class="dashboardDetails mR0">
      <div class="dashboardDetailsTitle"><img src="../web/images/result-icon.gif" width="20" height="21" />Exam results</div>
      <div class="dashboardDetailsInner"><span>Exam results has been published  </span>
  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="34%" align="left" valign="top" scope="col">Student Name</th>
    <th width="41%" align="left" valign="top" scope="col">Course Code </th>
        <th width="41%" align="left" valign="top" scope="col">Result </th>
    
  </tr>
  <?php 
   $i =0;
  // echo "<pre>";
   //print_r($rsExamResult);
  foreach ($rsExamResult  as $result){
	  if($i == 3) break;
	 if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				     <td>{$result[first_name]} {$result[last_name]}</td>
                <td>{$result[code]}</td>
                
				 <td> {$result[result]}  </td>
               </tr>";
	 $i++;   } ?>
   
</table>
<span class="moreBtn"><a href="center_exam_result.php">More</a></span>
      </div>
        
      </div>
      <?php 
	  }
	  ?>
    </div>
      <div>
        
      </div>
           
    </div>
  </div>
  </div>
<?php 
include('centerfooter.php');
}
?>