<?php
/*
 * The template for displaying archive pages.
 */
?>

<?php get_header(); ?>
<div id="content">

	<?php if (have_posts()) : $count = 0; ?>
		<?php if (is_category()) { ?>
			<?php /*?><h4 class="page-title"><?php echo single_cat_title(); ?></h4> <?php */?>
		<?php } elseif (is_day()) { ?>
			<?php /*?><h4 class="page-title"><?php _e('Daily Archives', 'darkorange'); ?> | <?php echo get_the_date(); ?></h4><?php */?>
		<?php } elseif (is_month()) { ?>
			<?php /*?><h4 class="page-title"><?php _e('Monthly Archives', 'darkorange'); ?> | <?php echo get_the_date('F Y'); ?></h4><?php */?>
		<?php } elseif (is_year()) { ?>
			<?php /*?><h4 class="page-title"><?php _e('Yearly Archives', 'darkorange'); ?> | <?php echo get_the_date('Y'); ?></h4><?php */?>
		<?php } elseif (is_author()) { ?>
			<?php /*?><h4 class="page-title"><?php _e('Author Archives', 'darkorange'); ?></h4><?php */?>
		<?php } elseif (is_tag()) { ?>
			<h4 class="page-title"><?php _e('Tag Archives', 'darkorange'); ?> | <?php echo single_tag_title('', true); ?></h4>
	<?php } ?>

    
    
    
    

            
	<?php while (have_posts()) : the_post(); $count++; ?>
		<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to ', 'darkorange'); ?><?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
		<h5 class="postmetadata"><?php _e('Posted on ', 'darkorange'); ?><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a> | <?php _e('By ', 'darkorange'); ?> 
		<?php the_author_posts_link(); ?> <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : echo '|'; ?>
		<?php comments_popup_link( __( 'Leave a response', 'darkorange' ), __( '1 response', 'darkorange' ), __( '% responses', 'darkorange' ) ); ?><?php endif; ?></h5>

	<?php if ( has_post_thumbnail() ) { 
		the_post_thumbnail(); 
	} 	?>

	<?php the_excerpt(); ?>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.', 'darkorange'); ?></p>
		<?php endif; ?>
				
<div class="post-nav">
	<div class="nav-prev"><?php next_posts_link(__( '&laquo; Older posts', 'darkorange' )) ?></div>
	<div class="nav-next"><?php previous_posts_link(__( 'Newer posts &raquo;', 'darkorange' )) ?></div>
</div>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>