
$(document).ready(function() {
	
	 if( $(".dynamicfields").children().size() ==  1 )
	 {
		 $(".dynamicfields>div:first-child").find(".deleteSelection img").attr("src","../web/images/delete-btn-inactive.png");
		 
		 }
 	 var addFieldNo = 1;
	 $('.inputSelect select.centersList').hide();
	 $('.inputSelect select.CertificateList').hide();
	 $('.inputSelect select.dateDiff').hide();
	  $('.inputSelect select.paymentStatus').hide();
	 $('.inputSelect select.graduationStatus').hide();
	 $('.inputSelect select.examResult').hide();
	 $('.inputSelect .BetweenDate').hide();
	$('.addFilter').click(function() {
		
		 $(".dynamicfields>div:first-child").find(".deleteSelection img").attr("src","../web/images/delete-btn.png");
		 if( $(".dynamicfields").children().size() <= 7 ){
	var filedSet=['Last Name','Program','Centre', 'Date of Joining', 'Payment Status','Graduation Status'];
	 $(".studentListing").attr("disabled", true);
	 	  $('.datepicker').datepick('destroy');
	$(".dynamicfields>div:first-child").clone(true).insertAfter(".dynamicfields>div:last-child");
	$(".dynamicfields>div:last-child").find("label.error").remove();
	$(".dynamicfields>div:last-child").find("#datepicker1").attr( "id", "datepicker1"+addFieldNo );
	$(".dynamicfields>div:last-child").find("#datepicker2").attr( "id", "datepicker2"+addFieldNo );
		$(".dynamicfields>div:last-child").find("#studentListing").attr( "id", "studentListing"+addFieldNo );
		$(".dynamicfields>div:last-child select.studentListing").attr("disabled", false);
		$(".datepicker").datepick({
       /* buttonImage: '../web/images/calendar-img.gif',*/
        buttonImageOnly: true,
      /*  showOn: 'button',*/
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate:  new Date(2000, 12-1, 01),  
		maxDate: 0
,
		//onClose: function() { $(".datepicker").focus(); }
		});
		$(".dynamicfields>div").find(".studentListing").each(function() {
			//alert($(this).val());
			switch($(this).val())
			{
				case 'First Name':
				//alert("First");
			$(".studentListing option[value='First Name']").remove();
			$(this).append('<option value="First Name" selected="selected">First Name</option>');
				
			  break;
			case 'Last Name':
		//alert('last nasmer');
			$(".studentListing option[value='Last Name']").remove();
			$(this).append('<option value="Last Name" selected="selected">Last Name</option>');
				
			  break;
			  case 'Program':
			$(".studentListing option[value='Program']").remove();
			$(this).append('<option value="Program" selected="selected">Program</option>');
				
			  break;
			  
			  case 'Centre':
				//alert("First");
			$(".studentListing option[value='Centre']").remove();
			$(this).append('<option value="Centre" selected="selected">Centre</option>');
				
			  break;
			  case 'Date of Joining':
				//alert("First");
			$(".studentListing option[value='Date of Joining']").remove();
			$(this).append('<option value="Date of Joining" selected="selected">Date of Joining</option>');
				
			  break;
			  case 'Payment Status':
				//alert("First");
			$(".studentListing option[value='Payment Status']").remove();
			$(this).append('<option value="Payment Status" selected="selected">Payment Status</option>');
				
			  break;
			   case 'Graduation Status':
				//alert("First");
			$(".studentListing option[value='Graduation Status']").remove();
			$(this).append('<option value="Graduation Status" selected="selected">Graduation Status</option>');
				
			  break;
			 
			/*  case 'Exam Result':
				//alert("First");
			$(".studentListing option[value='Exam Result']").remove();
			$(this).append('<option value="Exam Result" selected="selected">Exam Result</option>');
				
			  break;*/
			
			}
			
		$(this).parent().find(".inputSelect select.centersList").hide();
		$(this).parent().find(".inputSelect select.CertificateList").hide();
		$(this).parent().find(".inputSelect select.dateDiff").hide();
		$(this).parent().find(".inputSelect select.paymentStatus").hide();
		$(this).parent().find(".inputSelect select.graduationStatus").hide();
		$(this).parent().find(".inputSelect select.examResult").hide();
		$(this).parent().find(".inputSelect .BetweenDate").hide();
		$(this).parent().find(".inputSelect input#inputBox2").hide();
		$(this).parent().find(".inputSelect input").removeClass('required');
		$(this).parent().find(".inputSelect select").removeClass('required');
		$(this).parent().find(".inputSelect input#inputBox").show();
		$(this).parent().find(".inputSelect input#inputBox").addClass('required');
		if($(this).val() == "Last Name")
		{
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox2").show();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").addClass('required');
		
		}
		if($(this).val() == "Centre")
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.centersList").addClass('required');
			$(this).parent().find(".inputSelect select.centersList").show();
		}
		if($(this).val() == "Program")
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.CertificateList").addClass('required');
			$(this).parent().find(".inputSelect select.CertificateList").show();
		}
		if($(this).val() == "Date of Joining" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.dateDiff").addClass('required');
			$(this).parent().find(".inputSelect select.dateDiff").show();
			 $(this).parent().find('.inputSelect .BetweenDate').show();
			 $(this).parent().find(".inputSelect input.datepicker").addClass('required');
		}
		if($(this).val() == "Payment Status" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.paymentStatus").addClass('required');
			$(this).parent().find(".inputSelect select.paymentStatus").show();
		}
		if($(this).val() == "Graduation Status" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.graduationStatus").addClass('required');
			$(this).parent().find(".inputSelect select.graduationStatus").show();
		}
		if($(this).val() == "Exam Result" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.examResult").addClass('required');
			$(this).parent().find(".inputSelect select.examResult").show();
		}
	
	
	
	
			/*$(this).parent().find(".inputSelect select.centersList").hide();
	$(this).parent().find(".inputSelect select.CertificateList").hide();
	$(this).parent().find(".inputSelect input").show();
	if($(this).val() == "Centre")
	{//alert($(this).val());
	$(this).parent().find(".inputSelect input").hide();
	$(this).parent().find(".inputSelect select.CertificateList").hide();
	$(this).parent().find(".inputSelect select.centersList").show();
	}
	if($(this).val() == "Program")
	{//alert($(this).val());
	$(this).parent().find(".inputSelect input").hide();
	$(this).parent().find(".inputSelect select.centersList").hide();
	$(this).parent().find(".inputSelect select.CertificateList").show();
	}*/
	
			});
			$(".dynamicfields>div:first-child select.studentListing option:not(:selected)").remove();
			$(".dynamicfields>div:first-child select.studentListing").append('<option value="First Name">First Name</option>');
			$(".dynamicfields>div:first-child select.studentListing").append('<option value="Last Name">Last Name</option>');
			$(".dynamicfields>div:first-child select.studentListing").append('<option value="Program">Program</option>');
			$(".dynamicfields>div:first-child select.studentListing").append('<option value="Centre">Centre</option>');
			$(".dynamicfields>div:first-child select.studentListing").append('<option value="Date of Joining">Date of Joining</option>');
			$(".dynamicfields>div:first-child select.studentListing").append('<option value="Payment Status">Payment Status</option>');
			$(".dynamicfields>div:first-child select.studentListing").append('<option value="Graduation Status">Graduation Status</option>');
			/*$(".dynamicfields>div:first-child select.studentListing").append('<option value="Exam Result">Exam Result</option>');*/
			///alert(newfiledSet);
			$('.studentListingnew').each(function() {
		//$(this).parent().find("div.fromDate").show();
		if($(this).val() == "Before" || $(this).val() == "After")
		{
			//alert($(this).val() );
			$(this).parent().find("div.fromDate").hide();
			
			}
		if($(this).val() == "Between")
		{
			$(this).parent().find("div.fromDate").show();
		}
	});
	
		addFieldNo++;
		return false;
		
	}
	});
