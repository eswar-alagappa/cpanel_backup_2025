
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
                                    <h2>Fees <small>Add</small></h2>
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

                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/master/fees/add" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Fees Info</span>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Select Program <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12 program_id" name="program_id" id="program_id">
													<option value="">Select Program</option>
													<?php if(!empty($programList)) { foreach($programList as $k=>$program){?>
														<option value="<?php echo $program->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && ($post_set['program_id']== $program->program_id) ? 'selected' : '');?>><?php echo stripslashes($program->name); ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('program_id'); ?>
                                            </div>
                                        </div>
                                       

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Registration Fee ( <i class="fa fa-dollar"></i> ) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="register_fee" value="<?php echo (isset($post_set['register_fee']) && !empty($post_set['register_fee']) ? $post_set['register_fee'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="register_fee" placeholder="Registration Fee" required="required" type="text">
												<?php echo form_error('register_fee'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Graduation Fee ( <i class="fa fa-dollar"></i> ) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="graduate_fee" value="<?php echo (isset($post_set['graduate_fee']) && !empty($post_set['graduate_fee']) ? $post_set['graduate_fee'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="graduate_fee" placeholder="Graduation Fee" required="required" type="text">
												<?php echo form_error('graduate_fee'); ?>
                                            </div>
                                        </div>
										
										
		<fieldset id="examquestion" class="">
		<legend>Course Fee </legend>

		<div id="entry1" class="clonedInput">
		<div class="form-group col-md-6 col-sm-6 col-xs-12">
            <select class="select_course form-control" name="course[0][]" id="p_0_course" multiple="multiple" style="height:60px">
              <option value="" >Select Course</option>
			  <?php if(isset($selectedCourse) && !empty($selectedCourse)){
				  foreach($selectedCourse as $k=>$course){?>
				  <option value="<?php echo $course->course_code ?>" <?php echo ((isset($post_set['course']) && !empty($post_set['course']) && (in_array($course->course_code,$post_set['course'])) ) ?  'selected="selected"': '')?> ><?php echo $course->course_code ?></option>
			  <?php }}?>
           
            </select> 
			<?php echo form_error('course[]'); ?>
          </div>

		  
		  
        
        <div class="form-group col-md-6 col-sm-12 col-xs-12">
         
          <input id="amount" name="amount[]" type="text" placeholder="Amount in Dollar" value="<?php echo (isset($post_set['amount']) && !empty($post_set['amount']  ) ?  $post_set['amount'][0]: '')?>" class="input_amount form-control" >
		  <?php echo form_error('amount[]'); ?>
		  <div style="height:60px">&nbsp;</div>
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Penalty Fee ( <i class="fa fa-dollar"></i> ) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="penalty_fee" value="<?php echo (isset($post_set['penalty_fee']) && !empty($post_set['penalty_fee']) ? $post_set['penalty_fee'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="penalty_fee" placeholder="Penalty Fee" required="required" type="text">
												<?php echo form_error('penalty_fee'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Other Fee ( <i class="fa fa-dollar"></i> ) <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="other_fee" value="<?php echo (isset($post_set['other_fee']) && !empty($post_set['other_fee']) ? $post_set['other_fee'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="other_fee" placeholder="Other Fee" required="required" type="text">
												<?php echo form_error('other_fee'); ?>
                                            </div>
                                        </div>
							
										
                                       
                                       
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/master/fees/" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
			
			<script>
			$(document).ready( function() { 	
				
				//var courseTag = document.getElementByTagName("course[]");
				var courseArray = new Array();
				$(document).on("change","[id^='p_']",function(){
					var selectedBox = $(this).attr('id');
					var selectedBoxVal = $(this).val();
					var testSelected = $('#'+selectedBox+' option[value="'+selectedBoxVal+'"]').attr("selected","selected");
						courseArray.push(testSelected.val())
						//alert( courseArray )
						
						//alert( $(this).attr('selected','selected') )
					
				});
				
				 $('.program_id').change(function(){ //any select change on the dropdown with id country trigger this code
                            var program = $('.program_id').val();
							
							if(program !="")
							{ 
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>dance/admin/master/ajaxPgm",
									data: {field_id:'program_id',field_val : program,type:'courses'},
									dataType:"json",
									 //beforeSend : function(r){   $('#dvLoading').addClass('imgloading');	},
									success: function(value) //we're calling the response json array 'cities'
									{
									               //$('#dvLoading').removeClass('imgloading'); 
											//alert(value);
											var obj = value;
											$('#p_0_course').html('');
											var x1 = document.getElementById("p_0_course");
											var option1 = document.createElement("option");
											option1.value = '';
											option1.text = 'Select';
											x1.add(option1);
											


											$.each( value, function( key, val ) {
											
											//$('.selectpicker').selectpicker();
											//$('.selectpicker').selectpicker('refresh');
											var x = document.getElementById("p_0_course");
											
											var option = document.createElement("option");
											option.value = val.course_code;
											option.text = val.course_code;
											//alert(option.text);
											x.add(option);
												
											});
											
									}
									});
							}
							
					});
			});
			</script>
			