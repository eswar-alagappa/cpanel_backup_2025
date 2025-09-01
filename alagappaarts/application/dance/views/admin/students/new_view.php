<style>
.addProgramForm ul{
	 display: block;
    margin: 0 auto;
    overflow: hidden;
    padding: 0;
    width: 445px;
}
.addProgramForm ul li {
    display: block;
    list-style-type: none;
    margin-bottom: 20px;
    overflow: hidden;
}

.addProgramForm ul li label {
    float: left;
    padding-top: 0;
    width: 200px;
}

.addProgramForm ul li span {
    float: left;
}
</style>
<!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                   

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Student <small>View</small></h2>
									
									
									<?php if ($this->session->flashdata('SucMessage')!='') { ?>
										  <div class="alert alert-success alert-dismissable">
												<i class="fa fa-check"></i>
												<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												<b>Alert!</b>
												<?php echo $this->session->flashdata('SucMessage') ;   ?>
											</div>
									<?php } ?>
									
                                   
                                </div>
								
                                <div class="x_content">
                                    
									
									<div class="addProgramForm">
									  <ul>
									 
										 
										
										<li>
										<label>Firstname : </label>
										<span><?php echo $selectedValues->firstname ?></span>  
										</li> 
										
										 <li>
										<label>Lastname : </label>
										<span><?php echo $selectedValues->lastname ?></span>  
										</li> 
										
										 <li>
										<label>Age : </label>
										<span><?php echo $selectedValues->age ?></span>  
										</li> 
										
										 <li>
										<label>Date of birth : </label>
										<span><?php echo date('d/m/Y',strtotime($selectedValues->dob)); ?></span>  
										</li> 
										
										 <li>
										<label>Gender : </label>
										<span><?php echo $selectedValues->gender ?></span>  
										</li> 
										
										
										 <li>
										<label>Mobile : </label>
										<span><?php echo $selectedValues->mobileno ?></span>  
										</li>
										
										<li>
										<label>Alter Mobile : </label>
										<span><?php echo $selectedValues->altermobileno ?></span>  
										</li>
										
										 <li>
										<label>Email : </label>
										<span><?php echo $selectedValues->email ?></span>  
										</li>
										
										<li>
										<label>Father Name : </label>
										<span><?php echo $selectedValues->father_name ?></span>  
										</li>
										<li>
										<label>Father Occupation : </label>
										<span><?php echo $selectedValues->father_occ ?></span>  
										</li>
										<li>
										<label>Mother Name : </label>
										<span><?php echo $selectedValues->mother_name ?></span>  
										</li>
										<li>
										<label>Mother Occupation : </label>
										<span><?php echo $selectedValues->mother_occ ?></span>  
										</li>
										
										 <li>
										<label>Address : </label>
										<span><?php echo $selectedValues->address ?></span>  
										</li> 
										
										 <li>
										<label>City : </label>
										<span><?php echo $selectedValues->city ?></span>  
										</li> 
										
										 <li>
										<label>State : </label>
										<span><?php echo $selectedValues->state ?></span>  
										</li> 
										
										 <li>
										<label>Country : </label>
										<span><?php echo $selectedValues->country ?></span>  
										</li> 
										
										 <li>
										<label>Zipcode : </label>
										<span><?php echo $selectedValues->zip ?></span>  
										</li> 
										<li>
										<label>Photo : </label>
										<a href="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->photo; ?>" target="_blank">View</a>
										<!--<span><img src="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->photo; ?>" style="width:32px;" /></span>  -->
										</li>
										<li>
										<label>Birth Certificate : </label>
										<a href="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->birth_certificate; ?>" target="_blank">View</a>
										<!--<span><img src="<?php echo base_url(); ?>assets/profile/<?php echo $selectedValues->photo; ?>" style="width:32px;" /></span>  -->
										</li>
										 <li>
										<label>Level  : </label>
										<span><?php echo $selectedValues->level  ?></span>  
										</li> 
										
										 <li>
										<label>Name of institution : </label>
										<span><?php echo $selectedValues->nameofins ?></span>  
										</li> 
										
									<!--	<li>
										<label>City : </label>
										<span><?php echo $selectedValues->acacity ?></span>  
										</li> 
										
										 <li>
										<label>State : </label>
										<span><?php echo $selectedValues->acastate ?></span>  
										</li> 
										
										 <li>
										<label>Country : </label>
										<span><?php echo $selectedValues->acacountry ?></span>  
										</li> -->
										
										<li>
										<label>Bharathanatiyam Experience : </label>
										<span><?php echo $selectedValues->expinbhar ?></span>  
										</li> 
										
										<li>
										<label>Special accomplishments (if any) : </label>
										<span><?php echo $selectedValues->specquali ?></span>  
										</li> 
										
										<li>
										<label>Name of your Guru : </label>
										<span><?php echo $selectedValues->nameofguru ?></span>  
										</li> 
										
										<li>
										<label>Name of the Dance Institution : </label>
										<span><?php echo $selectedValues->nameofdance ?></span>  
										</li> 
										
										<li>
										<label>Mobile : </label>
										<span><?php echo $selectedValues->bharmobileno ?></span>  
										</li>
										
										<li>
										<label>Credentials & Awards : </label>
										<span><?php echo $selectedValues->bharaltermobno ?></span>  
										</li>
										
										 <li>
										<label>Address : </label>
										<span><?php echo $selectedValues->bharaddress ?></span>  
										</li> 
										
										<!--<li>
										<label>City : </label>
										<span><?php echo $selectedValues->bharcity ?></span>  
										</li> 
										
										 <li>
										<label>State : </label>
										<span><?php echo $selectedValues->bharstate ?></span>  
										</li> 
										
										 <li>
										<label>Country : </label>
										<span><?php echo $selectedValues->bharcountry ?></span>  
										</li> 
										
										 <li>
										<label>Zipcode : </label>
										<span><?php echo $selectedValues->bharzip ?></span>  
										</li>-->
										
										<li>
										<label>Program Enroll : </label>
										<span><?php echo $selectedValues->program_enroll ?></span>  
										</li>
										
										 
									  

										 <li class=""><a class="saveBtn btn btn-round btn-warning" href="<?php echo base_url().'dance/admin/students/new_students_list'?>">Back</a>
										 
										</li>
									  
									  </ul>
									  </div>
	  
									
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
                    <!-- footer content -->
                <!--<footer>
                    <div class="">
                        <p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                            <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>-->
                <!-- /footer content -->
                    
                </div>