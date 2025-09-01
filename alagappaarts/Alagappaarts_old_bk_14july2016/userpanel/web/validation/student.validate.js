$(document).ready(function(){
var oldrefcode = $('#txtEnrollmentid').val();
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

$("#studentForm").validate({
  rules: {
txtFname:{
		required: true,
		alpha: true,
		maxlength:30
		},
/*txtLname:{
		required: true	
		},*/
txtAge:{
		required: true
		},
txtMobile:{
		required: true,
		number: true,
		maxlength:15
		},	
txtEmail:{
		required: true,
		maxlength:40,
		email:true
		},
txtCity:{
		required: true,
		maxlength:30
		},
txtState:{
		required: true,
		maxlength:30
		},
txtCountry:{
		required: true,
		maxlength:30
		},
txtZip:{
		required: true,
		maxlength: 15
		},
/* txtdob:{
		required: true,
		DateFormat:true
	   },	
	   */
txtAddress:{
		   maxlength: 100
		   },
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
		required: true,
		alpha: true,
		maxlength:30
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
		}/*,
txtEnrollmentid:{
	  noSpace: true,
	  alphanumeric:true
		}*/	
	 },
 messages:{
		txtFname : {
			required: "Enter the First name",
			alpha: "Enter valid name",
			maxlength: "Enter lessthan 30 characters"
			},
		/*txtLname : "Enter the Last name",*/
		txtAge:"Enter age",
		txtEmail : {
			required: "Enter Email ID",
			maxlength: "Enter lessthan 40 characters"
			},
		txtMobile : {
			required: "Enter contact number",
			number: "Enter only numeric values",
			maxlength: "Enter lessthan 15 characters"
			},
		txtCity	: {
			required: " Enter City",
			maxlength: "Enter lessthan 30 characters"
			},
		txtState : {
			required: " Enter state",
			maxlength: "Enter lessthan 30 characters"
			},
				
		txtCountry	:{
			required: " Enter country",
			maxlength: "Enter lessthan 30 characters"
			},
			
		txtZip :{
			required: " Enter zipcode",
			maxlength: "Enter lessthan 15 characters"
			},
		txtAddress :{
		   maxlength: "Enter lessthan 100 characters"
		   },
		
/*		txtdob : { 
		required :"Pick a date",
		DateFormat: "Please enter a date in the format mm/dd/yyyy"}, */
		rdgender : "Select the gender",
		ddlProgram: "Select the program",
		ddlCenter : "Select the center",
		txtExpBha : "Enter the bharathanatyam experience",
		txtguruname : {
			required: "Enter guru name",
			alpha: "Enter valid name",
			maxlength: "Enter lessthan 30 characters"
			},
		txtMark:"Enter the mark",
		file1:"upload the video",
		ddlcourse:"Select the course", 
		rdstatus:"Select any status"/*,
		txtEnrollmentid:"Enter Reference Code"*/
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



$('#txtEnrollmentid').blur(function()
{
var refcode= $("#txtEnrollmentid").val();
	if(oldrefcode!=refcode){
if($(this).next(".error").is(':visible')){
	if($(".error").is(':visible')){
		$("#msg").hide();
	}}
	else{
		$("#msg").show();	
if( $.trim($(this).val()).length>0)
{
$("#msg").html('Checking...');
$.ajax({
type: "POST",
url:"admin_refcode_controller.php",
data:{refcode:refcode},
success: function(result){
if($.trim(result)!=0)
{
		$('#btnStudentadd').attr("disabled", "true");
		$('#btnStudentedit').attr("disabled", "true");
		$("#msg").parent('div').removeClass("has-success");
		$("#msg").html('<font color="red">Login Id is already exist</font>');
		$("#msg").parent('div').addClass("has-error");
}
else
{
		$('#btnStudentadd').removeAttr("disabled");
		$('#btnStudentedit').removeAttr("disabled");
		$("#msg").parent('div').removeClass("has-error");
		$("#msg").html('<font color="green">Login Id is available</font>');
		$("#msg").parent('div').addClass("has-success");
}
}
	});
	}}
}//if close
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