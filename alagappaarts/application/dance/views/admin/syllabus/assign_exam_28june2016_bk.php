<!--
<style>
      /* ==========================================================================
          Demo using Bootstrap 3.3.4 and jQuery 1.11.2
          You don't need any of the following styles for the form to work properly, 
          these are just helpers for the demo/test page.
        ========================================================================== */

      #wrapper { 
        width:595px;
        margin:0 auto;
      }
      legend {
        margin-top: 20px;
      }
      #attribution {
        font-size:12px;
        color:#999;
        padding:20px;
        margin:20px 0;
        border-top:1px solid #ccc;
      }
      #O_o { 
        text-align: center; 
        background: #33577b;
        color: #b4c9dd;
        border-bottom: 1px solid #294663;
      }
      #O_o a:link, #O_o a:visited {
        color: #b4c9dd;
        border-bottom: #b4c9dd;
        display: block;
        padding: 8px;
        text-decoration: none;
      }
      #O_o a:hover, #O_o a:active {
        color: #fff;
        border-bottom: #fff;
        text-decoration: none;
      }
      @media only screen and (max-width: 620px), only screen and (max-device-width: 620px) {
        #wrapper {
          width: 90%;
        }
        legend {
          font-size: 24px;
          font-weight: 500;
        }
      }
	  
	  .stud_detail ul li{
		  list-style:none;
	  }
	 
	  .stud_detail ul li span{
		padding:10px;
		width:200px;
		display:inline-block
	  }
	  .pay table tr th, tr td{
		  width:10%;
	  }
      </style>
  <script type="text/javascript" src="<?php //echo base_url()?>assets/admin/js/clone-form-td.js"></script>-->
  <style>
   .stud_detail ul li{
		  list-style:none;
	  }
	 
	  .stud_detail ul li span{
		padding:10px;
		width:200px;
		display:inline-block
	  }
	  .pay table tr th, tr td{
		  width:10%;
	  }
	  .margin_top_50{
		  margin-top:50px;
	  }
  </style>
<div class="right_col" role="main">

                <div class="">
                    <!--<div class="page-title">
                        <div class="title_left">
                            <h3>
                    Form Validation
                </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Student  <small>Assign Online Exam</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
									<?php $urlArg = ((isset($arg) && !empty($arg)) ? '/'.$arg : '');?>
                                    <form id="" name="" method="POST" action="<?php echo base_url()?>dance/admin/students/assign_exam<?php echo $urlArg;?>" class="form-horizontal form-label-left" novalidate enctype="multipart/form-data">
									
                                       
                                        <span class="section">Assign Exam</span>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Select Program <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control col-md-7 col-xs-12 program_id" name="program_id" id="program_id">
													<option value="">Select Program</option>
													<?php if(!empty($programList)) { foreach($programList as $k=>$program){?>
														<option value="<?php echo $program->program_id; ?>" <?php echo (isset($post_set['program_id']) && !empty($post_set['program_id'])  && ($post_set['program_id']== $program->program_id) ? 'selected' : '');?>><?php echo stripslashes($program->name); ?></option>
													<?php } } ?>
											   </select>
											   <?php echo form_error('program_id'); ?>
                                            </div>
                                        </div>
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Enrollment details </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
												<div class="stud_detail">
													<ul>
														<li><span>Student ID : </span><span><?php echo $enroll_detail->username?></span></li>
														<li><span>Student Name : </span><span><?php echo $enroll_detail->firstname.' '.$enroll_detail->lastname?></span></li>
														<li><span>Center Name : </span><span><?php echo $enroll_detail->centerName?></span></li>
														<li><span>Program Enrolled : </span><span class="pname"><?php echo $enroll_detail->programName?></span></li>
														<li><span>Date of joining : </span><span><?php echo ((isset($getPaid->paid_on) && !empty($getPaid->paid_on)) ? date('j F Y',strtotime($getPaid->paid_on)) : '') ?></span></li>
														<li><span>Program fee :( $ ) </span><span class="pgm_fee"><?php echo '$ '. 
														((isset($paymentList[0]->Total_fee) && !empty($paymentList[0]->Total_fee)) ? $paymentList[0]->Total_fee : '') ?></span></li>
													</ul>
												</div>
											</div>
										</div>
										
										
										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Payment details </label>
											
											<div class="col-md-12 col-sm-12 col-xs-12 pay">
												<table class="payment_table" cellspacing="0" cellpadding="0" border="0">
													<thead>
													  <tr>
														<th>Amount  paid </th>
														<th>Payment  Type</th>
														<th>Payment  mode</th>
														<th> Paid  on </th>
														<th>Check No </th>
														<th>Status</th>
														<th> Remarks</th>
													  </tr>
													 </thead>
													 <tbody>
													 <?php if( isset($paymentList) && !empty($paymentList)){?>
													  <tr class="">														
														<td><?php echo $paymentList[0]->amount?></td>
														<td><?php echo $paymentList[0]->payment_option?></td>
														<td> <?php echo $paymentList[0]->payment_mode?> Payment  </td>
														<td><?php echo $paymentList[0]->paid_on?> </td>
														<td><?php echo $paymentList[0]->check_no?></td>
														<td><?php echo $paymentList[0]->paymentStatus?></td>
														<td><?php echo $paymentList[0]->comments?></td>
														</tr> 
														<?php } ?>	  
													</tbody>
												</table>
											</div>
												
                                       </div>

                                        
										
										
		
					

