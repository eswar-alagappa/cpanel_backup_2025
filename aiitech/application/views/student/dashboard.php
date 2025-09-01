<?php include "header.php"; ?>
<?php

$student_count = isset($student_count) ? $student_count : 0;
$staff_count = isset($staff_count) ? $staff_count : 0;

?>
<div id="page-wrapper">
	<div class="col_3">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="fa fa-users"></i>
				<div class="stats">
				  <h5><?php echo $staff_count; ?> <span></span></h5>
				  <div class="grow">
					<p>Staff</p>
				  </div>
				</div>
			</div>
		</div>
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="fa fa-users"></i>
				<div class="stats">
				  <h5><?php echo $student_count; ?> <span></span></h5>
				  <div class="grow grow1">
					<p>Students</p>
				  </div>
				</div>
			</div>
		</div>

					<div class="col-md-3 widget widget1">
						<div class="r3_counter_box">
							<i class="fa fa-eye"></i>
							<div class="stats">
							  <h5>0 <span>%</span></h5>
							  <div class="grow grow3">
								<p>Visitors</p>
							  </div>
							</div>
						</div>
					 </div>

					<div class="col-md-3 widget widget1">
						<div class="r3_counter_box">
							<i class="fa fa-mail-forward"></i>
							<div class="stats">
							  <h5>0 <span></span></h5>
							  <div class="grow">
								<p>Dummy</p>
							  </div>
							</div>
						</div>
					 </div>


		<div class="clearfix"> </div>
	</div>
<!--body wrapper start-->
</div>
 <!--body wrapper end-->
</div>

       
<?php include "footer.php"; ?>
