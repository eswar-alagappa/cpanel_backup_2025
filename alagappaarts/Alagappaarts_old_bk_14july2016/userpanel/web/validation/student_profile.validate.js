$(document).ready(function(){
  $.validator.addMethod("DateFormat", function(value,element) {
        return value.match(/^(0[1-9]|1[012])[- //.](0[1-9]|[12][0-9]|3[01])[- //.](19|20)\d\d$/);
            },
                "Please enter a date in the format mm/dd/yyyy"
            );
  $.validator.addMethod("custom_number", function(value, element) {
    return this.optional(element) || value === "NA" ||
        value.match(/^[0-9,\+-]+$/);
}, "Please enter a valid number");
$("#frmprofileedit").validate({
  rules: {
txtMobile:{
		required: true,
		custom_number:true
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
txtdob:{
		required: true,
		DateFormat:true
	   },
txtAddress:{
required:true
}
	 },
 messages:{
		txtEmail : "Enter Email ID",
		txtMobile : "Enter contact number",
		txtCity	:" Enter City",
		txtState	:" Enter state",
		txtCountry	:" Enter country",
		txtZip	:" Enter zipcode",
		txtdob : { 
		required :"Pick a date",
		DateFormat: "Please enter a date in the format mm/dd/yyyy"},
		txtAddress:"Enter your Address"
	 },
errorElement: 'div',
errorClass: 'validateError',
errorPlacement: function(error, element) { 
if((element).attr("name")=="txtdob")
	{
		error.appendTo( ".studentdate");
	}
	else
error.insertAfter( element );
}


});
});