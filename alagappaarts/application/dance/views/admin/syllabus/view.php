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
										<label>Username : </label>
										<span><?php echo $selectedValues->username ?></span>  
										</li> 
										  
										 <li>
										<label>password : </label>
										<span><?php 
										$CI =& get_instance(); 
										echo $CI->decode($selectedValues->password) ; ?></span>  
										</li> 
										
										 <li>
										<label>Mobile : </label>
										<span><?php echo $selectedValues->mobile ?></span>  
										</li> 
										
										 <li>
										<label>Email : </label>
										<span><?php echo $selectedValues->email ?></span>  
										</li> 
										
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
										<label>Phone : </label>
										<span><?php echo $selectedValues->phone ?></span>  
										</li> 
										
										 <li>
										<label>Alternate Phone : </label>
										<span><?php echo $selectedValues->alternate_phone ?></span>  
										</li> 
										
										<!--<li>
										<label>Bharathanatiyam Experience : </label>
										<span><?php echo $selectedValues->bharathanatiyam_experience ?></span>  
										</li> 
										
										<li>
										<label>Other Info : </label>
										<span><?php echo $selectedValues->other_relevant_info ?></span>  
										</li> 
										
										<li>
										<label>Master name : </label>
										<span><?php echo $selectedValues->name_of_master ?></span>  
										</li> 
										
										<li>
										<label>Master Located At : </label>
										<span><?php echo $selectedValues->master_located_at ?></span>  
										</li> 
										
										<li>
										<label>Special Accomplishment : </label>
										<span><?php echo $selectedValues->special_accomplishment ?></span>  
										</li> -->
									  

										 <li class=""><a class="saveBtn btn btn-round btn-warning" href="<?php echo base_url().'dance/admin/syllabus/index'?>">Back</a>
										 
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