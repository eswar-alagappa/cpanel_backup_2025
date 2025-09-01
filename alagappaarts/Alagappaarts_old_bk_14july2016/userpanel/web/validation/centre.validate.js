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

$.validator.addMethod("alpha", function(value,element) {
return value.match(/^[a-zA-Z() ]+$/);
},"Please enter valid name"
);

$("#frmCentreadd").validate({
  rules: {
txtAcademyname:{
		required: true,
		maxlength: 30
		},
txtEmail1:{
		required: true,
		maxlength: 40,
		email:true	
		},
txtPhonedaytime:{
		required: true,
		maxlength: 15,
		number:true
		},	
txtAcademycity:{
		required: true,
		maxlength: 30,
		alpha: true
		},	
txtAcademystate:{
		required: true,
		maxlength: 30,
		alpha: true
		},
txtAcademycountry:{
		required: true,
		maxlength: 30,
		alpha: true
		},
txtAcademyzipcode:{
		required: true,
		maxlength: 15
		},
txtDirectorname:{
		required: true,
		alpha: true,
		maxlength: 30
	   },	
txtDirectorEmail:{
		required: true,
		maxlength: 40,
		email:true	
		},
txtDirectorstate:{
		required: true,
		alpha: true,
		maxlength: 30
		},	
txtDirectorcountry:{
		required: true,
		alpha: true,
		maxlength: 30
	   },	
txtDirectorzip:{
		required: true,
		maxlength: 15
		},
rdstatus:{
		required: true	
		},
txtCentreid	:{
		required: true,
		maxlength: 15
		}
	 },
 messages:{
		txtAcademyname : {
			required: "Enter Academy name",
			maxlength: "Enter lessthen 30 characters",
		},
		txtEmail1 : {
			required: "Enter Email ID",
			maxlength: "Enter lessthen 40 characters",
		},
		txtPhonedaytime : {
			required: "Enter Contact number",
			maxlength: "Enter lessthen 15 characters",
			number: "Enter valid phpne number"
			},
		txtAcademycity : {
			required: "Enter the city",
			alpha:"Enter valid city",
			maxlength: "Enter lessthen 30 characters"
			},
		txtAcademystate:{
			required: "Enter the state",
			alpha: "Enter valid state",
			maxlength: "Enter lessthen 30 characters"
			},
		txtAcademycountry: {
			required: "Enter the country",
			alpha: "Enter valid country",
			maxlength: "Enter lessthen 30 characters"
			},
		txtAcademyzipcode: {
			required: "Enter the zipcode",
			maxlength: "Enter lessthen 30 characters"
			},
		txtDirectorname : {
			required: "Enter director name",
			alpha: "Enter valid name",
			maxlength: "Enter lessthen 30 characters"
			},
		txtDirectorEmail : {
			required: "Enter Email ID",
			email: "Enter valid Email ID",
			maxlength: "Enter lessthen 40 characters"
			},
		txtDirectorstate : {
			required:"Enter the state",
			alpha: "Enter valid state",
			maxlength: "Enter lessthen 30 characters"
			},
		txtDirectorcountry : {
			required: "Enter the country",
			alpha: "Enter valid country",
			maxlength: "Enter lessthen 30 characters"
			},
		txtDirectorzip : {
			required: "Enter the zip",
			maxlength: "Enter lessthen 15 characters"
			},
		rdstatus: "Select any status",
		txtCentreid: {
			required: "Enter Reference Code",
			maxlength: "Enter lessthan 15 characters"
			}
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