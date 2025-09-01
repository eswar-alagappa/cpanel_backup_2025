<!DOCTYPE html>
<html lang="en">
<head>

  <title>Alagappa Institute of Technology </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
	
  <link rel="stylesheet" href="<?php echo base_url('/');?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('/');?>css/style.css">
  <link href="<?php echo base_url('/');?>css/normalize.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/');?>css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/');?>css/styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/');?>css/demo.css" media="all" />
 <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url('/');?>css/magnific-popup.css">
	
	  
    
  <script src="<?php echo base_url('/');?>js/jquery-1.12.0.min.js"></script>
  <script src="<?php echo base_url('/');?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('/');?>js/fade.js"></script>

  <script type="text/javascript" src="<?php echo base_url('/');?>js/jquery.magnific-popup.min.js"></script>
 
    
<script type="text/javascript" src="<?php echo base_url('/');?>js/jquery.flexslider-min.js"></script>

	<!--Slick & clean supports -->
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84501225-3', 'auto');
  ga('send', 'pageview');

</script>
	
</head>

<?php
$IMAGE_DIR = base_url('/') . 'uploads/';
$PDF_COURSE_OFFERED = '';
$PDF_ELIGIBLITY = '';
$PDF_FEE_STRUCTURE = '';
$PDF_ALAGAPPA_CLASS_SCHEDULE = '';
$PDF_PONDICHERRY_SCHEDULE = '';
$PDF_ALAGAPPA_CLASS_SCHEDULE = '#';
$PDF_PONDICHERRY_SCHEDULE = '#';
$PDF_SEMESTER_PROGRAMES = '#';
$PDF_NON_SEMESTER_PROGRAMES = '#';
$PDF_DIRECTORATE_OF_DISTANCE_EDUCATION = '#';
$PDF_MBA_NON_SEMESTER_APPLICATION = '#';

$sql = "select * from settings where left(key_name,3)='PDF'";
$query = $this->db->query($sql);
$rows = $query->result_array();
foreach ($rows as $row) {
  if ($row['key_name'] == 'PDF_COURSE_OFFERED'){
    $PDF_COURSE_OFFERED = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_ELIGIBLITY'){
    $PDF_ELIGIBLITY = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_FEE_STRUCTURE'){
    $PDF_FEE_STRUCTURE = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_ALAGAPPA_CLASS_SCHEDULE'){
    $PDF_ALAGAPPA_CLASS_SCHEDULE = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_PONDICHERRY_SCHEDULE'){
    $PDF_PONDICHERRY_SCHEDULE = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_ALAGAPPA_CLASS_SCHEDULE'){
    $PDF_ALAGAPPA_CLASS_SCHEDULE = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_SEMESTER_PROGRAMES'){
    $PDF_SEMESTER_PROGRAMES = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_NON_SEMESTER_PROGRAMES'){
    $PDF_NON_SEMESTER_PROGRAMES = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_DIRECTORATE_OF_DISTANCE_EDUCATION'){
    $PDF_DIRECTORATE_OF_DISTANCE_EDUCATION = base_url('/') . 'doc/' . $row['key_value'];
  }
  if ($row['key_name'] == 'PDF_MBA_NON_SEMESTER_APPLICATION'){
    $PDF_MBA_NON_SEMESTER_APPLICATION = base_url('/') . 'doc/' . $row['key_value'];
  }
}
?>

