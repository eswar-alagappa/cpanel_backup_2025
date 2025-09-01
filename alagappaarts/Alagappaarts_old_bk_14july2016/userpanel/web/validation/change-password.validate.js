$(document).ready(function(){
$("#frmchangepassword").validate({
  rules: {
txtOldpassword:{
		required: true	
		},
txtNewPassword:{
		required: true
		},
txtRenewpassword:{
		required: true,
		equalTo: "#newpassword"
	}
	 },
 messages:{
		txtOldpassword : "Enter your old password",
		txtNewPassword : "Enter your new password",
		txtRenewpassword : "Re enter your new password"
 },
errorElement: 'div',
errorClass:'validateError',
});
$('.cancelBtn').click(function(){
	 $('div.error').remove(); 
	});
});
	