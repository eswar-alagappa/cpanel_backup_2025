<!--
<style>
      /* ==========================================================================
          Demo using Bootstrap 3.3.4 and jQuery 1.11.2
          You don't need any of the following styles for the form to work properly, 
          these are just helpers for the demo/test page.
        ========================================================================== */

      #wrapper { 
        width:595px;
        margin:0 auto;
      }
      legend {
        margin-top: 20px;
      }
      #attribution {
        font-size:12px;
        color:#999;
        padding:20px;
        margin:20px 0;
        border-top:1px solid #ccc;
      }
      #O_o { 
        text-align: center; 
        background: #33577b;
        color: #b4c9dd;
        border-bottom: 1px solid #294663;
      }
      #O_o a:link, #O_o a:visited {
        color: #b4c9dd;
        border-bottom: #b4c9dd;
        display: block;
        padding: 8px;
        text-decoration: none;
      }
      #O_o a:hover, #O_o a:active {
        color: #fff;
        border-bottom: #fff;
        text-decoration: none;
      }
      @media only screen and (max-width: 620px), only screen and (max-device-width: 620px) {
        #wrapper {
          width: 90%;
        }
        legend {
          font-size: 24px;
          font-weight: 500;
        }
      }
	  
	  .stud_detail ul li{
		  list-style:none;
	  }
	 
	  .stud_detail ul li span{
		padding:10px;
		width:200px;
		display:inline-block
	  }
	  .pay table tr th, tr td{
		  width:10%;
	  }
      </style>
  <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/clone-form-td.js"></script>-->
  <style>
   .stud_detail ul li{
		  list-style:none;
	  }
	 
	  .stud_detail ul li span{
		padding:10px;
		width:200px;
		display:inline-block
	  }
	  .pay table tr th, tr td{
		  width:10%;
	  }
	  .margin_top_50{
		  margin-top:50px;
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
                                    <h2>Student  <small>Course Completion</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/students/course_completion<?php echo $urlArg;?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Course Completion</span>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Select Program <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12 program_id" name="program_id" id="program_id">
													<option value="">Select Program</option>
													<?php if(!empty($programList)) { foreach($programList as $k=>$program){?>
														<option value="<?php echo $program->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && ($post_set['program_id']== $program->program_id) ? 'selected' : (( !isset($post_set['program_id']) && isset($defaultProgram_id) && !empty($defaultProgram_id) && $defaultProgram_id==$program->program_id) ? 'selected' : ''));?>><?php echo stripslashes($program->name); ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('program_id'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Enrollment details </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
												<div class="stud_detail">
													<ul>
														<li><span>Student ID : </span><span><?php echo $enroll_detail->username?></span></li>
														<li><span>Student Name : </span><span><?php echo $enroll_detail->firstname.' '.$enroll_detail->lastname?></span></li>
														<li><span>Center Name : </span><span><?php echo $enroll_detail->centerName?></span></li>
														<li><span>Program Enrolled : </span><span class="pname"><?php echo $enroll_detail->programName?></span></li>
														<li><span>Date of joining : </span><span><?php echo ((isset($getPaid->paid_on) && !empty($getPaid->paid_on)) ? date('j F Y',strtotime($getPaid->paid_on)) : '') ?></span></li>
														<li><span>Program fee : </span><span class="pgm_fee"><?php echo '$ '. ((isset($paymentList[0]->Total_fee) && !empty($paymentList[0]->Total_fee)) ? $paymentList[0]->Total_fee : '')?></span></li>
													</ul>
												</div>
											</div>
										</div>
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Payment details </label>
											
											<div class="col-md-12 col-sm-12 col-xs-12 pay">
												<table class="payment_table" cellspacing="0" cellpadding="0" border="0">
													<thead>
													  <tr>
														<th>Amount  paid </th>
														<th>Payment  Type</th>
														<th>Payment  mode</th>
														<th> Paid  on </th>
														<th>Check No </th>
														<th>Status</th>
														<th> Remarks</th>
													  </tr>
													  </thead>
													  <tbody>
													  <?php if( isset($paymentList) && !empty($paymentList)){ ?>
													  <tr class="">
														<td><?php echo $paymentList[0]->amount?></td>
														<td><?php echo $paymentList[0]->payment_option?></td>
														<td> <?php echo $paymentList[0]->payment_mode?> Payment  </td>
														<td><?php echo $paymentList[0]->paid_on?> </td>
														<td><?php echo $paymentList[0]->check_no?></td>
														<td><?php echo $paymentList[0]->paymentStatus?></td>
														<td><?php echo $paymentList[0]->comments?></td>	
														</tr> 
													  <?php } ?>														
													</tbody>
												</table>
											</div>
												
                                       </div>
									   
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Mark details </label>
                                            
											
											<div class="col-md-12 col-sm-12 col-xs-12 pay">
												<table class="result_exam" cellspacing="0" cellpadding="0" border="0">
													<thead>													
													  <tr>
														<th>EXAM DATE</th>
														<th>COURSE CODE </th>														
														<th>MARKS OBTAINED</th>
														<th>RESULT</th>
														<th>GRADE</th>
													  </tr>
													  </thead>
													  <tbody>
													  <?php if( isset($ExamScore) && !empty($ExamScore)){
														  foreach($ExamScore as $exam){?>
													  <tr class="">
														<td><?php echo date('d-M-Y',strtotime($exam->exam_startdate))?></td>	
														<td><?php echo $exam->course_code?></td>														
														<td><?php echo $exam->score?> </td>
														<td><?php echo $exam->aeResult ?></td>														
														<td><?php echo $exam->aeGrade ?></td>
														
														
														<input type="hidden" name="score" id="score" value="<?php echo $exam->score; ?>">
														
														</tr> 
													  <?php }} ?>
													</tbody>
												</table>
											</div>
												
                                       </div>

                                   <input type="hidden" name="is_eligible" id="is_eligible" value="<?php echo (( isset($ExamScore) && !empty($ExamScore)) ? '1' : ''); ?>">
								   
									<input type="hidden" name="user_program_id" id="user_program_id" value="<?php echo $enroll_detail->user_program_id; ?>">
										
									<div class="item form-group">
									
										<div class="item form-group">                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Course Completion Update </label>
											</div>
										</div>
										<?php //echo 'graduation_status->'.$post_set['graduation_status']; 
										//echo 'enroll graduate status->'.$enroll_detail->graduation_status; ?>
										<div class="item form-group">                                            
                                           
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <label class="control-label col-md-6 col-sm-6 col-xs-12" for="number">Graduated </label>
												
												 <div class="radio radio-info radio-inline" style="text-align:left">
          <input type="radio" id="inlineRadio1" value="Y" name="graduation_status" <?php if( isset($post_set['graduation_status']) && !empty($post_set['graduation_status']) && $post_set['graduation_status'] =='Y') { ?> checked <?php } elseif(isset($enroll_detail->graduation_status) && !empty($enroll_detail->graduation_status) && trim($enroll_detail->graduation_status)=='Y'){ ?>checked <?php }else{ ?><?php } ?> >
          <label for="inlineRadio1"> Yes</label>
        </div>
        <div class="radio radio-info radio-inline">
          <input type="radio" id="inlineRadio2" value="N" name="graduation_status" <?php if( isset($post_set['graduation_status']) && !empty($post_set['graduation_status']) && $post_set['graduation_status'] =='N') { ?> checked <?php }elseif(isset($enroll_detail->graduation_status) && !empty($enroll_detail->graduation_status) && trim($enroll_detail->graduation_status)=='N'){ ?> <?php }elseif( !isset($post_set['graduation_status']) && !isset($enroll_detail->graduation_status)){ ?> checked<?php } ?> >
          <label for="inlineRadio2"> No</label>
        </div>
		
												<?php echo form_error('graduation_status'); ?>
                                            </div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												
                                                 <textarea id="comment" required="required" placeholder="Comments" name="comment" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['comment']) && !empty($post_set['comment']) ? $post_set['comment'] : (( isset($enroll_detail->graduation_status_comments ) && !empty($enroll_detail->graduation_status_comments )) ? $enroll_detail->graduation_status_comments : ''));?></textarea>
												
                                            </div>											
                                        </div>
										<input type="hidden" name="hiddenGraduateStatus" id="hiddenGraduateStatus" value="<?php echo ((isset($post_set['graduation_status']) && !empty($post_set['graduation_status']) && $post_set['graduation_status'] =='Y') ? '1' : ((isset($enroll_detail->graduation_status) && !empty($enroll_detail->graduation_status) && trim($enroll_detail->graduation_status)=='Y') ? '1':'')); ?>"> 
										
										<div class="item form-group graduateFields" id="graduate-Y" style="<?php echo ((isset($post_set['graduation_status']) && !empty($post_set['graduation_status']) && $post_set['graduation_status'] =='Y') ? 'display:block' : 'display:none'); ?>" >  
											<div class="col-md-6 col-sm-6 col-xs-12">
												 <label class="control-label col-md-6 col-sm-6 col-xs-12" for="number">Graduation Date </label>
												 <input type="text" name='graduate_date' id="start_dateInput" placeholder='Graduation Date' class="col-md-6 col-sm-6 col-xs-12 dateControl" value="<?php echo (( isset($enroll_detail->completion_date ) && !empty($enroll_detail->completion_date ) && $enroll_detail->completion_date !='0000-00-00 00:00:00') ? date('Y-m-d',strtotime($enroll_detail->completion_date)) : '');?>"/>
													<?php echo form_error('graduate_date'); ?>
			  
											</div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
												<select style="width:150px;" class="form-control" name="grade" id="grade">
													<option value="">Select Grade</option>
													<?php if(!empty($gradeArray)) { foreach($gradeArray as $key=>$grade){?>
														<option value="<?php echo $grade; ?>" <?php echo (isset($post_set['grade']) && !empty($post_set['grade'])  && ($post_set['grade']== $grade) ? 'selected' : (( isset($enroll_detail->grade) && !empty($enroll_detail->grade) && $enroll_detail->grade==$grade) ? 'selected' : ''));?>><?php echo stripslashes($grade); ?></option>
													<?php } } ?>
													<!-- -->
											   </select>
												<?php echo form_error('grade'); ?>
											</div>
										</div>
									</div>
									
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/students/index" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
												<?php //if( !isset($ExamScore->aeScore ) && empty($ExamScore->aeScore)){?>
												<input type="submit" class="btn btn-success"  value="Submit" name="submit">
												<?php //} ?>
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
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function(){
		
		 $(".dateControl:first").datepicker({
				maxDate:0,
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
			});
	
	if( $('#hiddenGraduateStatus').val() ==1){
		$('#graduate-Y').show();
	}else{
		$('#graduate-Y').hide();
	}
	
	 $("[name=graduation_status]").each(function(i) {
        $(this).change(function(){ 
            $('#graduate-Y').hide();
            divId = 'graduate-' + $(this).val();
            $("#"+divId).show('slow');
        });
    });
	
	
						$('.program_id').on('change',function(){ //any select change on the dropdown with id country trigger this code
                            var program = $('.program_id').val();
							
							if(program !="")
							{ 
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>dance/admin/students/ajaxCourseCompletion",
									data: {program_id : program,user_id:<?php echo $arg?>,type:'courses'},
									dataType:"json",
									 //beforeSend : function(r){   $('#dvLoading').addClass('imgloading');	},
									success: function(value) //we're calling the response json array 'cities'
									{
									               //$('#dvLoading').removeClass('imgloading'); 
											//alert(value);
											var Exam = value.exam; 
											if( Exam !== false){
												
												var examtableData = reg = pgmId = '';
												for(var k=0;k<Exam.length;k++){
													reg = ((Exam[k].regulation_id==1) ? 'Theory' : '');
													pgmId = Exam[k].program_id; 
													
													examtableData += "<tr><td>"+Exam[k].exam_startdate+"</td><td>"+Exam[k].course_code+"</td><td>"+Exam[k].score+"</td><td>"+Exam[k].aeResult+"</td><td>"+Exam[k].aeGrade+"</td><tr><input type='hidden' name='score[]' id='score' value='"+Exam[k].score+"'>";
													
													$('.pname').html(Exam[k].programName);
													$('.pgm_fee').html(Exam[k].Total_fee);
												
													$('#hiddenGraduateStatus').val( ((Exam[k].graduation_status=='Y') ? 1 : '') );
													$('#comment').val(Exam[k].graduation_status_comments);
													$('input[name="graduate_date"]').val(Exam[k].completion_date);
													$('#grade').val(Exam[k].grade);
													//$('input[name="graduation_status"]').val(Exam[k].graduation_status);
													if( Exam[k].graduation_status == 'Y'){
														$('input[id="inlineRadio1"]').attr('checked', 'checked');
														$('#graduate-Y').show();
													}else{
														$('input[id="inlineRadio2"]').attr('checked', 'checked');
														$('#graduate-Y').hide();
													}
													$('#user_program_id').val(Exam[k].user_program_id);
														
												}
												
												//alert( Exam[0].graduation_status +' '+Exam[1].graduation_status)
												$('.result_exam tbody').html(examtableData);
												
												$('#is_eligible').val('1');
												
											}else{
												$('.result_exam tbody').html('');
												$('.pname').html('');
												$('.pgm_fee').html('');
												$('#comment').val('');
												$('input[id="inlineRadio2"]').attr('checked', 'checked');
												$('#graduate-Y').hide();
												$('#is_eligible').val('');
											}
											
											var Payment = value.payment;
											if( Payment !== false){
												
												var paymenttableData = '';
												for(var k=0;k<Payment.length;k++){
													
													paymenttableData += "<tr><td>"+Payment[k].amount+"</td><td>"+Payment[k].payment_option+"</td><td>"+Payment[k].payment_mode+"</td><td>"+Payment[k].paid_on+"</td><td>"+Payment[k].check_no+"</td><td>"+Payment[k].status+"</td><td>"+Payment[k].comments+"</td><tr>";
													
												}
												$('.payment_table tbody').html(paymenttableData);
											}else{
												$('.payment_table tbody').html('');
											}
											/*var tableData = reg = pgmId = '';
											for(var k=0;k<value.length;k++){
												reg = ((value[k].regulation_id==1) ? 'Theory' : '');
												pgmId = value[k].program_id; 
												
												tableData += "<tr><td>"+value[k].course_code+"</td><td>"+reg+"</td><td>"+value[k].score+"</td><td class='td_result'>"+$('.td_result').html()+"</td><td class='td_grade'>"+$('.td_grade').html()+"</td><tr><input type='hidden' name='aeId[]' id='aeId' value='"+value[k].id+"'><input type='hidden' name='score[]' id='score' value='"+value[k].score+"'>";
												
											}
											$('.pname').html(value[0].programName);
											$('.result_exam tbody').html(tableData);*/
									}
									});
							}
							
					});
					
})
</script>
			