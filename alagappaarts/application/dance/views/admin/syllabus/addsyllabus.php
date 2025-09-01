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
                                    <h2>Syllabus <small>Add</small></h2>
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

                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/syllabus/addsyllabus" class="form-horizontal form-label-left"  enctype='multipart/form-data'>
                                    
									
                                       
                                       <span class="section">Add syllabus Info</span>
										
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
                                        <div class="item form-group ">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Enter Video Url<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 field_wrapper">
                                                
                                                 <input type="text" name="video_title[]"  class="form-control col-md-7 col-xs-12" placeholder="Enter Video Url title" title="Enter Video Url Title" value=""/>
                                                 <?php echo form_error('video_title[]'); ?>
                                                <input type="text" name="video_url[]"  class="form-control col-md-7 col-xs-12" placeholder="Enter Video Url" title="Enter Video Url" value=""/>
                                               <?php echo form_error('video_url[]'); ?>
                                               <textarea id="video_desc" name="video_desc[]" class="form-control col-md-7 col-xs-12" placeholder="Video Description"></textarea>
												<?php echo form_error('video_desc[]'); ?>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-1  ">
                                            <a href="javascript:void(0);" class="add_input_button"><img src="<?php echo base_url().'/assets/img/'?>add-icon.png"/></a>
                                            </div>
                                            
                                        </div>
                                         
                                        
                                        
                                        <div class="table-responsive item form-group">  
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Select PDF file<span class="required">*</span></label>
                                            <table class="col-md-6 col-sm-6 col-xs-12" id="dynamic_field">  
                                                <tr>  
                                                    <td>
                                                        <input type="text" name="pdf_title[]"  class="form-control col-md-7 col-xs-12" placeholder="Enter Pdf file title" title="Enter Pdf file Title" value=""/>
                                                    </td>
                                                    <td><input type="file" name='files[]' accept="pdf"  placeholder="Please select PDF file" class="form-control name_list col-md-7 col-xs-12"  />
                                                    <?php echo form_error('files[]'); ?>
                                                    </td> 
                                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                                </tr>  
                                                
                                            </table>  
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Syllabus<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <textarea id="syllabus_content" required="required" placeholder="Syllabus Content" name="syllabus_content" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['syllabus_content']) && !empty($post_set['syllabus_content']) ? $post_set['syllabus_content'] : '');?></textarea>
												<?php echo form_error('syllabus_content'); ?>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Key Aspects<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <textarea id="key_aspects" required="required" placeholder="Key Aspects" name="key_aspects" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['key_aspects']) && !empty($post_set['key_aspects']) ? $post_set['key_aspects'] : '');?></textarea>
												<?php echo form_error('key_aspects'); ?>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Guidelines<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <textarea id="guidelines" required="required" placeholder="Guidelines" name="guidelines" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['guidelines']) && !empty($post_set['guidelines']) ? $post_set['guidelines'] : '');?></textarea>
												<?php echo form_error('guidelines'); ?>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/syllabus/syllabus_list" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
            <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
            <script>
              $(function () {
                CKEDITOR.replace('syllabus_content');
                CKEDITOR.replace('key_aspects');
                CKEDITOR.replace('guidelines');
                CKEDITOR.replace('video_desc');
              });
            </script>
			
			<style>
	.Zebra_DatePicker *,.Zebra_DatePicker :after,.Zebra_DatePicker :before{-moz-box-sizing:content-box!important;-webkit-box-sizing:content-box!important;box-sizing:content-box!important}
