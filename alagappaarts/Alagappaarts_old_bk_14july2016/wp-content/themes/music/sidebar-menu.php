
<?php

if(!$post->post_parent){
	// will display the subpages of this top level page
	$children = wp_list_pages("title_li=&link_before=<span>&link_after=</span>&child_of=".$post->ID."&echo=0&depth=1");
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
		
		
		$children = wp_list_pages("title_li=&link_before=<span>&link_after=</span>&child_of=".$ancestors."&echo=0&depth=1");
		 $titlenamer = get_the_title($ancestors); 
		// you will always get the whole subpages list
	}
}



if ($children) { ?>
<?php ?>
<div class="musicLeftMenu">
<div class="curveTop"></div>
<div class="musicLeftMenuContent">
<h3 class="pBottom8"><?php echo $titlenamer;?></h3><?php ?>
	<ul>
		<?php echo $children; ?>
	</ul>
    </div>
<div class="curveBottom"></div>
</div>
<?php } 

?>
 
