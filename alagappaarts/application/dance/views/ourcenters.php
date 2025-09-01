
<div class="danceInnerContent">
 <?php $this->load->view('left_banner'); ?>


 
 
 <div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span>Our Centers</span></h2>
</div>



			<div class="apaaContent">

			<div class="centerListOuter">
			<div class="fl"><img width="5" height="44" src="../assets/home/images/register-title-bg-left.png"></div>
			<div class="centersTop">
			<ol class="snap_nav">
				<li>ALL</li>
				
			</ol>

			</div><div class="fr"><img width="5" height="44" src="<?php echo base_url() ?>assets/home/images/register-title-bg-right.png"></div>
			</div>
			<div class="centersContent">

			<strong>How does a Dance center become an authorized dance center?</strong>
			<p>A dance center should complete the accreditation form on the website and send it to APAA. To obtain APAC Certification a dance center must demonstrate the skills necessary to train students on learning, using and developing their skills. A center that fulfills the requirements for certification is an APAC (Alagappa Performing Arts Academy Authorized Certification Center). APAA, on a regular basis, will update the list of Authorized Dance Centers.</p>



			<div class="centersOuter">
			
			<?php //echo '<pre>';print_r($centers);die;
				$itemsCount   = count($centers);
				$itemsPerList = 2;
				$listsNeeded  = ceil($itemsCount / $itemsPerList);

				for ($i = 0; $i < $listsNeeded; $i++) {
					echo '<ul class="row', ($i + 1), '">';
					for ($j = 0; $j < $itemsPerList; $j++) {
						$index = (($i * $itemsPerList) + $j);
						if (isset($centers[$index])) {
							echo '<li>'?>

							<span class="equalheight" style="height: 63px; overflow: hidden;"><?php echo $centers[$index]->centerName; ?><br>
							<strong>Director :  <?php echo $centers[$index]->directorName; ?></strong>
							</span>
							<p><strong>Address </strong>: <?php echo trim($centers[$index]->centerAddress); ?><br>
							<strong>City, State </strong>: <?php echo trim($centers[$index]->centerCity).' , '.trim($centers[$index]->centerState); ?><br>
							<strong>Zip Code </strong>: <?php echo $centers[$index]->centerZip; ?><br>
							<strong>Country </strong>: <?php echo $centers[$index]->centerCountry; ?></p>
							<p><span class="number"><?php echo $centers[$index]->contact; ?></span><span class="mailid"><a href="mailto:<?php echo $centers[$index]->centerEmail; ?>"><?php echo $centers[$index]->centerEmail; ?></a></span></p>
			
									<?php //$centers[$index]->centerName, '</li>';
						} else {
							break;
						}
					}
					echo '</ul>';
				}
			?>
			
			
			</div>





			</div>

			</div>  

			

</div>



</div>