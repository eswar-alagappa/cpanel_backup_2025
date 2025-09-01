$(document).ready(function(){
  $.validator.addMethod("DateFormat", function(value,element) {
        return value.match(/^(0[1-9]|1[012])[- //.](0[1-9]|[12][0-9]|3[01])[- //.](19|20)\d\d$/);
            },
                "Please enter a date in the format mm/dd/yyyy"
            );
 jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
}, "No space please and don't leave it empty");
jQuery.validator.addMethod("alphanumeric", function(value, element) {
return this.optional(element) || value == value.match(/^[a-z0-9A-Z#]+$/);
},"Only Characters, Numbers & Hash Allowed.");
$("#studentForm").validate({
  rules: {
txtFname:{
		required: true	
		},
/*txtLname:{
		required: true	
		},*/
txtAge:{
		required: true	
		},
txtMobile:{
		required: true
		},	
txtEmail:{
		required: true,
		email:true
		},
txtCity:{
		required: true
		},
txtState:{
		required: true
		},
txtCountry:{
		required: true
		},
txtZip:{
		required: true
		},	
/* txtdob:{
		required: true,
		DateFormat:true
	   },	
	   */
rdgender:{
		required: true
		},
ddlProgram:{
		required:true
	},
ddlCenter:{
		required: true
		},	
txtExpBha:{
		required: true
	   },	
txtguruname:{
		required: true
		},
txtMark:{
	required:true
},
ddlcourse:{
	required:true
},
file1:{
	required:true
},
rdstatus:{
		required: true	
		},
txtEnrollmentid:{
	  noSpace: true,
	  alphanumeric:true
		}	
	 },
 messages:{
		txtFname : "Enter the First name",
		/*txtLname : "Enter the Last name",*/
		txtAge:"Enter age",
		txtEmail : "Enter Email ID",
		txtMobile : "Enter contact number",
		txtCity	:" Enter City",
		txtState	:" Enter state",
		txtCountry	:" Enter country",
		txtZip	:" Enter zipcode",
/*		txtdob : { 
		required :"Pick a date",
		DateFormat: "Please enter a date in the format mm/dd/yyyy"}, */
		rdgender : "Select the gender",
		ddlProgram:"Select the program",
		ddlCenter : "Select the center",
		txtExpBha : "Enter the music experience",
		txtguruname : "Enter guru name",
		txtMark:"Enter the mark",
		file1:"upload the video",
		ddlcourse:"Select the course", 
		rdstatus:"Select any status",
		txtEnrollmentid:"Enter Reference Code"
 },
errorElement: 'div',
ignore:':hidden',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdstatus")
	{
		error.appendTo( ".studentstatus");
	}
else if((element).attr("name")=="rdgender")
	{
		error.appendTo( ".studentgender" );
	} 
/*else if((element).attr("name")=="txtdob")
	{
		error.appendTo( ".studentdate");
	} 
else if(element.is(":checkbox") )
{ 
if((element).attr("name")=="chkProgram[]")
	{
		error.appendTo( ".chkprogram" );
	} 
}*/
else
error.insertAfter( element );
}
}
});
$('.resetBtn').click(function(){
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
$('#frmStudentsearch').validate({
	errorPlacement: function(error, element) {
		if(element.attr("name") == 'ddlProgram' )
		  $("#frmStudentsearch").find(".errorContainer").append(error);
}});
$('#frmCentreApproval').validate({
	rules:{
		txtCentrecode:{required:true }},
messages:{
		txtCentrecode : "Enter Center id"}
});
$("input[name$='rdstatus']").click(function(){
var radio_value = $(this).val();
if(radio_value=='10') {
$("#studentForm .referenceCode").show();
}
else  if(radio_value=='11' || radio_value=='12' ) 
{
$("#studentForm .referenceCode").css('display','none');
}
});
$('#frmStudentApproval').validate({
	rules:{
		txtEnrollmentid:{  noSpace: true ,
	  alphanumeric:true}},
messages:{
		txtEnrollmentid : "Enter Reference Code"}
});
});