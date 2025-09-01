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
                                    <h2>Faq <small>Update</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/settings/faq/update<?php echo $urlArg; ?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Faq Info</span>
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Select Type <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="type_id" id="type_id">
													<option value="">Select Type</option>
													<?php if(!empty($type)) { foreach($type as $k=>$typeid){?>
														<option value="<?php echo $k; ?>" <?php echo (isset($post_set['type_id']) && !empty($post_set['type_id'])  && ($post_set['type_id']== $k) ? 'selected' : 
														((  isset($selectedValues->type) && !empty($selectedValues->type) && $selectedValues->type==$k ) ? 'selected' : ''));?>><?php echo $typeid; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('type_id'); ?>
                                            </div>
                                        </div>
										
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Faq Title <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <!--<input id="title" value="<?php echo (isset($post_set['title']) && !empty($post_set['title']) ? $post_set['title'] : $selectedValues->title);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="title" placeholder="Page Title" required="required" type="text">-->
												<textarea name="title" class="form-control" id="title" rows="7" placeholder="Title"><?php echo (isset($post_set['title']) && !empty($post_set['title']) ? $post_set['title'] : stripslashes($selectedValues->title));?></textarea>
												<?php echo form_error('title'); ?>
                                            </div>
                                        </div>
										
                                       
                                        	<div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Faq Content <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <textarea name="faq_content" class="form-control" id="content" rows="7" placeholder="Content"><?php echo (isset($post_set['faq_content']) && !empty($post_set['faq_content']) ? $post_set['faq_content'] : stripslashes($selectedValues->content));?></textarea>
												 <?php echo form_error('faq_content'); ?>
                                            </div>
                                        </div>
										
										
										
										
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/settings/faq" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
			