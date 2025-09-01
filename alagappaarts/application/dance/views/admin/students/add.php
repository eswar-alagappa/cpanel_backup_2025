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
                                    <h2>Student <small>Add</small></h2>
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

                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/students/add" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Personal Details</span>
										
                                        <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="first_name" value="<?php echo (isset($post_set['first_name']) && !empty($post_set['first_name']) ? $post_set['first_name'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="first_name" placeholder="Firstname" required="required" type="text">
												<?php echo form_error('first_name'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="address" required="required" placeholder="Addresss" name="address" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['address']) && !empty($post_set['address']) ? $post_set['address'] : '');?></textarea>
												<?php echo form_error('address'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="last_name" value="<?php echo (isset($post_set['last_name']) && !empty($post_set['last_name']) ? $post_set['last_name'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="last_name" placeholder="Lastname" required="required" type="text">
												<?php echo form_error('last_name'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="city" value="<?php echo (isset($post_set['city']) && !empty($post_set['city']) ? $post_set['city'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="city" placeholder="City" required="required" type="text">
												<?php echo form_error('city'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="username" value="<?php echo (isset($post_set['username']) && !empty($post_set['username']) ? $post_set['username'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Username" required="required" type="text">
												<?php echo form_error('username'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="state" value="<?php echo (isset($post_set['state']) && !empty($post_set['state']) ? $post_set['state'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="state" placeholder="State" required="required" type="text">
												<?php echo form_error('state'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="datepicker" value="<?php echo (isset($post_set['dob']) && !empty($post_set['dob']) ? $post_set['dob'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="dob" placeholder="Date Of birth" required="required" type="text">
												<?php echo form_error('dob'); ?>
                                            </div>		
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="country" value="<?php echo (isset($post_set['country']) && !empty($post_set['country']) ? $post_set['country'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="country" placeholder="Country" required="required" type="text">
												<?php echo form_error('country'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">                                            
                                             <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="age" value="<?php echo (isset($post_set['age']) && !empty($post_set['age']) ? $post_set['age'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="age" placeholder="Age" required="required" type="text">
												<?php echo form_error('age'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="zip" value="<?php echo (isset($post_set['zip']) && !empty($post_set['zip']) ? $post_set['zip'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="zip" placeholder="Zipcode" required="required" type="text">
												<?php echo form_error('zip'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">                                            
                                           
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <!--<input id="gender" value="<?php echo (isset($post_set['gender']) && !empty($post_set['gender']) ? $post_set['gender'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="gender" placeholder="Gender"  type="text">-->
												
												 <div class="radio radio-info radio-inline" style="text-align:left">
          <input type="radio" id="inlineRadio1" value="Male" name="gender" <?php if( isset($post_set['gender']) && !empty($post_set['gender']) && $post_set['gender'] =='Male') { ?> checked <?php }else{ ?>checked<?php } ?> >
          <label for="inlineRadio1"> Male</label>
        </div>
        <div class="radio radio-info radio-inline">
          <input type="radio" id="inlineRadio2" value="Female" name="gender" <?php if( isset($post_set['gender']) && !empty($post_set['gender']) && $post_set['gender'] =='Female') { ?> checked <?php } ?> >
          <label for="inlineRadio2"> Female</label>
        </div>
		
												<?php echo form_error('gender'); ?>
                                            </div>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="email" value="<?php echo (isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="email" placeholder="Email" required="required" type="text">
												<?php echo form_error('email'); ?>
                                            </div>											
                                        </div>
                                       
                                        <div class="item form-group">   
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="contact" value="<?php echo (isset($post_set['contact']) && !empty($post_set['contact']) ? $post_set['contact'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="contact" placeholder="Mobile"  type="text">
												<?php echo form_error('contact'); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="alternate_contact" value="<?php echo (isset($post_set['alternate_contact']) && !empty($post_set['alternate_contact']) ? $post_set['alternate_contact'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="alternate_contact" placeholder="Alternate Phone Number"  type="text">
												<?php echo form_error('alternate_contact'); ?>
                                            </div>
										</div>
										
										<div class="ln_solid"></div>
										 <span class="section">Interested Program</span>
										
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Program <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="program_id[]" id="program_id" multiple="multiple" style="height:150px">
													<option value="">Select Program</option>
													<?php if(!empty($programs)) { foreach($programs as $k=>$pgm){?>
														<option value="<?php echo $pgm->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && (in_array($pgm->program_id,$post_set['program_id'])) ? 'selected="selected"' : '');?>><?php echo stripslashes($pgm->name); ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('program_id[]'); ?>
                                            </div>
                                        </div>
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Stream 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="stream[]" id="stream" multiple="multiple" style="height:150px">
													<option value="">Select Stream</option>
													<?php if(!empty($sreatm)) { foreach($sreatm as $k=>$str){?>
														<option value="<?php echo $k; ?>" <?php echo (isset($post_set['stream']) && !empty($post_set['stream'])  && (in_array($k,$post_set['stream'])) ? 'selected="selected"' : '');?>><?php echo $str; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('stream'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Centers <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="center_id" id="center_id">
													<option value="">Select Center</option>
													<?php if(!empty($centers)) { foreach($centers as $k=>$center){?>
														<option value="<?php echo $center->center_academy_id; ?>" <?php echo (isset($post_set['center_id']) && !empty($post_set['center_id'])  && ($post_set['center_id']== $center->center_academy_id) ? 'selected' : '');?>><?php echo $center->name; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('center_id'); ?>
                                            </div>
                                        </div>
										
										
										
										<div class="ln_solid"></div>
										
										 <span class="section">Bharatanatyam Details</span>
										 
										 
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="exp_bharatanatyam" value="<?php echo (isset($post_set['exp_bharatanatyam']) && !empty($post_set['exp_bharatanatyam']) ? $post_set['exp_bharatanatyam'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="exp_bharatanatyam" placeholder="Experience in bharatanatyam"  type="text">
												<?php echo form_error('exp_bharatanatyam'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="special_accomplished" value="<?php echo (isset($post_set['special_accomplished']) && !empty($post_set['special_accomplished']) ? $post_set['special_accomplished'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="special_accomplished" placeholder="Special Accomplished" required="required" type="text">
												<?php echo form_error('special_accomplished'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name_of_guru" value="<?php echo (isset($post_set['name_of_guru']) && !empty($post_set['name_of_guru']) ? $post_set['name_of_guru'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name_of_guru" placeholder="Name of your Guru" required="required" type="text">
												<?php echo form_error('name_of_guru'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="located_at" value="<?php echo (isset($post_set['located_at']) && !empty($post_set['located_at']) ? $post_set['located_at'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="located_at" placeholder="Located At" required="required" type="text">
												<?php echo form_error('located_at'); ?>
                                            </div>		
                                        </div>
										 
										 
										  <div class="item form-group"> 		
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="other_relevant_info" required="required" placeholder="Other Relevant Info" name="other_relevant_info" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['other_relevant_info']) && !empty($post_set['other_relevant_info']) ? $post_set['other_relevant_info'] : '');?></textarea>
												<?php echo form_error('other_relevant_info'); ?>
                                            </div>		
                                        </div>
										
										
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/students/index" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
	 var d = new Date();
	$( "#datepicker" ).datepicker({
		maxDate: new Date((d.getFullYear() - 06), (d.getMonth()), (d.getDate())),
		changeMonth: true,
		changeYear: true,
		yearRange: '-60:-06',
		dateFormat: 'yy-mm-dd',
    });
});

			</script>
			