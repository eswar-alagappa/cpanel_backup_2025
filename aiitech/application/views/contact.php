<?php include 'header.php'; ?>
<div class="container">
<div class="row">
<div class="banner">
<img src="img/banner.jpg" alt="ImageMissing"/>
</div>
</div>
</div>

<div class="container">
<div class="main-page">
<div class="row">

<div class="col-lg-3 col-xs-12 area">
<?php include 'major_links.php'; ?>
</div>
<?php include "social.php";?>


<div class="col-lg-8 col-xs-12 contact-page">
<div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26143.40882073321!2d80.24290738791247!3d13.083908735479042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0xdffb29086bf85c26!2sAlagappa+Matriculation+School!5e0!3m2!1sen!2sin!4v1458738853021" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
</div>
</div>
</div>

<div class="container">
<div class="main-page">
<div class="row">

<div class="col-lg-6 col-xs-12 address">
<h3>Our Location</h3>
<div class="contact-address">
<ul>
<li><span class="icon"><i class="fa fa-street-view"></i></span> No: 49 Gangadeeshwar koil street</li>
<li><span class="icon"><i class="fa fa-area-chart"></i></span> Purasawalkam,</li>
<li><span class="icon"><i class="fa fa-fort-awesome"></i></span> Chennai - 600 084,</li>
<li><span class="icon"><i class="fa fa-phone"></i></span> Phone : 044-42174904 / 45570122</li>
<li><span class="icon"><i class="fa fa-envelope"></i></span> Email : <a style="color:#0074E8;" href="mailto:info@aitech.com" title="Send E-mail">info@aiitech.com</a> / <a style="color:#0074E8;" href="mailto:aluddelc2097@gmail.com" title="Send E-mail">aluddelc2097@gmail.com</a></li>
</ul>
</div>
</div>

<div class="col-lg-6 col-xs-12 feedback-form">
<h3>FeedBack</h3>
<!--begin HTML Form-->

    
   
 <form class="form-horizontal" action="<?= base_url('mail/send_mail') ?>" method="POST">

<div class="form-group"> 
<label for="name" class="col-sm-3 control-label"><span class="required">*</span> Name:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="name" required name="name" placeholder="enter your full name">
</div>
</div>

<div class="form-group">
<label for="email" class="col-sm-3 control-label"><span class="required">*</span> Email: </label>
<div class="col-sm-9">
<input type="email" class="form-control" required id="email"  name="email" placeholder="enter your email id">
</div>
</div>

<div class="form-group">
<label for="phone" class="col-sm-3 control-label">Phone: </label>
<div class="col-sm-9">
<input type="tel" class="form-control" required id="phone" name="phone" placeholder="enter your phone number" >
</div>
</div>

<div class="form-group">
<label for="message" class="col-sm-3 control-label"><span class="required">*</span> Message:</label>
<div class="col-sm-9">
<textarea class="form-control" required name="message"  id="message" placeholder="share your experience with us"></textarea>
</div>
</div>


<div class="form-group">
<div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">
<button type="submit" value="Submit" name="submit" class="btn-lg btn-primary btn-block" >SUBMIT</button>
</div>
</div>
<!--end Form--></form>
<!--end col block--></div>
</div>
<?php include "social.php";?>


<div class="col-lg-9 col-xs-12 contact-page">

</div>
</div>
</div>
</div>

<?php include "footer.php"; ?>
