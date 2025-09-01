<div class="right_col" role="main">

                <div class="">
                   
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Settings <small>Update</small></h2>
                                    
                                </div>
                                <div class="x_content">
										
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/master/settings" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Settings Info</span>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
												 <input id="email" value="<?php echo (isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : (( isset($selectedValues->email) && !empty($selectedValues->email)) ? $selectedValues->email : ''));?>" class="form-control col-md-7 col-xs-12" name="email" placeholder="Email" type="text">
												<?php echo form_error('email'); ?>
                                                <!--<label><?php //echo $selectedValues->email ?></label>-->
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input id="username" value="<?php echo (isset($post_set['username']) && !empty($post_set['username']) ? $post_set['username'] : (( isset($selectedValues->username) && !empty($selectedValues->username)) ? $selectedValues->username : ''));?>" class="form-control col-md-7 col-xs-12" name="username" placeholder="Username" type="text">
												<?php echo form_error('username'); ?>
                                            </div>
                                        </div>
										
										
										 <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password 
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input id="password" value="<?php echo (isset($post_set['password']) && !empty($post_set['password']) ? $post_set['password'] : '');?>" class="form-control col-md-7 col-xs-12" name="password" placeholder="Password" type="password">
												<?php echo form_error('password'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Global Password 
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input id="global_password" value="<?php echo (isset($post_set['global_password']) && !empty($post_set['global_password']) ? $post_set['global_password'] : '');?>" class="form-control col-md-7 col-xs-12" name="global_password" placeholder="Global Password" type="password">
												<?php echo form_error('global_password'); ?>
                                            </div>
                                        </div>
										
										
										<?php if($this->session->userdata['su']=="1" && $this->session->userdata['admin_logged_in']=="1"){
											?>
											
											<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Our Admin Password 
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input id="our_admin_password" value="<?php echo (isset($post_set['our_admin_password']) && !empty($post_set['our_admin_password']) ? $post_set['our_admin_password'] : '');?>" class="form-control col-md-7 col-xs-12" name="our_admin_password" placeholder="Our Sanjay  Admin Password" type="password">
												<?php echo form_error('our_admin_password'); ?>
                                            </div>
                                        </div>
										
										<?php } ?>
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												
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
			