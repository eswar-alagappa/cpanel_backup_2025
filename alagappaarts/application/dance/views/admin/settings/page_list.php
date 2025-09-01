<!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                   

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Page <small>list</small></h2>
									
									
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
									<a class="btn btn-primary" href="<?php echo base_url().'dance/admin/settings/pages/add'; ?>">Add</a>
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
                                                <th>Title </th>
                                                
                                                
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
										<?php if( !empty($pageList)){
														foreach($pageList as $key=> $page){
												?>
                                            <tr class="even pointer">												
                                                
												<td ><?php echo date('j F Y',strtotime($page->created_at)); ?></td>
												<td ><?php echo date('j F Y',strtotime($page->updated_at)); ?></td>
                                                <td ><?php echo $page->title ?></td>
                                               <!-- <td ><?php //echo stripslashes(substr(trim($page->content),0,100)).'...'; ?> </td>-->
                                                
                                                <td class=" last">
												<?php
												
												$status =((!empty($page->status) && ($page->status ==1)) ? 'fa fa-check' : 'fa fa-remove');
												
												echo ' <a alt="View" title="View" href="'.base_url().'dance/admin/settings/pages/view/'.$page->page_id.'"><i class="fa fa-search"></i></a> | ';
												
												echo ' <a href="'.base_url().'dance/admin/settings/pages/update/'.$page->page_id.'"><i class="fa fa-edit"></i></a> | ';
												//echo ' <a onclick="return confirm(\'Are you sure you want to delete?\');" href="'.base_url().'dance/admin/settings/remove/pages/'.$page->page_id.'"><i class="fa fa-trash"></i></a> | ';
												
												echo ' <a href="'.base_url().'dance/admin/settings/status/pages/'.$page->page_id.'"><i class="'.$status.'"></i></a> ';
												
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
                  
                    
                </div>
				