<body>
<header>
<div class="container">
<div class="row" style="background: #4c9ef1;">
<div class="top-navigation">
<div class="col-lg-6 col-xs-12 left-list">
<a href="<?php echo site_url('/')?>" title="Alagappa Institute of Technology"><img src="img/logo.png" alt="ImageMissing">&nbsp;&nbsp; Alagappa Institute of Technology
<span class="slogan"><em>In Pursuit of Excellence in Education</em></span></a>
</div>
<div class="col-lg-4 col-xs-12 left-list" style="float:right;">
<a href="http://alagappa.org/" target="_blank" title="Alagappa Institute of Technology"><img src="<?php echo base_url();?>img/groups.png" alt="ImageMissing"></a>
</div>
</div>
</div>
</div>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo site_url('/')?>">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">About Us<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('/');?>profile">Alagappa Profile</a></li>
            <li><a href="<?php echo site_url('/');?>management">Management</a></li>
			 <li><a href="<?php echo site_url('/');?>administrator">Administrator</a></li>
          </ul>
        </li>
         <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Admission<span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a target="blank" href="procedure">Admission Procedure</a></li>
            <?php if ($PDF_COURSE_OFFERED != '') { ?>
              <li><a target="blank" href="<?php echo $PDF_COURSE_OFFERED; ?>">Course Offered</a></li>
          <?php } else { ?> 
              <li><a href="doc/courses-2017.pdf">Course Offered</a></li>
            <?php } ?>
			
			 <li>
          <?php if ($PDF_ELIGIBLITY == '') { ?>
            <a href="doc/eligibility.pdf" title="Eligibility">Eligibility</a>
          <?php } else { ?>
            <a href="<?php echo $PDF_ELIGIBLITY;?>" title="Eligibility">Eligibility</a>
          <?php } ?>
       </li>
			 <li><a href="app_form">Application</a></li>
			  <li>
            <?php if ($PDF_FEE_STRUCTURE == '') { ?>
              <a href="doc/fees_stru.pdf">Fees Structure</a></li>
            <?php } else { ?>
              <a href="<?php echo $PDF_FEE_STRUCTURE;?>" title="Fees Structure">Fees Structure</a></li>
            <?php } ?>
          </ul>
		  </li>
		<li class="dropdown">
		 <a class="dropdown-toggle" data-toggle="dropdown" href="#">Academics<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('/');?>university" title="University">University</a></li>
            <li><a href="<?php site_url('/');?>pcp_class" title="PCP Classes">PCP Classes</a></li>
			<li><a href="<?php echo site_url('/');?>syllabus" title="Syllabus">Syllabus</a></li>
          </ul>
		  </li>
		   <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Examination<span class="caret"></span></a>
		  <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('/');?>notify" title="Exam Notification">Exam Notification</a></li>
            <li><a href="<?php echo site_url('/');?>fees" title="Fees Details">Fees Details</a></li>
			 <li><a href="<?php echo site_url('/');?>venue" title="Exam Venue">Exam Venue</a></li>
			 <li><a href="<?php echo site_url('/');?>schedule" title="Exam Schedule">Exam Schedule</a></li>
          </ul>
		  </li>
		<li><a href="<?php echo site_url('/');?>gallery">Gallery</a></li>
		<li><a href="<?php echo site_url('/');?>contact">Contact Us</a></li>
		<li><a href="http://mis.alagappauniversity.ac.in/dde-online/login.php" target="_blank">Student Login</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="display:none;">
        <li><a href="#" title="sign in"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
</header>
<marquee><b>Alagappa University – Admissions Started for Calendar Year 2022.</b>
    
   <!-- <b><span>"Our achi's history on news7 tamil channel @ 6.30 pm and 10 pm today 15th December 2021."</span> <a href="https://aiitech.com/video.php" title="Our achi's history on news7 tamil channel @ 6.30 pm and 10 pm today 15th December 2021." target="_new" style="animation: blinker 1s linear infinite;color: #0074e8">Click Here</a></b> &nbsp; &nbsp;
    <b>“Alagappa University - Academic Year Admission 2021 going on. Last date for admission is 15th December, 2021.”</b> &nbsp; &nbsp; <b> "Alagappa University - Last date for II & III year fee payment extended to 31st December, 2021 with Fine for AY/CY. "  </b>-->
    </marquee>
<!--<marquee><b>December 2017 Examination-</b> Alagappa Institute of Technology, Purusaiwalkam, Chennai - Examination center and Computer Science Practical Exam Center of Alagappa University, And Examination center for Pondicherry University.</marquee>-->
<body>

