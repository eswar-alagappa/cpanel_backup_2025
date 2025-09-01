$(document).ready(function(){
$("#materialaddform").validate({
  rules: {
txtmaterialName:{
		required: true	
		},
txtDescription:{
		required: true
		},
rdstatus:{
		required: true
	}
	 },
 messages:{
		txtmaterialName : "Enter Material type",
		txtDescription : "Enter Material description",
		rdstatus : "Select the status"
     
	},
errorElement: 'div',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdstatus")
	{
		error.appendTo( ".status" );
	} 
else
error.insertAfter( element );
}
}


});
$('.cancelBtn').click(function(){
	
	 $('div.error').remove(); 
	});
	});
	$(document).ready(function(){
$("#loginForm").validate({
  rules: {
txtUname:{
		required: true	
		},
txtpwd:{
		required: true
		}
	 },
 messages:{
		txtUname : "Enter the username",
		txtpwd : "Enter the password"
 
	},
errorElement: 'div'


});
$('.cancelBtn').click(function(){
	
	 $('div.error').remove(); 
	});
	});