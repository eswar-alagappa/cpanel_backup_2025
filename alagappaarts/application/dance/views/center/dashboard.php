<div class="content">

   <div class="dowmloadButton"> 
        <a  href="../../assets/home/program_ guidelines.pdf" target="_blank"><img src="../../assets/home/images/download-btn.png"  /></a>
        </div>

    <div class="contentOuter">

    <div class="dashboardContent">

    

      <div class="dashboardDetails">

      <div class="dashboardDetailsTitle"><img src="<?php echo base_url()?>assets/home/images/schedule-icon.gif" width="20" height="21" />Exam schedule</div>

      <div class="dashboardDetailsInner">

      
		<?php if( isset($examSchedule) && !empty($examSchedule)){ ?>
      
      <span>Certificate</span>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <th width="22%" align="left" valign="top" scope="col">Course Code</th>

    <th width="34%" align="left" valign="top" scope="col">Exam From</th>

    <th width="44%" align="left" valign="top" scope="col">Till</th>

  </tr>
		<?php foreach($examSchedule as $k=> $exam) { if($k<3){?>
		<tr class=''>
			<!--<td><a href='online_exam_instruction.php?courseid=1'>CEB 01</a></td>-->
			<td> <?php echo $exam->course_code ?>  </td>
			<td> <?php echo date('d-M-Y',strtotime($exam->exam_date_starttime)); ?>  </td> 
			<td> <?php echo date('d-M-Y',strtotime($exam->exam_date_endtime)); ?> </td>	
		</tr>
		<?php }} ?>

</table>

<span class="moreBtn"><a href="<?php echo base_url()?>dance/center/exam_schedule">MOre</a></span>

		<?php }else{?>
			<span class="information">Exam not yet assigned</span>
		<?php } ?>
      </div>

        

      </div>

      <div class="dashboardDetails ">

      <div class="dashboardDetailsTitle"><img src="<?php echo base_url()?>assets/home/images/payment-icon.gif" width="20" height="21" />Payments</div>

      <div class="dashboardDetailsInner">
		
		<?php if( isset($paymentList) && !empty($paymentList) ) { ?>
          
	<span>Payment History </span> 

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <th width="33%" align="left" valign="top" scope="col">Student Name</th>
	
	<th width="34%" align="left" valign="top" scope="col">Program Name</th>

    <th width="34%" align="left" valign="top" scope="col">Amount($)</th>

  </tr>
<?php foreach($paymentList as $k=> $pay) { if($k<3){?>
  <tr class='altRows'><td><?php echo $pay->firstname.' '.$pay->lastname; ?></td>

    <td><?php echo stripslashes($pay->programName); ?></td>

	 <td><?php echo $pay->amount; ?></td>

  </tr>
<?php   } } ?>

</table>



<span class="moreBtn"><a href="<?php echo base_url()?>dance/center/payments">MOre</a></span>
		<?php  }else{ ?>
<span class="warning"><strong>No payments made</strong></span>
		<?php } ?>
      </div>

      

        

      </div>
	  
	  
	  
	  <div class="dashboardDetails mR0">
      <div class="dashboardDetailsTitle"><img width="20" height="21" src="<?php echo base_url()?>assets/home/images/result-icon.gif">Exam results</div>
      <div class="dashboardDetailsInner">
		<?php if( isset($examResult) && !empty($examResult) ) { ?>
		<span>Exam results has been published  </span>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <th width="34%" valign="top" align="left" scope="col">Student Name</th>
    <th width="41%" valign="top" align="left" scope="col">Course Code </th>
        <th width="41%" valign="top" align="left" scope="col">Result </th>
    
  </tr>
		<?php foreach($examResult as $k=> $result){ if($k<3){?>
		<tr class="">
			<td><?php echo $result->firstname.' '.$result->lastname ?> </td>
			<td><?php echo $result->course_code ?></td>
			<td> <?php echo $result->result ?>  </td>
		</tr>   
		<?php } } ?>
</tbody></table>
<span class="moreBtn"><a href="<?php echo base_url()?>dance/center/exam_result">More</a></span>
		<?php }else{ ?>
<span class="warning"><strong>No Exam Results</strong></span>
		<?php } ?>
      </div>
        
      </div>
	  
	  

      

      
    </div>

      <div>

        

      </div>

           

    </div>

  </div>