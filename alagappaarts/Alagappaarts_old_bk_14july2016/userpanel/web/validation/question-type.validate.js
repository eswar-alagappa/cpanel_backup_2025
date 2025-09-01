$(document).ready(function(){
	
$("#question-type").validate({
  rules: {
txtName:{
		required: true	
		},
txtDescription:{
		required: true
		},	
txtMarks:{
		required: true,
		digits:true
	},	
	ddlController:{
		required: true
		},
rdStatus:{
		required: true
		}

	 },
 messages:{
		txtName : "Enter the question type",
		txtDescription : "Enter the description ",
		txtMarks : "Enter the marks",
		ddlController:"Select contoller type",
		rdStatus:"Select the status"
    
	},
errorElement: 'div',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdStatus")
	{
		error.appendTo( ".statusnew");
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