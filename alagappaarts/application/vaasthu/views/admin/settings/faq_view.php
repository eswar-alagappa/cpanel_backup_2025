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
                                    <h2>Faq <small>View</small></h2>
									
									
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
										<label>title : </label>
										<span><?php echo $selectedValues->title ?></span>  
										</li> 
										  
										 <li>
										<label>Content : </label>
										<span><?php 
											echo $selectedValues->content ; ?></span>  
										</li> 
										
										 <li>
										<label>Type : </label>
										<span><?php echo $type[$selectedValues->type] ?></span>  
										</li> 
										
										 
										
									  

										 <li class=""><a class="saveBtn btn btn-round btn-warning" href="<?php echo base_url().'vaasthu/admin/settings/faq/'?>">Back</a>
										 
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