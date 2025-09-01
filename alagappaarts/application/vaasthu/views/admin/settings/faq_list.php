<!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                   

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Faq <small>list</small></h2>
									
									
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
									<a class="btn btn-primary" href="<?php echo base_url().'vaasthu/admin/settings/faq/add'; ?>">Add</a>
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
												<th>Type </th>
                                                <th width="30%">Title </th>
                                                
                                                
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
										<?php if( !empty($faqList)){ 
														foreach($faqList as $key=> $faq){
												?>
                                            <tr class="even pointer">												
                                                
												<td ><?php echo date('j F Y',strtotime($faq->created_at)); ?></td>
												<td ><?php echo date('j F Y',strtotime($faq->updated_at)); ?></td>
												<td ><?php echo (( isset($faq->type) && !empty($faq->type) && array_key_exists($faq->type,$faqtype)) ?  $faqtype[$faq->type] : ''); ?></td>
                                                <td ><?php echo $faq->title ?></td>
                                               <!-- <td ><?php //echo stripslashes(substr(trim($page->content),0,100)).'...'; ?> </td>-->
                                                
                                                <td class=" last">
												<?php
												
												$status =((!empty($faq->status) && ($faq->status ==1)) ? 'fa fa-check' : 'fa fa-remove');
												
												echo ' <a alt="View" title="View" href="'.base_url().'vaasthu/admin/settings/faq/view/'.$faq->faq_id.'"><i class="fa fa-search"></i></a> | ';
												
												echo ' <a href="'.base_url().'vaasthu/admin/settings/faq/update/'.$faq->faq_id.'"><i class="fa fa-edit"></i></a> | ';
												echo ' <a onclick="return confirm(\'Are you sure you want to delete?\');" href="'.base_url().'vaasthu/admin/settings/remove/faq/'.$faq->faq_id.'"><i class="fa fa-trash"></i></a> | ';
												
												echo ' <a href="'.base_url().'vaasthu/admin/settings/status/faq/'.$faq->faq_id.'"><i class="'.$status.'"></i></a> ';
												
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
				