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
                                    <h2>Program <small>Add</small></h2>
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

                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/master/programs/add" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Program Info</span>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Program Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="program_name" value="<?php echo (isset($post_set['program_name']) && !empty($post_set['program_name']) ? $post_set['program_name'] : '');?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="program_name" placeholder="Program Name" required="required" type="text">
												<?php echo form_error('program_name'); ?>
                                            </div>
                                        </div>
										
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="program_description" required="required" placeholder="Description" name="program_description" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['program_description']) && !empty($post_set['program_description']) ? $post_set['program_description'] : '');?></textarea>
												<?php echo form_error('program_description'); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Mail Content <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="mail_content" required="required" placeholder="Mail Content" name="mail_content" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['program_description']) && !empty($post_set['program_description']) ? $post_set['program_description'] : '');?></textarea>
												<?php echo form_error('mail_content'); ?>
                                            </div>
                                        </div>
										
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Duration <span class="required">*</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="duration_year" name="duration_year" placeholder="Year" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['duration_year']) && !empty($post_set['duration_year']) ? $post_set['duration_year'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('duration_year'); ?>
                                            </div>
											
											<div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="duration_month" name="duration_month" placeholder="Month" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['duration_month']) && !empty($post_set['duration_month']) ? $post_set['duration_month'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('duration_month'); ?>
                                            </div>
											
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Grace Period <span class="required">*</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="grace_period_year" name="grace_period_year" placeholder="Year" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['grace_period_year']) && !empty($post_set['grace_period_year']) ? $post_set['grace_period_year'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('grace_period_year'); ?>
                                            </div>
											 <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="grace_period_month" name="grace_period_month" placeholder="Month" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['grace_period_month']) && !empty($post_set['grace_period_month']) ? $post_set['grace_period_month'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('grace_period_month'); ?>
                                            </div>
                                        </div>
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Fast Track Duration <span class="required">*</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="number" id="fasttrack_duration" placeholder="Month" name="fasttrack_duration" required="required" data-validate-minmax="10,100" value="<?php echo (isset($post_set['fasttrack_duration']) && !empty($post_set['fasttrack_duration']) ? $post_set['fasttrack_duration'] : '');?>" class="form-control col-md-7 col-xs-12">
												<?php echo form_error('fasttrack_duration'); ?>
                                            </div>
											
                                        </div>
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/master/programs/" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
                CKEDITOR.replace('mail_content');
              });
            </script>
			