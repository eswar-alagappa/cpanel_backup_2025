<?php 

include("../config/config.inc.php");

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

include('studentheader.php');

include("../config/classes/studentmaster.class.php");

include("../config/classes/exammaster.class.php");

include("../config/classes/paymentmaster.class.php");



$exammaster = new exammaster();

$getExamschedule = $exammaster -> getExamschedule($userid);

$rsExams = $DB -> execute( $getExamschedule);



$rsExamResult = $exammaster -> getRecentExamResult($userid);

$paymentmaster  = new paymentmaster();

$getPaymentDetails = $paymentmaster -> getPaymentDetail($userid);

?>

<div class="headerBottom">



      <div class="admiTitle">Welcome  <?php     echo $username; ?>  </div>

      <div class="menuBottom">

       <ul>

          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>

            <li class="dashboardIcon"><a href="dashboard.php">dashboard</a></li>

          <li class="profilenav"><a href="student_profile_students.php">Profile</a></li> 

          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>

        </ul>

      </div>

    </div>

<div class="content">

   

    <div class="contentOuter">

    <div class="dashboardContent">

    

      <div class="dashboardDetails">

      <div class="dashboardDetailsTitle"><img src="../web/images/schedule-icon.gif" width="20" height="21" />Exam schedule</div>

      <div class="dashboardDetailsInner">

      

      <?php if(count($rsExams->fields[code]))

	  {

		  ?>

      <span>Certificate</span>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <th width="22%" align="left" valign="top" scope="col">Course Code</th>

    <th width="34%" align="left" valign="top" scope="col">Exam From</th>

    <th width="44%" align="left" valign="top" scope="col">Till</th>

  </tr>

  

  

  

  <?php  

			  $i =0;

			  while(!$rsExams->EOF)

 				{

					if($i % 2) 	$classname="altRows";

					else $classname="";

				  echo "

				  <tr class='{$classname}'>

                <td><a href='online_exam_instruction.php?courseid=".$rsExams->fields[course_id]."'>{$rsExams->fields[code]}</a></td>

                <td> {$rsExams->fields[startDate]}  </td>

                <td>{$rsExams->fields[endDate]} </td></tr>";

                   $rsExams-> MoveNext();

				   $i++;

 				 }?>

  

</table>

<span class="moreBtn"><a href="student_exam_schedule.php">MOre</a></span>

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

    <th width="33%" align="left" valign="top" scope="col">Paid on</th>

    <th width="34%" align="left" valign="top" scope="col">Amount($)</th>

      <th width="34%" align="left" valign="top" scope="col">Mode</th>

    <th width="33%" align="left" valign="top" scope="col">Status </th>

  </tr>

  <?php  foreach  ($getPaymentDetails as $getPaymentDetail)

 				{

					if($i % 2) 	$classname="altRows";

					else $classname="";

				  echo "<tr class='{$classname}'><td>{$getPaymentDetail['paid_on']}</td>

    <td>". $getPaymentDetail['amount'] ."</td>

	 <td>{$getPaymentDetail[paymentmode]}</td>

    <td>{$getPaymentDetail[paymentstatus]}</td>

  </tr>";

  $i++;

				}

  ?>

  

</table>



<span class="moreBtn"><a href="student_payments.php">MOre</a></span>

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

    <th width="34%" align="left" valign="top" scope="col">Course Code</th>

    <th width="41%" align="left" valign="top" scope="col">Mark </th>

        <th width="41%" align="left" valign="top" scope="col">Result </th>

    <th width="25%" align="left" valign="top" scope="col">Grade</th>

  </tr>

  <?php 

   $i =0;

  foreach ($rsExamResult  as $result){

	 if($i % 2) 	$classname="altRows";

					else $classname="";

				  echo "

				  <tr class='{$classname}'>

                <td>{$result[code]}</td>

                <td> {$result[total_mark]}  </td>

				 <td> {$result[result]}  </td>

                <td>{$result[grade]} </td></tr>";

	 $i++; } ?>

   

</table>

<span class="moreBtn"><a href="student_exam_result.php">More</a></span>

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

<?php 

include('studentfooter.php');

}

?>