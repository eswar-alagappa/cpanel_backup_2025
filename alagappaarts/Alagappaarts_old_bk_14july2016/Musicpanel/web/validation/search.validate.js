$(document).ready(function(){
	
jQuery.validator.addMethod("require_from_group", function(value, element, options) {

}, jQuery.format("Please fill out at least {0} of these fields."));
jQuery.validator.addClassRules("fillone", {
    require_from_group: [1,".fillone"]
});
$("#search").validate({
  rules: {
txtname:{
		required: true,
		alpha:true	
		},
fillone: "required"		
 },
messages:{
		txtName : "Enter course name"
},
errorElement: 'div'
});
$('.cancelBtn').click(function(){
	
	 $('div.error').remove(); 
	});
	});