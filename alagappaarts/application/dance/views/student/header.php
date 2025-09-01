<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript charset=utf-8">
<title>Alagappaarts-Online exam</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/alagappaarts.png" />
<!--<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/home/css/style.css" />-->
<link href="<?php echo base_url()?>assets/home/css/style-student.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="<?php echo base_url()?>assets/home/css/colorbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url()?>assets/home/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/home/js/jquery.plugin.js"></script>
<!--<script type="text/javascript" src="http://alagappaarts.com/userpanel/web/scripts/jquery.countdown.js"></script>
<script type="text/javascript" src="http://alagappaarts.com/userpanel/web/scripts/jquery.validate.js"></script>
<script type="text/javascript" src="http://alagappaarts.com/userpanel/web/scripts/datetimepicker/jquery.datepick.js"></script>
<script type="text/javascript" src="http://alagappaarts.com/userpanel/web/scripts/datetimepicker/jquery.datepick.min.js"></script>
<script type="text/javascript" src="http://alagappaarts.com/userpanel/web/scripts/datetimepicker/jquery.datepick.pack.js"></script>
<script src="http://alagappaarts.com/userpanel/web/scripts/questions.js" type="text/javascript"></script>
 <script type="text/javascript" src="http://alagappaarts.com/userpanel/web/ckeditor/ckeditor.js"></script>
<link href="http://alagappaarts.com/userpanel/web/css/jquery.datepick.css" rel="stylesheet" type="text/css" />-->

</head>
<body>
<?php $application_base = 'http://' . $_SERVER['HTTP_HOST'];?>
<div class=" wrapper">
  <div class="header">
    <div class="headerTop">
      <div class="logo"><a href="<?php echo base_url().'dance/student/index' ?>"><img src="<?php echo base_url() ?>assets/home/images/spacer.gif" width="1" height="1" class="logoImg" /></a></div>
       <div class="menu">
        <ul id="nav">
        
        <li  class="top"><a href="<?php echo base_url() ?>dance/student/program_enrolled">Program Enrolled</a></li>
          <li><a class="top_link" href="javascript:;">Exams</a>
          	<ul class="sub">
            
<li><a href="<?php echo base_url() ?>dance/student/exam_schedule">Schedule</a></li>
<li><a href="<?php echo base_url() ?>dance/student/sample_exam">Sample Exam</a></li>
<li><a href="<?php echo base_url() ?>dance/student/online_exam">Online Exams</a></li>
<li><a href="<?php echo base_url() ?>dance/student/exam_result">Exam Results</a></li>
</ul>
          </li>
            <li><a href="<?php echo base_url() ?>dance/student/payments">Payments</a></li>
            <li><a  href="<?php echo base_url() ?>dance/student/feedback">Feedback </a></li>
            <li  ><a href="<?php echo base_url() ?>assets/home/exam-guidelines.pdf" target="_blank">Program Guidelines </a></li>
            <li class="last"><a href="<?php echo base_url() ?>assets/home/APAA_On_Line_Exam_Instructions.pdf" target="_blank">Exam Instructions </a></li>
           </ul>
      </div>
    </div>
    
  </div>
<div class="headerBottom">



      <div class="admiTitle">Welcome  <?php echo $this->session->userdata('profileName') ?>  </div>

      <div class="menuBottom">

       <ul>

         <!-- <li class="homeIcon"><a href="<?php echo $application_base ?>">website Home</a></li> -->

            <li class="dashboardIcon"><a href="<?php echo base_url().'dance/student/index'?>">dashboard</a></li>

          <li class="profilenav"><a href="<?php echo base_url().'dance/student/profile'?>">Profile</a></li> 

          <li class="logoutIcon "><a class="end" href="<?php echo base_url().'dance/student/logout'?>">Logout</a></li>

        </ul>

      </div>

    </div>
	
	<div class="content">
