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
                                    <h2>Question type <small>Update</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>vaasthu/admin/exams/questiontypes/update<?php echo $urlArg; ?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Question type Info</span>

                                      <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="qt_name" value="<?php echo (isset($post_set['qt_name']) && !empty($post_set['qt_name']) ? $post_set['qt_name'] : $selectedValues->name);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="qt_name" placeholder="Name" required="required" type="text">
												<?php echo form_error('qt_name'); ?>
                                            </div>
                                        </div>
										
										
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Description <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="qt_description" required="required" placeholder="Description" name="qt_description" class="form-control col-md-7 col-xs-12"><?php echo (isset($post_set['qt_description']) && !empty($post_set['qt_description']) ? $post_set['qt_description'] : $selectedValues->description);?></textarea>
												<?php echo form_error('qt_description'); ?>
                                            </div>
                                        </div>
										
										
										 <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mark Per Question <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="mark_per_question" value="<?php echo (isset($post_set['mark_per_question']) && !empty($post_set['mark_per_question']) ? $post_set['mark_per_question'] : $selectedValues->mark_per_question);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="mark_per_question" placeholder="Mark Per Question" required="required" type="text">
												<?php echo form_error('mark_per_question'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Controller Type <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="controller_type" id="controller_type">
													<option value="">Select Controller Type</option>
													<?php if(!empty($questionType)) { foreach($questionType as $k=>$controllertype){?>
														<option value="<?php echo $k; ?>" <?php echo (isset($post_set['controller_type']) && !empty($post_set['controller_type'])  && ($post_set['controller_type']== $k) ? 'selected' : 
														(isset($selectedValues->controller_id) && !empty($selectedValues->controller_id)  && ($selectedValues->controller_id== $k) ? 'selected': ''));?>><?php echo $controllertype; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('controller_type'); ?>
                                            </div>
                                        </div>
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>vaasthu/admin/exams/questiontypes" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
			