<div class="form-group margin_top_50">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<table class="table table-bordered table-hover additionalMargin" id="actionTable">
					<!--<thead>
					<tr >
						<th class="text-center">Action</th>
						<th class="text-center">Responsibility</th>
						<th class="text-center">Completion Date</th>
					</tr>
					</thead>-->
					<tbody>
					<tr id='actionRow0'>
           
            <td> <div id="myclone_0"></div>
				<select class="select_course_code form-control" data="responsibilityInput" name="course_code[]" id="p_0_course_code" >
              			  <option value="" >Select</option>
			  <?php if(isset($selectedCourse) && !empty($selectedCourse)){?>

				  <?php foreach($selectedCourse as $k=>$course){?>
				  <option value="<?php echo $course->course_id ?>" <?php echo ((isset($post_set['course']) && !empty($post_set['course']) && (in_array($course->course_code,$post_set['course'])) ) ?  'selected="selected"': '')?> ><?php echo $course->course_code ?></option>
			  <?php }}?>
           
				</select> 
			<?php echo form_error('course_code[]'); ?>
             
            </td>
            <td>
              <input type="text" name='from_schedule[]' id="start_dateInput" placeholder='Start Date' class="form-control dateControl"/>
			  <?php echo form_error('from_schedule[]'); ?>
            </td>
			 <td>
              <input type="text" name='to_schedule[]' id="end_dateInput" placeholder='End Date' class="form-control end_dateControl dateControl"/>
			  <?php echo form_error('to_schedule[]'); ?>
            </td>
          </tr>
					</tbody>
				</table>
				<a id="add_row" class="btn btn-default pull-right">Add Row</a>
				<a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
			</div>
		</div>
	</div>
</div>				
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
												<a href="<?php echo base_url(); ?>dance/admin/students/index" class="btn btn-primary" onclick="return confirm('Are you sure you want to leave this page?');"> Cancel </a>
												<input type="submit" class="btn btn-success"  value="Submit" name="submit">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
			
			
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

			<script>
			
			var cloned;

$(function() {
    initDatepickersAndSelect();
    $('#add_row').on('click', function(evt){addRow();});
    $('#delete_row').on('click', function(evt){deleteRow();});
	
	
});

function initDatepickersAndSelect() {
    cloned = $("table.table tr#actionRow0").eq(0).clone();
    $(".dateControl:first,.end_dateControl:first").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
    });

    /*$(".responsibility:first").select2({
      tags: true
    });*/
}

