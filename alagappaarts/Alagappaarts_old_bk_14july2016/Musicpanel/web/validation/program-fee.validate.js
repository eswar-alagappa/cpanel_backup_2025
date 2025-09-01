$(document).ready(function(){
$("#prgm-fee").validate({
  rules: {
txtregfee:{
		required: true,
		number:true	
		},
txtgradfee:{
		required: true,
		number:true
		},	
txtPenaltyfee:{
		required: true,
		number:true
	},	
txtotherfee:{
		required: true,
		number:true
		},
/*txtfee1:{
		required: true
	},	
txtfee2:{
		required: true
		},
listcourse1:{
		required: true
		},
listcourse2:{
		required: true
		},*/

ddlProgram:{
	required:true
},
rdStatus:{
	required: true
		}
	 },
 messages:{
		txtregfee : "Enter regulation fee",
		txtgradfee : "Enter graduation fee",
		txtPenaltyfee : "Enter penalty fee",
		txtotherfee : "Enter other fee",
		/*txtfee1 : "Enter course fee",
		txtfee2 : "Enter course fee",
		listcourse1 : "Select the course",
		listcourse2 : "Select the course",*/
		ddlProgram:"Select the program",
		rdStatus:"Select the status"
		
           
	},
errorElement: 'div',
errorPlacement: function(error, element) { 
if(element.is(":input") )
{ 
if((element).attr("name")=="rdStatus")
	{
		error.appendTo( ".programfee-status" );
	}

 else if(element.is(":select") )
{ 
if((element).attr("name")=="ddlProgram")
	{
		error.appendTo( ".dropdownprogramlist" );
	}
	
/*if((element).attr("size")== "4" || (element).attr("title")=="Fee is required" )
	{
		error.appendTo( ".courseFee" );
	}*/
	else
error.insertAfter( element );
}
}
},submitHandler: function(form) {
		$(".dynamicfields>div").find('.classMultiple').attr("disabled", false);
        postForm();
		}
});

$('.cancelBtn').click(function(){
	
	 $('div.error').remove(); 
	});
	});