<!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <!--<div class="page-title">
                        <div class="title_left">
                            <h3>
                    Invoice
                    <small>
                        Some examples to get you started
                    </small>
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
                    </div>
                    <div class="clearfix"></div>-->

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Syllabus <small>list</small></h2>
									
									
									<?php if ($this->session->flashdata('SucMessage')!='') { ?>
										  <div class="alert alert-success alert-dismissable">
												<i class="fa fa-check"></i>
												<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												<b>Alert!</b>
												<?php echo $this->session->flashdata('SucMessage') ;   ?>
											</div>
									<?php } ?>
									
                                    <!--<ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
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
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>-->
                                </div>
								<div class="x_content">
									<a class="btn btn-primary" href="<?php echo base_url().'dance/admin/syllabus/addsyllabus'; ?>">Add</a>
								</div>
								
								<!--<div class="x_content">
									<a class="btn btn-primary" href="<?php echo base_url().'dance/admin/syllabus/bulk_sms'; ?>">Send Bulk Mail To Student</a>
								</div>-->
                                <div class="x_content">
								
								
								<!--<form id="frmStudentsearch" method="post" action="<?php echo base_url().'dance/admin/syllabus/index' ?>">
								<table border="0" cellpadding="5" cellspacing="5">
									<tbody>
									<tr>
										<td><h3>PROGRAM : &nbsp;</h3></td>
										<td>
											<select id="program" name="program">
												<option value="">-Select-</option>
												<?php if( isset($programList) && !empty($programList)){
													foreach($programList as $program){?>
														<option value="<?php echo $program->program_id; ?>" <?php echo ((isset($post_set['program']) && !empty($post_set['program']) && $post_set['program'] == $program->program_id) ? 'selected' : '') ?>><?php echo stripslashes($program->name); ?></option>
												<?php }}?>
											</select>
										</td>
									</tr>
									<tr>
										<td><h3>CENTER : &nbsp;</h3></td>
										<td>
											<select id="center" name="center">
												<option value="">-Select-</option>
												<?php if( isset($centers) && !empty($centers)){
													foreach($centers as $center){?>
													<option value="<?php echo $center->center_academy_id; ?>" <?php echo ((isset($post_set['center']) && !empty($post_set['center']) && $post_set['center'] == $center->center_academy_id) ? 'selected' : '') ?>><?php echo stripslashes($center->name); ?></option>
												<?php }}?>
											</select>
										</td>
									</tr>
									
									<tr>
										<td><h3>STATUS : &nbsp;</h3></td>
										<td>
											<select id="status" name="status">
												<option value="">-Select-</option>
												<?php if( isset($status) && !empty($status)){
													foreach($status as $k=> $stat){?>
													<option value="<?php echo $k; ?>" <?php 
													echo ((isset($post_set['status']) && $k == '1' && $post_set['status'] ==1) ? 'selected' : 
													((isset($post_set['status']) && $k == '2' && $post_set['status'] ==2) ? 'selected' : 
													((isset($post_set['status']) && $k == 'waiting' && $post_set['status'] =='waiting') ? 'selected' : ''))) ?>><?php echo stripslashes($stat); ?></option>
												<?php }}?>
											</select>
										</td>
									</tr>
									
									
									<tr><td></td><td align="center"><input type="submit" class="goBtn btn btn-primary" value="Go" name="search"></td></tr>
									</tbody>
								</table>
								</form>-->
								
								
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--<th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>-->
												<th>created </th>
												<th>Modified </th>
												<th>program </th>
												<th>Title </th>
                                                <th>Type </th>
                                                <th>Path </th>
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
										<?php if( !empty($syllabusList)){ krsort($syllabusList);//echo '<pre>';print_r($listData);
														foreach($syllabusList as $key=> $list){
												?>
                                            <tr class="even pointer">												
                                                <!--<td class="a-center ">
                                                    <input type="checkbox" class="tableflat">
                                                </td>-->
												<!--<td ><?php echo date('j F Y',strtotime($list->created_at)); ?></td>
												<td ><?php echo date('j F Y',strtotime($list->updated_at)); ?></td>-->
												
												<td ><?php echo (($list->created_at != '0000-00-00 00:00:00') ? date('j F Y',strtotime($list->created_at)) : ''); ?></td>
												<td ><?php echo (($list->updated_at != '0000-00-00 00:00:00') ? date('j F Y',strtotime($list->updated_at)) : ''); ?></td>
												<td class=" "><?php echo $list->program_id ?></td>
												 <td class=" "><?php echo (($list->type == 'Video') ? $list->video_title : (($list->type == 'Pdf') ? $list->pdf_title : '')); ?></td>
                                                <td class=" "><?php echo $list->type ?></td>
                                                <td class=" "><?php echo $list->path ?></td>
                                                
                                                <!--<td class=" "></td>-->
                                                <td style="width:150px" class=" last">
												<?php
												
												$status =((!empty($list->status) && ($list->status ==1)) ? 'fa fa-check' : 'fa fa-remove');
												
												//echo ' <a alt="View" title="View" href="'.base_url().'dance/admin/syllabus/view/'.$list->syllabus_program_id.'"><i class="fa fa-search"></i></a> | ';
												
												echo ' <a alt="Update" title="Update" href="'.base_url().'dance/admin/syllabus/updatesyllabus/'.$list->syllabus_program_id.'"><i class="fa fa-edit"></i></a> | ';
												
												echo ' <a alt="Remove" title="Remove" onclick="return confirm(\'Are you sure you want to delete?\');" href="'.base_url().'dance/admin/syllabus/removesyllabus/'.$list->syllabus_program_id.'"><i class="fa fa-trash"></i></a> | ';
												
												/*echo ' <a alt="Change Status" title="Change Status" href="'.base_url().'dance/admin/syllabus/status/'.$list->user_id.'"><i class="'.$status.'"></i></a> | ';
												
												echo '<a href="'.base_url().'dance/admin/syllabus/reset_password/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/reset-password-icon.png" alt="Reset Password" title="Reset Password"></a> | ';
												
												if($list->status ==1){
												echo '<a href="'.base_url().'dance/admin/syllabus/assign_exam/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/assign-exam-icon.png" alt="Assign Exam" title="Assign Exam"></a> | ';
												}
												echo '<a href="'.base_url().'dance/admin/syllabus/result_exam/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/publish-result.png" alt="Result Exam" title="Result Exam"></a> | ';
												
												echo '<a href="'.base_url().'dance/admin/syllabus/course_completion/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/course-completion-update-icon.png" alt="Course Completion" title="Course Completion"></a>';
												*/
												?>
                                                </td>												
                                            </tr>
                                            <?php } } ?>
                                        </tbody>

                                    </table>
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