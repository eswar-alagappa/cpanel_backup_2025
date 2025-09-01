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
                                    <h2>Menu <small>Update</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>music/admin/settings/menu/update<?php echo $urlArg; ?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Menu Info</span>

                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Menu Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" value="<?php echo (isset($post_set['name']) && !empty($post_set['name']) ? $post_set['name'] : stripslashes($selectedValues->name));?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Menu name" required="required" type="text">
												<?php echo form_error('name'); ?>
                                            </div>
                                        </div>
										
                                       
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Parent Menu <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="parent_id" id="parent_id">
													<option value="">Select Parent</option>
													<?php if(!empty($getParentMenu)) { foreach($getParentMenu as $k=>$parent){?>
														<option value="<?php echo $parent->menu_id; ?>" <?php echo (isset($post_set['parent_id']) && !empty($post_set['parent_id'])  && ($post_set['parent_id']== $parent->menu_id) ? 'selected' : 
														((isset($selectedValues->parent_id) && !empty($selectedValues->parent_id) && $selectedValues->parent_id==$parent->menu_id) ? 'selected' : '')  );?>><?php echo $parent->name; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('parent_id'); ?>
                                            </div>
                                        </div>	
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Menu Type <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12" name="menutype" id="menutype">
													<option value="">Select Type</option>
													<?php if(!empty($menuType)) { foreach($menuType as $k=>$type){?>
														<option value="<?php echo $k; ?>" <?php echo (isset($post_set['menutype']) && !empty($post_set['menutype'])  && ($post_set['menutype']== $k) ? 'selected' : 
														((isset($selectedValues->type) && !empty($selectedValues->type) && $selectedValues->type==$k) ? 'selected' : '')  );?>><?php echo $type; ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('menutype'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Menu Link <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="link" value="<?php echo (isset($post_set['link']) && !empty($post_set['link']) ? $post_set['link'] : $selectedValues->link);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="link" placeholder="Menu Link" required="required" type="text">
												<?php echo form_error('link'); ?>
                                            </div>
                                        </div>
										
										
										
										
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>music/admin/settings/menu" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
			