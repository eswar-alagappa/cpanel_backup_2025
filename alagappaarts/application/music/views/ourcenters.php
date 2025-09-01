<div class="musicInnerContent">
 <?php $this->load->view('left_banner'); ?>
 <div class="musicInnerContentRight">
<div class="musicInnerBanner">Our Centers</div>
			<div class="musicApaaContent">
			<?php if( isset($centers) && !empty($centers)){ 
				foreach($centers as $center){?>
			<div class="ourCenter">			  
				<div class="ourCenterContent">
					<div class="ourCenterTitle"><?php echo $center->centerName ?></div>
						<div class="ourCenterInner">
							<p><b>Director Name :</b> <?php echo $center->directorName ?><br>
							<b>Address :</b> <?php echo $center->address ?><br>
							<b>Email :</b> <a><?php echo $center->email ?></a><br>
							<b>Phone :</b> <?php echo $center->contact ?></p>
						</div>
				</div>
			 </div>
				<?php } } ?>
			 
			<!--<div class="ourCenter">
			  
			<div class="ourCenterContent">
			<div class="ourCenterTitle">Nrityananda School of Bharatanatyam &amp; Music</div>
			<div class="ourCenterInner">
			<p><b>Director Name :</b> Ms.Sangeetha Agarwal / Ms.Vibha Harikar<br>
			<b>ADDRESS:</b> 4921, Sammy Joe Drive, Fairfax, VA 22030-8274. USA<br>
			<b>E-mail Id :</b> <a href="mailto:vibha.harikar@nrityananda.com">vibha.harikar@nrityananda.com </a><br>
			<b>Number</b> 7036464436″</p>
			</div>
			</div>
			  </div>

			 
			<div class="ourCenter">
			  
			<div class="ourCenterContent">
			<div class="ourCenterTitle">Sangeetha Swara Laya(SSL), Malaysia</div>
			<div class="ourCenterInner">
			<ul><strong>Branch Locations at Malaysia:</strong>
			<li>Selangar</li>
			<li>Shah Alam</li>
			<li>Penang  </li>
			<li>Kedah</li>
			<li>Johar</li>
			<li>Perak</li>
			</ul>
			</div>
			</div>
			  </div>-->
			  </div> 

						

			</div>



</div>