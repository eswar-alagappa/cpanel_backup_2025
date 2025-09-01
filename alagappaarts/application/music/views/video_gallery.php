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
<div class="musicInnerContent">
 <?php $this->load->view('left_banner'); ?>


 
 
 <div class="musicInnerContentRight">
<div class="musicInnerBanner">
<h2><span>Video Gallery</span></h2>
</div>

    
<div class="musicApaaContent">
 		 
<p><iframe width="100%" height="290" frameborder="0" allowfullscreen="allowfullscreen" src="https://www.youtube.com/embed/FtG58okDOMc"></iframe></p>
	  </div>
</div>



</div>