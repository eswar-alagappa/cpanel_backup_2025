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
      </style>
  <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/clone-form-td.js"></script>

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
                                    <h2>Question <small>Update</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>vaasthu/admin/exams/questions/update<?php echo $urlArg; ?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Question Info</span>
										
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Question Type <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="question_type" readonly="readonly" id="question_type">
													<option value="">Select Question Type</option>
													<?php if(!empty($questionType)) { foreach($questionType as $k=>$qtype){?>
														<option value="<?php echo $qtype->questiontype_id; ?>" <?php echo (isset($post_set['question_type']) && !empty($post_set['question_type'])  && ($post_set['question_type']== $qtype->questiontype_id) ? 'selected' : 
														(( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id== $qtype->questiontype_id) ) ? 'selected' : ''));?>><?php echo $qtype->name; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('question_type'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Courses <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="course[]" id="course" multiple="multiple" size="5">
													
													<?php
													foreach ($Courses as $brand => $list) {?>
														  <optgroup label="<?php echo $brand ?>">
														  <?php foreach ($list as $code => $name){ ?>
															<option value="<?php echo $name->course_id ?>" <?php echo (isset($post_set['course']) && !empty($post_set['course']) && in_array( $name->course_id, $post_set['course']) ? 'selected' :
																((isset($selectedCourseQuestion) && in_array($name->course_id,$selectedCourseQuestion)) ? 'selected': '')) ?>> <?php echo $name->course_code ?> </option>
														  <?php } ?>
														  </optgroup>
														<?php }
													?>
													
													
											   </select>
											   <?php echo form_error('course[]'); ?>
                                            </div>
                                        </div>
										
									<div id="drop_1" class="title_activ" style="<?php echo ((isset($post_set['question_type']) && !empty($post_set['question_type']) && $post_set['question_type']!='1' ) ? 'display:none' : 
									( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id!= 1) ? 'display:none': 'display:block')); ?>" >
                                      

									<fieldset id="examquestion" class="">
										<legend>Exam &amp; Question Details </legend>

										<div class="item form-group">
                                            <label class="control-label col-md-3 col-md-offset-1 col-sm-3 col-xs-12" for="name">Multiple Choice <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input id="question" value="<?php echo (isset($post_set['question']) && !empty($post_set['question']) ? $post_set['question'] :
													((isset($selectedValues->question) && !empty($selectedValues->question)) ? $selectedValues->question : ''));?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="question" placeholder="Questions" required="required" type="text">
												<?php echo form_error('question'); ?>
                                            </div>
                                        </div>
										
                                       
                                       <div class="item form-group"> 
											<label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">A 
                                            </label>
											<div class="col-md-5 col-sm-5 col-xs-12">
                                                <textarea id="multiple_choice" required="required" placeholder="" name="multiple_choice[]" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['multiple_choice'][0]) && !empty($post_set['multiple_choice'][0]) ? $post_set['multiple_choice'][0] : 
												((isset($selectedMultiChoice[0]) && !empty($selectedMultiChoice[0])) ? $selectedMultiChoice[0] : ''));?></textarea>
												<?php echo form_error('multiple_choice[0]'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="flat multichoiceans" value="A" <?php echo ((isset($selectedValues->answer) && !empty($selectedValues->answer) && $selectedValues->answer=='A') ? 'checked' : '');?> name="multiple_choice_answer[]"> 
                                                    </label>
													<?php echo form_error('multiple_choice_answer[0]'); ?>
                                                </div>
                                            </div>		
                                        </div>
										<div class="item form-group"> 
											<label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">B 
                                            </label>
											<div class="col-md-5 col-sm-5 col-xs-12">
                                                <textarea id="multiple_choice" required="required" placeholder="" name="multiple_choice[]" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['multiple_choice'][1]) && !empty($post_set['multiple_choice'][1]) ? $post_set['multiple_choice'][1] : 
												((isset($selectedMultiChoice[1]) && !empty($selectedMultiChoice[1])) ? $selectedMultiChoice[1] : ''));?></textarea>
												<?php //echo form_error('multiple_choice[]'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="flat multichoiceans" value="B" <?php echo ((isset($selectedValues->answer) && !empty($selectedValues->answer) && $selectedValues->answer=='B') ? 'checked' : '');?> name="multiple_choice_answer[]"> 
                                                    </label>
                                                </div>
                                            </div>		
                                        </div>
										<div class="item form-group"> 
											<label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">C 
                                            </label>
											<div class="col-md-5 col-sm-5 col-xs-12">
                                                <textarea id="multiple_choice" required="required" placeholder="" name="multiple_choice[]" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['multiple_choice'][2]) && !empty($post_set['multiple_choice'][2]) ? $post_set['multiple_choice'][2] : 
												((isset($selectedMultiChoice[2]) && !empty($selectedMultiChoice[2])) ? $selectedMultiChoice[2] : ''));?></textarea>
												<?php //echo form_error('multiple_choice[]'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="flat multichoiceans" value="C" <?php echo ((isset($selectedValues->answer) && !empty($selectedValues->answer) && $selectedValues->answer=='C') ? 'checked' : '');?> name="multiple_choice_answer[]"> 
                                                    </label>
                                                </div>
                                            </div>		
                                        </div>
										<div class="item form-group"> 
											<label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">D 
                                            </label>
											<div class="col-md-5 col-sm-5 col-xs-12">
                                                <textarea id="multiple_choice" required="required" placeholder="" name="multiple_choice[]" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['multiple_choice'][3]) && !empty($post_set['multiple_choice'][3]) ? $post_set['multiple_choice'][3] : 
												((isset($selectedMultiChoice[3]) && !empty($selectedMultiChoice[3])) ? $selectedMultiChoice[3] : ''));?></textarea>
												<?php //echo form_error('multiple_choice[]'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="flat multichoiceans" value="D" <?php echo ((isset($selectedValues->answer) && !empty($selectedValues->answer) && $selectedValues->answer=='D') ? 'checked' : '');?> name="multiple_choice_answer[]" > 
                                                    </label>
                                                </div>
                                            </div>		
                                        </div>
										
									</fieldset>
									
									
									<div class="ln_solid"></div>
									</div>
									
									
									<div id="drop_2" class="dropdown" style="<?php echo ((isset($post_set['question_type']) && !empty($post_set['question_type']) && $post_set['question_type']!='2' ) ? 'display:none' : 
									( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id!= 2) ? 'display:none': 'display:block')); ?>">
									
									
									<div class="item form-group"> 
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Match the following 
										</label>
									</div>
									 
									 
									<div id="entry1" class="clonedInput">
									
									
									
									<div class="item form-group"> 
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="0_question" required="required" placeholder="Question" name="match_question[]" class="question form-control col-md-7 col-xs-12"><?php echo ((isset($selectedValues->question) && !empty($selectedValues->question)) ? $selectedValues->question : '');//echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?></textarea>
												<?php echo form_error('match_question[]'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="0_answer" required="required" placeholder="Answer" name="match_answer[]" class="answer form-control col-md-7 col-xs-12"><?php echo ((isset($selectedValues->answer) && !empty($selectedValues->answer)) ? $selectedValues->answer : '');//echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?></textarea>
												<?php echo form_error('match_answer[]'); ?>
                                            </div>		
                                        </div>
										
									
									</div>
									
									<div class="form-group col-md-12 col-sm-6 col-xs-12">	
									 <p>
									<button type="button" id="btnAdd" name="btnAdd" class="btn btn-info">add section</button>
									  <button type="button" id="btnDel" name="btnDel" class="btn btn-danger">remove section above</button>
									</p>
									</div>
									
									</div>
									
									
										
									<div id="drop_3" class="dropdown" style="<?php echo ((isset($post_set['question_type']) && !empty($post_set['question_type']) && $post_set['question_type'] !='3' ) ? 'display:none' : 
									( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id!= 3) ? 'display:none': 'display:block')); ?>">
										
										<div class="item form-group"> 
											<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Subjective 5 Marks
											</label>
										</div>
									
										<div class="item form-group"> 
											
											<div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="question" required="required" placeholder="Question" name="sub_question_5" class="form-control col-md-7 col-xs-12"><?php echo ((isset($selectedValues->question) && !empty($selectedValues->question)) ? $selectedValues->question : ''); //echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?></textarea>
												<?php echo form_error('sub_question_5'); ?>
                                            </div>	
													
                                        </div>

									</div>
									
									<div id="drop_4" class="dropdown" style="<?php echo ((isset($post_set['question_type']) && !empty($post_set['question_type']) && $post_set['question_type']!='4' ) ? 'display:none' : 
									( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id!= 4) ? 'display:none': 'display:block')); ?>" >
										
										<div class="item form-group"> 
											<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Subjective 4 Marks
											</label>
										</div>
										
										<div class="item form-group"> 
											
											<div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="question" required="required" placeholder="Question" name="sub_question_4" class="form-control col-md-7 col-xs-12"><?php echo ((isset($selectedValues->question) && !empty($selectedValues->question)) ? $selectedValues->question : ''); //echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?></textarea>
												<?php echo form_error('sub_question_4'); ?>
                                            </div>	
													
                                        </div>

									</div>
									
									<div id="drop_5" class="dropdown" style="<?php echo ((isset($post_set['question_type']) && !empty($post_set['question_type']) && $post_set['question_type'] !='5' ) ? 'display:none' : 
									( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id!= 5) ? 'display:none': 'display:block')); ?>">
										
										<div class="item form-group"> 
											<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Fill in the Blank
											</label>
										</div>
										
										<div class="item form-group"> 
											
											<div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="question" required="required" placeholder="Question" name="fill_in_blank_question" class="form-control col-md-7 col-xs-12"><?php echo ((isset($selectedValues->question) && !empty($selectedValues->question)) ? $selectedValues->question : ''); //echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?></textarea>
												<?php echo form_error('fill_in_blank_question'); ?>
                                            </div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="checkbox" for="option_two">
												 <label>
													If Two Answer <input type="checkbox" class="flat second_answer" id="option_two" name=""> 
												 </label>
											</div>
										</div>
										<div class="item form-group">
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="fill_in_blank_answer" value="<?php echo (isset($post_set['fill_in_blank_answer']) && !empty($post_set['fill_in_blank_answer']) ? $post_set['fill_in_blank_answer'] : 
												 ((isset($selectedValues->answer) && !empty($selectedValues->answer)) ? $selectedValues->answer : ''));?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="fill_in_blank_answer" placeholder="Answer" required="required" type="text">
												<?php echo form_error('fill_in_blank_answer'); ?>
                                            </div>													
                                        </div>
										
										<div class="item form-group" id="answer_two" style="display:none">
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="answer" value="<?php echo (isset($post_set['answer']) && !empty($post_set['answer']) ? $post_set['answer'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="answer" placeholder="Answer" required="required" type="text">
												<?php echo form_error('answer'); ?>
                                            </div>													
                                        </div>
										

									</div>
									
									<div id="drop_6" class="dropdown" style="<?php echo ((isset($post_set['question_type']) && !empty($post_set['question_type']) && $post_set['question_type'] !='6' ) ? 'display:none' : 
									( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id!= 6) ? 'display:none': 'display:block')); ?>">
										
										<div class="item form-group"> 
											<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Subjective 6 Marks
											</label>
										</div>
										
										<div class="item form-group"> 
											
											<div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="question" required="required" placeholder="Question" name="sub_question_6" class="form-control col-md-7 col-xs-12"><?php echo ((isset($selectedValues->question) && !empty($selectedValues->question)) ? $selectedValues->question : ''); //echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?></textarea>
												<?php echo form_error('sub_question_6'); ?>
                                            </div>	
													
                                        </div>

									</div>
									
									<div id="drop_7" class="dropdown" style="<?php echo ((isset($post_set['question_type']) && !empty($post_set['question_type']) && $post_set['question_type'] !='7' ) ? 'display:none' :
									( isset($selectedValues->question_type_id) && !empty($selectedValues->question_type_id) && ($selectedValues->question_type_id!= 7) ? 'display:none': 'display:block')); ?>">
										
										<div class="item form-group"> 
											<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Subjective 8 Marks
											</label>
										</div>
										
										<div class="item form-group"> 
											
											<div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="question" required="required" placeholder="Question" name="sub_question_8" class="form-control col-md-7 col-xs-12"><?php echo ((isset($selectedValues->question) && !empty($selectedValues->question)) ? $selectedValues->question : ''); //echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : '');?></textarea>
												<?php echo form_error('sub_question_8'); ?>
                                            </div>	
													
                                        </div>

									</div>
										
										
										
										
                                        
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>vaasthu/admin/exams/questions/" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
												<input type="submit" class="btn btn-success"  value="Update" name="update">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
<script type="text/javascript">
$(document).ready(function(){
		
		//$('.dropdown').hide();
	$('#question_type').on('change',function(e){
		
			var id = $(this).val();
			if(id)
			{
				 $('.dropdown').siblings('[id^=drop_]').hide();
				 $("#drop_" + id).show();
			}else{
				$("#drop_" + id).hide();
			}
			
	});
	
	 $('.second_answer').on('click',function( e ){ 
			if ($(this).is(":checked")) { 
					$("#answer_two").show();
			}else{ alert( 's')
					$("#answer_two").hide();
			}
			
		 });
		 
		
		 
});
</script>
			