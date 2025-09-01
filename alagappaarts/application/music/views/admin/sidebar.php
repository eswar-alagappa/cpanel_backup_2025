<div class="col-md-3 left_col">
	<div class="left_col scroll-view">

		<!--<div class="navbar nav_title" style="border: 0;">
			<a href="<?php echo base_url()?>music/admin/login" class="site_title"> <span><?php echo $SiteMainTitle; ?></span></a>
		</div>-->
		<div class="dance_profile_pic"></div>
		<div class="clearfix"></div>

		<!-- menu prile quick info -->
		<div class="profile">
		
			
		
			<div class="profile_pic">				
				<img width="50" height="50" src="<?php echo base_url().'assets/sanjay-logo.png' ?>" alt="Alagappaarts" title="Alagappaarts" class="img-circle profile_img">
				
			</div>
			<div class="profile_info">
				<span>Welcome,</span>
				<h2><?php 
				echo 'Super Admin';
				?></h2>
			</div>
		</div>
		<!-- /menu prile quick info -->

		<br />

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

			<div class="menu_section">
				<h3>General</h3>
				
					<ul class="nav side-menu">
						<li><a><i class="fa fa-user"></i> Masters <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url();?>music/admin/master/dashboard">Dashboard</a></li>
								<!--<li><a href="javascript:;">Profile</a></li>-->
								<li><a href="<?php echo base_url();?>assets/admin/Dance_Program_Guide.pdf" target="_blank">Program Guidelines</a></li>
								<li><a href="<?php echo base_url();?>music/admin/master/programs">Programs</a></li>
								<li><a href="<?php echo base_url();?>music/admin/master/courses">Courses</a></li>
								<li><a href="<?php echo base_url();?>music/admin/master/fees">Fee</a></li>
								<li><a href="<?php echo base_url();?>music/admin/master/settings">Admin</a></li>
							</ul>
						</li>
						<li><a><i class="glyphicon glyphicon-home"></i> Centers <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url();?>music/admin/centers/index">List</a>
								</li>
							</ul>
						</li>
						
						<li><a><i class="fa fa-users"></i> Students <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="<?php echo base_url();?>music/admin/students/index">List</a>
								</li>
								<li><a href="<?php echo base_url();?>music/admin/students/assign_exam_list">Assign Exam List</a>
								</li>
								<li><a href="<?php echo base_url();?>music/admin/students/exam_attend_fail_list">Exam Attend Fail List</a>
								</li>
							</ul>
						</li>
						
						<li><a><i class="glyphicon glyphicon-book"></i> Exam <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">								
								<li><a href="<?php echo base_url();?>music/admin/quiz/index">Exam</a></li>
							</ul>
						</li>
						<!--<li><a><i class="glyphicon glyphicon-book"></i> Online Exam <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">								
								<li><a href="<?php echo base_url();?>music/admin/exams/questiontypes/">Question type</a></li>
								<li><a href="<?php echo base_url();?>music/admin/exams/questions/">Questions</a></li>
							</ul>
						</li>-->
						
						<li><a><i class="glyphicon glyphicon-usd"></i> Payments <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">								
								<!--<li><a href="<?php echo base_url();?>music/admin/settings/country">Paypal</a>
								</li>-->
								<li><a href="<?php echo base_url();?>music/admin/payment/index">Pending Payments</a>
								</li>
								
							</ul>
						</li>
						
						<li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">								
								<!--<li><a href="javascript:;">Messages</a>
								</li>-->
								<li><a href="<?php echo base_url();?>music/admin/settings/feedback">Feedback</a>
								</li>
								<!--<li><a href="javascript:;">Reports</a>
								</li>
								<li><a href="<?php echo base_url();?>music/admin/settings/menu">Menu</a>
								</li>-->
								<!--<li><a href="<?php echo base_url();?>music/admin/settings/mail">Email Template</a>
								</li>-->
								<li><a href="<?php echo base_url();?>music/admin/settings/faq">Faq</a>
								</li>
								<li><a href="<?php echo base_url();?>music/admin/settings/pages">Pages</a>
								</li>
								
							</ul>
						</li>
						
					</ul>
				
				
				<!--<ul class="nav side-menu">
					<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu" style="display: none">
							<li><a href="index.html">Dashboard</a>
							</li>
							<li><a href="index2.html">Dashboard2</a>
							</li>
							<li><a href="index3.html">Dashboard3</a>
							</li>
						</ul>
					</li>
					<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu" style="display: none">
							<li><a href="form.html">General Form</a>
							</li>
							<li><a href="form_advanced.html">Advanced Components</a>
							</li>
							<li><a href="form_validation.html">Form Validation</a>
							</li>
							<li><a href="form_wizards.html">Form Wizard</a>
							</li>
							<li><a href="form_upload.html">Form Upload</a>
							</li>
							<li><a href="form_buttons.html">Form Buttons</a>
							</li>
						</ul>
					</li>
					<li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu" style="display: none">
							<li><a href="general_elements.html">General Elements</a>
							</li>
							<li><a href="media_gallery.html">Media Gallery</a>
							</li>
							<li><a href="typography.html">Typography</a>
							</li>
							<li><a href="icons.html">Icons</a>
							</li>
							<li><a href="glyphicons.html">Glyphicons</a>
							</li>
							<li><a href="widgets.html">Widgets</a>
							</li>
							<li><a href="invoice.html">Invoice</a>
							</li>
							<li><a href="inbox.html">Inbox</a>
							</li>
							<li><a href="calender.html">Calender</a>
							</li>
						</ul>
					</li>
					<li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu" style="display: none">
							<li><a href="tables.html">Tables</a>
							</li>
							<li><a href="tables_dynamic.html">Table Dynamic</a>
							</li>
						</ul>
					</li>
					<li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu" style="display: none">
							<li><a href="chartjs.html">Chart JS</a>
							</li>
							<li><a href="chartjs2.html">Chart JS2</a>
							</li>
							<li><a href="morisjs.html">Moris JS</a>
							</li>
							<li><a href="echarts.html">ECharts </a>
							</li>
							<li><a href="other_charts.html">Other Charts </a>
							</li>
						</ul>
					</li>
				</ul>-->
			</div>
			<!--<div class="menu_section">
				<h3>Live On</h3>
				<ul class="nav side-menu">
					<li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu" style="display: none">
							<li><a href="e_commerce.html">E-commerce</a>
							</li>
							<li><a href="projects.html">Projects</a>
							</li>
							<li><a href="project_detail.html">Project Detail</a>
							</li>
							<li><a href="contacts.html">Contacts</a>
							</li>
							<li><a href="profile.html">Profile</a>
							</li>
						</ul>
					</li>
					<li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu" style="display: none">
							<li><a href="page_404.html">404 Error</a>
							</li>
							<li><a href="page_500.html">500 Error</a>
							</li>
							<li><a href="plain_page.html">Plain Page</a>
							</li>
							<li><a href="login.html">Login Page</a>
							</li>
							<li><a href="pricing_tables.html">Pricing Tables</a>
							</li>

						</ul>
					</li>
					<li><a><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a>
					</li>
				</ul>
			</div>-->

		</div>
		<!-- /sidebar menu -->

		<!-- /menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Lock">
				<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" href="<?php echo base_url();?>music/admin/login/signout" title="Logout">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div>

