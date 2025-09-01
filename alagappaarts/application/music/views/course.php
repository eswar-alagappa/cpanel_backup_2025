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
ul.ui-tabs-nav{
	 background: transparent url("../../../music_assets/home/images/registe-title-bg.gif") repeat scroll left top;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	 background: none;
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
.ui-tabs .ui-tabs-panel{ padding:0px !important; }
table tr td, th{
	 background-color: #eed492;
	 padding:5px;
}
.apaaContent{
	float:left;
}
.ui-state-default a{
	color:#ffd4a5 !important;
}
#tabs ul li.ui-state-active{
background:rgba(0, 0, 0, 0) url("../../../assets/home/images/menu-left-bg.gif") repeat scroll right top
}
tr td{
border-right: 1px solid #deb54c;
border-bottom: 1px solid #deb54c;
}
</style>
<div class="musicInnerContentOuter">
	<div class="musicInnerContent">
	 <?php $this->load->view('left_banner'); ?>


	<div class="musicInnerContentRight">

	<div class="musicInnerBanner">Instrumental Music</div>



	  <div class="apaaContent">
		
		<?php if(isset($pgmCourse) && !empty($pgmCourse)){ ?>
		<div id="tabs">
	  <ul>
		<li><a href="#tabs-1">CERTIFICATE</a></li>
		<li><a href="#tabs-2">ADVANCE CERTIFICATE</a></li>
		<li><a href="#tabs-3">DIPLOMA</a></li>
		<li><a href="#tabs-4">BACHELOR&#8217;S DEGREE</a></li>
	  </ul>
	  
	  <?php $i=1;
		if(isset($pgmCourse) && !empty($pgmCourse)){
			foreach($pgmCourse as $k=>$pgm)
			{?>
				<div id="tabs-<?php echo $i ?>">
					
					<table class="course" border="0" width="100%" cellspacing="0" cellpadding="0">
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
		<li><a href="#tabs-2">ADVANCE CERTIFICATE</a></li>
		<li><a href="#tabs-3">DIPLOMA</a></li>
		<li><a href="#tabs-4">BACHELOR&#8217;S DEGREE</a></li>
	  </ul>
	  
	  <?php $k=0;
		if(isset($pgmFees) && !empty($pgmFees)){ 
			for($i=0;$i<= count($pgmFees); $i++)
			{ $sum = array();
			?>
				
				<div id="tabs-<?php echo $k ?>">
				<table class="fees" border="0" width="100%" cellspacing="0" cellpadding="0">
					<?php if( $k){ ?>
					<thead>
						
							<th>Course Code</th>
							<th>Course Content</th>
							<th width="255">Tuition Fees including
text Books / DVD</th>
						
					</thead>
					<?php }  ?>
					<tbody>
						<?php if( isset($pgmFees[$i]) && !empty($pgmFees[$i])) {
								for($j=0;$j< count($pgmFees[$i]); $j++){?>

						<tr class="altRows">
							<td align="center"><?php echo $pgmFees[$i][$j][0]; ?></td>
							<td align="left"><?php echo $pgmFees[$i][$j][1]; ?></td>
							<td <?php if( count($pgmFees[$i][$j]) > 3 ){?> rowspan="2" <?php }?> align="center"><?php echo 'USD '.$pgmFees[$i][$j][2]; $sum[] = $pgmFees[$i][$j][2]; ?></td>
						</tr>
						<?php if( count($pgmFees[$i][$j]) > 3 ){?>
							<td align="center"><?php echo $pgmFees[$i][$j][3] ?></td>
							<td align="left"><?php echo $pgmFees[$i][$j][4] ?></td>
							
						<?php } ?>
						
						<?php  } } if( $k){ ?> 
						<tr><td></td><td>Total</td><td align="center"><?php echo 'USD '.array_sum($sum); ?></td></tr>
						<?php } $k++;  ?>
					</tbody>
				</table>
			</div>
			<?php
				
			}
		} 
		
		?>
		
	  
	</div>
	<?php } ?>


	</div>  







	</div>

	</div>
</div>