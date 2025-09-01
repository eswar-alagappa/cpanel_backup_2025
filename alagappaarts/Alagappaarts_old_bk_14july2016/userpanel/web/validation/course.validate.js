$(document).ready(function(){
	

$("#frmCourses").validate({
  rules: {
txtName:{
		required: true	
		},
fillone: "required",		
ddlProgram:{
		required: true
		},	
txtCode:{
		required: true
	},	
ddlRegulation:{
		required: true
		},
txthour:{
		required: true
	},	
txtmin:{
		required: true
		},
txtlimit:{
		required: true
		},
rdstatus:{
	required: true
		}
	 },
messages:{
		txtName : "Enter course name",
		ddlProgram :"Select any program ",
		txtCode : "Enter course code",
		ddlRegulation :"Select the regulation",
		txthour : "Enter Hour",
		txtmin : "Enter minutes",
		txtlimit : "Enter exam attempt limit",
		rdstatus:"Select the status"
    
	},
errorElement: 'div',
ignore: ":hidden",
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdstatus")
	{
		error.appendTo( ".statusnew");
	}
	else if((element).attr("name")=="txthour")
	{
		error.appendTo( ".durationyear" );
	} 
	else if((element).attr("name")=="txtmin")
	{
		error.appendTo( ".durationmonth" );
	}  
else
error.insertAfter( element );
}
}

});
$('.cancelBtn').click(function(){
	
	 $('div.error').remove(); 
	});
	
	$.validator.addMethod('required_group', function(val, el) {
	var $module = $(el).parents('div.searchBox');
     return $module.find('.required_group:filled').length;
});
$.validator.addClassRules('required_group', {
        'required_group' : true
});
$.validator.messages.required_group = 'Please fill out at least one of these fields.';
$('#frmCourseSearch').validate({
	errorPlacement: function(error, element) {
		if(element.attr("name") == 'txtName' )
		  $("#frmCourseSearch").find(".errorContainer").append(error);
}});
	});