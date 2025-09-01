<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
	
	$(function() {
    $( "#tabs" ).tabs();
  });
    /*$(document).ready(function(){

		var tabID = location.search.substring(1); 

		if(tabID){

			$('.contentLeftTop div').each(function(){ $(this).hide(); });

			$('#tabvanilla ul li').each(function(){ $(this).removeClass('ui-tabs-selected'); });

			$('#content'+tabID).show();

			$('#'+tabID).addClass('ui-tabs-selected');

			

		}

		});*/





</script>
<style>
.ui-widget-content{
	background:none;
	border:none;	
}
.ui-widget-header{
	background:none;
	border:none;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	 background: transparent url("../../../assets/home/images/left-bg.gif") no-repeat scroll left top;
    cursor: pointer;
    float: left !important;
    font-size: 12px;
    font-weight: bold !important;
    list-style: outside none none;
    margin-right: 3px;
    padding: 0;
    text-align: center !important;
    text-decoration: none;
    text-transform: uppercase;
}
</style>
<div class="danceInnerContent">
 <?php $this->load->view('left_banner'); ?>
<!--<div class="danceInnerContentLeft"><div class="danceBannerLeft">

 <img src="http://alagappaarts.com/dance/wp-content/header-images/academics-banner-left.jpg" alt="academics-banner-left.jpg" title="academics-banner-left.jpg" />

</div>

<div class="danceLeftContent">

<div  class="academicsleftNav"><h2>Academics</h2>	<ul>
		<li class="page_item page-item-2309 current_page_item"><a href="http://alagappaarts.com/dance/academics/apaa-programs/"><span>Apaa Programs</span></a></li>
<li class="page_item page-item-2311"><a href="http://alagappaarts.com/dance/academics/eligibility/"><span>Eligibility</span></a></li>
<li class="page_item page-item-2313"><a href="http://alagappaarts.com/dance/academics/fast-track/"><span>Fast track</span></a></li>
<li class="page_item page-item-2316"><a href="http://alagappaarts.com/dance/academics/fee-structure/"><span>Fee Structure</span></a></li>
<li class="page_item page-item-2318"><a href="http://alagappaarts.com/dance/academics/photo-gallery/"><span>Photo gallery</span></a></li>
<li class="page_item page-item-2320"><a href="http://alagappaarts.com/dance/academics/video-gallery/"><span>Video Gallery</span></a></li>
<li class="page_item page-item-2322"><a href="http://alagappaarts.com/dance/academics/online-exam/"><span>Online Exam</span></a></li>
<li class="page_item page-item-2324"><a href="http://alagappaarts.com/dance/academics/faq/"><span>FAQ</span></a></li>
	</ul></div>

<div class="courses" id="tabcourses">

<h2>Programs</h2>

<ul>

<li><a href="http://alagappaarts.com/dance/academics/apaa-programs?0">Certificate</a></li>

<li><a href="http://alagappaarts.com/dance/academics/apaa-programs?1">Associate Degree</a></li>

<li><a href="http://alagappaarts.com/dance/academics/apaa-programs?2">Diploma</a></li>

<li><a href="http://alagappaarts.com/dance/academics/apaa-programs?3">Bachelor's Degree</a></li>

</ul>

</div>

<div class="news innerNews">

<h2>news</h2>
<p>Disciple of Smt.Deepali Vora – Nitya Shetra Dance School, completed her Arangetram successfully in Log Angeles, USA.</p>
</div>

</div>

</div>-->

<div class="danceInnerContentRight">

<div class="danceBanner">

<h2><span>Apaa Programs</span></h2>

</div>



  <div class="apaaContent">
	
	<?php if(isset($pgmCourse) && !empty($pgmCourse)){ ?>
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">CERTIFICATE</a></li>
    <li><a href="#tabs-2">ASSOCIATE DEGREE</a></li>
    <li><a href="#tabs-3">DIPLOMA</a></li>
	<li><a href="#tabs-4">BACHELOR&#8217;S DEGREE</a></li>
  </ul>
  
  <?php $i=1;
	if(isset($pgmCourse) && !empty($pgmCourse)){
		foreach($pgmCourse as $k=>$pgm)
		{?>
			<div id="tabs-<?php echo $i ?>">
				
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<th>Course Code</th>
							<th>Course Name</th>
							<th width="255">Content</th>
						</tr>
						<?php if( isset($pgm) && !empty($pgm)){ foreach($pgm as $key=> $pgcourse){?>
						<tr class="altRows">
							<td class="courseName"><?php echo $pgcourse->course_code ?></td>
							<td><?php echo $pgcourse->name ?></td>
							<td><?php echo $pgcourse->description ?></td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
		
			</div>
			<?php //echo '<pre>';print_r($pgm);
			$i++;
			
		}
	} 
	
	?>
	
  
</div>
<?php } ?>

<?php if(isset($pgmFees) && !empty($pgmFees)){ ?>
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">CERTIFICATE</a></li>
    <li><a href="#tabs-2">ASSOCIATE DEGREE</a></li>
    <li><a href="#tabs-3">DIPLOMA</a></li>
	<li><a href="#tabs-4">BACHELOR&#8217;S DEGREE</a></li>
  </ul>
  
  <?php $i=1;
	if(isset($pgmFees) && !empty($pgmFees)){
		foreach($pgmFees as $k=>$pgmfee)
		{?>
			<div id="tabs-<?php echo $i ?>">
				<p><span>Name of the Course :</span> <?php echo stripslashes($pgmfee[0]->pname); ?><br>
				<span>Duration:</span> <?php 
				echo (!empty($pgmfee[0]->fast_track_duration) ? 'Fast Track - '.($pgmfee[0]->grace_period_month + $pgmfee[0]->fast_track_duration).' Month; ' : ''); 
				echo (!empty($pgmfee[0]->duration_year) ? 'Regular - '.($pgmfee[0]->duration_year ).' Year' : ''); 
				?></p>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<th>Course Code</th>
							<th>Course Content</th>
							<th width="255">Tuition Fees including
text Books / DVD</th>
						</tr>
						<?php 
						$j=0; $feecnt = count($pgmfee);
						if( isset($pgmfee) && !empty($pgmfee)){ foreach($pgmfee as $key=> $fee){?>
						<tr class="altRows">
							<td align="center"><?php echo $fee->course_code//(($j==0) ? 'RG' : (($j==($feecnt-1)) ? 'GR' : $fee->course_code))  ?></td>
							<td align="left"><?php echo $fee->coursename//(($j==0) ? 'Registration' : (($j==($feecnt-1)) ? 'Graduation' : $fee->coursename)) ?></td>
							<td align="center"><?php echo $fee->amount ?></td>
						</tr>
						<?php  $j++; }}?>
					</tbody>
				</table>
		
			</div>
			<?php //echo '<pre>';print_r($pgm);
			$i++;
			
		}
	} 
	
	?>
	
  
</div>
<?php } ?>


</div>  







</div>

</div>