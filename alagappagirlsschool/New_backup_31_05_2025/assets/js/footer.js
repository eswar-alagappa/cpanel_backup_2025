document.addEventListener("DOMContentLoaded", function () {
  const footerHTML = `
        <div class="footer-top">

        </div>
        <div class="widget-area">
            <div class="container">
                <div class="row justify-content-center gx-60">
                    <div class="col-lg-4">
                        <div class="widget footer-widget">
                            <h3 class="widget_title v4">Join Us on Social Media</h3>
                            <div class="widget-about-two">
                               <div class="col-lg-auto">
                                  <div class="footer-social">
                                     <a href="https://www.facebook.com/alagappagirls123/"><i class="fab fa-facebook-f"></i></a>
                                     <a href="https://x.com/alagappaschools"><i class="fas fa-times"></i></a>
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
                                 <a href="mailto:girls@alagappa.org">girls@alagappa.org</a>
                              </p>
                              <p class="footer-info"><i class="fas fa-mobile-alt"></i>Phone: <a href="tel:+919952984487">+91 9952984487</a></p>
                              <p class="footer-info"><i class="fal fa-map-marker"></i>
                                 Alagappapuram, karaikudi-630001
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
  `;

  const footerElement = document.querySelector("footer.footer-wrapper.footer-layout1");
  if (footerElement) {
    footerElement.innerHTML = footerHTML;
    // If the original footer from index.php had a data-bg-src, ensure the shell tag in yoga-day.php retains it.
    // The shell tag in yoga-day.php will be: <footer class="footer-wrapper footer-layout1" data-bg-src="assets/img/bg/footer-bg-1-1.png"></footer>
    // The main.js or other scripts might use this data attribute, so it's good to have it on the shell.
  } else {
    console.warn("⚠️ No <footer class='footer-wrapper footer-layout1'> element found to inject the footer HTML.");
  }
});