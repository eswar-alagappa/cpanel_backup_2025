$(document).ready(function(){
$("#frmLogin").validate({
  rules: {
txtUsername:{
		required: true	
		},
txtPassword:{
		required: true
		}
	 },
 messages:{
		txtUsername : "Enter the username",
		txtPassword : "Enter the password"
 
	},
errorElement: 'div'


});
});