function addRow() {

    var $tr = cloned.clone();
    var newRowIdx = $("table.table tr").length;
    $tr.attr('id', 'actionRow' + newRowIdx);
	
	
	//$('#actionRow'+newRowIdx+'').after('<div id="myclone"></div>');
	 /*if($input.is("input")) {
        $input.val("");
      }*/
	  
	  
	  
	$tr.find("select").each(function(i_idx, i_elem) {
		
      var $input = $(i_elem); 
		//$input.attr('data').find('option').clone().appendTo('#p_0_course_code');
      $input.attr({
        'id': function(_, id) {
          return id + newRowIdx;
        },
        'name': function(_, name) {
          return name.replace('[0]', '['+ newRowIdx +']');
        },
		
        //'value': $(this).val()
      });
	  var $options = $('#p_0_course_code > option'); //alert( $options.text() )
	  
	  
	  
	  if($input.attr("data") == 'responsibilityInput'+newRowIdx) { //alert(newRowIdx)
			//$('select [data="'+'responsibilityInput'+newRowIdx+'"]').append('<option value="d">dd</option>');
		//$('#myclone').attr( 'id', 'myclone_' +newRowIdx)
		//$('#p_0_course_code').clone().attr( 'data', 'responsibilityInput' +newRowIdx).insertAfter("#myclone_"+newRowIdx);
		}
    });
	
	/*$("#p_0_course_code").find('option').each(function( i, opt ) {
		alert(opt.value +' '+opt.text)
		$('select[data="responsibilityInput1"]').val(opt.value);
	});*/
	
	//$('select [data="responsibilityInput"] option').clone().appendTo('select [data="responsibilityInput'+newRowIdx+'"]');
	
    $tr.find("input").each(function(i_idx, i_elem) {

      var $input = $(i_elem);

      if($input.is("input")) {
        $input.val("");
      }

      $input.attr({
        'id': function(_, id) {
          return id + newRowIdx;
        },
        'name': function(_, name) {
          return name.replace('[0]', '['+ newRowIdx +']');
        },
        //'value': ''
      });


    });
    $tr.appendTo("table.table");

    $(".dateControl", $tr).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
    });

	$('#p_0_course_code'+newRowIdx).html($('#p_0_course_code').html());
	
	
    /*$(".responsibility", $tr).select2({
      tags: true
    });*/
}

function deleteRow() {
    var curRowIdx = $("table.table tr").length;
    if (curRowIdx > 1) {
        $("#actionRow" + (curRowIdx - 1)).remove();
        curRowIdx--;
    }
}


			$(document).ready( function() { 	


	
//$('input.scdatepicker').datepicker("destroy");
//$('input.scdatepicker').datepicker();
	
				/*var i = 1;
$('.scdatepicker').each(function () { 	
    $(this).attr("id",'schedule_'+i).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
	});
    i++;
});*/

				/*$( "#from_schedule_0,#from_schedule_2,#to_schedule_0,#to_schedule_2" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				   //yearRange: '-85:-08',
				   dateFormat: 'yy-mm-dd',
				});*/
	
				//var courseTag = document.getElementByTagName("course[]");
				/*var courseArray = new Array();
				$(document).on("change","[id^='p_']",function(){
					var selectedBox = $(this).attr('id');
					var selectedBoxVal = $(this).val();
					var testSelected = $('#'+selectedBox+' option[value="'+selectedBoxVal+'"]').attr("selected","selected");
						courseArray.push(testSelected.val())
						//alert( courseArray )
						
						//alert( $(this).attr('selected','selected') )
					
				});*/
				
				 $('.program_id').change(function(){ //any select change on the dropdown with id country trigger this code
                            var program = $('.program_id').val();
							
							if(program !="")
							{ 
								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>dance/admin/students/ajaxPgm",
									data: {field_id:'program_id',field_val : program,type:'courses',user_id:<?php echo $arg?>},
									dataType:"json",
									 //beforeSend : function(r){   $('#dvLoading').addClass('imgloading');	},
									success: function(value) //we're calling the response json array 'cities'
									{
									               //$('#dvLoading').removeClass('imgloading'); 
											//alert(value);
											var Exam = value.exam;
											var Payment = value.payment;
											paymenttableData = '';
											for(var k=0;k<Payment.length;k++){
												
												paymenttableData += "<tr><td>"+Payment[k].amount+"</td><td>"+Payment[k].payment_option+"</td><td>"+Payment[k].payment_mode+"</td><td>"+Payment[k].paid_on+"</td><td>"+Payment[k].check_no+"</td><td>"+Payment[k].status+"</td><td>"+Payment[k].comments+"</td><tr>";
												
											}
											$('.payment_table tbody').html(paymenttableData);
											if( Exam !== false){
												$('.pname').html(Exam[0].programName);
												$('.pgm_fee').html(Exam[0].Total_fee);
											}
											var obj = value.course;
											$('#p_0_course_code').html('');
											var x1 = document.getElementById("p_0_course_code");
											var option1 = document.createElement("option");
											option1.value = '';
											option1.text = 'Select';
											x1.add(option1);
											


											$.each( value.course, function( key, val ) {
											
											//$('.selectpicker').selectpicker();
											//$('.selectpicker').selectpicker('refresh');
											var x = document.getElementById("p_0_course_code");
											
											var option = document.createElement("option");
											option.value = val.course_id;
											option.text = val.course_code;
											//alert(option.text);
											x.add(option);
												
											});
											
									}
									});
							}
							
					});
			});
			</script>
			