<div class="top_nav">

	<div class="nav_menu">
		<nav class="" role="navigation">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<!--<img src="<?php echo base_url();?>assets/admin/images/img.jpg" alt="">-->
						<!--<img alt="Farebucket" title="Farebucket" src="<?php echo base_url();?>assets/admin/images/bucket.png">-->
						<?php
						/*echo ((!empty($this->session->userdata('admin_user_role')) && $this->session->userdata('admin_user_role')== 1) ? 'Super Admin' :
								((!empty($this->session->userdata('admin_user_role')) && $this->session->userdata('admin_user_role')== 2) ? 'Admin' :
								((!empty($this->session->userdata('admin_user_role')) && $this->session->userdata('admin_user_role')== 7) ? 'SEO' : '')));*/
								echo 'Super Admin';
								?>
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<!--<li><a href="javascript:;">  Profile</a>
						</li>
						<li>
							<a href="javascript:;">
								<span class="badge bg-red pull-right">50%</span>
								<span>Settings</span>
							</a>
						</li>
						<li>
							<a href="javascript:;">Help</a>
						</li>-->
						<li><a href="<?php echo base_url();?>music/admin/login/signout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
						</li>
					</ul>
				</li>

				<li role="presentation" class="dropdown">
					<!--<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-envelope-o"></i>
						<span class="badge bg-green">6</span>
					</a>-->
					<ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
						<li>
							<a>
								<span class="image">
							<img src="<?php echo base_url();?>assets/admin/images/img.jpg" alt="Profile Image" />
						</span>
								<span>
							<span>John Smith</span>
								<span class="time">3 mins ago</span>
								</span>
								<span class="message">
							Film festivals used to be do-or-die moments for movie makers. They were where... 
						</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image">
							<img src="<?php echo base_url();?>assets/admin/images/img.jpg" alt="Profile Image" />
						</span>
								<span>
							<span>John Smith</span>
								<span class="time">3 mins ago</span>
								</span>
								<span class="message">
							Film festivals used to be do-or-die moments for movie makers. They were where... 
						</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image">
							<img src="<?php echo base_url();?>assets/admin/images/img.jpg" alt="Profile Image" />
						</span>
								<span>
							<span>John Smith</span>
								<span class="time">3 mins ago</span>
								</span>
								<span class="message">
							Film festivals used to be do-or-die moments for movie makers. They were where... 
						</span>
							</a>
						</li>
						<li>
							<a>
								<span class="image">
							<img src="<?php echo base_url();?>assets/admin/images/img.jpg" alt="Profile Image" />
						</span>
								<span>
							<span>John Smith</span>
								<span class="time">3 mins ago</span>
								</span>
								<span class="message">
							Film festivals used to be do-or-die moments for movie makers. They were where... 
						</span>
							</a>
						</li>
						<li>
							<div class="text-center">
								<a>
									<strong>See All Alerts</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</li>
					</ul>
				</li>

			</ul>
		</nav>
	</div>

</div>