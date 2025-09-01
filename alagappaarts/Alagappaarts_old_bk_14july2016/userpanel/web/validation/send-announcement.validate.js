$(document).ready(function(){
$("#frmSendAnnouncement").validate({
  rules: {
ddlCenter:{
		required: true	
		},
/*'student[]':{
		required:true
},*/
txtReplyMessage:{
		required:true
},
txtSubject:{
			required:true
		},
txtMessage:{
	required:true
}
 },
 messages:{
		ddlCenter : "Select the center",
		'student[]':"Select the student",
		'centre[]':"Select the center",
		txtSubject:"Enter the subject",
		txtMessage:"Enter the message content",
		/*txtStudentSubject:"Enter the subject",
		txtStudentMessage:"Enter the message content",*/
		txtReplyMessage:"Please leave your reply"     
	},
errorElement: 'div',
errorClass:'validateError',
errorPlacement: function(error, element) { 
if((element).attr("name")=="student[]")
	{
		error.appendTo( ".studentError" );
	}
else if((element).attr("name")=="centre[]")
	{
		error.appendTo( ".centreError" );
	}
else
error.insertAfter(element);

}
});
$('.cancelBtn').click(function(){
	 $('div.error').remove(); 
	});
	});
	