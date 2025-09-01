<style>
.pay span{
	color:#f00;
	font-weight:bold;
}
</style>
<div class="right_col" role="main">

                <div class="">
                    <!--<div class="page-title">
                        <div class="title_left">
                            <h3>
                    Form Validation
                </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Payment <small>Add</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
								<?php $urlArg = ((isset($arg) && !empty($arg)) ? '/'.$arg : '');?>
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/payment/add_check_pay<?php echo $urlArg; ?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Payment Info</span>
										
										<div class="item form-group"> 
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div>Student Id : <?php echo $payData->username ?></div>
													<div>Student Name : <?php echo $payData->firstname.' '.$payData->lastname ?></div>
													<div>Center Name : <?php echo $payData->centerName ?></div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-12 pay">
													<div>Program Enrolled : <?php $pgmCnt = count($programList); echo $programList[$pgmCnt-1]->name; ?></div>
													<div>Date Of Joining : <?php echo date('j F Y',strtotime($payData->dateofjoining)) ?></div>
													<div>Amount Paid ( <i class="fa fa-dollar"></i> ): <?php echo ((isset($payData->paidAmt) && !empty($payData->paidAmt)) ? $payData->paidAmt : '<span>Payment not yet received</span>') ?></div>
												</div>
											</div>
										</div>
										
                                        <div class="item form-group">                                            
                                           
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <!--<input id="gender" value="<?php echo (isset($post_set['gender']) && !empty($post_set['gender']) ? $post_set['gender'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="gender" placeholder="Gender"  type="text">-->
												
												 <div class="radio radio-info radio-inline" style="text-align:left">
          <input type="radio" id="inlineRadio1" value="Fully" name="pay_option" <?php if( !empty($post_set['pay_option']) && $post_set['pay_option'] =='Fully') { ?> checked <?php }else{ ?>checked<?php } ?> >
          <label for="inlineRadio1"> Fully</label>
        </div>
        <div class="radio radio-info radio-inline">
          <input type="radio" id="inlineRadio2" value="Partial" name="pay_option" <?php if(!empty($post_set['pay_option']) && $post_set['pay_option'] =='Partial') { ?> checked <?php } ?> >
          <label for="inlineRadio2"> Partial</label>
        </div>
		
												<?php echo form_error('pay_option'); ?>
                                            </div>
										</div>
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="check_received" value="<?php echo (isset($post_set['check_received']) && !empty($post_set['check_received']) ? $post_set['check_received'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="check_received" placeholder="Check Received On" required="required" type="text">
												<?php echo form_error('check_received'); ?>
                                            </div>		
										</div>
										
										 <div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="check_number" value="<?php echo (isset($post_set['check_number']) && !empty($post_set['check_number']) ? $post_set['check_number'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="check_number" placeholder="Check No" required="required" type="text">
												<?php echo form_error('check_number'); ?>
                                            </div>	
										</div>
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="check_date" value="<?php echo (isset($post_set['check_date']) && !empty($post_set['check_date']) ? $post_set['check_date'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="check_date" placeholder="Check Date" required="required" type="text">
												<?php echo form_error('check_date'); ?>
                                            </div>		
										</div>
										
										 <div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="check_amount" value="<?php echo (isset($post_set['check_amount']) && !empty($post_set['check_amount']) ? $post_set['check_amount'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="check_amount" placeholder="Check Amount" required="required" type="text">
												<?php echo form_error('check_amount'); ?>
                                            </div>	
										</div>
										
										 <div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="bank_name" value="<?php echo (isset($post_set['bank_name']) && !empty($post_set['bank_name']) ? $post_set['bank_name'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="bank_name" placeholder="Bank Name & Branch" required="required" type="text">
												<?php echo form_error('bank_name'); ?>
                                            </div>	
										</div>
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="credited_on" value="<?php echo (isset($post_set['credited_on']) && !empty($post_set['credited_on']) ? $post_set['credited_on'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="credited_on" placeholder="Credited on" required="required" type="text">
												<?php echo form_error('credited_on'); ?>
                                            </div>		
										</div>
										
										  <div class="item form-group"> 		
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="comments" required="required" placeholder="Comments" name="comments" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['comments']) && !empty($post_set['comments']) ? $post_set['comments'] : '');?></textarea>
												<?php echo form_error('comments'); ?>
                                            </div>		
                                        </div>
										<input type="hidden" name="program_id" id="program_id" value="<?php echo $programList[$pgmCnt-1]->program_id ?>">
										
										<!--<div class="item form-group">
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="status" id="status">
													<option value="">Select Status</option>
													<?php if(!empty($statusArray)) { foreach($statusArray as $k=>$stats){?>
														<option value="<?php echo $k; ?>" <?php echo (isset($post_set['status']) && !empty($post_set['status'])  && ($post_set['status']== $k) ? 'selected' : '');?>><?php echo $stats; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('status'); ?>
                                            </div>
                                        </div>-->
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/payment/index" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
												<input type="submit" class="btn btn-success"  value="Submit" name="submit">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			 <script type="text/javascript">
        $(document).ready(function(){
            $( "#check_received,#check_date,#credited_on" ).datepicker({
			  changeMonth: true,
			  changeYear: true,
			  //maxDate: new Date(),
			   //yearRange: '-85:-08',
			   dateFormat: 'yy-mm-dd',
			});
		});
</script>
			