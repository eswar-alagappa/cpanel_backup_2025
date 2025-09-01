<link type="text/css" href="<?php echo base_url()?>assets/home/css/ui.all.css" rel="stylesheet" />

<script src="//code.jquery.com/jquery-1.10.2.js"></script>  
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#accordion").accordion({active: false, collapsible: true, alwaysOpen: false, autoheight: false});
});
</script>
<style>
.ui-accordion .ui-accordion-content{
	border-style:none;
}
</style>
<div class="danceInnerContent">
 <?php $this->load->view('left_banner'); ?>


 
 
 <div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span>Video Gallery</span></h2>
</div>

    
<div class="apaaContent videogallery">
	
	<!-- Gallery Start -->
 		 
		<ul>
		<li><iframe width="100%" height="290" frameborder="0" allowfullscreen="allowfullscreen" src="https://www.youtube.com/embed/sx_ib62cdvI?rel=0"></iframe></li>
		<li><iframe width="100%" height="290" frameborder="0" allowfullscreen="allowfullscreen" src="https://www.youtube.com/embed/8QkM-WBxkEM?rel=0"></iframe></li>
		
		</ul>
	
	<!-- Gallery End -->

</div>
</div>



</div>