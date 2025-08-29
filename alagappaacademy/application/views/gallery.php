<link href="https://alagappaschools.com/css/jquery.littlelightbox.css" rel="stylesheet" type="text/css">

<div class="container">

		<?php
			$CI =& get_instance();
			$CI->showBanner($type) ;
		?>
		<div class="row col-md-12 text-justify padding_inline">
			<h3 class="orangecolor inline_heading_margin_bottom">GALLERY</h3>
		
			<div class="row col-md-9 text-justify padding_inline">
			
			<?php 
			if( isset($gallery) && !empty($gallery) && count($gallery) >0):
			foreach($gallery as $gal):
			?>
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="<?php echo base_url().'upload/gallery/'.$gal->big_img ?>" data-littlelightbox-group="gallery" title="<?php echo $gal->title ?>"><img src="<?php echo base_url().'upload/gallery/thumb/'.$gal->small_img ?>" alt="<?php echo $gal->title ?>"></a>
			</div>
			<?php endforeach; endif; ?>
			<!--<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-2.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-02.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-3.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-03.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-4.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-04.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-5.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-05.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-6.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-06.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-7.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-07.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-8.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-08.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-9.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-09.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-10.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-10.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-11.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-11.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-12.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-12.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-13.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-13.jpg" alt="Alagappa School chennai"></a>
			</div>
			
			<div class="col-lg-4 col-xs-12 gallery-popup">
			<a class="lightbox thumbnail" href="assets/images/gallery/Big/B-14.jpg" data-littlelightbox-group="gallery" title="Annual Camp to Ketti Valley, Coonoor"><img src="assets/images/gallery/Small/S-14.jpg" alt="Alagappa School chennai"></a>
			</div>-->

		</div>
	
		<?php 
		//echo $this->load->view('right'); 
		$CI =& get_instance();
		$CI->showRight() ;
		?>
	</div>
</div>		
		
		
		<script type="text/javascript" src="https://alagappaschools.com/js/jquery.flexisel.js"></script>
	<script type="text/javascript" src="https://alagappaschools.com/js/scrollview.js"></script>
	<script src="https://alagappaschools.com/js/viewportchecker.js" type="text/javascript"></script>
	<script src="https://alagappaschools.com/js/wow.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://alagappaschools.com/js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="https://alagappaschools.com/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="https://alagappaschools.com/js/jquery.ui.rcarousel.js"></script>
	<script type="text/javascript" src="https://alagappaschools.com/js/jquery.littlelightbox.js"></script>
	<script src="https://alagappaschools.com/js/jquery.firstVisitPopup.js"></script>
	<script src="https://alagappaschools.com/assets/popup/main.js"></script>
	<link rel="stylesheet" href="https://alagappaschools.com/assets/popup/main.css">
	
	<script>

$('.lightbox').littleLightBox();
</script>