.Zebra_DatePicker{position:absolute;background:#666;border:3px solid #666;z-index:1200;font-family:Tahoma,Arial,Helvetica,sans-serif;font-size:13px;top:0}
.Zebra_DatePicker *{margin:0;padding:0;color:#000;background:transparent;border:none}
.Zebra_DatePicker table{border-collapse:collapse;border-spacing:0;width:auto;table-layout:auto}
.Zebra_DatePicker td,.Zebra_DatePicker th{text-align:center;padding:5px 0}
.Zebra_DatePicker td{cursor:pointer}
.Zebra_DatePicker .dp_daypicker,.Zebra_DatePicker .dp_monthpicker,.Zebra_DatePicker .dp_yearpicker{margin-top:3px}
.Zebra_DatePicker .dp_daypicker td,.Zebra_DatePicker .dp_daypicker th,.Zebra_DatePicker .dp_monthpicker td,.Zebra_DatePicker .dp_yearpicker td{background:#E8E8E8;width:30px;border:1px solid #7BACD2}
.Zebra_DatePicker,.Zebra_DatePicker .dp_header .dp_hover,.Zebra_DatePicker .dp_footer .dp_hover{-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px}
.Zebra_DatePicker.dp_visible{visibility:visible;filter:alpha(opacity=100);-khtml-opacity:1;-moz-opacity:1;opacity:1;transition:opacity .2s ease-in-out}
.Zebra_DatePicker.dp_hidden{visibility:hidden;filter:alpha(opacity=0);-khtml-opacity:0;-moz-opacity:0;opacity:0}
.Zebra_DatePicker .dp_header td{color:#FFF}
.Zebra_DatePicker .dp_header .dp_previous,.Zebra_DatePicker .dp_header .dp_next{width:30px}
.Zebra_DatePicker .dp_header .dp_caption{font-weight:700}
.Zebra_DatePicker .dp_header .dp_hover{background:#222;color:#FFF}
.Zebra_DatePicker .dp_daypicker th{background:#FC3}
.Zebra_DatePicker td.dp_not_in_month{background:#F3F3F3;color:#CDCDCD;cursor:default}
.Zebra_DatePicker td.dp_not_in_month_selectable{background:#F3F3F3;color:#CDCDCD;cursor:pointer}
.Zebra_DatePicker td.dp_weekend{background:#D8D8D8}
.Zebra_DatePicker td.dp_weekend_disabled{color:#CCC;cursor:default}
.Zebra_DatePicker td.dp_selected{background:#5A4B4B;color:#FFF!important}
.Zebra_DatePicker td.dp_week_number{background:#FC3;color:#555;cursor:text;font-style:italic}
.Zebra_DatePicker .dp_monthpicker td{width:33%}
.Zebra_DatePicker .dp_yearpicker td{width:33%}
.Zebra_DatePicker .dp_footer{margin-top:3px}
.Zebra_DatePicker .dp_footer .dp_hover{background:#222;color:#FFF}
.Zebra_DatePicker .dp_today{color:#FFF;padding:3px}
.Zebra_DatePicker .dp_clear{color:#FFF;padding:3px}
.Zebra_DatePicker td.dp_current{color:#C40000}
.Zebra_DatePicker td.dp_disabled_current{color:#E38585}
.Zebra_DatePicker td.dp_disabled{background:#F3F3F3;color:#CDCDCD;cursor:default}
.Zebra_DatePicker td.dp_hover{background:#482424;color:#FFF}
button.Zebra_DatePicker_Icon{display:block;position:absolute;width:16px;height:16px;background:url(calendar.png) no-repeat left top;text-indent:-9000px;border:none;cursor:pointer;padding:0;line-height:0;vertical-align:top}
button.Zebra_DatePicker_Icon_Disabled{background-image:url(calendar-disabled.png)}
button.Zebra_DatePicker_Icon{margin:0 0 0 3px}
button.Zebra_DatePicker_Icon_Inside{margin:0 3px 0 0}


		</style>
			 <!--<script src="<?php echo base_url().'assets/admin/js/zebra_datepicker.js' ?>"></script>-->
			 
			 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
			<script>
			/*$('#datepicker-example1').Zebra_DatePicker({
					show_clear_date: true,
					direction: [true, '2010-01-01'],
					format: 'Y-m-d'   //  note that becase there's no day in the format
					//view: 'years',
					//direction:-1              //  users will not be able to select a day!
				});*/
				
				
				$(document).ready(function () {
    /*$("#datepicker").datepicker({
        yearRange: '-65:-13',
        changeMonth: true,
        changeYear: true,
        defultDate: '1-1-1994',
        dateFormat: 'mm-dd-yy',
        minDate:"-65Y",
        maxDate:"-13Y" 
    });*/
	/* var d = new Date();
	$( "#datepicker" ).datepicker({
		maxDate: new Date((d.getFullYear() - 06), (d.getMonth()), (d.getDate())),
		changeMonth: true,
		changeYear: true,
		yearRange: '-60:-06',
		dateFormat: 'yy-mm-dd',
    });*/
    
    
    var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" id="'+i+'" name="pdf_title[]"  class="form-control col-md-7 col-xs-12" placeholder="Enter Pdf file title" title="Enter Pdf file Title" value=""/></td><td><input type="file" name="files[]" accept="application/pdf" placeholder="Enter your Name" class="form-control name_list col-md-7 col-xs-12" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      
      
      
    
            var max_fields = 25;
            var add_input_button = $('.add_input_button');
            var field_wrapper = $('.field_wrapper');
            
            var input_count = 1;
            // Add button dynamically
            $(add_input_button).click(function(){
            if(input_count < max_fields){
                
            var new_field_html = '<div class="field_wrapper">';
            //new_field_html += '<div class="item form-group"><input class="form-control col-md-7 col-xs-12" type="text" placeholder="Enter Video Url title" title="Enter Video Url Title" name="video_title[]" value=""/><input class="form-control col-md-7 col-xs-12" type="text" placeholder="Enter Video Url" title="Enter Video Url" name="video_url[]" value=""/><div class="col-md-1 col-sm-1 col-xs-1  "><a href="javascript:void(0);" class="remove_input_button" title="Remove field"><img src="../../../assets/img/remove-icon.png"/></a></div> </div>';
            new_field_html += '<div class="item form-group"><input class="form-control col-md-7 col-xs-12" type="text" placeholder="Enter Video Url title" title="Enter Video Url Title" name="video_title[]" value=""/><input class="form-control col-md-7 col-xs-12" type="text" placeholder="Enter Video Url" title="Enter Video Url" name="video_url[]" value=""/><textarea id="video_desc'+input_count+'" name="video_desc[]" class="form-control col-md-7 col-xs-12" placeholder="Video Description"></textarea><div class="col-md-1 col-sm-1 col-xs-1  "><a href="javascript:void(0);" class="remove_input_button" title="Remove field"><img src="../../../assets/img/remove-icon.png"/></a></div> </div>';
            new_field_html += '</div>';
            //CKEDITOR.replace('video_desc'+input_count+'');
            //CKEDITOR.add;
            input_count++;
            $(field_wrapper).append(new_field_html);
            
            }
            });
            // Remove dynamically added button
            $(field_wrapper).on('click', '.remove_input_button', function(e){
            e.preventDefault();
            $(this).parent().parent('div').remove();
            $(this).parent().parent().parent('div').remove();
            //$(this).parent('div').next().find('label').remove();
            input_count--;
            });



});

</script>	

