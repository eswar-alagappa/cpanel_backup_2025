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
#content ul li{
	background:none;
}
table{
border: 1px solid #deb54c;	
}
table tr td, tr th{
border-right: 1px solid #deb54c;
border-bottom: 1px solid #deb54c;
}
.ui-tabs .ui-tabs-panel{
	padding:0px !important;
}
.ui-state-default a{
color:#8d540e !important;
}
#tabs ul li.ui-state-active{
background:#f7ebbc none repeat scroll 0 0;
 border-left: 1px solid #d4c691;
    border-right: 1px solid #d4c691;
    border-top: 2px solid #8d540e;
    color: #8d540e;
    text-decoration: none;
}

</style>

 <?php $this->load->view('left_banner'); ?>


<div class="danceInnerContentRight">




  <div class="apaaContent">
	
	<?php if(isset($pgmCourse) && !empty($pgmCourse)){ ?>
	<!--<div id="tabs">
  <ul>
    <li><a href="#tabs-1">CERTIFICATE</a></li>
    <li><a href="#tabs-2">ASSOCIATE DEGREE</a></li>
    <li><a href="#tabs-3">DIPLOMA</a></li>
	<li><a href="#tabs-4">BACHELOR&#8217;S DEGREE</a></li>
  </ul>
  -->
  <?php $i=1;
	if(isset($pgmCourse) && !empty($pgmCourse)){
		/*foreach($pgmCourse as $k=>$pgm)
		{*/?>
			<!--<div id="tabs-<?php echo $i ?>">
				
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
		
			</div>-->
			<?php //echo '<pre>';print_r($pgm);
			/*$i++;			
		}*/
		?>
		<div class="programsContent" id="content">

			<h2>Programs</h2>
		<p><img width="234" height="290" alt="certificate-program" 
		src="<?php echo base_url().'vaasthu_assets/home/images/certificate-program1.jpg'?>" class="alignleft size-full wp-image-153"><img width="234" height="290" alt="diploma-program" 
		src="<?php echo base_url().'vaasthu_assets/home/images/diploma-program1.jpg'?>" class="alignleft size-full wp-image-151"><img width="234" height="290" alt="degree-program" 
		src="<?php echo base_url().'vaasthu_assets/home/images/degree-program1.jpg'?>" class="alignleft size-full wp-image-152"></p>


	
</div>
		<?php
	} 
	
	?>
	
  
<!--</div>-->
<?php } ?>

<?php if(isset($pgmFees) && !empty($pgmFees)){ ?>

<h2>Fee Structure</h2>

<div class="fee-structureContent" id="content">
	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">CERTIFICATE</a></li>
    <li><a href="#tabs-2">DIPLOMA</a></li>
	<li><a href="#tabs-3">BACHELOR&#8217;S DEGREE</a></li>
  </ul>
  
  <?php $i=1; //echo '<pre>';print_r($pgmFees);
	if(isset($pgmFees) && !empty($pgmFees)){
		foreach($pgmFees as $k=>$pgmfee)
		{  $sum= 0;?>
			<div id="tabs-<?php echo $i ?>">
				<!--<p><span>Name of the Course :</span> <?php echo stripslashes($pgmfee[0]->pname); ?><br>
				<span>Duration:</span> <?php 
				echo (!empty($pgmfee[0]->fast_track_duration) ? 'Fast Track - '.($pgmfee[0]->grace_period_month + $pgmfee[0]->fast_track_duration).' Month; ' : ''); 
				echo (!empty($pgmfee[0]->duration_year) ? 'Regular - '.($pgmfee[0]->duration_year ).' Year' : ''); 
				?></p>-->
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th align="center">Course Code</th>
							<th align="center">Syllabus</th>
							<th align="center" width="255">Fee(INR)</th>
						</tr>
					</thead>
					<tbody>
						<tr><td align="center"><?php echo substr($pgmfee[0]->course_code, 0, 3).' RG'?></td><td align="left">Course registration</td><td align="center"><?php echo $pgmfee[0]->registration_fee ?></td></tr>
						<?php 
						$j=0; $feecnt = count($pgmfee);
						if( isset($pgmfee) && !empty($pgmfee)){ foreach($pgmfee as $key=> $fee){?>
						<tr class="altRows">
							<td align="center"><?php echo $fee->course_code ?></td>
							<td align="left"><?php echo $fee->coursename ?></td>
							<td align="center"><?php echo $fee->amount; $sum += $fee->amount; ?></td>
						</tr>
						<?php  $j++; }}?>
					<tr><td align="center"><?php echo substr($pgmfee[0]->course_code, 0, 3).' GR'?></td><td align="left">Graduation</td><td align="center"><?php echo $pgmfee[0]->graduation_fee ?></td></tr>
					<tr><td></td><td align="left">Total Fees</td><td align="center"><?php echo $sum + $pgmfee[0]->graduation_fee + $pgmfee[0]->registration_fee; ?></td></tr>
					</tbody>
				</table>
		
			</div>
			<?php //echo '<pre>';print_r($pgm);
			$i++;
			
		}
	} 
	
	?>
	
  
</div>
</div>
<?php } ?>


</div>  







</div>