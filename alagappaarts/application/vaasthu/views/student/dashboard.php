<div class="contentOuter">

    <div class="dashboardContent">

    

      <div class="dashboardDetails">

      <div class="dashboardDetailsTitle"><img src="<?php echo base_url()?>assets/home/images/schedule-icon.gif" width="20" height="21" />Exam schedule</div>

      <div class="dashboardDetailsInner">
	  
	  <?php if( isset($exam_schedule) && !empty($exam_schedule)) {?>
		
      <span>Certificate</span>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <th width="22%" align="left" valign="top" scope="col">Course Code</th>

    <th width="34%" align="left" valign="top" scope="col">Exam From</th>

    <th width="44%" align="left" valign="top" scope="col">Till</th>

  </tr>
		<?php foreach($exam_schedule as $exam){
			$CI =& get_instance();
			$encodedUrl = $CI->encode($exam->course_id);
			?>
		<tr class=''>
			<td><a href='<?php echo base_url().'dance/student/exam_process/'.$encodedUrl ?>'><?php echo $exam->course_code ?></a></td>
			<td> <?php echo date('d-M-Y',strtotime($exam->exam_date_starttime)); ?>  </td>
			<td><?php echo date('d-M-Y',strtotime($exam->exam_date_endtime)) ?> </td>
		</tr>
		<?php }?>

</table>

<span class="moreBtn"><a href="<?php echo base_url().'dance/student/exam_schedule' ?>">MOre</a></span>

	  <?php }else{ ?>
<span class="information">Exam not yet assigned</span>
	  <?php } ?>
      </div>

        

      </div>

      <div class="dashboardDetails ">

      <div class="dashboardDetailsTitle"><img src="<?php echo base_url()?>assets/home/images/payment-icon.gif" width="20" height="21" />Payments</div>

      <div class="dashboardDetailsInner">
		<?php if( isset($paymentList) && !empty($paymentList)){  ?>
          
	<span>Payment History </span> 

      <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <th width="33%" align="left" valign="top" scope="col">Paid on</th>

    <th width="34%" align="left" valign="top" scope="col">Amount($)</th>

      <th width="34%" align="left" valign="top" scope="col">Mode</th>

    <th width="33%" align="left" valign="top" scope="col">Status </th>

  </tr>
	<?php foreach($paymentList as $payment) { ?>
  <tr class='altRows'><td><?php echo date('d-M-Y',strtotime($payment->paid_on)); ?></td>

    <td><?php echo $payment->amount ?></td>

	 <td><?php echo $payment->payment_mode ?> Payment</td>

    <td><?php echo $payment->paymentStatus ?></td>

  </tr>
	<?php } ?>

</table>



<span class="moreBtn"><a href="<?php echo base_url().'dance/student/payments' ?>">MOre</a></span>

		<?php }else{ ?>
<span class="warning"><strong>No payments made</strong></span>
		<?php } ?>

      </div>

      

        

      </div>

      

      
    </div>

      <div>

        

      </div>

           

</div>

