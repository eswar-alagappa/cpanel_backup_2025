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
                                    <h2>Student <small>list</small></h2>
									
									
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
									<a class="btn btn-primary" href="<?php echo base_url().'vaasthu/admin/students/add'; ?>">Add</a>
								</div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--<th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>-->
												<th>created </th>
												<th>Modified </th>
												<th>Username </th>
                                                <th>Firstname </th>
												<th>Lastname </th>
                                                <th>Email </th>
                                                <th>Mobile </th>
                                                <!--<th>Status </th>-->
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
										<?php if( !empty($listData)){ //echo '<pre>';print_r($listData);
														foreach($listData as $key=> $list){
												?>
                                            <tr class="even pointer">												
                                                <!--<td class="a-center ">
                                                    <input type="checkbox" class="tableflat">
                                                </td>-->
												<td ><?php echo date('j F Y',strtotime($list->created_at)); ?></td>
												<td ><?php echo date('j F Y',strtotime($list->updated_at)); ?></td>
												<td class=" "><?php echo $list->username ?></td>
                                                <td class=" "><?php echo $list->firstname ?></td>
                                                <td class=" "><?php echo $list->lastname ?> </td>
                                                <td class=" "><?php echo $list->email ?> </td>
												<td class=" "><?php echo $list->mobile ?> </td>
                                                <!--<td class=" "></td>-->
                                                <td style="width:150px" class=" last">
												<?php
												
												$status =((!empty($list->status) && ($list->status ==1)) ? 'fa fa-check' : 'fa fa-remove');
												
												echo ' <a alt="View" title="View" href="'.base_url().'vaasthu/admin/students/view/'.$list->user_id.'"><i class="fa fa-search"></i></a> | ';
												
												echo ' <a alt="Update" title="Update" href="'.base_url().'vaasthu/admin/students/update/'.$list->user_id.'"><i class="fa fa-edit"></i></a> | ';
												echo ' <a alt="Remove" title="Remove" onclick="return confirm(\'Are you sure you want to delete?\');" href="'.base_url().'vaasthu/admin/students/remove/'.$list->user_id.'"><i class="fa fa-trash"></i></a> | ';
												
												echo ' <a alt="Change Status" title="Change Status" href="'.base_url().'vaasthu/admin/students/status/'.$list->user_id.'"><i class="'.$status.'"></i></a> | ';
												
												echo '<a href="'.base_url().'vaasthu/admin/students/reset_password/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/reset-password-icon.png" alt="Reset Password" title="Reset Password"></a> | ';
												
												echo '<a href="'.base_url().'vaasthu/admin/students/assign_exam/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/assign-exam-icon.png" alt="Assign Exam" title="Assign Exam"></a> | ';
												
												echo '<a href="'.base_url().'vaasthu/admin/students/result_exam/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/publish-result.png" alt="Result Exam" title="Result Exam"></a> | ';
												
												echo '<a href="'.base_url().'vaasthu/admin/students/course_completion/'.$list->user_id.'"><img width="20" height="18" src="'.base_url().'assets/home/images/course-completion-update-icon.png" alt="Course Completion" title="Course Completion"></a>';
												
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