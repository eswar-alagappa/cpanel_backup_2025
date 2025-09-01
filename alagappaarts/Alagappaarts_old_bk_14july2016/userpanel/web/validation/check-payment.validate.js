$(document).ready(function(){
$("#frmCheckPayment").validate({
  rules: {
txtAmountPaid:{
		required: true,
		number:true
		},
txtPaidOn:{
		required: true
		},
txtCheckNo:{
		required: true
		},	
txtBanknameBranch:{
		required: true
		},	
txtCreditedOn:{
		required: true
	   },	
txtCheckDate:{
		required: true
},
txtTranscationRefNo:{
		required: true
},
txtComments:{
		required:true
	},
rdstatus:{
		required: true	
		}	
	 },
 messages:{
		txtAmountPaid : "Enter amount",
		txtPaidOn : "Pick a date",
		txtCheckNo : "Enter check number",
		txtBanknameBranch : "Enter the bank name & its branch",
		txtCreditedOn : "Pick a date",
		txtCheckDate : "Pick a date",
		txtTranscationRefNo : "Enter transaction ref No",
		txtComments:"Leave your comments",
		rdstatus:"Select any status"
 },
errorElement: 'div',
errorPlacement: function(error, element) { 

if((element).attr("name")=="txtPaidOn")
	{
		error.appendTo( ".paidondatepick");
	}
else if((element).attr("name")=="txtCreditedOn")
	{
		error.appendTo( ".creditondatepick" );
	} 
else if((element).attr("name")=="txtCheckDate")
	{
		error.appendTo( ".checkdatepick");
	} 
else
error.insertAfter( element );

}
});
$('.cancelBtn').click(function(){
	 $('div.error').remove(); 
	});
	});