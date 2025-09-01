<link type="text/css" href="<?php echo base_url()?>assets/home/css/ui.all.css" rel="stylesheet" />

<script src="//code.jquery.com/jquery-1.10.2.js"></script>  
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#accordion").accordion({active: false, collapsible: true, alwaysOpen: false, autoheight: false, animate: false});
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
<h2><span>FAQ</span></h2>
</div>

    
<div class="apaaContent">

<div id="accordion" class="ui-accordion ui-widget ui-helper-reset" role="tablist">

<?php if( isset($getFaqs) && !empty($getFaqs) ){ foreach( $getFaqs as $k=> $faq){?>
<h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="true" tabindex="0"><span class="ui-icon ui-icon-triangle-1-e"></span><?php echo $faq->title ?></h3> 
<div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" style="height: 87px; display: none; overflow: auto; padding-top: 10px; padding-bottom: 0px;" role="tabpanel"><p><?php echo $faq->content ?></p>
 </div>
<?php }} ?>

 </div>
 
 <!--<div class="navigation"><ol class="wp-paginate"><li><span class="title">Pages:</span></li><li><span class="page current">1</span></li><li><a class="page" title="2" href="http://alagappaarts.com/dance/academics/faq/page/2/">2</a></li><li><a class="next" href="http://alagappaarts.com/dance/academics/faq/page/2/">»</a></li></ol></div>-->
 
</div>
</div>



</div>