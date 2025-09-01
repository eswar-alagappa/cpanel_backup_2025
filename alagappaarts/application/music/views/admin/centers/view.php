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
<?php 
 $CI =& get_instance();
 
?>
<!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                   

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Centers <small>View</small></h2>
									
									
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
										<label>Academy name : </label>
										<span><?php echo $selectedValues->academyname ?></span>  
										</li> 
										 <li>
										<label>Academy Username : </label>
										<span><?php 
											echo $selectedValues->username ; ?></span>  
										</li> 
										   <li>
										<label>Academy Password : </label>
										<span><?php 
											echo $CI->decode($selectedValues->password) ; ?></span>  
										</li> 
										  
										 <li>
										<label>Academy Email : </label>
										<span><?php 
											echo $selectedValues->academyemail ; ?></span>  
										</li> 
										
										 <li>
										<label>Address : </label>
										<span><?php echo $selectedValues->academyaddress ?></span>  
										</li> 
										
										 <li>
										<label>Website : </label>
										<span><?php echo $selectedValues->website ?></span>  
										</li> 
										
										 <li>
										<label>Contact : </label>
										<span><?php echo $selectedValues->contact ?></span>  
										</li> 
										
										 <li>
										<label>Alternate Contact : </label>
										<span><?php echo $selectedValues->alternate_contact ?></span>  
										</li> 
										
										 <li>
										<label>City : </label>
										<span><?php echo $selectedValues->acity ?></span>  
										</li> 
										
										 <li>
										<label>State : </label>
										<span><?php echo $selectedValues->astate; ?></span>  
										</li> 
										
										 <li>
										<label>Country : </label>
										<span><?php echo $selectedValues->acountry ?></span>  
										</li> 
										
										 <li>
										<label>Zipcode : </label>
										<span><?php echo $selectedValues->azip ?></span>  
										</li> 
										
										 <li>
										<label>No.of.Arangetram : </label>
										<span><?php echo $selectedValues->no_of_arangetram ?></span>  
										</li> 
										
										 <li>
										<label>No.of Establishment : </label>
										<span><?php echo $selectedValues->no_of_establishment ?></span>  
										</li> 
										
										 <li>
										<label>Director name : </label>
										<span><?php echo $selectedValues->cdname ?></span>  
										</li> 
										
										 <li>
										<label>Director Email : </label>
										<span><?php echo $selectedValues->cdemail ?></span>  
										</li> 
										
										 <li>
										<label>Director Date of birth : </label>
										<span><?php echo date('d/m/Y',strtotime($selectedValues->cddob)); ?></span>  
										</li> 
										
										 <li>
										<label>Director Address : </label>
										<span><?php echo $selectedValues->cdaddress ?></span>  
										</li> 
										
										<li>
										<label>Director State : </label>
										<span><?php echo $selectedValues->cdstate ?></span>  
										</li> 
										
										<li>
										<label>Director City : </label>
										<span><?php echo $selectedValues->cdcity ?></span>  
										</li> 
										
										<li>
										<label>Director Country : </label>
										<span><?php echo $selectedValues->cdcountry ?></span>  
										</li> 
										
										<li>
										<label>Director Zipcode : </label>
										<span><?php echo $selectedValues->cdzip ?></span>  
										</li> 
										
										<li>
										<label>Special Qualification : </label>
										<span><?php echo $selectedValues->special_qualification ?></span>  
										</li> 
										
										<li>
										<label>Bharathanatiyam Experinece  : </label>
										<span><?php echo $selectedValues->experience_bharathanatiyam ?></span>  
										</li> 
										
										<li>
										<label>Master name : </label>
										<span><?php echo $selectedValues->master_name ?></span>  
										</li>
											
										<li>
										<label>Event Performance : </label>
										<span><?php echo $selectedValues->events_performance ?></span>  
										</li> 

										<li>
										<label>Located At : </label>
										<span><?php echo $selectedValues->located_at ?></span>  
										</li> 
										
										<li>
										<label>Award Title : </label>
										<span><?php echo $selectedValues->award_title ?></span>  
										</li> 
										
										<li>
										<label>Other Relevant Info : </label>
										<span><?php echo $selectedValues->other_relevant_info ?></span>  
										</li> 
										
										<li>
										<label>Ballets Choreographed : </label>
										<span><?php echo $selectedValues->ballets_choreographed ?></span>  
										</li> 
										
									  

										 <li class=""><a class="saveBtn btn btn-round btn-warning" href="<?php echo base_url().'music/admin/centers/index'?>">Back</a>
										 
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