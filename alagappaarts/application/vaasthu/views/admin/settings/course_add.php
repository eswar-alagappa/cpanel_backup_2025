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
                                    <h2>Course <small>Add</small></h2>
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

                                    <form id="" name="" method="POST" action="<?php echo base_url()?>vaasthu/admin/master/courses/add" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Course Info</span>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Select Program <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="program_id" id="program_id">
													<option value="">Select Program</option>
													<?php if(!empty($programList)) { foreach($programList as $k=>$program){?>
														<option value="<?php echo $program->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && ($post_set['program_id']== $program->program_id) ? 'selected' : '');?>><?php echo $program->name; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('program_id'); ?>
                                            </div>
                                        </div>
                                       

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course code <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="course_code" value="<?php echo (isset($post_set['course_code']) && !empty($post_set['course_code']) ? $post_set['course_code'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="course_code" placeholder="Course Code" required="required" type="text">
												<?php echo form_error('course_code'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="course_name" value="<?php echo (isset($post_set['course_name']) && !empty($post_set['course_name']) ? $post_set['course_name'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="course_name" placeholder="Course Name" required="required" type="text">
												<?php echo form_error('course_name'); ?>
                                            </div>
                                        </div>
										
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="course_description" required="required" placeholder="Description" name="course_description" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['course_description']) && !empty($post_set['course_description']) ? $post_set['course_description'] : '');?></textarea>
												<?php echo form_error('course_description'); ?>
                                            </div>
                                        </div>
										
										
										<fieldset id="examquestion" class="">
										<legend>Exam &amp; Question settings </legend>

										
		<div id="entry1" class="clonedInput">
          
        

        <!-- Select Basic -->
      
        <div class="form-group col-md-3 col-sm-6 col-xs-12">
            <select class="select_ttl form-control" name="partition[]" id="partition">
              <option value="" selected="selected" disabled="disabled">Select Partition</option>
              <?php for($i=1;$i<=7;$i++){?>
			  <option value="<?php echo $i ?>">Part - <?php echo $i?></option>
			  <?php } ?>
            </select> <!-- end .select_ttl -->
			<?php echo form_error('partition[]'); ?>
          </div>
	
	
	  <!-- Select Basic -->
       
        <div class="form-group col-md-3 col-sm-6 col-xs-12">
            <select class="select_tt2 form-control" name="question_type[]" id="question_type">
              <option value="" selected="selected" disabled="disabled">Select Question type</option>
			  <?php if(isset($questionType) && !empty($questionType)){
				  foreach($questionType as $k=>$question){?>
				  <option value="<?php echo $k ?>"><?php echo $question?></option>
			  <?php }}?>
           
            </select> <!-- end .select_ttl -->
			<?php echo form_error('question_type[]'); ?>
          </div>

		  
		  
        <!-- Text input-->
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
         
          <input id="no_of_question" name="no_of_question[]" type="text" placeholder="No Of Question" class="input_noof_quest form-control" >
		  <?php echo form_error('no_of_question[]'); ?>
        </div>


       

        </div>
		<div class="form-group col-md-12 col-sm-6 col-xs-12">	
		 <p>
        <button type="button" id="btnAdd" name="btnAdd" class="btn btn-info">add section</button>
          <button type="button" id="btnDel" name="btnDel" class="btn btn-danger">remove section above</button>
        </p>
		</div>
										
		</fieldset>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Regulation <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="regulation_id" id="regulation_id">
													<option value="">Select Regulation</option>
													<?php if(!empty($regulationList)) { foreach($regulationList as $k=>$regulation){?>
														<option value="<?php echo $k; ?>" <?php echo (isset($post_set['regulation_id']) && !empty($post_set['regulation_id'])  && ($post_set['regulation_id']== $k) ? 'selected' : '');?>><?php echo $regulation; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('regulation_id'); ?>
                                            </div>
                                        </div>
										
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Exam Duration <span class="required">*</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="exam_duration_hours" name="exam_duration_hours" placeholder="Hours" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['exam_duration_hours']) && !empty($post_set['exam_duration_hours']) ? $post_set['exam_duration_hours'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('exam_duration_hours'); ?>
                                            </div>
											
											<div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="exam_duration_mins" name="exam_duration_mins" placeholder="Mins" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['exam_duration_mins']) && !empty($post_set['exam_duration_mins']) ? $post_set['exam_duration_mins'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('exam_duration_mins'); ?>
                                            </div>
											
                                        </div>
										
										
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Exam attempt Limit <span class="required">*</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="exam_attempt_limit" placeholder="Month" name="exam_attempt_limit" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['exam_attempt_limit']) && !empty($post_set['exam_attempt_limit']) ? $post_set['exam_attempt_limit'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('exam_attempt_limit'); ?>
                                            </div>
											
                                        </div>
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>vaasthu/admin/master/courses/" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
			