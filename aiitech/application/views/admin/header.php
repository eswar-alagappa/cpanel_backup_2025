<!DOCTYPE HTML>
<html>
<head>
<title>Aitech</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--
<script type="application/x-javascript"> 
addEventListener("load", function() { 
	setTimeout(hideURLbar, 0); 
}, false); 

function hideURLbar(){
	 window.scrollTo(0,1);
}
</script>
 -->

 <!-- Bootstrap Core CSS -->
<script src="<?php echo base_url('/');?>js/jquery-1.12.0.min.js"></script>
<script src="<?php echo base_url('/');?>js/daterangepicker.js"></script>
<script src="<?php echo base_url('/');?>js/jquery-ui.js"></script>
<script src="<?php echo base_url('/');?>js/helper.js"></script>


<link href="<?php echo base_url('/');?>admin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url('/');?>admin/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url('/');?>admin/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="<?php echo base_url('/');?>admin/css/icon-font.min.css" type='text/css' />
<link href="<?php echo base_url('/');?>admin/css/animate.css" rel="stylesheet" type="text/css" media="all">
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url('/');?>css/jquery-ui.css">


<?php
if (!isset($_SESSION) ){    
    session_start();
} 

if (!isset($_SESSION['username']) || !isset($_SESSION['first_name'])){
	return;
}

$login_id = $_SESSION['id'];
$login_role = $_SESSION['role'];
$login_username = $_SESSION['username'];
$login_rolename = $_SESSION['rolename'];
$login_firstname = $_SESSION['first_name'];
$login_lastname = $_SESSION['last_name'];
$login_image_url = $_SESSION['image_url'];
$IMAGE_DIR = base_url('/') . 'uploads/';

?>


<!--
<script src="<?php echo base_url('/');?>admin/js/wow.min.js"></script>
<script>
	 new WOW().init();
</script>
-->

<!-- Placed js at the end of the document so the pages load faster -->

</head> 

 <body class="sticky-header left-side-collapsed">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="<?php echo site_url('/');?>admin/dashboard">
					<?php echo $login_firstname;?> <span></span></a>
				</h1>
			</div>
			<div class="logo-icon text-center">
				<a href="<?php echo site_url('/');?>admin/dashboard"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<?php if ($login_rolename == 'admin') { ?>
						<li class="active"><a href="<?php echo site_url('/');?>admin/dashboard">
							<i class="lnr lnr-power-switch"></i><span>Dashboard</span></a>
						</li>

						<li class="menu-list">
							<a href="#"><i class="lnr lnr-cog"></i>
								<span>Settings</span></a>
								<ul class="sub-menu-list">
									<li><a href="<?php echo site_url('/');?>admin/course">Course</a> </li>
									<li><a href="<?php echo site_url('/');?>admin/semester">Semester</a></li>
									<li><a href="<?php echo site_url('/');?>admin/student">Subject</a></li>
									<li><a href="<?php echo site_url('/');?>admin/feetype">Fee Type</a></li>
									<li><a href="<?php echo site_url('/');?>admin/student_semester">Transfer student to Next sem</a></li>
								</ul>
						</li>
						<li><a href="<?php echo site_url('/');?>admin/staff">
							<i class="lnr lnr-spell-check"></i> <span>Staff</span></a>
						</li>
						<?php } ?>
	
						<?php if ($login_rolename == 'admin' || $login_rolename == 'staff') { ?>
						<li>
							<a href="<?php echo site_url('/');?>admin/student"><i class="lnr lnr-menu"></i> <span>Student</span></a>
						</li>              

						<li>
							<a href="<?php echo site_url('/');?>admin/gallery"><i class="lnr lnr-menu"></i> <span>Gallery</span></a>
						</li>              

						<li>
							<a href="<?php echo site_url('/');?>admin/latestnews"><i class="lnr lnr-menu"></i> <span>Latest news</span></a>
						</li>              
						<li>
							<a href="<?php echo site_url('/');?>admin/settings/pdfupload"><i class="lnr lnr-menu"></i> <span>PDF file upload</span></a>
						</li>              
						<?php } ?>

						<?php if ($login_rolename == 'admin') { ?>
						<li>
							<a href="<?php echo site_url('/');?>admin/slider"><i class="lnr lnr-menu"></i> <span>Slider</span></a>
						</li>              

						<li class="menu-list">
							<a href="#"><i class="lnr lnr-envelope"></i> <span>Fee details</span></a>
							<ul class="sub-menu-list">
								<li><a href="<?php echo site_url('/');?>admin/fees">Fee Structure</a></li>
								<li><a href="<?php echo site_url('/');?>admin/payment">Semester Fees receipt</a> </li>
							</ul>
						</li>    

						<li class="menu-list">
							<a href="#"><i class="lnr lnr-cog"></i>
								<span>Examination</span></a>
								<ul class="sub-menu-list">
									<li><a href="<?php echo site_url('/');?>admin/examnotification">Exam Notification</a> </li>
									<li><a href="<?php echo site_url('/');?>admin/examvenue">Exam Venue</a></li>
								</ul>
						</li>
						<?php } ?>

						<?php if ($login_rolename == 'student') { ?>
						<li>
							<a href="<?php echo site_url('/');?>admin/myaccount"><i class="lnr lnr-menu"></i> <span>My Account</span></a>
						</li>              
						<?php } ?>

					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->
    
		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span style="background:url(<?php echo $IMAGE_DIR . $login_image_url;?>) no-repeat center"> </span> 
										 <div class="user-name">
											<p><?php echo $login_username; ?><span><?php echo $login_rolename; ?></span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<?php
										$url = site_url('/') . 'admin/viewprofile/display/' . md5($login_id);
									?>
									<li> <a href="<?php echo $url;?>"><i class="fa fa-user"></i>View Profile</a> </li> 
									<li> <a href="<?php echo site_url('/');?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
		<!-- //header-ends -->
