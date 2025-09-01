/*
 * Active Menu jQuery Plugin 1.0.0
 *
 * Copyright (c) 2009 Chad Ort
 * http://www.caodesigns.com/blog/free-stuff/jquery-active-menu-plugin-2.php?postID=39
 */

/*
Usage
$(ULITEM).activeMenu(OPTIONS);

ULITEM: the item which want the functionality of auto activation tab e.g. #mainMen, .mainMenu etc
OPTIONS: 
In case of no options default options will be used
Example options
$(ULITEM).activeMenu({
	idSwitch: 'someId',
	defaultSite: 'mysite.com',
	defaultIndex: 0
	});
	
in case of mysite.com url first tab will be activated	
*/
(function($){
$.fn.activeMenu = function(options){
	var defaults = {  
		idSwitch: 'active'
		
	},  
	intialize = function(id){
		var op = $.extend({},defaults,options);
		var loc = location.href;
		
		var activeCount = 0;
		$(id).find('ul li').each(function(){
			var href = $(this).find('a').attr('href');
			var isActiveLink = "javascript:;";		
			if(isActiveLink == href){
			//if(loc.search(href) != -1){
				$(this).attr('class', op.idSwitch);
				var menucontainer = $(this).parents("div.menu_body");
				
				if(menucontainer.is(':hidden') == true)
				 {
					 menucontainer.prev().addClass("menuOn");
					 menucontainer.slideDown(500);
					 //$(this).addClass("menuOn").next("div.menu_body").slideDown(500);
				 }
				activeCount++;
			}
			
			
		});
		
	}
	
	return this.each(function(){
		intialize(this);					  
	});
}

})(jQuery);