$(document).ready(function(){
$("#studentForm").validate({
  rules: {
txtFname:{
		required: true	
		},
txtEmail:{
		required: true,
		email:true	
		},
txtcontact:{
		required: true
		},	
txtAddress:{
		required: true
		},	
txtdob:{
		required: true
	   },	
rdgender:{
		required: true,
		email:true	
		},
'prgm[]':{
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
		}	
	 },
 messages:{
		txtFname : "Enter the name",
		txtEmail : "Enter Email ID",
		txtcontact : "Enter contact number",
		txtAddress : "Enter the address",
		txtdob : "Pick a date",
		rdgender : "Select the gender",
		'prgm[]':"Select the program",
		ddlCenter : "Select the center",
		txtExpBha : "Enter the bharathanatyam experience",
		txtguruname : "Enter guru name",
		txtMark:"Enter the mark",
		file1:"upload the video",
		ddlcourse:"Select the course", 
		rdstatus:"Select any status"
 },
errorElement: 'div',
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
else if((element).attr("name")=="txtdob")
	{
		error.appendTo( ".studentdate");
	} 
else if(element.is(":checkbox") )
{ 
if((element).attr("name")=="prgm[]")
	{
		error.appendTo( ".chkprogram" );
	} 
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