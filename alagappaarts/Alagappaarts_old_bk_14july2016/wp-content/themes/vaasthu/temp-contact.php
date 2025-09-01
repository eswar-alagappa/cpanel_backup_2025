<?php
/*
Template Name: Contact Us
 * The default template for displaying pages.
 */
?>

<?php get_header(); ?>
<div id="content-full">
<h2><?php the_title(); ?></h2>
	<div class="contactContent">
    <div class="contactContentL"><span>Please fill the following form to <br />
Connect with us</span>
<?php insert_cform('1'); ?>
	
    </div>
    
     <div class="contactContentR">
	<span>Alagappa Performing Arts Academy,</span>
    <div class="contactInnerRight">
     <?php echo get('contact_us_usa_address');?>
   <?php echo get('contact_us_usa_map');?>
    </div>
    
     <div class="contactInnerRight">
    <?php echo get('contact_us_india_address');?>
   <?php echo get('contact_us_india_map');?>
    </div>
    
    
    
    
    
   
    
    
    </div>
    </div>

</div>		
	

<?php get_footer(); ?>