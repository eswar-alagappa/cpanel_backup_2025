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
                                    <h2>Feedback <small>Reply</small></h2>
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
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>vaasthu/admin/settings/feedback/reply<?php echo $urlArg; ?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Feedback Info</span>
										<?php if ($this->session->flashdata('SucMessage')!='') { ?>
											  <div class="alert alert-success alert-dismissable">
													<i class="fa fa-check"></i>
													<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
													<b>Alert!</b>
													<?php echo $this->session->flashdata('SucMessage') ;   ?>
												</div>
										<?php } ?>
										
										
										
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Feedback subject <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="subject" value="<?php echo (isset($post_set['subject']) && !empty($post_set['subject']) ? $post_set['subject'] : $selectedValues->subject);?>" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="subject" placeholder="Feedback Subject" required="required" type="text">
												
												<?php echo form_error('subject'); ?>
                                            </div>
                                        </div>
										
                                       
                                        <div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Feedback Message <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <textarea name="message" class="form-control" id="message" rows="7" placeholder="Message"><?php echo (isset($post_set['message']) && !empty($post_set['message']) ? $post_set['message'] : stripslashes($selectedValues->message));?></textarea>
												 <?php echo form_error('message'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label for="description" class="control-label col-md-3">Feedback Reply <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <textarea name="reply" class="form-control" id="message" rows="7" placeholder=""><?php echo (isset($post_set['reply']) && !empty($post_set['reply']) ? $post_set['reply'] : stripslashes($selectedValues->reply));?></textarea>
												 <?php echo form_error('reply'); ?>
                                            </div>
                                        </div>
										
										
										
										
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>vaasthu/admin/settings/feedback" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
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
			