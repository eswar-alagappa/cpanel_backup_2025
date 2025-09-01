<?php

/*

Template Name:Dance of the month

*/

?>
<?php



get_header(); ?>

<div class="danceInnerContent">
  <?php get_sidebar(); ?>
  <div class="danceInnerContentRight">
    <div class="danceBanner">
      <h2><span>
        <?php the_title(); ?>
        </span></h2>
    </div>
   
    
    <div class="apaaContent featuredancerContent">
      <?php query_posts('category_name=dance of the month')?>
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <h4>
        <?php the_title(); ?>
      </h4>
   
   
      <div class="featuredimg"><div class="slide">
        <?php $attachments = new Attachments( 'attachments' );  ?>
        <?php $i=1; if( $attachments->exist() ) : while( $attachments->get() ) :  ?>
        <div> <img src="<?php echo $attachments->url();?>" alt="..."> </div>
        <?php $i++; endwhile; endif; ?>
      </div></div>
      <?php the_content();?>
      <div class="datebg">
        <?php the_time('M')?>
        <span>
        <?php the_time('Y')?>
        </span></div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
</div>
<?php get_footer(); ?>
