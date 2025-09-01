$(document).ready(function(){
  $.validator.addMethod("DateFormat", function(value,element) {
        return value.match(/^(0[1-9]|1[012])[- //.](0[1-9]|[12][0-9]|3[01])[- //.](19|20)\d\d$/);
            },
                "Please enter a date in the format mm/dd/yyyy"
            );
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
txtDirectordob:{
		required: true,
		DateFormat:true
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
		txtDirectordob : { 
		required :"Pick a date",
		DateFormat: "Please enter a date in the format mm/dd/yyyy"},  
		txtDirectorEmail : "Enter Email ID",
		txtDirectorstate : "Enter the state",
		txtDirectorcountry : "Enter the country",
		txtDirectorzip : "Enter the zip",
		rdstatus:"Select any status",
		txtCentreid:"Enter Reference Code"
  },
errorElement: 'div',
errorClass: 'divError',
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



});