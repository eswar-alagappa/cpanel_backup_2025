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
                                    <h2>Student <small>Update</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>vaasthu/admin/students/update<?php echo $urlArg;?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Personal Details</span>
										
                                        <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="first_name" value="<?php echo (isset($post_set['first_name']) && !empty($post_set['first_name']) ? $post_set['first_name'] : $selectedValues->firstname );?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="first_name" placeholder="Firstname" required="required" type="text">
												<?php echo form_error('first_name'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="address" required="required" placeholder="Addresss" name="address" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['address']) && !empty($post_set['address']) ? $post_set['address'] : $selectedValues->address);?></textarea>
												<?php echo form_error('address'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="last_name" value="<?php echo (isset($post_set['last_name']) && !empty($post_set['last_name']) ? $post_set['last_name'] : $selectedValues->lastname);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="last_name" placeholder="Lastname" required="required" type="text">
												<?php echo form_error('last_name'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="city" value="<?php echo (isset($post_set['city']) && !empty($post_set['city']) ? $post_set['city'] : $selectedValues->city);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="city" placeholder="City" required="required" type="text">
												<?php echo form_error('city'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="username" value="<?php echo (isset($post_set['username']) && !empty($post_set['username']) ? $post_set['username'] : $selectedValues->username);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Username" required="required" type="text">
												<?php echo form_error('username'); ?>
                                            </div>											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="state" value="<?php echo (isset($post_set['state']) && !empty($post_set['state']) ? $post_set['state'] : $selectedValues->state);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="state" placeholder="State" required="required" type="text">
												<?php echo form_error('state'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="datepicker" value="<?php echo (isset($post_set['dob']) && !empty($post_set['dob']) ? $post_set['dob'] : $selectedValues->dob);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="dob" placeholder="Date Of birth" required="required" type="text">
												<?php echo form_error('dob'); ?>
                                            </div>		
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="country" value="<?php echo (isset($post_set['country']) && !empty($post_set['country']) ? $post_set['country'] : $selectedValues->country);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="country" placeholder="Country" required="required" type="text">
												<?php echo form_error('country'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">                                            
                                             <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="age" value="<?php echo (isset($post_set['age']) && !empty($post_set['age']) ? $post_set['age'] : $selectedValues->age);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="age" placeholder="Age" required="required" type="text">
												<?php echo form_error('age'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="zip" value="<?php echo (isset($post_set['zip']) && !empty($post_set['zip']) ? $post_set['zip'] : $selectedValues->zip);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="zip" placeholder="Zipcode" required="required" type="text">
												<?php echo form_error('zip'); ?>
                                            </div>											
                                        </div>
										
										<div class="item form-group">                                            
                                           
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <!--<input id="gender" value="<?php echo (isset($post_set['gender']) && !empty($post_set['gender']) ? $post_set['gender'] : $selectedValues->gender);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="gender" placeholder="Gender"  type="text">-->
												
												 <div class="radio radio-info radio-inline" style="text-align:left">
          <input type="radio" id="inlineRadio1" value="M" name="gender" <?php if( !empty($post_set['gender']) && $post_set['gender'] =='Male') { ?> checked <?php }elseif($selectedValues->gender=='Male'){?>checked<?php }else{ ?>checked<?php } ?> >
          <label for="inlineRadio1"> Male</label>
        </div>
        <div class="radio radio-info radio-inline">
          <input type="radio" id="inlineRadio2" value="F" name="gender" <?php if(!empty($post_set['gender']) && $post_set['gender'] =='Female') { ?> checked <?php }elseif($selectedValues->gender=='Female'){?>checked<?php } ?> >
          <label for="inlineRadio2"> Female</label>
        </div>
		
												<?php echo form_error('gender'); ?>
                                            </div>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="email" value="<?php echo (isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : $selectedValues->email);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="email" placeholder="Email" required="required" type="text">
												<?php echo form_error('email'); ?>
                                            </div>											
                                        </div>
                                       
                                        <div class="item form-group">   
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="contact" value="<?php echo (isset($post_set['contact']) && !empty($post_set['contact']) ? $post_set['contact'] : $selectedValues->phone);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="contact" placeholder="Mobile"  type="text">
												<?php echo form_error('contact'); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="alternate_contact" value="<?php echo (isset($post_set['alternate_contact']) && !empty($post_set['alternate_contact']) ? $post_set['alternate_contact'] : $selectedValues->alternate_phone);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="alternate_contact" placeholder="Alternate Phone Number"  type="text">
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
														<option value="<?php echo $pgm->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && (in_array($pgm->program_id,$post_set['program_id'])) ? 'selected="selected"' : 
														((isset($selectedPgmList) && !empty($selectedPgmList)  && (in_array($pgm->program_id,$selectedPgmList)) ? 'selected="selected"' :'')));?>><?php echo stripslashes($pgm->name); ?></option>
													<?php } } ?>
											   </select>
											   <?php //echo form_error('program_id[]'); ?>
                                            </div>
                                        </div>
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Stream 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="stream[]" id="stream" multiple="multiple" style="height:150px">
													<option value="">Select Stream</option>
													<?php if(!empty($sreatm)) { foreach($sreatm as $k=>$str){?>
														<option value="<?php echo $k; ?>" <?php echo (isset($post_set['stream']) && !empty($post_set['stream'])  && (in_array($k,$post_set['stream'])) ? 'selected="selected"' : 
														((isset($selectedStreamList) && !empty($selectedStreamList)  && (in_array($k,$selectedStreamList)) ? 'selected="selected"' :'')));?>><?php echo $str; ?></option>
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
														<option value="<?php echo $center->center_academy_id; ?>" <?php echo (isset($post_set['center_id']) && !empty($post_set['center_id'])  && ($post_set['center_id']== $center->center_academy_id) ? 'selected' : 
														((isset($selectedValues->center_id) && !empty($selectedValues->center_id)  && ($selectedValues->center_id== $center->center_academy_id)) ? 'selected' :''));?>><?php echo $center->name; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('center_id'); ?>
                                            </div>
                                        </div>
										
										
										
										<div class="ln_solid"></div>
										
										 <span class="section">Bharatanatyam Details</span>
										 
										 
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="exp_bharatanatyam" value="<?php echo (isset($post_set['exp_bharatanatyam']) && !empty($post_set['exp_bharatanatyam']) ? $post_set['exp_bharatanatyam'] : $selectedValues->bharathanatiyam_experience);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="exp_bharatanatyam" placeholder="Experience in bharatanatyam"  type="text">
												<?php echo form_error('exp_bharatanatyam'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="special_accomplished" value="<?php echo (isset($post_set['special_accomplished']) && !empty($post_set['special_accomplished']) ? $post_set['special_accomplished'] : $selectedValues->special_accomplishment);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="special_accomplished" placeholder="Special Accomplished" required="required" type="text">
												<?php echo form_error('special_accomplished'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group"> 		
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name_of_guru" value="<?php echo (isset($post_set['name_of_guru']) && !empty($post_set['name_of_guru']) ? $post_set['name_of_guru'] : $selectedValues->name_of_master);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name_of_guru" placeholder="Name of your Guru" required="required" type="text">
												<?php echo form_error('name_of_guru'); ?>
                                            </div>	
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="located_at" value="<?php echo (isset($post_set['located_at']) && !empty($post_set['located_at']) ? $post_set['located_at'] : $selectedValues->master_located_at);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="located_at" placeholder="Located At" required="required" type="text">
												<?php echo form_error('located_at'); ?>
                                            </div>		
                                        </div>
										 
										 
										  <div class="item form-group"> 		
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="other_relevant_info" required="required" placeholder="Other Relevant Info" name="other_relevant_info" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['other_relevant_info']) && !empty($post_set['other_relevant_info']) ? $post_set['other_relevant_info'] : $selectedValues->other_relevant_info);?></textarea>
												<?php echo form_error('other_relevant_info'); ?>
                                            </div>		
                                        </div>
										
										
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>vaasthu/admin/students/index" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	   yearRange: '-85:-08',
	   dateFormat: 'yy-mm-dd',
    });
});
</script>  