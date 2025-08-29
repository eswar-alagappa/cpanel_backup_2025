document.addEventListener("DOMContentLoaded", function () {
  const headerHTML = `
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
                                    <li class="css"><a href="upcoming-events.php">Upcoming Events</a></li>
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
      </header>`; // Note: The original header.js had "vs-header header-layout1" on the outer div within headerHTML. If the target <header> in yoga-day.php should have these classes, they should be on the <header> tag itself in yoga-day.php or this outer div within headerHTML should be <header class="vs-header header-layout1">

// The original script provided by the user was:
// const header = document.querySelector("header");
// if (header) {
//   header.innerHTML = headerHTML;
// } else {
//   console.warn("⚠️ No <header> element found to inject the menu.");
// }
// This implies yoga-day.php must provide an empty <header> tag.
// The headerHTML should then be the *content* of that tag.
// The HTML structure above for headerHTML is self-contained and includes mobile menu etc.
// It starts with <div class="vs-menu-wrapper"> and then <div class="vs-header header-layout1">.
// This means it's designed to be put *inside* an empty <header> tag.

  const headerElement = document.querySelector("header");
  if (headerElement) {
    headerElement.innerHTML = headerHTML;
  } else {
    console.warn("⚠️ No <header> element found to inject the header HTML.");
  }
});