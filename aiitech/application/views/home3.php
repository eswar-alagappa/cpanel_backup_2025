<?php include "header.php"; ?>

<script>
var $ = jQuery.noConflict();
</script>
<div class="container">
<div class="row">
<div class="main-page">
<div class="col-lg-6 col-xs-12 half-slider">
   <div class="slider_container">
		<div class="flexslider">
	      <ul class="slides">
	      	
	    	<li>
	    		<img src="img/banner/banner1.png" alt="" title=""/>
	    	</li>
	    	<li>
	    		<img src="img/banner/banner2.png" alt="" title=""/>
	    	</li>
	    	
<?php
	$sql = "select s.*  ";
	$sql .= " from slider s " ;
	$sql .= " order by s.id asc  ";
	$query = $this->db->query($sql);
	$rows = $query->result_array();
	foreach($rows as $row){
?>
	    	<li>
	    	<img src="<?php echo $IMAGE_DIR . $row['image_url'];?>" alt="" title=""/>
	    	<div class="flex-caption">
                <div class="caption_title_line"><h2><?php echo $row['title'];?></h2><p><?php echo $row['description'];?></p></div>
                </div>				
	    	</li>

<?php		
	}
?>


	    </ul>
	  </div>
   </div>
  
</div>
  
<?php include 'social.php'; ?>
<div class="col-lg-6 col-xs-12 page-content">
<h1>AT A GLANCE</h1>
<p>The Alagappa Institute of Technology (AIT) is a service-oriented institution with the primary focus on providing education in emerging academic disciplines, vocational programs and in the field of performing arts. It was founded in September 2001 by Mr. R. Vairavan, the grandson of Dr. RM. Alagappa Chettiar, the founder of the Alagappa Schools, Colleges and the Alagappa University, Karaikudi, Tamil Nadu, India.</p>
<ul class="col-list">
<li><i style="color:#F4A32A;" class="fa fa-university"></i>&nbsp;&nbsp; Alagappa University, Karaikudi, Tamil Nadu.</li>
<li><i style="color:#F4A32A;" class="fa fa-university"></i>&nbsp;&nbsp; Pondicherry University, Pondicherry.</li>
<li><i style="color:#F4A32A;" class="fa fa-university"></i>&nbsp;&nbsp; Tamil Nadu Open University, Chennai.</li>
<li><i style="color:#F4A32A;" class="fa fa-university"></i>&nbsp;&nbsp; Anna University, Coimbatore.</li>
<li><i style="color:#F4A32A;" class="fa fa-university"></i>&nbsp;&nbsp; University Of Madras</li>
</ul>
<br>
<a href="doc/courses-2017.pdf" style="color:#f4a32a;"><p>DEc 2019 DDE-Examination Time Table - Revised</p></a>
</div>

      
</div>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-xs-12 univer-list">
<div class="university">
<div class="col-lg-2 col-xs-12 width">
<div class="animateblock left"><img src="<?php echo base_url()?>img/logos/logo-img.png" height="55" width="70" style="margin-top: -12px;">
<div class="break">Alagappa University, Karaikudi.</div>
</div></div>
<div class="col-lg-2 col-xs-12 width">
<div class="animateblock left"><img src="<?php echo base_url()?>img/logos/Pondy_Univ_logo1.png" width="70" style="margin-top: -12px;"><div class="break">Pondicherry University, Pondicherry.</div></div>
</div>
<div class="col-lg-2 col-xs-12 width">
<div class="animateblock left"><img src="<?php echo base_url()?>img/logos/logo.png" width="60" style="margin-top: -12px;"><div class="break">Tamil Nadu Open University, Chennai.</div></div>
</div>
<div class="col-lg-2 col-xs-12 width">
<div class="animateblock left"><img src="<?php echo base_url()?>img/logos/Anna_University_Logo.svg.png" width="60" style="margin-top: -12px;"><div class="break">Anna University, Coimbatore.</div>
</div></div>
<div class="col-lg-2 col-xs-12 width">
<div class="animateblock left"><img src="<?php echo base_url()?>img/logos/logo (1).png" width="60" style="margin-top: -12px;"><div class="break">University Of Madras.</div>
</div></div>
</div>
</div>
</div>
</div>



<div class="container">
<div class="row">
<div class="latest-news">

