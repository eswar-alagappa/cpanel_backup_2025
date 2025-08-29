<div class="container">
	
	<?php
		$CI =& get_instance();
		$CI->showBanner($type) ;
	?>
	
	<div class="row col-md-9 text-justify padding_inline">
		<h3 class="orangecolor inline_heading_margin_bottom">CONTACT US</h3>
				
		<div class="col-lg-12"> 
			<div class="col-lg-6 reachus">
				<h4>REACH US</h4>
				<div class="">
					<ul>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i> Alagappa Academy,</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i> Alagappapuram,</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i>  Karaikudi– 630 003.</li>
						<li><i class="fa fa-envelope" aria-hidden="true"></i>  <a href="http://www.alagappaacademy.com">www.alagappaacademy.com</a> </li>
						<li><i class="fa fa-phone" aria-hidden="true"></i> 04565-230396</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-6 contactus_address">
				<h4>CONTACT US</h4>
				<div class="">
					<ul>
						<li>For Enquiries, Admission, Career</li><li>Mail to: <a href="mailto:dralagappaacademy@gmail.com" title="Enquiry">dralagappaacademy@gmail.com</a></li>
						<li>Enquiry : <a href="mailto:sivakumar@alagappa.org" title="Enquiry">sivakumar@alagappa.org</a></li>
						<!--<li>Principal : <a href="mailto:principal@alagapaacademy.com" title="Principal">principal@alagapaacademy.com</a></li>-->
					</ul>
				</div>
			</div>
		</div>
		
		
	</div>
	
	<?php 
		//echo $this->load->view('right'); 
		$CI =& get_instance();
		$CI->showRight() ;
		?>
	
</div>