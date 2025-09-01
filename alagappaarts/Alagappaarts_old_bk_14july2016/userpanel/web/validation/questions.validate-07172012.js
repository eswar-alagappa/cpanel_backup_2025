$(document).ready(function(){
$("#questionform").validate({
  rules: {
ddlquestiontype:{
		required: true	
		},
'chkcourses[]':{
		required:true
},
txtquestion:{
		required:true
},
txtboolquestion:{
		required:true
},
txtchoicequestion:{
		required:true
},
'chkans[]':{
		required:true
},
rdbool:{
		required: true	
},
rdstatus:{
		required: true	
}	
	 },
 messages:{
		ddlquestiontype : "Select the question type",
		'chkcourses[]':"Select the course",
		'chkans[]':"Tick the correct answer",
		txtquestion:"Enter the question",
		txtboolquestion:"Enter the question",
		txtchoicequestion:"Enter the question",
		rdbool:"Select the correct answer",
		rdstatus:"Select the status"
    
	},
	ignore:':hidden',
errorElement: 'div',
errorPlacement: function(error, element) { 
if (element.is(":checkbox") )
{ 
if((element).attr("name")=="chkcourses[]")
	{
		error.appendTo( ".checkboxpgm" );
	} 
	else if((element).attr("name")=="chkans[]")
	{
		error.appendTo( ".multipleanswers" );
	} 
}
else if(element.is(":radio") )
{ 
if((element).attr("name")=="rdstatus")
	{
		error.appendTo( ".questionstatus" );
	}
else  if((element).attr("name")=="rdbool")
	{
		error.appendTo( ".boolstatus" );
	}
}
else if(element.is(":textarea") )
{ 
if((element).attr("id")=="txtAns1")
	{
		error.appendTo( ".optans1" );
	}
else if((element).attr("id")=="txtAns2")
	{
		error.appendTo( ".optans2");
	} 
else if((element).attr("id")=="txtAns3")
	{
		error.appendTo( ".optans3" );
	} 
else if((element).attr("id")=="txtAns4")
	{
		error.appendTo( ".optans4" );
	} 
else if((element).attr("name")=="txtquestion")
	{
		error.appendTo( ".briefanswer" );
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