<div class="col-lg-4 col-xs-12 area">
<?php include 'major_links.php'; ?>
</div>
<div class="col-lg-4 col-xs-12 news" style="height:auto;">
<h3>Latest News</h3>
<marquee id='scroll_news' direction="up">

<div class="latest-news" style="height:280px;width:100%" onMouseOver="document.getElementById('scroll_news').stop();" onMouseOut="document.getElementById('scroll_news').start();">




<h5><i  class="fa fa-graduation-cap"></i> <span style="color:#0396FF;">Admissions</span></h5>

<a href="javascript:void(0)" target="_blank" style="color:#f4a32a;"><p>1. Alagappa University</p></a>

<!--<p>Calendar year 2018-19 admission going on...</p>-->
<p>Admission for Calendar Year 2020 will start from 1st week of January 2020</p>

<a href="javascript:void(0)" target="_blank" style="color:#f4a32a;"><p>2. Pondicherry University</p></a>

<p>Admission for Calendar Year 2020 will start from 1st week of January 2020</p>


<!--<h5><i  class="fa fa-graduation-cap"></i> <span style="color:#0396FF;">PCP Classes</span></h5>

<p>PCP classes for Alagappa University and Pondicherry University have started..</p>-->



<!--<a href="doc/courses-2017.pdf" style="color:#f4a32a;"><p>Updated Course List</p></a>

<a href="<?php echo base_url();?>schedule" target="_blank" style="color:#f4a32a;"><p>December 2017 Examination List</p></a>-->
<?php
	$sql = "select * from latest_news order by name";
	$query = $this->db->query($sql);
	$rows = $query->result_array();
	foreach($rows as $row){
?>
<h5><i  class="fa fa-graduation-cap"></i> <span style="color:#0396FF;"><?php echo $row['title'];?></span></h5>
<p><?php echo $row['description'];?></p>
<?php
	} ?>

	<!--<h5><i  class="fa fa-graduation-cap"></i> <span style="color:#0396FF;">Examination</span></h5>
	<p>Examination Starts on 26 Dec 2017</p>
    <p>Examination Centers (Theory and Practical) for Dec 2017 -<a href="<?php echo base_url();?>uploads/pdf/dec_2017/DDE Exam Centres Dec 2017.pdf" target="_blank" style="color:#f4a32a;"> Click here</a></p>

	<p>December 2017 Examination Timetable For -<a href="<?php echo base_url();?>schedule" target="_blank" style="color:#f4a32a;"> Click here</a></p>
	
	<h5><i  class="fa fa-graduation-cap"></i> <span style="color:#0396FF;">Pondicherry University Examination</span></h5>
	<p>December 2017 Examination Timetable for Alagappa Institute of Technology -<a href="<?php echo base_url();?>schedule" target="_blank" style="color:#f4a32a;"> Click here</a></p>
	
	<p><a href="<?php echo base_url(); ?>uploads/pdf/dec_2017/PU time table Sem.pdf" style="color:#f4a32a;" title="Exam Schedule" target="_blank">PU Semester Programme</a></p>

	<p><a href="<?php echo base_url(); ?>uploads/pdf/dec_2017/PU time table Non Sem.pdf" style="color:#f4a32a;" title="Exam Schedule" target="_blank">PU Non-Semester Programme</a></p>
	
	<h5><i  class="fa fa-graduation-cap"></i> <span style="color:#0396FF;">Examination Centers</span></h5>
	
	<p>Examination Centers December 2017 - <a href="<?php echo base_url();?>uploads/pdf/dec_2017/PU%20exam%20center.pdf" target="_blank" style="color:#f4a32a;"> Click here</a></p>-->
	
	
	
</marquee>
</div>
</div>


<div class="col-lg-4 col-xs-12 technology">
<h3>Welcome to Alagappa Institute of Technology</h3>
<p><img class="img-border" src="img/news1.jpg" alt="ImageMissing"><span class="hints">AIT has been designed to provide an academic ambience,conducive for learning.<span></p>
<h5>Our Institution</h5>
<p><img class="img-border" src="img/news2.jpg" alt="ImageMissing"><span class="hints">AIT has been designed to provide an academic ambience,conducive for learning. The Institutes in Chennai and Karaikudi have been equipped with state of the art hardware and software, which clearly distinguish it from the rest of such centers in the city.</span></p>


</div>
</div>
</div>
</div>

<?php include "footer.php"; ?>