$('.deleteSelection').click(function() {
		  
		if( $(".dynamicfields").children().size() > 1 ){
			var filedSet=['First Name','Last Name','Program','Centre', 'Date of Joining', 'Payment Status','Graduation Status'];
			var newfiledSet =filedSet;
			$(this).parent().remove();
			$(".dynamicfields>div:last-child select.studentListing").attr("disabled", false);
				$(".dynamicfields>div").find(".studentListing").each(function() {
				
			switch($(this).val())
			{
				
		case 'First Name':
			 newfiledSet.splice( $.inArray('First Name',newfiledSet), 1 );
			break;
		case 'Last Name':
			newfiledSet.splice( $.inArray('Last Name',newfiledSet), 1 );
			break;
		case 'Program':
		  	newfiledSet.splice( $.inArray('Program',newfiledSet), 1 );
			break;
	
		 case 'Centre':
		  	newfiledSet.splice( $.inArray('Centre',newfiledSet), 1 );
		 	 break;
		 case 'Date of Joining':
			newfiledSet.splice( $.inArray('Date of Joining',newfiledSet), 1 );
			break;
		  case 'Payment Status':
			newfiledSet.splice( $.inArray('Payment Status',newfiledSet), 1 );
		   break;
		 case 'Graduation Status':
			newfiledSet.splice( $.inArray('Graduation Status',newfiledSet), 1 );
		  break;
		 /*case 'Exam Result':
			newfiledSet.splice( $.inArray('Exam Result',newfiledSet), 1 );
			 break;*/
		}
				
		$(this).parent().find(".inputSelect select.centersList").hide();
		$(this).parent().find(".inputSelect select.CertificateList").hide();
		$(this).parent().find(".inputSelect select.dateDiff").hide();
		$(this).parent().find(".inputSelect select.graduationStatus").hide();
		$(this).parent().find(".inputSelect select.paymentStatus").hide();
		$(this).parent().find(".inputSelect select.examResult").hide();
		$(this).parent().find(".inputSelect .BetweenDate").hide();
		$(this).parent().find(".inputSelect input#inputBox2").hide();
		$(this).parent().find(".inputSelect input").removeClass('required');
		$(this).parent().find(".inputSelect select").removeClass('required');
		$(this).parent().find(".inputSelect input#inputBox").show();
		$(this).parent().find(".inputSelect input#inputBox").addClass('required');
		if($(this).val() == "Last Name")
		{
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox2").show();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").addClass('required');
		
		}
		if($(this).val() == "Centre")
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.centersList").addClass('required');
			$(this).parent().find(".inputSelect select.centersList").show();
		}
		if($(this).val() == "Program")
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.CertificateList").addClass('required');
			$(this).parent().find(".inputSelect select.CertificateList").show();
		}
		if($(this).val() == "Date of Joining" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.dateDiff").addClass('required');
			$(this).parent().find(".inputSelect select.dateDiff").show();
			 $(this).parent().find('.inputSelect .BetweenDate').show();
			  $(this).parent().find(".inputSelect input.datepicker").addClass('required');
		}
		if($(this).val() == "Payment Status" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.paymentStatus").addClass('required');
			$(this).parent().find(".inputSelect select.paymentStatus").show();
		}
		if($(this).val() == "Graduation Status" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.graduationStatus").addClass('required');
			$(this).parent().find(".inputSelect select.graduationStatus").show();
		}
		if($(this).val() == "Exam Result" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.examResult").addClass('required');
			$(this).parent().find(".inputSelect select.examResult").show();
		}
	
	
		});
		//alert(newfiledSet);
		$(".dynamicfields>div:last-child select.studentListing option:not(:selected)").remove();
		$.each(newfiledSet, function(index,value) {
			$(".dynamicfields>div:last-child select.studentListing").append($('<option>').text(value).val(value));
		});
	
			}
		 if( $(".dynamicfields").children().size() ==  1 )
	    {
		 $(".dynamicfields>div:first-child").find(".deleteSelection img").attr("src","../web/images/delete-btn-inactive.png");
		 
		 }
});
$('.clearAll').click(function() {
	$(".dynamicfields").find("label.error").remove();
		$(".dynamicfields>div").each(function() {
		if( $(".dynamicfields").children().size() > 1 ){
			$(this).remove();}
		});
		$(".dynamicfields>div:first-child select.studentListing option").remove();
		$(".dynamicfields>div:first-child select.studentListing").append('<option value="First Name" selected="selected">First Name</option>');
		$(".dynamicfields>div:first-child select.studentListing").append('<option value="Last Name">Last Name</option>');
		$(".dynamicfields>div:first-child select.studentListing").append('<option value="Program">Program</option>');
		$(".dynamicfields>div:first-child select.studentListing").append('<option value="Centre">Centre</option>');
		$(".dynamicfields>div:first-child select.studentListing").append('<option value="Date of Joining">Date of Joining</option>');
		$(".dynamicfields>div:first-child select.studentListing").append('<option value="Payment Status">Payment Status</option>');
		$(".dynamicfields>div:first-child select.studentListing").append('<option value="Graduation Status">Graduation Status</option>');
		/*$(".dynamicfields>div:first-child select.studentListing").append('<option value="Exam Result">Exam Result</option>');*/
		$('.inputSelect select.centersList').hide();
		$('.inputSelect select.CertificateList').hide();
		$('.inputSelect select.dateDiff').hide();
		$('.inputSelect select.paymentStatus').hide();
		$('.inputSelect select.graduationStatus').hide();
		$('.inputSelect select.examResult').hide();
		$('.inputSelect .BetweenDate').hide();
		$(".inputSelect input#inputBox2").hide();
		$(".inputSelect input#inputBox").show();
		 if( $(".dynamicfields").children().size() ==  1 )
	 {
		 $(".dynamicfields>div:first-child").find(".deleteSelection img").attr("src","../web/images/delete-btn-inactive.png");
		 
		 }
});
$('.studentListing').change(function() {
	  $('.datepicker').datepick('destroy');
	$(this).parent().find("label.error").remove();
	$(this).parent().find(".inputSelect select.centersList").hide();
	$(this).parent().find(".inputSelect select.CertificateList").hide();
	$(this).parent().find(".inputSelect select.dateDiff").hide();
	$(this).parent().find(".inputSelect select.paymentStatus").hide();
	$(this).parent().find(".inputSelect select.graduationStatus").hide();
	$(this).parent().find(".inputSelect select.examResult").hide();
	 $(this).parent().find('.inputSelect .BetweenDate').hide();
	$(this).parent().find(".inputSelect input").removeClass('required');
		$(this).parent().find(".inputSelect select").removeClass('required');
		$(this).parent().find(".inputSelect input#inputBox").show();
		$(this).parent().find(".inputSelect input#inputBox").addClass('required');
		if($(this).val() == "First Name")
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").show();
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox").addClass('required');
		
		}
		if($(this).val() == "Last Name")
		{
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox2").show();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").addClass('required');
		
		}
		if($(this).val() == "Centre")
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.centersList").addClass('required');
			$(this).parent().find(".inputSelect select.centersList").show();
		}
		if($(this).val() == "Program")
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.CertificateList").addClass('required');
			$(this).parent().find(".inputSelect select.CertificateList").show();
		}
		if($(this).val() == "Date of Joining" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.dateDiff").addClass('required');
			$(this).parent().find(".inputSelect select.dateDiff").show();
			 $(this).parent().find('.inputSelect .BetweenDate').show();
			  $(this).parent().find(".inputSelect input.datepicker").addClass('required');
			  $(".datepicker").datepick({
       /* buttonImage: '../web/images/calendar-img.gif',*/
        buttonImageOnly: true,
      /*  showOn: 'button',*/
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: new Date(2000, 12-1, 01),   
		maxDate: 0
,
		//onClose: function() { $(".datepicker").focus(); }
		});
		}
		if($(this).val() == "Payment Status" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.paymentStatus").addClass('required');
			$(this).parent().find(".inputSelect select.paymentStatus").show();
		}
		if($(this).val() == "Graduation Status" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.graduationStatus").addClass('required');
			$(this).parent().find(".inputSelect select.graduationStatus").show();
		}
		if($(this).val() == "Exam Result" )
		{
			$(this).parent().find(".inputSelect input#inputBox2").hide();
			$(this).parent().find(".inputSelect input#inputBox").hide();
			$(this).parent().find(".inputSelect input#inputBox").removeClass('required');
			$(this).parent().find(".inputSelect input#inputBox2").removeClass('required');
			$(this).parent().find(".inputSelect select.examResult").addClass('required');
			$(this).parent().find(".inputSelect select.examResult").show();
		}
});
$('.studentListingnew').change(function() {
	$(this).parent().find("div.fromDate").show();
	if($(this).val() == "Before" || $(this).val() == "After")
	{
		$(this).parent().find("div.fromDate input").removeClass('required');
		$(this).parent().find("div.fromDate").hide();
	}
	if($(this).val() == "Between")
	{
		$(this).parent().find("div.fromDate input").addClass('required');
		$(this).parent().find("div.fromDate").show();
	}
});

$("#frmStudentreport").validate({
	/* beforeSubmit: function(arr, $form, options) {
          $(".studentListing").attr("disabled", false);
            return true;
        }*/
	 messages:{
		"txtFromdate[]" : "",
		"txtTodate[]" : ""
           
	},
	submitHandler: function(form) { 
              $(form).find(".studentListing").attr("disabled", false);
			  ('#frmStudentreport').submit();
		 //  $(form).submit();
    } 

	/* success: function() {
		 
         $(".studentListing").attr("disabled", false);
     
        }*/
});
});

