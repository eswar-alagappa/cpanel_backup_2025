$(document).ready(function()
{
	//Product sidebar accordion - sliding
	
	
	var id = ".menu_body ul li";
	// Pageload - Set active menu and showing corresponding content based on querystring 	
	var tabID = location.search.substring(1); 
	if(tabID)
	{
	$(id).each(function(){
	
			if(this.id == tabID)
			{
				
				
				 $("#content"+tabID).slideDown(500);
			
				$('#'+tabID).addClass('activebtn');
				$("#contentDefault").slideUp(500);
				
				var menucontainer = $(this).parents("div.menu_body");
				//alert($(this).text());
				if(menucontainer.is(':hidden') == true)
				 {
					 menucontainer.prev().addClass("menuOn");
					 menucontainer.slideDown(500);
					 //$(this).addClass("menuOn").next("div.menu_body").slideDown(500);
					 
				 }
				 $('.subTitle').html('<a href="index.html">Home</a> > <a href="products.html">Products</a> > <span>'+menucontainer.prev().text()+'</span>');
		
			}
			else
			{
				if(this.id)
				{
					$("#content"+this.id).slideUp(500);
					$('#'+this.id).removeClass('activebtn'); 
				}
			}
		});
	
	
	
	}
	// Menu click - Showing the corresponding content
	$(id).click(function(){
		
		var currentid=(this.id);
		
		$(id).each(function(){
			
			if(this.id == currentid)
			{
				
				
				 $("#content"+currentid).slideDown(500);
			
				$('#'+currentid).addClass('activebtn');
				$("#contentDefault").slideUp(500);
				var menucontainer = $(this).parents("div.menu_body");
		$('.subTitle').html('<a href="index.html">Home</a> > <a href="products.html">Products</a> > <span>'+menucontainer.prev().text()+'</span>');
	
			}
			else
			{
				if(this.id)
				{
					$("#content"+this.id).slideUp(500);
					$('#'+this.id).removeClass('activebtn'); 
				}
			}
		});
		
		});
	
});