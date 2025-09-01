<?php

if(!$post->post_parent){
	// will display the subpages of this top level page
	$children = wp_list_pages("title_li=&link_before=<span>&link_after=</span>&child_of=".$post->ID."&echo=0");
	 $titlenamer = get_the_title($post->post_parent); 
}
else{
	// diplays only the subpages of parent level
	
	$cathierarchy = $post->ancestors;
	
	if($post->ancestors)
	{
		$ancestors = end($post->ancestors);
		
		if(count($post->ancestors)>=2)
		{
			$ancestors = $cathierarchy[1];
			
		}
		// now you can get the the top ID of this page
		// wp is putting the ids DESC, thats why the top level ID is the last one
		
		
		$children = wp_list_pages("title_li=&link_before=<span>&link_after=</span>&child_of=".$ancestors."&echo=0");
		 $titlenamer = get_the_title($ancestors); 
		// you will always get the whole subpages list
	}
}



if ($children) { ?>
<?php
$classname = 'danceleftNav';
if(is_page(array('registration','students-registration','students-log-in','heritage','center-registration')))
{
	$classname = 'studentleftNav';
}
else if(is_page(array('academics','apaa-programs','eligibility','fast-track','fee-structure','photo-gallery','video-gallery','online-exam','faq')))
{
$classname = 'academicsleftNav';
}

 ?><div  class="<?php echo $classname; ?>"><h2><?php echo $titlenamer;?></h2><?php ?>
	<ul>
		<?php echo $children; ?>
	</ul></div>
<?php } 

?>
 
