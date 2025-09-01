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
                                    <h2>Center <small>Update</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/centers/update<?php echo $urlArg; ?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Academy Details</span>
										
                                        <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_name" value="<?php echo (isset($post_set['academy_name']) && !empty($post_set['academy_name']) ? $post_set['academy_name'] : $selectedValues->academyname);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_name" placeholder="Academy Name" required="required" type="text">
												<?php echo form_error('academy_name'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="academy_address" required="required" placeholder="Addresss" name="academy_address" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['academy_address']) && !empty($post_set['academy_address']) ? $post_set['academy_address'] : $selectedValues->academyaddress );?></textarea>
												<?php echo form_error('academy_address'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group"> 
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="username" value="<?php echo (isset($post_set['username']) && !empty($post_set['username']) ? $post_set['username'] : $selectedValues->username);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Username" required="required" type="text">
												<?php echo form_error('username'); ?>
                                            </div>	
                                            										
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_city" value="<?php echo (isset($post_set['academy_city']) && !empty($post_set['academy_city']) ? $post_set['academy_city'] : $selectedValues->acity);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_city" placeholder="City" required="required" type="text">
												<?php echo form_error('academy_city'); ?>
                                            </div>											
                                        </div>
										<input id="center_user_id" value="<?php echo (isset($post_set['center_user_id']) && !empty($post_set['center_user_id']) ? $post_set['center_user_id'] : $selectedValues->center_user_id);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="center_user_id" placeholder="" required="" type="hidden">
										 <div class="item form-group">  
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_email" value="<?php echo (isset($post_set['academy_email']) && !empty($post_set['academy_email']) ? $post_set['academy_email'] : $selectedValues->academyemail);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_email" placeholder="Email" required="required" type="text">
												<?php echo form_error('academy_email'); ?>
                                            </div>	
                                            										
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_state" value="<?php echo (isset($post_set['academy_state']) && !empty($post_set['academy_state']) ? $post_set['academy_state'] : $selectedValues->astate);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_state" placeholder="State" required="required" type="text">
												<?php echo form_error('academy_state'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">    
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_website" value="<?php echo (isset($post_set['academy_website']) && !empty($post_set['academy_website']) ? $post_set['academy_website'] : $selectedValues->website);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_website" placeholder="Website" required="required" type="text">
												<?php echo form_error('academy_website'); ?>
                                            </div>	
                                            
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_country" value="<?php echo (isset($post_set['academy_country']) && !empty($post_set['academy_country']) ? $post_set['academy_country'] : $selectedValues->acountry);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_country" placeholder="Country" required="required" type="text">
												<?php echo form_error('academy_country'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">    
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_phone" value="<?php echo (isset($post_set['academy_phone']) && !empty($post_set['academy_phone']) ? $post_set['academy_phone'] : $selectedValues->contact);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_phone" placeholder="Contact" required="required" type="text">
												<?php echo form_error('academy_phone'); ?>
                                            </div>
                                            
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_zip" value="<?php echo (isset($post_set['academy_zip']) && !empty($post_set['academy_zip']) ? $post_set['academy_zip'] : $selectedValues->azip);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_zip" placeholder="Zipcode" required="required" type="text">
												<?php echo form_error('academy_zip'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">  
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_alternate_phone" value="<?php echo (isset($post_set['academy_alternate_phone']) && !empty($post_set['academy_alternate_phone']) ? $post_set['academy_alternate_phone'] : $selectedValues->alternate_contact);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_alternate_phone" placeholder="Alternate Contact"  type="text">
												<?php echo form_error('academy_alternate_phone'); ?>
                                            </div>
                                           
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_no_of_arrangetram" value="<?php echo (isset($post_set['academy_no_of_arrangetram']) && !empty($post_set['academy_no_of_arrangetram']) ? $post_set['academy_no_of_arrangetram'] : $selectedValues->no_of_arangetram);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_no_of_arrangetram" placeholder="No Of Arrangetram" required="required" type="text">
												<?php echo form_error('academy_no_of_arrangetram'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group"> 
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="academy_year_of_establishment" value="<?php echo (isset($post_set['academy_year_of_establishment']) && !empty($post_set['academy_year_of_establishment']) ? $post_set['academy_year_of_establishment'] : $selectedValues->no_of_establishment);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="academy_year_of_establishment" placeholder="Year of Establishment"  type="text">
												<?php echo form_error('academy_year_of_establishment'); ?>
                                            </div>
										</div>
                                       
                                        
										<div class="ln_solid"></div>
										 <span class="section">Director's Details</span>
										
										
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="director_name" value="<?php echo (isset($post_set['director_name']) && !empty($post_set['director_name']) ? $post_set['director_name'] : $selectedValues->cdname);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="director_name" placeholder="Director Name" required="required" type="text">
												<?php echo form_error('director_name'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="director_address" required="required" placeholder="Addresss" name="director_address" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['director_address']) && !empty($post_set['director_address']) ? $post_set['director_address'] : $selectedValues->cdaddress);?></textarea>
												<?php echo form_error('director_address'); ?>
                                            </div>											
                                        </div>
										
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="director_datepicker" value="<?php echo (isset($post_set['director_dob']) && !empty($post_set['director_dob']) ? $post_set['director_dob'] : $selectedValues->cddob);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="director_dob" placeholder="Date Of Birth" required="required" type="text">
												<?php echo form_error('director_dob'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="director_state" value="<?php echo (isset($post_set['director_state']) && !empty($post_set['director_state']) ? $post_set['director_state'] : $selectedValues->cdstate);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="director_state" placeholder="State" required="required" type="text">
												<?php echo form_error('director_state'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="director_email" value="<?php echo (isset($post_set['director_email']) && !empty($post_set['director_email']) ? $post_set['director_email'] : $selectedValues->cdemail);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="director_email" placeholder="Email"  type="text">
												<?php echo form_error('director_email'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="director_country" value="<?php echo (isset($post_set['director_country']) && !empty($post_set['director_country']) ? $post_set['director_country'] : $selectedValues->cdcountry);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="director_country" placeholder="Country" required="required" type="text">
												<?php echo form_error('director_country'); ?>
                                            </div>											
                                        </div>
										
										
										<div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="director_special_qualification" required="required" placeholder="Special Qualification" name="director_special_qualification" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['director_special_qualification']) && !empty($post_set['director_special_qualification']) ? $post_set['director_special_qualification'] : $selectedValues->special_qualification);?></textarea>
												<?php echo form_error('director_special_qualification'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="director_zip" value="<?php echo (isset($post_set['director_zip']) && !empty($post_set['director_zip']) ? $post_set['director_zip'] : $selectedValues->cdzip);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="director_zip" placeholder="Zipcode" required="required" type="text">
												<?php echo form_error('director_zip'); ?>
                                            </div>		
                                        </div>
										<div class="ln_solid"></div>
										
										 <span class="section">Bharatanatyam Details</span>
										 
										 
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="exp_bharatanatyam" value="<?php echo (isset($post_set['exp_bharatanatyam']) && !empty($post_set['exp_bharatanatyam']) ? $post_set['exp_bharatanatyam'] : $selectedValues->experience_bharathanatiyam);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="exp_bharatanatyam" placeholder="Experience in bharatanatyam"  type="text">
												<?php echo form_error('exp_bharatanatyam'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name_of_guru" value="<?php echo (isset($post_set['name_of_guru']) && !empty($post_set['name_of_guru']) ? $post_set['name_of_guru'] : $selectedValues->master_name);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name_of_guru" placeholder="Name of your Guru" required="required" type="text">
												<?php echo form_error('name_of_guru'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="events_performance" required="required" placeholder="Events Performance" name="events_performance" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['events_performance']) && !empty($post_set['events_performance']) ? $post_set['events_performance'] : $selectedValues->events_performance);?></textarea>
												<?php echo form_error('events_performance'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="located_at" value="<?php echo (isset($post_set['located_at']) && !empty($post_set['located_at']) ? $post_set['located_at'] : $selectedValues->located_at);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="located_at" placeholder="Located At" required="required" type="text">
												<?php echo form_error('located_at'); ?>
                                            </div>		
                                        </div>
										 
										 
										  <div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="awards_title" required="required" placeholder="Awards Title" name="awards_title" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['awards_title']) && !empty($post_set['awards_title']) ? $post_set['awards_title'] : $selectedValues->award_title);?></textarea>
												<?php echo form_error('awards_title'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="other_relevant_info" required="required" placeholder="Other Relevant Info" name="other_relevant_info" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['other_relevant_info']) && !empty($post_set['other_relevant_info']) ? $post_set['other_relevant_info'] : $selectedValues->other_relevant_info);?></textarea>
												<?php echo form_error('other_relevant_info'); ?>
                                            </div>		
                                        </div>
										
										<div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="ballets_choreograph" required="required" placeholder="Ballets Choreographed" name="ballets_choreograph" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['ballets_choreograph']) && !empty($post_set['ballets_choreograph']) ? $post_set['ballets_choreograph'] : $selectedValues->ballets_choreographed);?></textarea>
												<?php echo form_error('ballets_choreograph'); ?>
                                            </div>	
										</div>
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/centers/index" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
			
			<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(document).ready(function () {
	var d = new Date();
	$( "#director_datepicker" ).datepicker({
		maxDate: new Date((d.getFullYear() - 15), (d.getMonth()), (d.getDate())),
      changeMonth: true,
      changeYear: true,
	   yearRange: '-85:-15',
	   dateFormat: 'yy-mm-dd',
    });
});
</script>  
			