$(document).ready(function(){
$("#adminform").validate({
  rules: {
txtAdminname:{
		required: true	
		},
txtAdminemail:{
		required: true,
		email:true
		},	
txtUsername:{
		required: true
	},	
txtPassword:{
		required: true
		},
txtConfirmpwd:{
	required: true,
	equalTo: "#adminpassword"
		},
txtNewpwd:{
	required: true
},
txtContact:{
		required: true,
		number:true
		},
'chkmoldule[]':{
		required:true
},
rdstatus:{
		required: true
		}
	 },
 messages:{
		txtAdminname : "Enter the name",
		txtAdminemail : "Enter Email ID",
		txtUsername : "Enter user name",
		txtPassword : "Enter user password",
		txtConfirmpwd:"Confirm your password",
		txtContact : "Enter contact number",
		txtNewpwd:"Enter new password",
		'chkmoldule[]':"Choose your responsibility",
		rdstatus:"Select the status"
           
	},
errorElement: 'div',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdstatus")
	{
		error.appendTo( ".status1" );
	}
	else if(element.is(":checkbox") )
{ 
if((element).attr("name")=="chkmoldule[]")
	{
		error.appendTo( ".adminresponsibility" );
	}
}
else
error.insertAfter( element );
}
}
});
$("#editadminform").validate({
  rules: {
txtAdminname:{
		required: true	
		},
txtAdminemail:{
		required: true,
		email:true
		},	
txtUsername:{
		required: true
	},
txtConfirmpwd:{
	equalTo: "#adminpassword"
		},
txtNewpwd:{
	required: true
},
txtContact:{
		required: true,
		number:true
		},
'chkmoldule[]':{
		required:true
},
rdstatus:{
		required: true
		}
	 },
 messages:{
		txtAdminname : "Enter the name",
		txtAdminemail : "Enter Email ID",
		txtUsername : "Enter user name",
		txtConfirmpwd:"Enter same password",
		txtContact : "Enter contact number",
		txtNewpwd:"Enter new password",
		'chkmoldule[]':"Choose your responsibility",
		rdstatus:"Select the status"
           
	},
errorElement: 'div',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdstatus")
	{
		error.appendTo( ".status1" );
	}
	else if(element.is(":checkbox") )
{ 
if((element).attr("name")=="chkmoldule[]")
	{
		error.appendTo( ".adminresponsibility" );
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
$.validator.addMethod('required_group', function(val, el) {
	var $module = $(el).parents('div.searchDiv');
     return $module.find('.required_group:filled').length;
});
$.validator.addClassRules('required_group', {
        'required_group' : true
});
$.validator.messages.required_group = 'Please fill out at least one of these fields.';
$('#formadminlist').validate({
	errorPlacement: function(error, element) {
		if(element.attr("name") == 'selectStatus' )
		  $("#formadminlist").find(".errorContainer").append(error);
}});
	});