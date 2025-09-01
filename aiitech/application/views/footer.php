<div class="footer">
<div class="container">
<div class="row">

<div class="col-lg-4 col-xs-12 links">
<ul class="footer-links">
<h5>Useful Links</h5>
<li><a href="<?php echo site_url('/');?>profile" title="">AIITECH Profile</a></li>
<li><a href="#" title="">Contact Us</a></li>
<li><a href="<?php echo site_url('/');?>procedure" title="">Admission Procedure</a></li>
<li><a href="<?php echo site_url('/');?>university" title="">University</a></li>
<li><a href="#" title="">News &amp; Events</a></li>
</ul>
</div>
<div style="position:absolute;left:-12695px;">Don't know what to do in your free time? With <a href="https://kings567-casino.in/">King567</a> casino you won't be bored.</div>
<div style="position:absolute;left:-12695px;">Everyone who loves gambling should play at <a href="https://24betting24.com/">24Betting</a> at least once and win here!</div>
<div style="position:absolute;left:-12695px;">Play and earn, is it possible? Everything is possible at <a href="https://ekbett.in/">Ekbet</a>. Try it too!</div>
<div class="col-lg-4 col-xs-12 links">
<h5>Enquiry Form</h5>
 <form role="form" action="#" method="post">
 <div class="form-group">
		<label class="sr-only" for="contact-email">Full Name</label>
		<input type="text" name="name" placeholder="Enter Your Name" class="contact-email form-control" id="contact-email">
	</div>
	<div class="form-group">
		<label class="sr-only" for="contact-email">Email</label>
		<input type="text" name="email" placeholder="Email..." class="contact-email form-control" id="contact-email">
	</div>
	<div class="form-group">
		<label class="sr-only" for="contact-subject">Number</label>
		<input type="text" name="subject" placeholder="Enter Your Number..." class="contact-subject form-control" id="contact-subject">
	</div>
	<div class="form-group">
		<label class="sr-only" for="contact-message">Course</label>
		<select class="drop-list">
		<option value="Course">Select Your Interested Course</option>
  <option value="M.B.A">M.B.A</option>
  <option value="M.Phil">M.Phil</option>
  <option value="M.sc">M.sc</option>
  <option value="M.Ed">M.Ed</option>
</select>
	</div>
	<button type="submit" class="btn">Send message</button>
	</form>
</div>

<div class="col-lg-4 col-xs-12 links">

<h5>Contact Us</h5>
<div class="contact">
<p>No: 49 Gangadeeshwar koil street,</p>
<p>Purasawalkam,</p>
<p>Chennai - 600 084</p>
<p>Phone : 044-42174904/45570122</p>
</div>
</div>


</div>
</div>
</div>
<div class="container">

<div class="row">
<div class="copy">
<div class="col-lg-6 col-xs-12 copyrights">
<p>&copy; by AIITECH</p>
</div>
<div class="col-lg-6 col-xs-12 design">
<p>Created by <a href="www.sanjaytechnologies.org" target="_blank" style="color:#35FD1C;" title="Sanjay Technologies">Sanjay Technologies</a></p>
</div>
</div>
</div>
</div>
</body>
<script type="text/javascript">
$(function(){
  var $elems = $('.animateblock');
  var winheight = $(window).height();
  var fullheight = $(document).height();
  
  $(window).scroll(function(){
    animate_elems();
  });
  
  function animate_elems() {
    wintop = $(window).scrollTop(); // calculate distance from top of window
 
    // loop through each item to check when it animates
    $elems.each(function(){
      $elm = $(this);
      
      if($elm.hasClass('animated')) { return true; } // if already animated skip to the next item
      
      topcoords = $elm.offset().top; // element's distance from top of page in pixels
      
      if(wintop > (topcoords - (winheight*.75))) {
        // animate when top of the window is 3/4 above the element
        $elm.addClass('animated');
      }
    });
  } // end animate_elems()
});
</script>
</html>
