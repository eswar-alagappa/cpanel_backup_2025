<?php
//print '<pre>';
//print_r($post);
if(!$post->post_parent){
	
	// will display the subpages of this top level page
	$children = wp_list_pages("title_li=&link_before=&link_after=&child_of=".$post->ID."&echo=0&depth=1&sort_column=post_date");
	
	 $titlenamer = get_the_title($post->post_parent); 
	 
	 /*echo "Parent";
	 echo "<pre>";
	 print_r($post->guid);
	 echo "</pre>";exit;*/
	 if($_REQUEST['page_id']==$post->id) {
$classname = "current_page_item";
}
	 $parent_link=$post->guid;
}
else{
	// diplays only the subpages of parent level
	
	$cathierarchy = $post->ancestors;
	
	if($post->ancestors)
	{
		$ancestors = end($post->ancestors);
		
		if(count($post->ancestors)>=2)
		{
			$ancestors = $cathierarchy[0];
			
		}
		// now you can get the the top ID of this page
		// wp is putting the ids DESC, thats why the top level ID is the last one
		
		
		$children = wp_list_pages("title_li=&link_before=&link_after=&child_of=".$ancestors."&echo=0&depth=1&sort_column=post_date");
		 $titlenamer = get_the_title($ancestors); 
		// you will always get the whole subpages list
	}
	
	$parent_id=$post->post_parent;
	$parent_link=get_permalink($parent_id);
	//print_r($post->guid);
}



if ($children) { ?>

            
         <div class="navigationMiddle">
<div class="navigationMiddleInner">
<h3><?php the_title();?></h3>
<ul>


<?php echo $children; ?>
</ul>


</div> 
 </div>            
         
          
          


<?php } 

?>