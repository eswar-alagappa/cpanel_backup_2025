<!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                   

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Payment <small>list</small></h2>
									
									
									<?php if ($this->session->flashdata('SucMessage')!='') { ?>
										  <div class="alert alert-success alert-dismissable">
												<i class="fa fa-check"></i>
												<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												<b>Alert!</b>
												<?php echo $this->session->flashdata('SucMessage') ;   ?>
											</div>
									<?php } ?>
									
                                   
                                </div>
								
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--<th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>-->
												<th>Student ID </th>
												<th>Student Name </th>
                                                <th>Program Enrolled </th>
												<th>Date of Joining </th>
                                                <th>Program Fee </th>
                                                <th>Amount Paid </th>
												<th>OutStanding Amount </th>
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
										<?php if( !empty($payments)){ //echo '<pre>';print_r($payments);
														foreach($payments as $key=> $payment){ 
														if( $payment->Total_fee != array_sum($totalPayAmount[$payment->program_id][$payment->user_id])){
												?>
                                            <tr class="even pointer">												
                                                
												<!--<td ><?php echo date('j F Y',strtotime($payment->created_at)); ?></td>
												<td ><?php echo date('j F Y',strtotime($payment->updated_at)); ?></td>-->
                                                <td ><?php echo $payment->username ?></td>
												<td ><?php echo $payment->firstname.' '.$payment->lastname ?></td>
												<td ><?php echo date('j F Y',strtotime($payment->dateofjoining)) ?></td>
												<td ><?php echo stripslashes($payment->name) ?></td>
												<td ><?php echo $payment->Total_fee ?></td>
												<td ><?php echo array_sum($totalPayAmount[$payment->program_id][$payment->user_id]) ?></td>
												<td ><?php echo ( $payment->Total_fee - array_sum($totalPayAmount[$payment->program_id][$payment->user_id]) ) ?></td>
                                               <!-- <td ><?php //echo stripslashes(substr(trim($page->content),0,100)).'...'; ?> </td>-->
                                                
                                                <td class=" last">
												<?php
												$PayLink =  base_url().'vaasthu/admin/payment/add_check_pay/'.$payment->user_id;
												$check_active = 'fa fa-money'; 
												echo ' <a alt="Make Check Payment" title="Make Check Payment" href="'.$PayLink.'"><i class="'.$check_active.'"></i></a>';
												
												?>
                                                </td>												
                                            </tr>
														<?php } } } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
                  
                    
                </div>
	<style>
.inactive-mode{
	color:#ccc;opacity:0.8
}
</style>	