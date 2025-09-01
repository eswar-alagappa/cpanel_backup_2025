$(document).ready(function(){
  $.validator.addMethod("DateFormat", function(value,element) {
        return value.match(/^(0[1-9]|1[012])[- //.](0[1-9]|[12][0-9]|3[01])[- //.](19|20)\d\d$/);
            },
                "Please enter a date in the format mm/dd/yyyy"
            );
			
				$.validator.addMethod("alpha", function(value,element) {
return value.match(/^[a-zA-Z() ]+$/);
},"Please enter valid name "
);
$("#studentForm").validate({
	
  rules: {
txtFname:{
		required: true,
		alpha:true
		},
txtLname:{
		required: true,
		alpha:true	
		},
txtAge:{
		required: true	,
		digits:true
		},
txtMobile:{
		required: true,
		digits:true,
		maxlength:10
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
		required: true,
		digits:true
		},	

rdgender:{
		required: true
		},
ddlProgram:{
		required:true
	},
txtdob:{
		required:true
	},
ddlCenter:{
		required: true
		},	
txtExpBha:{
		required: true
	   },	
txtguruname:{
		required: true,
		alpha:true
		},
txtMark:{
	required:true,
	digits:true
},
ddlcourse:{
	required:true
},
/*uploadphoto:{
	required:true
},*/
txtcontact:{digits:true},
txtAddress:{
	 required:true
},
/*txtSpecqualification:{
	required:true
},*/
txtEnrollmentid:{
		required: true	
		},
defaultReal:{
		required: true	
		}
	 },
 messages:{
		txtFname : "Please enter a valid first name",
		txtLname : "Please enter a valid last name",
		txtAge:"Enter age",
		txtEmail : "Enter Email ID",
		txtMobile : "Enter contact number",
		txtAddress: "Enter your address",
		txtCity	:" Enter your city",
		txtState	:" Enter your state",
		txtCountry	:" Enter your country",
		txtZip	:" Enter the zipcode",
		rdgender : "Select the gender",
		ddlProgram:"Select the program",
		txtdob:"Enter the Date of Birth",
		ddlCenter : "Select the center",
		txtExpBha : "Enter the music experience",
		txtguruname : "Please enter your guru name",
		uploadphoto:"upload the video",
		ddlcourse:"Select the course", 
		txtSpecqualification:"Enter your academic background",
		txtEnrollmentid:"Enter Reference Code",
		defaultReal:"Enter the captcha "
 },
errorElement: 'div',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdgender")
	{
		error.appendTo( ".studentgender" );
	} 
else if((element).attr("name")=="txtdob")
	{
		error.appendTo( ".studentdate");
	} 
else if((element).attr("name")=="defaultReal")
{
	error.appendTo( ".captcha");
}
else
error.insertAfter( element );
}
}
});

$("#frmCentreadd").validate({
  rules: {
txtAcademyname:{
		required: true	
		},
txtEmail1:{
		required: true,
		email:true	
		},
txtAcademyaddress:{
		required: true
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
		required: true,
		digits:true
		},
rdstatus:{
		required: true	
		},
txtCentreid	:{
		required: true	
		},
defaultReal:{
		required: true	
		}
	 },
 messages:{
		txtAcademyname : "Enter Academy name",
		txtEmail1 : "Enter Email ID",
		txtAcademyaddress : "Enter Address",
		txtPhonedaytime : "Enter Contact number",
		txtAcademycity : "Enter the city",
		txtAcademystate:"Enter the state",
		txtAcademycountry:"Enter the country",
		txtAcademyzipcode:"Enter the zipcode",
		txtDirectorname : "Enter director name",
		txtDirectordob:"Enter the Date of Birth",
		txtDirectorEmail : "Enter Email ID",
		txtDirectorstate : "Enter the state",
		txtDirectorcountry : "Enter the country",
		txtDirectorzip : "Enter the zip",
		rdstatus:"Select any status",
		txtCentreid:"Enter Reference Code",
		defaultReal:"Enter the captcha "
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
else if((element).attr("name")=="defaultReal")
{
	error.appendTo( ".captcha");
}
else
error.insertAfter( element );
}
}
});

/*$("input[name$='rdstatus']").click(function(){
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
		txtEnrollmentid:{required:true }},
messages:{
		txtEnrollmentid : "Enter Reference Code"}
});*/
});