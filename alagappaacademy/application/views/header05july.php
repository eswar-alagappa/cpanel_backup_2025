<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alagappa Academy School, Karaikudi</title>
<link href="images/icon.png" rel="icon">

<!-- Header css -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/style.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
<!-- drop down css -->
<link href="<?php echo base_url()?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/bootsnav.css" rel="stylesheet">
<!-- Slider css-->
<link href="<?php echo base_url()?>assets/css/slider.css" rel="stylesheet">

<link href="<?php echo base_url()?>assets/css/side_bar.css" rel="stylesheet">

<!-- Js Pllugins -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/semisticky.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<!-- dropdown menu js -->
<script src="<?php echo base_url()?>assets/js/bootsnav.js"></script>
<!-- Slider js-->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/slider.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jssor.slider.min.js"></script>
<!--Latest news js -->
<script src="<?php echo base_url()?>assets/js/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script>
</head>

<header class="masthead">
<div class="container1">
<div class="col-lg-12 col-sm-12 padding-left-none padding-right-none">
	<div class="col-lg-6 col-sm-12 left-info">
	<p>Mobile: +91 9876543210 <span style="color: #f36d21;">| </span>Email:<a href="mailto:info@alagapaacademy.com" title="Drop a Mail">info@alagapaacademy.com</a></p>
	</div>
	<div class="col-lg-6 col-sm-12 right-info">
	<ul>
	<li><span style="color:#fff;">BE PART OF ALAGAPPA ACADEMY</span><a href="https://alagappa.org/alagappa-cbse-academy.html" target="_blank"><span class="blinking"> (APPLY NOW) </span></a></li>
	</ul>
	</div>
	
</div>
</div>

</header>	  	  	
  	
  	
<!-- Begin Navbar -->
<div class="">
<nav class="navbar bootsnav">
<div id="nav">
  <div class="navbar navbar-default navbar-static">
    <div class="container">
	<div class="brand-name"><a href="<?php echo base_url()?>" title="Alagappa Academy School in Karaikudi"><img src="<?php echo base_url()?>assets/images/logo.png" alt="Alagappa Academy School in Karaikudi"></a></div>
      
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
       <i class="fa fa-bars" aria-hidden="true"></i>
      </a>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav" data-in="fadeInDown" animation-duration="0.3s" data-out="fadeInDown">
          <li><a href="<?php echo base_url()?>">Home</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us</a>
			<ul class="dropdown-menu">
					<li><a href="alagappa-academy.html">Alagappa Academy</a></li>
					<li><a href="mission-and-vision.html">Mission and Vision</a></li>
					<li><a href="message-from-the-management.html">Message from the Management</a></li>
					<li><a href="message-from-the-principals-desk.html">Message from the Principals Desk</a></li>
				</ul>
		  </li>
		   <li class="dropdown">
                    <a href="admissions.html"  >Admission</a>
                </li>
               <!-- <li class="dropdown">
                    <a href="achievements.html"  >Achievements</a>
                </li>-->
          <li><a href="academics.html">Academics</a></li>
		  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Facilities</a>
				<ul class="dropdown-menu">
					<li><a href="modern-smart-class-rooms.html">Modern Smart Class Rooms</a></li>
					<li><a href="library.html">Library</a></li>
					<li><a href="computer-lab.html">Computer Lab</a></li>
					<li><a href="sport-facilities.html">Sport Facilities</a></li>
					<li><a href="residential-facilities.html">Residential Facilities</a></li>
					<li><a href="other-facilities.html">Other Facilities</a></li>
				</ul>
		  </li>
		  <li><a href="gallery.html">Gallery</a></li>
		  <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>		
    </div>
  </div>
</div>
</nav>
</div>

<!-- contact form start-->

<div id="contactform" >
  <div id="contact-button">   
    <div class="rotated-text">Apply Now</div>
  </div>
    <form method="POST" action="">
      <h2>admission form</h2>
      <input required="" type="text" name="name" placeholder="Enter your name">
      <input required="" type="text" name="parent_name" placeholder="Enter Parent/Guardian Name">
      <input required="" type="text" name="email" placeholder="Enter your Email-id">
      <input required="" type="text" maxlength="10" id="mobile_sign" pattern="[0-9]{10}" name="mobile_no" placeholder="Enter your Mobile no">
      <p class="error_msg_sign" style="display: none;color:red;">Mobile number should start with 6,7,8,9 and contain atleast 10 digit number</p>
      <input type="hidden" name="role" value="cbse">
      <input type="text" id="datepicker" name="dob" placeholder="Enter your DOB" class="hasDatepicker">
            <select name="class" required=""> 
          <option value="">Select your class</option>
                     <option value="1st STD">1st STD</option>     
                   <option value="2nd STD">2nd STD</option>     
                   <option value="3rd STD">3rd STD</option>     
                   <option value="4th STD">4th STD</option>     
                   <option value="5th STD">5th STD</option>     
                   <option value="6th STD">6th STD</option>     
                   <option value="7th STD">7th STD</option>     
                   <option value="8th STD">8th STD</option>     
                   <option value="9th STD">9th STD</option>     
                
      </select>
     
      <textarea name="address" required="" row="6" col="5" placeholder="Enter your address"></textarea> 
         <div class="radio">
          <lable>Hostel Facilities</lable>
          <div class="form_part">
              <lable>Yes</lable>
          <input required="" type="radio" name="hostel" value="Yes">
          <lable>No</lable>
          <input required="" type="radio" name="hostel" value="No" checked="">
       </div>
       </div>
      <div class="radio">
          <lable>Transportation Services</lable>
          <div class="form_part">
          <lable for="yes">Yes</lable>
          <input required="" id="yes" type="radio" name="trans" value="Yes">
          <lable for="no">No</lable>
          <input required="" id="no" type="radio" name="trans" value="No" checked="">
       </div>
       </div>
    <input class="submit_btn" id="submit_sign" type="submit" value="SUBMIT">
  </form> 
</div>

<!-- contact form end-->

<!-- Begin Body -->
<!-- Social Media -->

<div class="icon-bar">
  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="#" class="google"><i class="fa fa-google"></i></a> 
  <a href="#" class="youtube"><i class="fa fa-youtube"></i></a> 
</div>

<!-- Social Media -->