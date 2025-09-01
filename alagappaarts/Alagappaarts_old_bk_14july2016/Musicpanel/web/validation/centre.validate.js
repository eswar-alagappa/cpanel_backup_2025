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
$("#frmCentreadd").validate({
  rules: {
txtAcademyname:{
		required: true	
		},
txtEmail1:{
		required: true,
		email:true	
		},
txtPhonedaytime:{
		required: true,
		number:true
		},	
txtAcademycity:{
		required: true
		},	
txtAcademystate:{
		required: true
		},
txtAcademycountry:{
		required: true
		},
txtAcademyzipcode:{
		required: true
		},
txtDirectorname:{
		required: true
	   },	
txtDirectorEmail:{
		required: true,
		email:true	
		},
txtDirectorstate:{
		required: true
		},	
txtDirectorcountry:{
		required: true
	   },	
txtDirectorzip:{
		required: true
		},
rdstatus:{
		required: true	
		},
txtCentreid	:{
		required: true	
		}
	 },
 messages:{
		txtAcademyname : "Enter Academy name",
		txtEmail1 : "Enter Email ID",
		txtPhonedaytime : "Enter Contact number",
		txtAcademycity : "Enter the city",
		txtAcademystate:"Enter the state",
		txtAcademycountry:"Enter the country",
		txtAcademyzipcode:"Enter the zipcode",
		txtDirectorname : "Enter director name",
		txtDirectorEmail : "Enter Email ID",
		txtDirectorstate : "Enter the state",
		txtDirectorcountry : "Enter the country",
		txtDirectorzip : "Enter the zip",
		rdstatus:"Select any status",
		txtCentreid:"Enter Reference Code"
  },
errorElement: 'div',
ignore:':hidden',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{  
if((element).attr("name")=="rdstatus")
	{
		error.appendTo(".centrestatus");
	}
else if((element).attr("name")=="txtDirectordob")
	{
		error.appendTo(".studentdate");
	} 
else
error.insertAfter( element );
}
}
});
$('.cancelBtn').click(function(){
 $('div.error').remove(); 
 $("#frmCentreadd .referenceCode").hide();
});
$.validator.addMethod('required_group', function(val, el) {
	var $module = $(el).parents('div.searchDiv');
     return $module.find('.required_group:filled').length;
});
$.validator.addClassRules('required_group', {
        'required_group' : true
});
$.validator.messages.required_group = 'Please fill out at least one of these fields.';
$('#formCentrelist').validate({
	errorPlacement: function(error, element) {
		if(element.attr("name") == 'selectCountry' )
		  $("#formCentrelist").find(".errorContainer").append(error);
}});
$('#frmCentreApproval').validate({
	rules:{
		txtCentrecode:{required: true,alphanumeric: true,noSpace: true}},
messages:{
		txtCentrecode : "Enter Center id without space"}
});
$("input[name$='rdstatus']").click(function(){
var radio_value = $(this).val();

if(radio_value=='Y') {
$("#frmCentreadd .referenceCode").show();
}
else  if(radio_value=='N' ) 
{
$("#frmCentreadd .referenceCode").css('display','none');
}
});

});