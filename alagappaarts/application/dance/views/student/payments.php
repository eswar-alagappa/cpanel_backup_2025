    <div class="topNav">
      <ul>
      <li><a href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Payments </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2><span>Payment History</span>
              <!--<span class="makePaymentbtn"><a href="<?php echo base_url().'dance/student/make_payment'?>" class="submitBtn">Make Payment</a><img width="7" height="24" src="../../assets/home/images/add-right-bg.png"></span> -->
            </h2>
     
      <div class="contentInner">
			 <?php if( isset($paymentList) && !empty($paymentList)){ ?>
             <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Program Enrolled</th>
                <th> Payment Option	</th>
                <th>  Date of Payment</th>
                 <th> Amount paid ($)</th>
                 <th>Payment mode</th>
                 <th>Status</th>
              </tr>
            <?php foreach($paymentList as $pay){ ?>
				<tr class="">
                <td><?php echo stripslashes($pay->name) ?></td>
                <td> <?php echo $pay->payment_option?>  </td>
                <td><?php echo date('d-M-Y',strtotime($pay->paid_on))?> </td><td><?php echo $pay->amount?></td><td><?php echo $pay->payment_mode?> Payment</td><td><?php echo $pay->paymentStatus ?></td>	 
              </tr>  
			<?php } ?>
            </tbody>
          </table>
		   <?php }else{ ?>
		   <div class="warning">Payment not yet paid. To make the payment through Paypal, Click on the  button '<strong>Make Payment</strong>'.  </div>
		   <?php } ?>
                     </div>
       
      <div>
        
      </div>
           
    </div>
