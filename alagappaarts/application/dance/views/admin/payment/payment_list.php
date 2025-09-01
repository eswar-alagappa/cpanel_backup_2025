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
								
								<form id="frmStudentsearch" method="post" action="<?php echo base_url().'dance/admin/payment/index' ?>">
								<table border="0" cellpadding="5" cellspacing="5">
									<tbody>
									<tr>
										<td><h3>PROGRAM : &nbsp;</h3></td>
										<td>
											<select id="program" name="program">
												<option value="">-Select-</option>
												<?php if( isset($programList) && !empty($programList)){
													foreach($programList as $program){?>
														<option value="<?php echo $program->program_id; ?>" <?php echo ((isset($post_set['program']) && !empty($post_set['program']) && $post_set['program'] == $program->program_id) ? 'selected' : '') ?>><?php echo stripslashes($program->name); ?></option>
												<?php }}?>
											</select>
										</td>
									</tr>
									<tr>
										<td><h3>CENTER : &nbsp;</h3></td>
										<td>
											<select id="center" name="center">
												<option value="">-Select-</option>
												<?php if( isset($centers) && !empty($centers)){
													foreach($centers as $center){?>
													<option value="<?php echo $center->center_academy_id; ?>" <?php echo ((isset($post_set['center']) && !empty($post_set['center']) && $post_set['center'] == $center->center_academy_id) ? 'selected' : '') ?>><?php echo stripslashes($center->name); ?></option>
												<?php }}?>
											</select>
										</td>
									</tr>
									
									<tr><td></td><td align="center"><input type="submit" class="goBtn btn btn-primary" value="Go" name="search"></td></tr>
									</tbody>
								</table>
								</form>
								
								
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
										<?php if( !empty($payments)){ 
														foreach($payments as $key=> $payment){ 
														
												?>
                                           <tr class="even pointer">
                                                <td ><?php echo $payment['username'] ?></td>
												<td ><?php echo $payment['firstname'].' '.$payment['lastname'] ?></td>
												<td ><?php echo date('j F Y',strtotime($payment['dateofjoin'])) ?></td>
												<td ><?php echo stripslashes($payment['program']) ?></td>
												<td ><?php echo $payment['total_fee'] ?></td>
												<td><?php echo $payment['paidAmt'] ?></td>
                                                <td><?php echo $payment['outstandingAmt'] ?></td>
												
                                                <td class=" last">
												<?php
												$PayLink =  base_url().'dance/admin/payment/add_check_pay/'.$payment['user_id'];
												$check_active = 'fa fa-money'; 
												echo ' <a alt="Make Check Payment" title="Make Check Payment" href="'.$PayLink.'"><i class="'.$check_active.'"></i></a>';
												
												?>
                                                </td>												
                                            </tr>
														<?php  } } ?>
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