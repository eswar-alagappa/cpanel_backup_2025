<?php
$category = get_the_category();


if (is_home()){
include(TEMPLATEPATH.'/header-index.php');
}
else if(is_single())
{
	
include(TEMPLATEPATH.'/header-single.php');

}
else 
{
	
include(TEMPLATEPATH.'/header-inner.php');

}

?>