<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript charset=utf-8">
<title>Alagappaarts-Online exam</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/alagappaarts.png" />
<link href="<?php echo base_url()?>assets/home/css/style-student.css" type="text/css" rel="stylesheet"  />
<link href="<?php echo base_url()?>assets/home/css/style-center.css" type="text/css" rel="stylesheet"  />


<style>
.admiTitle_new {
    color: #eed7a0;
    float: left;
    font-size: 15px;
    margin-top: 10px;
}
</style>
</head>
<body>
<div class=" wrapper">
  <div class="header">
    <div class="headerTop">
      <div class="logo"><a href="#"><img src="<?php echo base_url()?>assets/home/images/spacer.gif" width="1" height="1" class="logoImg" /></a></div>
      
	  <div class="menu">
        <ul id="nav">
			<li class="top"><a href="<?php echo base_url()?>dance/center/students" class="top_link">Students</a></li>
			<li><a href="<?php echo base_url()?>dance/center/exam_schedule">Exams</a></li>
			<li><a href="<?php echo base_url()?>dance/center/payments">Payments</a></li>
			<li><a href="<?php echo base_url()?>dance/center/exam_result">Result </a></li>
			<li class="last"><a target="_blank" href="<?php echo base_url() ?>assets/home/Program_Guide_0412.pdf">Program Guidelines </a></li>
           </ul>
      </div>
	  
    </div>
    
  </div>
<div class="headerBottom">


		<?php $profileName = $this->session->userdata('profileName'); $strLen = strlen($profileName); 
		$title_class = (($strLen > 30) ? 'admiTitle_new' : 'admiTitle') ?>
      <div class="<?php echo $title_class ?>">Welcome  <?php  echo $profileName; ?>  </div>

      <div class="menuBottom">

       <ul>

          <li class="homeIcon"><a href="javascript:;">website Home</a></li>

            <li class="dashboardIcon"><a href="<?php echo base_url().'dance/center/index'?>">dashboard</a></li>

          <li class="profilenav"><a href="<?php echo base_url().'dance/center/profile'?>">Profile</a></li> 

          <li class="logoutIcon "><a class="end" href="<?php echo base_url().'dance/center/logout'?>">Logout</a></li>

        </ul>

      </div>

    </div>
