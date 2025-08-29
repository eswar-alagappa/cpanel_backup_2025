<?php
// Handle form submission
$formSubmitted = false;
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values and sanitize them
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $number = htmlspecialchars(trim($_POST['number']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Basic validation
    if ($firstname && $lastname && $email && $number && $message) {
        // Set email parameters
        $to = "seraphimtechnology@gmail.com";  // Change this to your email
        $subject = "New Contact Form Submission";
        $body = "You have received a new message from your website contact form:\n\n"
              . "First Name: $firstname\n"
              . "Last Name: $lastname\n"
              . "Email: $email\n"
              . "Phone Number: $number\n\n"
              . "Message:\n$message";

        $headers = "From: $email";

        // Attempt to send the email
        if (mail($to, $subject, $body, $headers)) {
            $formSubmitted = true;
        } else {
            $errorMessage = "Failed to send your message. Please try again later.";
        }
    } else {
        $errorMessage = "Please fill in all required fields.";
    }
}
?>


﻿<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Contact Form - Alagappa Girls Matriculation Hr. Sec School - Excellence in Education, Karaikudi</title>
    <meta name="author" content="Zemaraim Technology Private Limited">
<meta name="description" content="Alagappa Girls Matriculation Hr.Sec School in Karaikudi provides quality education with a focus on academic excellence, holistic development, and extracurricular activities for girls.">
<meta name="keywords" content="Alagappa Girls School, Karaikudi, Matriculation School, Girls Education, School in Karaikudi, Educational Excellence, Holistic Development, Karaikudi Schools">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="../../css2?family=Fredoka:wght@400;500;600;700&family=Jost:wght@400;500&display=swap" rel="stylesheet">


    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/app.min.css"> -->
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Layerslider -->
    <link rel="stylesheet" href="assets/css/layerslider.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>



<style>
    body {
    font-family: var(--body-font);
    font-size: 16px;
    font-weight: 400;
    color: var(--body-color);
    background-color: var(--body-bg);
    line-height: 0;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
}
    
    .info-style2 .info-icon img {
    filter: none;
    padding-top: 27px;
    transition: all ease 0.4s;
}
    
</style>

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

	
	

    <!--==============================
     Preloader
  ==============================-->
    <div class="preloader  ">
        <button class="vs-btn preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <div class="loader"></div>
        </div>
    </div><!--==============================
    Mobile Menu
  ============================== -->
   <div class="vs-menu-wrapper">
         <div class="vs-menu-area text-center">
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
               <a href="index.php"><img src="assets/img/logo.png" alt="Kiddino"></a>
            </div>
            <div class="vs-mobile-menu">
               <ul>
                  <li>
                     <a href="index.php">Home</a>
                  </li>
                  <li class="menu-item-has-children">
                     <a href="#">About</a>
                     <ul class="sub-menu">
                        <li><a href="about-us.php">About us</a></li>
                        <li><a href="management.php">Management</a></li>
                        <li><a href="principals-desk.php">Principal’s Desk</a></li>
                        <li><a href="uniqueness_of_the_school.php">Uniqueness of School</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="admission.php">Admission</a>
                  </li>
                  <li class="menu-item-has-children">
                     <a href="#">Academics</a>
                     <ul class="sub-menu">
                        <li><a href="curriculum_overview.php">Curriculum Overview</a></li>
                        <li><a href="school-regulations.php">School Regulations</a></li>
                        <li><a href="academic-achievers.php">Academic Achievers</a></li>
                     </ul>
                  </li>
                  <li class="menu-item-has-children">
                     <a href="#">Curricular</a>
                     <ul class="sub-menu">
                        <li><a href="extra-curriculum.php">Extra Curriculum</a></li>
                        <li><a href="eco-club.php">Eco Club</a></li>
                        <li><a href="guides-and-bulbuls.php">Guides and Bulbuls</a></li>
                     </ul>
                  </li>
                  <li class="menu-item-has-children">
                     <a href="#">Gallery</a>
                     <ul class="sub-menu">
                        <li class="menu-item-has-children">
                           <a href="#">Facilities</a>
                           <ul class="sub-menu">
                              <li class="css"><a href="transportation.php">Transportation</a></li>
                              <li class="css"><a href="biology-lab.php">Biology Lab</a></li>
                              <li class="css"><a href="chemistry-lab.php">Chemistry Lab</a></li>
                              <li class="css"><a href="class-room.php">Class Room</a></li>
                              <li class="css"><a href="computer-lab.php">Computer Lab</a></li>
                              <li class="css"><a href="physics-lab.php">Physics Lab</a></li>
                              <li class="css"><a href="play-field.php">Play Field</a></li>
                              <li class="css"><a href="library.php">Library</a></li>
                           </ul>
                        </li>
                        <li class="menu-item-has-children">
                           <a href="#">Testimonials</a>
                           <ul class="sub-menu">
                              <li class="css"><a href="parents-corner.php">Parents Corner</a></li>
                           </ul>
                        </li>
                        <li class="menu-item-has-children">
                           <a href="#">Photos</a>
                           <ul class="sub-menu">
                              <li class="css"><a href="festivals.php">festivals</a></li>
                              <li class="css"><a href="function.php">functions</a></li>
                              <li class="css"><a href="meetings.php">Meetings</a></li>
                           </ul>
                        </li>
                        <li class="css"><a href="upcoming-events.php">Our Events</a></li>
                        <li class="css"><a href="manuscript.php" aria-current="page">Manuscript</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="contact.php">Contact</a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
<!--==============================
         Sidemenu
 ============================== -->
        <div class="sidemenu-wrapper d-none d-lg-block">
           <div class="sidemenu-content">
              <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
              <div class="widget">
                 <div class="widget-about">
                    <div class="footer-logo"><img src="assets/img/logo.png" alt="Kiddino"></div>
                    <p class="mb-0">We are constantly expanding the range of services offered, taking care of children of all ages.</p>
                 </div>
              </div>
              <div class="widget">
                 <h3 class="widget_title">Get In Touch</h3>
                 <div>
                    <p class="footer-text">Monday to Friday: <span class="time">8.30am – 05.00pm</span></p>
                    <p class="footer-text">Saturday, Sunday: <span class="time">Holiday </span></p>
                    <p class="footer-info"><i class="fal fa-envelope"></i>Email: <a href="mailto:girls@alagappa.org">girls@alagappa.org</a></p>
                    <p class="footer-info"><i class="fas fa-mobile-alt"></i>Phone: <a href="tel:+919952984487">+91 9952984487</a></p>
                 </div>
              </div>
              <div class="widget">
                <div>
                  <h3 style="font-size: 25px; font-weight: bold; border-bottom: 2px solid #f1c40f; display: inline-block; padding-bottom: 5px; margin-bottom: 15px;">Follow Us</h3>
                
                  <p style="margin: 12px 0; font-size: 18px; display: flex; align-items: center;">
                    <a href="https://wa.me/919952984487" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                      <i class="fab fa-whatsapp" style="color:#25D366; font-size: 35px; width: 28px;"></i>
                      <span style="margin-left: 10px;">WhatsApp</span>
                    </a>
                  </p>
                
                  <p style="margin: 12px 0; font-size: 18px; display: flex; align-items: center;">
                    <a href="https://x.com/alagappaschools" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                      <i class="fab fa-twitter" style="color:#000; font-size: 35px; width: 28px;"></i>
                      <span style="margin-left: 10px;">X</span>
                    </a>
                  </p>
                
                  <p style="margin: 12px 0; font-size: 18px; display: flex; align-items: center;">
                    <a href="https://www.youtube.com/@alagappagirlsinfinity119" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                      <i class="fab fa-youtube" style="color:#FF0000; font-size: 32px; width: 28px;"></i>
                      <span style="margin-left: 10px;">YouTube</span>
                    </a>
                  </p>
                
                  <p style="margin: 12px 0; font-size: 18px; display: flex; align-items: center;">
                    <a href="https://www.instagram.com/alagappa_girlsschool/" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                      <i class="fab fa-instagram" style="color:#E1306C; font-size: 35px; width: 28px;"></i>
                      <span style="margin-left: 10px;">Instagram</span>
                    </a>
                  </p>
                
                  <p style="margin: 12px 0; font-size: 18px; display: flex; align-items: center;">
                    <a href="https://www.facebook.com/alagappagirls123/" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                      <i class="fab fa-facebook-f" style="color:#4267B2; font-size: 35px; width: 28px;"></i>
                      <span style="margin-left: 10px;">Facebook</span>
                    </a>
                  </p>
                    <p style="margin: 12px 0; font-size: 18px; display: flex; align-items: center;">
                      <a href="https://www.linkedin.com/in/alagappagirlsmatricschool/" target="_blank" style="color: inherit; text-decoration: none; display: flex; align-items: center;">
                      <i class="fab fa-linkedin-in" style="color:#0077B5; font-size: 35px; width: 28px;"></i>
                      <span style="margin-left: 10px;">LinkedIn</span>
                    </a>
                  </p>
                </div>
                </div>
              </div>
              <div class="widget">
                 <h3 class="widget_title">Upcoming Events</h3>
                 <div class="recent-post-wrap">
                    <div class="recent-post">
                       <div class="media-img">
                          <a href="christmas-program.php"><img src="assets/img/events/christmas2.jpg" alt="Blog Image"></a>
                       </div>
                       <div class="media-body">
                          <div class="recent-post-meta">
                             <a href="christmas-program.php"><i class="far fa-calendar-alt"></i>December 23, 2025</a>
                          </div>
                          <h4 class="post-title"><a class="text-inherit" href="christmas-program.php">Christmas Program</a></h4>
                       </div>
                    </div>
                    <div class="recent-post">
                       <div class="media-img">
                          <a href="new_year.php"><img src="assets/img/events/malala/3.jpg" alt="Blog Image"></a>
                       </div>
                       <div class="media-body">
                          <div class="recent-post-meta">
                             <a href="new_year.php"><i class="far fa-calendar-alt"></i>Jaunary 2, 2026</a>
                          </div>
                          <h4 class="post-title"><a class="text-inherit" href="new_year.php">New Year Program</a></h4>
                       </div>
                    </div>
                    <div class="recent-post">
                       <div class="media-img">
                          <a href="department_delight.php"><img src="assets/img/events/department_delight.jpg" alt="Blog Image"></a>
                       </div>
                       <div class="media-body">
                          <div class="recent-post-meta">
                             <a href="department-deligh.php"><i class="far fa-calendar-alt"></i>September 2, 2025</a>
                          </div>
                          <h4 class="post-title"><a class="text-inherit" href="department_delight.php">Department Delight 2025</a></h4>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>

      <!--==============================
         Header Area
         ==============================-->
      <header class="vs-header header-layout1">
         <div class="header-top">
            <div class="container">
               <div class="row justify-content-between align-items-center">
                  <div class="col-auto d-none d-lg-block">
                     <div class="header-links style-white">
                        <ul>
                           <li><a href="https://www.alagappa.org/" target="_blank" rel="noopener"><img class="alignnone wp-image-8582" src="assets/img/alagappaIicon.png" alt="" width="31" height="31"> Welcome to Alagappa Group of Educational Institutions</a>
                           </li>
                           <!--<li><a href="contact.html" class="searchBoxTggler"><i class="far fa-search"></i>Search-->
                           <!--        Keyword</a></li>-->
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-auto text-center">
                     <div class="header-links style2 style-white">
                        <ul>
                           <li><i class="fas fa-envelope"></i>Email: <a href="mailto:girls@alagappa.org">girls@alagappa.org</a></li>
                           <li><i class="fas fa-mobile-alt"></i>Phone: <a href="tel:+919952984487">+91 9952984487</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="sticky-wrap">
            <div class="sticky-active">
               <div class="container">
                  <div class="row gx-3 align-items-center justify-content-between">
                     <div class="col-8 col-sm-auto">
                        <div class="header-logo">
                           <a href="index.php">
                           <img src="assets/img/logo.png" alt="logo">
                           </a>
                        </div>
                     </div>
                     <div class="col text-end text-lg-center">
                        <nav class="main-menu menu-style1 d-none d-lg-block">
                           <ul>
                              <li>
                                 <a href="index.php">Home</a>
                              </li>
                              <li class="menu-item-has-children">
                                 <a href="#">About</a>
                                 <ul class="sub-menu">
                                    <li><a href="about-us.php">About us</a></li>
                                    <li><a href="management.php">Management</a></li>
                                    <li><a href="principals-desk.php">Principal’s Desk</a></li>
                                    <li><a href="uniqueness_of_the_school.php">Uniqueness of School</a></li>
                                 </ul>
                              </li>
                              <li>
                                 <a href="admission.php">Admission</a>
                              </li>
                              <li class="menu-item-has-children">
                                 <a href="#">Academics</a>
                                 <ul class="sub-menu">
                                    <li><a href="curriculum_overview.php">Curriculum Overview</a></li>
                                    <li><a href="school-regulations.php">School Regulations</a></li>
                                    <li><a href="academic-achievers.php">Academic Achievers</a></li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <a href="#">Curricular</a>
                                 <ul class="sub-menu">
                                    <li><a href="extra-curriculum.php">Extra Curriculum</a></li>
                                    <li><a href="eco-club.php">Eco Club</a></li>
                                    <li><a href="guides-and-bulbuls.php">Guides and Bulbuls</a></li>
                                 </ul>
                              </li>
                              <li class="menu-item-has-children">
                                 <a href="#">Gallery</a>
                                 <ul class="sub-menu">
                                    <li class="menu-item-has-children">
                                       <a href="#">Facilities</a>
                                       <ul class="sub-menu">
                                          <li class="css"><a href="transportation.php">Transportation</a></li>
                                          <li class="css"><a href="chemistry-lab.php">Chemistry Lab</a></li>
                                          <li class="css"><a href="class-room.php">Class Room</a></li>
                                          <li class="css"><a href="computer-lab.php">Computer Lab</a></li>
                                          <li class="css"><a href="physics-lab.php">Physics Lab</a></li>
                                          <li class="css"><a href="play-field.php">Play Field</a></li>
                                          <li class="css"><a href="library.php">Library</a></li>
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <a href="#">Testimonials</a>
                                       <ul class="sub-menu">
                                          <li class="css"><a href="parents-corner.php">Parents Corner</a></li>
                                          <!--
                                             <li class="css"><a href="alumini.php">Alumini</a></li>
                                             <li class="css"><a href="students.php">Students</a></li>
                                             -->
                                       </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                       <a href="#">Photos</a>
                                       <ul class="sub-menu">
                                          <li class="css"><a href="festivals.php">festivals</a></li>
                                          <li class="css"><a href="function.php">functions</a></li>
                                          <li class="css"><a href="meetings.php">Meetings</a></li>
                                       </ul>
                                    </li>
                                    <li class="css"><a href="upcoming-events.php">Our Events</a></li>
                                    <li class="css"><a href="manuscript.php" aria-current="page">Manuscript</a></li>
                                 </ul>
                              </li>
                              <li>
                                 <a href="contact.php">Contact</a>
                              </li>
                           </ul>
                        </nav>
                        <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
                     </div>
                     <div class="col-auto  d-none d-lg-block">
                        <div class="header-icons">
                           <button class="simple-icon sideMenuToggler"><i class="far fa-bars"></i></button>
                        </div>
                     </div>
                     <div class="col-auto d-none d-xl-block">
                        <a href="admission.php" class="vs-btn">Admission</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>

    <!--********************************
   		Code Start From Here 
	******************************** -->


    <!--********************************
   		Code Start From Here 
	******************************** -->



    <div class="breadcumb-wrapper " data-bg-src="assets/img/breadcumb/management.jpg">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Contact Us</h1>
<!--                <p class="breadcumb-text">Montessori Is A Nurturing And Holistic Approach To Learning</p>-->
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="index.html">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!--==============================
    Contact Area
    ==============================-->
    <section class=" space-top space-extra-bottom ">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-style2">
                        <div class="info-icon"><img src="assets/img/icon/c-b-1-1.svg" alt="icon"></div>
                        <h3 class="info-title">Phone No</h3>
                        <p class="info-text"><a href="tel:+919952984487" class="text-inherit">+91 9952984487</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-style2">
                        <div class="info-icon"><img src="assets/img/icon/c-b-1-2.svg" alt="icon"></div>
                        <h3 class="info-title">Monday to Friday</h3>
                        <p class="info-text">8.30am – 05.00pm</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-style2">
                        <div class="info-icon"><img src="assets/img/icon/c-b-1-3.svg" alt="icon"></div>
                        <h3 class="info-title">Email Address</h3>
                        <p class="info-text"><a href="mailto:girls@alagappa.org" class="text-inherit">girls@alagappa.org</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section><!--==============================
    Contact Area
    ==============================-->
    
    
    <style>
        
        
        .required { color: red; }
        .success { color: green; }
        .error { color: red; }
    </style>
    <section class=" space-extra-bottom ">
        <div class="container">
            <div class="row flex-row-reverse gx-60 justify-content-between">
                <div class="col-lg-6 col-xxl-auto">
                    <div class="img-box7">
                        <div class="mega-hover"><img class="w-100" src="assets/img/contactus.jpg" alt="teacher">
                        </div>
                    </div>
                </div>s
                <div class="col-xl col-xxl-6 align-self-center">
                    <div class="title-area">
                        <span class="sec-subtitle">Have Any questions? so plese</span>
                        <h2 class="sec-title">Feel Free to Contact!</h2>
                    </div>
                    <form action="contact.php" method="post" class="form-style3 layout2">
    <div class="row justify-content-between">
        <div class="col-md-6 form-group">
            <label for="firstname">First Name <span class="required">*</span></label>
            <input name="firstname" id="firstname" type="text" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="lastname">Last Name <span class="required">*</span></label>
            <input name="lastname" id="lastname" type="text" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="email">Email Address <span class="required">*</span></label>
            <input name="email" id="email" type="email" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="number">Phone Number <span class="required">*</span></label>
            <input name="number" id="number" type="tel" required>
        </div>
        <div class="col-12 form-group">
            <label for="message">Message <span class="required">*</span></label>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Type your message" required></textarea>
        </div>
        <div class="col-auto form-group">
            <button class="vs-btn" type="submit">Send Message</button>
        </div>
        <div class="form-messages">
            <?php if ($formSubmitted): ?>
                <p class="success">Thank you! Your message has been sent.</p>
            <?php elseif ($errorMessage): ?>
                <p class="error"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
        </div>
    </div>
</form>
                </div>
            </div>
        </div>
    </section><!--==============================
    Map Area
    ==============================-->
    <section class=" space-bottom">
        <div class="container">
            <div class="title-area">
                <h2 class="mt-n2">How To Find Us</h2>
            </div>
            <div class="map-style1">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.2464958706005!2d78.7908775!3d10.078877799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0067c70ab126b5%3A0xb474792b5b9ec8c1!2sAlagappa%20Girls%20School!5e0!3m2!1sen!2sin!4v1742029144752!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
	
	
   <footer class="footer-wrapper footer-layout1" data-bg-src="assets/img/bg/footer-bg-1-1.png">
         <div class="footer-top">
         </div>
         <div class="widget-area">
            <div class="container">
               <div class="row justify-content-center gx-60">
                  <div class="col-lg-4">
                     <div class="widget footer-widget">
                        <h3 class="widget_title v4">Join Us on Social Media</h3>
                        <div class="widget-about-two">
                           <!--<p>-->
                           <!--   The Alagappa Girls School was founded in 2014 by our Chairman Dr. Ramanathan Vairavan.-->
                           <!--   The aim of this school is to discover and draw out the best in all our girls, -->
                           <!--   to bring them up in a happy, structured and caring environment...<a href="about-us.php">Read More</a>-->
                           <!--</p>-->
                           <div class="col-lg-auto">
                              <div class="footer-social">
                                 <a href="https://www.facebook.com/alagappagirls123/"><i class="fab fa-facebook-f"></i></a>
                                 <a href="https://x.com/alagappaschools"><i class="fab fa-twitter"></i></a>
                                 <a href="https://www.linkedin.com/in/alagappagirlsmatricschool/?originalSubdomain=in"><i class="fab fa-linkedin-in"></i></a>
                                 <a href="https://www.youtube.com/@alagappagirlsinfinity119"><i class="fab fa-youtube"></i></a>
                                 <a href="https://www.instagram.com/alagappa_girlsschool/"><i class="fab fa-instagram"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-4">
                     <div class="widget widget_nav_menu  footer-widget">
                        <h3 class="widget_title">Quick Links</h3>
                        <div class="menu-all-pages-container footer-menu">
                           <ul class="menu">
                              <li><a href="about-us.php">About us</a></li>
                              <li><a href="admission.php">Admission</a></li>
                              <li><a href="curriculum_overview.php">Curriculum</a></li>
                              <li><a href="academic-achievers.php">Achievers</a></li>
                              <li><a href="upcoming-events.php">Events</a></li>
                              <li><a href="principals-desk.php">Principal’s Desk</a></li>
                              <li><a href="manuscript.php">Manuscript</a></li>
                              <li><a href="contact.php">Contact Us</a></li>
                              <li><a href="management.php">Management</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-4">
                     <div class="widget footer-widget">
                        <h3 class="widget_title">Location</h3>
                        <div>
                           <p class="footer-info">
                              <i class="fal fa-envelope"></i>Email: 
                              <a href="mailto:girls@alagappa.org">
                                 girls@alagappa.org
                           </p>
                           <p class="footer-info"><i class="fas fa-mobile-alt"></i>Phone: <a href="tel:+918925046042">+91 8925046042</a></p>
                           <p class="footer-info"><i class="fal fa-map-marker"></i>
                              Alagappapuram, Karaikudi-630001
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="copyright-wrap">
            <div class="container">
               <div class="row flex-row-reverse gy-3 justify-content-between align-items-center">
                  <div class="col-lg-auto">
                     <p class="copyright-text "> Designed by  <a href="https://www.zemaraimtechnology.com/">Zemaraim Technology Pvt. Ltd.</a></p>
                  </div>
                  <div class="col-lg-auto">
                     <p class="copyright-text "><a href="https://www.alagappa.org/" target="_blank" rel="noopener"><img class="alignnone wp-image-8582" src="assets/img/alagappaIicon.png" alt="" width="31" height="31"></a> <a href="https://www.alagappa.org/">Alagappa Group of Educational Institutions</a>. All Rights Reserved.</a></p>
                  </div>
               </div>
            </div>
         </div>
      </footer>
    <a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>
    
    
<!--    <div id="footer"></div>-->

    <!--********************************
			Code End  Here 
	******************************** -->

    <!--==============================
        All Js File
    ============================== -->
    <!-- Jquery -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Slick Slider -->
    <script src="assets/js/slick.min.js"></script>
    <!-- <script src="assets/js/app.min.js"></script> -->

    <!-- jquery ui -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Isotope Filter -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- Main Js File -->
    <script src="assets/js/main.js"></script>


</body>

</html>