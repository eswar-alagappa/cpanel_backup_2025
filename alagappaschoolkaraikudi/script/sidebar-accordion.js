$(document).ready(function()
{
$(".menu_list p.menu_head").click(function()
    {
		$("p.menu_head").removeClass("menuOn");
		$("div.menu_body").siblings("div.menu_body").slideUp("slow");
		
         if($(this).next("div.menu_body").is(':hidden') == true)
		 {
			 $(this).addClass("menuOn").next("div.menu_body").slideDown(500);
		 }



		
      	
	});
	
	$(".menu_list li.menu_head2").click(function()
    {
		$("li.menu_head2").removeClass("menuOn2 menuOn3");
		$("div.menu_body2").slideUp("slow");
		
         if($(this).next("div.menu_body2").is(':hidden') == true)
		 {
			 $(this).addClass("menuOn2").next("div.menu_body2").slideDown(500);
		 }
});
});