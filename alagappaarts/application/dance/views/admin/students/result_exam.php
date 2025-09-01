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
                                    <h2>Student  <small>Result Exam</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/students/result_exam<?php echo $urlArg;?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Result Exam</span>
										<center>
											<span class="successMsg">
												<?php if ($this->session->flashdata('SucMessage')) { ?>
													<div class="alert alert-danger alert-dismissable">
														<?php echo $this->session->flashdata('SucMessage'); ?>
													</div>
											</span>
											<span class="errorMsg">
												<?php }if ($this->session->flashdata('ErrMessage')) { ?>
													<div class="alert alert-danger alert-dismissable">
														<?php echo $this->session->flashdata('ErrMessage'); ?>
													</div>
												<?php } ?>
											</span>
										</center>
									
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
														<li><span>Program Enrolled : </span><span class="pname">
														<?php 
														echo ((isset($post_set['program_id']) && !empty($post_set['program_id']) && $post_set['program_id']== $ExamScore[0]->program_id) ? $ExamScore[0]->programName : ((isset($ExamScore[0]->programName) && !empty($ExamScore[0]->programName)) ? $ExamScore[0]->programName : '')); 
														//echo $enroll_detail->programName?></span></li>
														<li><span>Date of joining : </span><span class="dojoin"><?php echo ((isset($getPaid->paid_on) && !empty($getPaid->paid_on)) ? date('j F Y',strtotime($getPaid->paid_on)) : '') ?></span></li>
													</ul>
												</div>
											</div>
										</div>
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Mark details </label>
                                            
											
											<div class="col-md-12 col-sm-12 col-xs-12 pay">
												<table class="result_exam" cellspacing="0" cellpadding="0" border="0">
													<thead> 
													  <tr>
														<th>COURSE CODE </th>
														<th>PREGULATION</th>
														<th>MARKS OBTAINED</th>
														<th>RESULT</th>
														<th>GRADE</th>
													  </tr>
													  </thead> 
													  <tbody>
													  <?php if( isset($ExamScore) && !empty($ExamScore) && count($ExamScore)>0){
														  foreach($ExamScore as $exam){?>
													  <tr class="">
														<td><?php echo $exam->course_code?></td>
														<td> <?php if(array_key_exists($exam->regulation_id, $regulationList)){ echo $regulationList[$exam->regulation_id]; } ?></td>
														<td><?php echo $exam->score?> </td>
														<td class="td_result<?php echo $exam->program_id ?>">
														<select style="width:130px;" class="form-control result" name="result[]" id="result_<?php echo $exam->id ?>">
															<option value="">Select Result</option>
															<?php if(!empty($resultArray)) { foreach($resultArray as $resultKey=>$res){?>
																<option value="<?php echo $res; ?>" <?php 
																echo (isset($post_set['result']) && !empty($post_set['result'])  && ($post_set['result']== $res) ? 'selected' : (( isset($exam->aeResult) && !empty($exam->aeResult) && $exam->aeResult==$res) ? 'selected' : ''));?>><?php echo stripslashes($res); ?></option>
															<?php } } ?>
													   </select>
													    <?php echo form_error('result[]'); ?>
														</td>
														<td class="td_grade<?php echo $exam->program_id ?>">
														<select style="width:100px;" class="form-control grade" name="grade[]" id="grade_<?php echo $exam->id ?>">
															<option value="">Select Grade</option>
															<?php if(!empty($gradeArray)) { foreach($gradeArray as $key=>$grade){?>
																<option value="<?php echo $grade; ?>" <?php echo (isset($post_set['grade']) && !empty($post_set['grade'])  && ($post_set['grade']== $grade) ? 'selected' : (( isset($exam->aeGrade) && !empty($exam->aeGrade) && $exam->aeGrade==$grade) ? 'selected' : ''));?>><?php echo stripslashes($grade); ?></option>
															<?php } } ?>
													   </select>
													    <?php echo form_error('grade[]'); ?>
														</td>
														
														<input type="hidden" name="aeId[]" id="aeId" value="<?php echo $exam->id; ?>">
														<input type="hidden" name="score[]" id="score" value="<?php echo $exam->score; ?>">
														
														
														</tr>  
													  <?php } }else{ echo '<tr><td colspan="5" align="center">No Such Record Found</td></tr>'; }?>
													</tbody>
												</table>
											</div>
												
                                       </div>
									   
									   <input type="hidden" name="is_eligible" id="is_eligible" value="<?php echo (( isset($ExamScore) && !empty($ExamScore)) ? '1' : ''); ?>">
										
										<div class="empty_result_grade" style="display:none">
											<select style="width:130px;" class="form-control result" name="result[]" id="result_">
												<option value="">Select Result</option>
												<?php if(!empty($resultArray)) { foreach($resultArray as $resultKey=>$res){?>
													<option value="<?php echo $res; ?>" <?php 
													echo (isset($post_set['result']) && !empty($post_set['result'])  && ($post_set['result']== $res) ? 'selected' : (( isset($exam->aeResult) && !empty($exam->aeResult) && $exam->aeResult==$res) ? 'selected' : ''));?>><?php echo stripslashes($res); ?></option>
												<?php } } ?>
											</select>
											
											<select style="width:100px;" class="form-control grade" name="grade[]" id="grade_">
												<option value="">Select Grade</option>
												<?php if(!empty($gradeArray)) { foreach($gradeArray as $key=>$grade){?>
													<option value="<?php echo $grade; ?>" <?php echo (isset($post_set['grade']) && !empty($post_set['grade'])  && ($post_set['grade']== $grade) ? 'selected' : (( isset($exam->aeGrade) && !empty($exam->aeGrade) && $exam->aeGrade==$grade) ? 'selected' : ''));?>><?php echo stripslashes($grade); ?></option>
												<?php } } ?>
											</select>
										</div>		   
 										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/students/index" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
												<?php if( !isset($ExamScore->aeScore ) && empty($ExamScore->aeScore)){?>
												<input type="submit" class="btn btn-success"  value="Submit" name="submit">
												<?php } ?>
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

			<script>
			

			$(document).ready( function() { 	

				
				 $('.program_id').change(function(){ //any select change on the dropdown with id country trigger this code
                            var program = $('.program_id').val();
							
							if(program !="")
							{ 
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>dance/admin/students/ajaxResultExam",
									data: {program_id : program,user_id:<?php echo $arg?>,type:'courses'},
									dataType:"json",
									 //beforeSend : function(r){   $('#dvLoading').addClass('imgloading');	},
									success: function(value) //we're calling the response json array 'cities'
									{
									               //$('#dvLoading').removeClass('imgloading'); 
											//alert($('.result').html());
											if( value !== false){
												
												if( typeof $('.result').html() == 'undefined' && typeof $('.grade').html() == 'undefined'){
													$('.empty_result_grade').show();
												}
												var Result = (( typeof $('.result').html() !== 'undefined') ? $('.result').html().replace('selected=""'," ") : '');
												var Grade = (( typeof $('.grade').html() !== 'undefined') ? $('.grade').html().replace('selected=""'," ") : '');
																							
												var tableData = reg = pgmId = resultSelect = gradeResult = '';
												for(var k=0;k<value.length;k++){
													reg = ((value[k].regulation_id==1) ? 'Theory' : '');
													pgmId = value[k].program_id; 
													if( Result!= ''){
														resultSelect = '<select id="result_'+value[k].id+'" name="result[]" class="result form-control " style="width:130px;">'+Result+'</select>';
													}
													if( Grade!= ''){
													gradeResult = '<select id="grade_'+value[k].id+'" name="grade[]" class="grade form-control " style="width:130px;">'+Grade+'</select>';
													}
													
													tableData += "<tr><td>"+value[k].course_code+"</td><td>"+reg+"</td><td>"+value[k].score+"</td><td class='td_result"+pgmId+"'>"+resultSelect+"</td><td class='td_grade"+pgmId+"'>"+gradeResult+"</td><tr><input type='hidden' name='aeId[]' id='aeId' value='"+value[k].id+"'><input type='hidden' name='score[]' id='score' value='"+value[k].score+"'>";
													
												}
												
												$('.pname').html(value[0].programName);
												$('.result_exam tbody').html(tableData);
												
												for(var j=0;j<value.length;j++){
													$('#result_'+value[j].id).each(function(i,val){
															 $('option', this).each(function (i,val) {
																if( val.value == value[j].aeResult){
																	 $(this).attr('selected', 'selected')
																}
															 });
													});
													$('#grade_'+value[j].id).each(function(i,val){
															 $('option', this).each(function (i,val) {
																if( val.value == value[j].aeGrade){
																	 $(this).attr('selected', 'selected')
																}
															 });
													});
												}
												$('#is_eligible').val('1');
												if( typeof $('.result').html() == 'undefined' && typeof $('.grade').html() == 'undefined'){
													$('.empty_result_grade').hide();
												}
												
											}else{
												
												$('.pname').html('');
												$('.result_exam tbody').html('');
												$('#is_eligible').val('');
											}
												
												
									}
									});
							}
							 
					});
			});
			</script>
			