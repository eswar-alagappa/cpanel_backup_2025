<?php
$arg1 = $this->uri->segment(1);
$arg2 = $this->uri->segment(2);
$parentMenu_small = ((isset($arg2) && !empty($arg2)) ? strtolower($arg2) : strtolower($arg1));
?>
<?php $this->load->view('left_banner'); ?>
<div id="content" class="<?php echo ((isset($parentMenu_small) && !empty($parentMenu_small)) ? $parentMenu_small : '') ?>Content">
<?php print_r($page); ?> 	
</div>	


