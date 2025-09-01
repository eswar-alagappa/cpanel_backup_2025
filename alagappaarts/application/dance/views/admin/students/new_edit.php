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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/students/new_update<?php echo $urlArg;?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Personal Details</span>
										
                                        <div class="item form-group">                                            
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="txtFirstName" value="<?php echo (isset($post_set['txtFirstName']) && !empty($post_set['txtFirstName']) ? $post_set['txtFirstName'] : $selectedValues->firstname );?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtFirstName" placeholder="Firstname" required="required" type="text">
												<?php echo form_error('txtFirstName'); ?>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input id="txtLastName" value="<?php echo (isset($post_set['txtLastName']) && !empty($post_set['txtLastName']) ? $post_set['txtLastName'] : $selectedValues->lastname);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtLastName" placeholder="Lastname" required="required" type="text">
												<?php echo form_error('txtLastName'); ?>
                                            </div>
                                            <div class="col-md-2 col-sm-3 col-xs-12">
                                                <input type="file" class="custom_upload" id="flePhoto" name="flePhoto">
                                                <input type="hidden" name="uploadImage" value="">
                                                <input type="hidden" name="cur_image" value="<?php echo $selectedValues->photo; ?>">
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-12">
                                                <a href="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->photo; ?>" target="_blank">View</a>
                                                <!--<img src="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->photo; ?>" style="width:32px;" />-->
                                            </div>
                                            <div class="col-md-2 col-sm-3 col-xs-12">
                                                <input type="file" class="custom_upload" id="fleBirth" name="fleBirth">
                                                <input type="hidden" name="fleBirth" value="">
                                                <input type="hidden" name="cur_birth_image" value="<?php echo $selectedValues->birth_certificate; ?>">
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-12">
                                                <a href="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->birth_certificate; ?>" target="_blank">View</a>
                                                <!--<img src="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->birth_certificate; ?>" style="width:32px;" />-->
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="txtAge" value="<?php echo (isset($post_set['txtAge']) && !empty($post_set['txtAge']) ? $post_set['txtAge'] : $selectedValues->age);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtAge" placeholder="Age" required="required" type="text">
												<?php echo form_error('txtAge'); ?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="datepicker" value="<?php echo (isset($post_set['txtDOB']) && !empty($post_set['txtDOB']) ? $post_set['txtDOB'] : $selectedValues->dob);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtDOB" placeholder="Date Of birth" required="required" type="text">
												<?php echo form_error('txtDOB'); ?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <!--<input id="gender" value="<?php echo (isset($post_set['gender']) && !empty($post_set['gender']) ? $post_set['gender'] : $selectedValues->gender);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="gender" placeholder="Gender"  type="text">-->
												<div class="radio radio-info radio-inline" style="text-align:left">
                                                  <input type="radio" id="inlineRadio1" value="Male" name="txtGender" <?php if( !empty($post_set['txtGender']) && $post_set['txtGender'] =='Male') { ?> checked <?php }elseif($selectedValues->gender=='Male'){?>checked<?php }else{ ?><?php } ?> >
                                                  <label for="inlineRadio1"> Male</label>
                                                </div>
                                                <div class="radio radio-info radio-inline">
                                                  <input type="radio" id="inlineRadio2" value="Female" name="txtGender" <?php if(!empty($post_set['txtGender']) && $post_set['txtGender'] =='Female') { ?> checked <?php }elseif($selectedValues->gender=='Female'){?>checked<?php } ?> >
                                                  <label for="inlineRadio2"> Female</label>
                                                </div>
                                        		
                                        		<?php echo form_error('txtGender'); ?>
                                            </div>
                                        </div>
                                        <div class="item form-group">   
											 <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="txtMobileNo" value="<?php echo (isset($post_set['txtMobileNo']) && !empty($post_set['txtMobileNo']) ? $post_set['txtMobileNo'] : $selectedValues->mobileno);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtMobileNo" placeholder="Mobile"  type="text">
												<?php echo form_error('txtMobileNo'); ?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="txtAlterMobileNo" value="<?php echo (isset($post_set['txtAlterMobileNo']) && !empty($post_set['txtAlterMobileNo']) ? $post_set['txtAlterMobileNo'] : $selectedValues->altermobileno);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtAlterMobileNo" placeholder="Alternate Phone Number"  type="text">
												<?php echo form_error('txtAlterMobileNo'); ?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="txtEmail" value="<?php echo (isset($post_set['txtEmail']) && !empty($post_set['txtEmail']) ? $post_set['txtEmail'] : $selectedValues->email);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtEmail" placeholder="Email" required="required" type="text">
												<?php echo form_error('txtEmail'); ?>
                                            </div>
										</div>
										
										<div class="item form-group">   
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtFatherName" value="<?php echo (isset($post_set['txtFatherName']) && !empty($post_set['txtFatherName']) ? $post_set['txtFatherName'] : $selectedValues->father_name);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtFatherName" placeholder="Father Name"  type="text">
												<?php echo form_error('txtFatherName'); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtFatherOcc" value="<?php echo (isset($post_set['txtFatherOcc']) && !empty($post_set['txtFatherOcc']) ? $post_set['txtFatherOcc'] : $selectedValues->father_occ);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtFatherOcc" placeholder="Father Occupation"  type="text">
												<?php echo form_error('txtFatherOcc'); ?>
                                            </div>
										</div>
										<div class="item form-group">   
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtMotherName" value="<?php echo (isset($post_set['txtMotherName']) && !empty($post_set['txtMotherName']) ? $post_set['txtMotherName'] : $selectedValues->mother_name);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtMotherName" placeholder="Mother Name"  type="text">
												<?php echo form_error('txtMotherName'); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtMotherOcc" value="<?php echo (isset($post_set['txtMotherOcc']) && !empty($post_set['txtMotherOcc']) ? $post_set['txtMotherOcc'] : $selectedValues->mother_occ);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtMotherOcc" placeholder="Mother Occupation"  type="text">
												<?php echo form_error('txtMotherOcc'); ?>
                                            </div>
										</div>
										
										 <div class="item form-group">                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="txtAddress" required="required" placeholder="Addresss" name="txtAddress" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['txtAddress']) && !empty($post_set['txtAddress']) ? $post_set['txtAddress'] : $selectedValues->address);?></textarea>
												<?php echo form_error('txtAddress'); ?>
                                            </div>											
                                        </div>
										
										 <div class="item form-group">
										    <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtCity" value="<?php echo (isset($post_set['txtCity']) && !empty($post_set['txtCity']) ? $post_set['txtCity'] : $selectedValues->city);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtCity" placeholder="City" required="required" type="text">
												<?php echo form_error('txtCity'); ?>
                                            </div>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtState" value="<?php echo (isset($post_set['txtState']) && !empty($post_set['txtState']) ? $post_set['txtState'] : $selectedValues->state);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtState" placeholder="State" required="required" type="text">
												<?php echo form_error('txtState'); ?>
                                            </div>	
                                        </div>
										
										<div class="item form-group">     
										    <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtCountry" value="<?php echo (isset($post_set['txtCountry']) && !empty($post_set['txtCountry']) ? $post_set['txtCountry'] : $selectedValues->country);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtCountry" placeholder="Country" required="required" type="text">
												<?php echo form_error('txtCountry'); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtZip" value="<?php echo (isset($post_set['txtZip']) && !empty($post_set['txtZip']) ? $post_set['txtZip'] : $selectedValues->zip);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtZip" placeholder="Zipcode" required="required" type="text">
												<?php echo form_error('txtZip'); ?>
                                            </div>		
                                        </div>
										
										<div class="ln_solid"></div>
										<span class="section">Academic Background</span>
										 <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="Level" value="<?php echo (isset($post_set['txtLevel']) && !empty($post_set['txtLevel']) ? $post_set['txtLevel'] : $selectedValues->level);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtLevel" placeholder="Level"  type="text">
												<?php echo form_error('txtLevel'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtNameofIns" value="<?php echo (isset($post_set['txtNameofIns']) && !empty($post_set['txtNameofIns']) ? $post_set['txtNameofIns'] : $selectedValues->nameofins);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtNameofIns" placeholder="Name fo institution" required="required" type="text">
												<?php echo form_error('txtNameofIns'); ?>
                                            </div>											
                                        </div>
                                      <!--  <div class="item form-group">
										    <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="txtAcaCity" value="<?php echo (isset($post_set['txtAcaCity']) && !empty($post_set['txtAcaCity']) ? $post_set['txtAcaCity'] : $selectedValues->acacity);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtAcaCity" placeholder="City" required="required" type="text">
												<?php echo form_error('txtAcaCity'); ?>
                                            </div>
											<div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="txtAcaState" value="<?php echo (isset($post_set['txtAcaState']) && !empty($post_set['txtAcaState']) ? $post_set['txtAcaState'] : $selectedValues->acastate);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtAcaState" placeholder="State" required="required" type="text">
												<?php echo form_error('txtAcaState'); ?>
                                            </div>	
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input id="txtAcaCountry" value="<?php echo (isset($post_set['txtAcaCountry']) && !empty($post_set['txtAcaCountry']) ? $post_set['txtAcaCountry'] : $selectedValues->acacountry);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtAcaCountry" placeholder="Country" required="required" type="text">
												<?php echo form_error('txtAcaCountry'); ?>
                                            </div>
                                        </div> -->
                                        
                                        <div class="ln_solid"></div>
										<span class="section">Experience in Bharathanatyam</span>
										 
										 
										<div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="Level" value="<?php echo (isset($post_set['txtExpInBhar']) && !empty($post_set['txtExpInBhar']) ? $post_set['txtExpInBhar'] : $selectedValues->expinbhar);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtExpInBhar" placeholder="Experience in Bharathanatyam"  type="text">
												<?php echo form_error('txtExpInBhar'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtSpecqualification" value="<?php echo (isset($post_set['txtSpecqualification']) && !empty($post_set['txtSpecqualification']) ? $post_set['txtSpecqualification'] : $selectedValues->specquali);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtSpecqualification" placeholder="Special accomplishments (if any)" required="required" type="text">
												<?php echo form_error('txtSpecqualification'); ?>
                                            </div>											
                                        </div>
                                        <div class="item form-group">                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtNameofGuru" value="<?php echo (isset($post_set['txtNameofGuru']) && !empty($post_set['txtNameofGuru']) ? $post_set['txtNameofGuru'] : $selectedValues->nameofguru);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtNameofGuru" placeholder="Name of your Guru"  type="text">
												<?php echo form_error('txtNameofGuru'); ?>
                                            </div>
											
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtNameofDanceIns" value="<?php echo (isset($post_set['txtNameofDanceIns']) && !empty($post_set['txtNameofDanceIns']) ? $post_set['txtNameofDanceIns'] : $selectedValues->nameofdance);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtNameofDanceIns" placeholder="Name of Dance Institution" required="required" type="text">
												<?php echo form_error('txtNameofDanceIns'); ?>
                                            </div>											
                                        </div>
                                        <div class="item form-group">   
											 <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtBharMobileNo" value="<?php echo (isset($post_set['txtBharMobileNo']) && !empty($post_set['txtBharMobileNo']) ? $post_set['txtBharMobileNo'] : $selectedValues->bharmobileno);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtBharMobileNo" placeholder="Mobile"  type="text">
												<?php echo form_error('txtBharMobileNo'); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtBharAlterMobileNo" value="<?php echo (isset($post_set['txtBharAlterMobileNo']) && !empty($post_set['txtBharAlterMobileNo']) ? $post_set['txtBharAlterMobileNo'] : $selectedValues->bharaltermobno);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtBharAlterMobileNo" placeholder="Alternate Phone Number"  type="text">
												<?php echo form_error('txtBharAlterMobileNo'); ?>
                                            </div>
										</div>
										<div class="item form-group">                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="txtBharAddress" required="required" placeholder="Addresss" name="txtBharAddress" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['txtBharAddress']) && !empty($post_set['txtBharAddress']) ? $post_set['txtBharAddress'] : $selectedValues->bharaddress);?></textarea>
												<?php echo form_error('txtBharAddress'); ?>
                                            </div>											
                                        </div>
										
										 <!--<div class="item form-group">
										    <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtBharCity" value="<?php echo (isset($post_set['txtBharCity']) && !empty($post_set['txtBharCity']) ? $post_set['txtBharCity'] : $selectedValues->bharcity);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtBharCity" placeholder="City" required="required" type="text">
												<?php echo form_error('txtBharCity'); ?>
                                            </div>
											<div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtBharState" value="<?php echo (isset($post_set['txtBharState']) && !empty($post_set['txtBharState']) ? $post_set['txtBharState'] : $selectedValues->bharstate);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtBharState" placeholder="State" required="required" type="text">
												<?php echo form_error('txtBharState'); ?>
                                            </div>	
                                        </div>
										
										<div class="item form-group">     
										    <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtBharCountry" value="<?php echo (isset($post_set['txtBharCountry']) && !empty($post_set['txtBharCountry']) ? $post_set['country'] : $selectedValues->bharcountry);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtBharCountry" placeholder="Country" required="required" type="text">
												<?php echo form_error('txtBharCountry'); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="txtBharZip" value="<?php echo (isset($post_set['txtBharZip']) && !empty($post_set['txtBharZip']) ? $post_set['txtBharZip'] : $selectedValues->bharzip);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="txtBharZip" placeholder="Zipcode" required="required" type="text">
												<?php echo form_error('txtBharZip'); ?>
                                            </div>		
                                        </div>-->
                                        
                                        <div class="ln_solid"></div>
										<span class="section">Program Enroll : </span>
                                        <table class="course" border="1" width="100%" cellspacing="0" cellpadding="0" style="margin-top:10px;margin-bottom:10px;">
                                            <tr>
                                            <th>Certificate</th>
                                            <th>Advanced Certificate</th>
                                            <th>Diploma</th>
                                            <th>Degree</th>
                                            </tr>
                                            <tr>
                                            <td><input type="checkbox" name="txtRegular" class="group" value="Certificate" <?php if($selectedValues->program_enroll == 'Certificate'){ echo 'checked'; } ?> /> Regular</td>
                                            <td><input type="checkbox" name="txtRegular" class="group" value="Advanced Certificate" <?php if($selectedValues->program_enroll == 'Advanced Certificate'){ echo 'checked'; } ?> /> Regular</td>
                                            <td><input type="checkbox" name="txtRegular" class="group" value="Diploma" <?php if($selectedValues->program_enroll == 'Diploma'){ echo 'checked'; } ?> /> Regular</td>
                                            <td><input type="checkbox" name="txtRegular" class="group" value="Degree" <?php if($selectedValues->program_enroll == 'Degree'){ echo 'checked'; } ?> /> Regular</td>
                                            </tr>
                                        </table>
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/students/new_students_list" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
	$( "#datepicker" ).datepicker({
		maxDate: new Date((d.getFullYear() - 06), (d.getMonth()), (d.getDate())),
      changeMonth: true,
      changeYear: true,
	   yearRange: '-60:-06',
	   dateFormat: 'yy-mm-dd',
    });
});
</script>  