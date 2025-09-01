<style>
#clickable a{
	color: #000000;
    text-decoration: none;
}
</style>
<div class="contentOuter">

 <?php
    
    if(@$_SESSION['msg'] != ''){
        echo $_SESSION['msg'];
    }
    unset($_SESSION['msg']);
  
                ?>
				
					<?php if ($this->session->flashdata('ErrMessage')) { ?>
				<div class="alert alert-success">
					<?php echo $this->session->flashdata('ErrMessage'); ?>
				</div>
			<?php } ?>
				
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
		<?php $k=1;foreach($exam_schedule as $exam){ 
			  if($k<=3){
			$CI =& get_instance();
			$encodedUrl = $CI->encode($exam->course_id);
			?>
		<tr class=''>
			<td id="clickable"><a href='javascript:void(0)' id="<?= $encodedUrl ?>"><?php echo $exam->course_code ?></a></td>
			<td> <?php echo date('d-M-Y',strtotime($exam->exam_date_starttime)); ?>  </td>
			<td><?php echo date('d-M-Y',strtotime($exam->exam_date_endtime)) ?> </td>
		</tr>
		<?php $k++; } }?>

</table>

<span class="moreBtn"><a href="<?php echo base_url().'music/student/exam_schedule' ?>">MOre</a></span>

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
	<?php $j = 1; foreach($paymentList as $payment) { if($j<=3){ ?>
  <tr class='altRows'><td><?php echo date('d-M-Y',strtotime($payment->paid_on)); ?></td>

    <td><?php echo $payment->amount ?></td>

	 <td><?php echo $payment->payment_mode ?> Payment</td>

    <td><?php echo $payment->paymentStatus ?></td>

  </tr>
	<?php $j++; } } ?>

</table>



<span class="moreBtn"><a href="<?php echo base_url().'music/student/payments' ?>">MOre</a></span>

		<?php }else{ ?>
<span class="warning"><strong>No payments made</strong></span>
		<?php } ?>

      </div>

      </div>
      
    </div>

      <div>

      </div>

</div>

<script type="text/javascript">var sType = "keypress";</script> 
 
<!--[if IE]> 
<script type="text/javascript">sType = "keydown";</script> 
<![endif]--> 
 

<script>
$(document).ready(function()
{		
	$('#clickable').on('click','a',function()
	{   
		//var id = $(this).attr('id');		
		//var url1 = "<?php echo base_url() ?>music/student/exam_process/"+id;
		
		var url = "<?php echo base_url() ?>music/student/online_exam";				
		window.location = url;
			
	});
		
});
</script>