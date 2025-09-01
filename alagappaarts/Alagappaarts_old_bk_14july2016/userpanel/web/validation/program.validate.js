$(document).ready(function(){
$("#prgmaddform").validate({
  rules: {
txtName:{
		required: true	
		},
/*txtDescription:{
		required: true	
		},*/
txtDurationyear:{
		required: true,
		number:true	
		},	
txtDurationmonth:{
		required: true,
		number:true		
		},	
txtGraceyear:{
		required: true,
		number:true		
		},	
txtGracemonth:{
		required: true,
		number:true		
		},
rdStatus:{
		required: true	
		}	
	 },
 messages:{
		txtName : "Enter program name",
	/*	txtDescription : "Enter program description",*/
		txtDurationyear : "Enter year",
		txtDurationmonth : "Enter month",
		txtGraceyear : "Enter year",
		txtGracemonth : "Enter month",
		rdStatus:"Select any status"
           
	},
errorElement: 'div',
errorPlacement: function(error, element) { 
if (element.is(":input") )
{ 
if((element).attr("name")=="rdStatus")
	{
		error.appendTo( ".status" );
	} 
else if((element).attr("name")=="txtDurationyear")
	{
		error.appendTo( ".durationyear" );
	} 
	else if((element).attr("name")=="txtDurationmonth")
	{
		error.appendTo( ".durationmonth" );
	} 
else if((element).attr("name")=="txtGraceyear")
	{
		error.appendTo( ".graceyear" );
	} 
	else if((element).attr("name")=="txtGracemonth")
	{
		error.appendTo( ".gracemonth" );
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