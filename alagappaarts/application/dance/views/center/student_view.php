
       
    <div class="studentViewContent">
      <h2>View Student</h2>
      
      <div class="registrationForm">
       <div class="tapMenu" id="navigation">
<ul>
<li id="1" class="last activebtn"><a href="javascript:;">Personal Details</a></li>
<li id="2" class=""><a href="javascript:;">Enrollment Details</a></li>

</ul>
</div>
<div class="registrationFormStudents">  <input value="661" id="studentid" name="studentid" style="display:none">
   <div class="content1" style="display: block;">
           
                <fieldset class="w100">
        <legend>Personal Details    </legend>
      <ul>
      
         
      <li>
        <label>First Name:<?php echo $personal->firstname ?>  </label>
		</li>
        
      <li>
        <label>Last Name: <?php echo $personal->lastname ?>    </label>
		</li>
        
      <li>
        <label>D.O.B: <?php echo date('d-M-Y',strtotime($personal->dob)) ?> </label>
         </li>
         
       <li>
         <label> Age :<?php echo $personal->age ?></label>
		  </li>
        
        <li>
          <label> Gender : <?php echo $personal->gender ?></label>
		</li>
        
        <li>
           <label>Mobile: <?php echo $personal->mobile ?></label>
		 </li>
        
        <li>
           <label>Alternate Phone Number: <?php echo $personal->phone ?></label>
		  </li>
      
      </ul>
     
      <ul>
      
<li><label>Address:  <?php echo $personal->address ?></label>
		</li>
        
        <li>
          <label>City: <?php echo $personal->city ?></label>
		 </li>
        <li>
          <label>State: <?php echo $personal->state ?></label>
		  </li>
        
        <li><label>Country: <?php echo $personal->country ?>  </label>
		</li>
        <li>
          <label>Zip: <?php echo $personal->zip ?></label>
		  </li>
         <li>
          <label>Email: <?php echo $personal->email ?></label>
		 </li>
      </ul>
      </fieldset>
           
           <fieldset class="w100">
        <legend>Programs Enrolled</legend>
        <ul> 
        <li><?php echo $personal->programName ?></li></ul>
         <ul>
         <li>
           <label> Center :
  <?php echo $personal->centerName ?></label>
		 </li>
</ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Bharatanatyam Details </legend>
       <ul class="experience">
                <li>
                  <label>Experience in Bharathanatyam :  <?php echo $personal->bharathanatiyam_experience ?> </label>
                   </li>
                     
                      <li><label>Special accomplishments (if any) : <?php echo $personal->special_accomplishment ?> </label></li>
              <li>
                <label>Name of your Guru :  <?php echo $personal->name_of_master ?></label></li>
                  
                   <li><label>Located at 	: <?php echo $personal->master_located_at ?> </label></li>
                   <li>
                     <label>Other relevant info :  <?php echo $personal->other_relevant_info ?> </label>
                   </li>
                       </ul>
         <ul>
         
         </ul>
        </fieldset>
        
        <fieldset class="w100">
        <legend>Student Status  </legend>
       <ul class="experience">
                <li class="w100">
        <label class="w100">Status : </label>
         
 

        </li><li> <?php echo ((isset($personal->status) && !empty($personal->status) && $personal->status==1) ? 'Active' : 'Inactive'); ?>		</li>
                </ul>
         <ul>
         
</ul>
        </fieldset>

      
      </div>
    
      <div class="content2" style="display: none;">
           
                
           
         
     
         <fieldset class="w100">
        <legend><strong>Program Enrolled</strong></legend>
       <label> Select Program   : </label>
       
                
           
      <select class="w250 pgmpayroll" id="selectProgram" name="selectProgram"> 
        <?php if( isset($programList) && !empty($programList)){ foreach($programList as $k=> $pgm){?>
			<option  value="<?php echo $pgm->program_id ?>" selected="selected"><?php echo $pgm->name ?></option>         
			<?php }} ?>
		</select>	
                 </fieldset>
       <div class="studentDetails">
     <fieldset class="w100 pgmDetail">
        <!--<legend><strong>Program Enrolled</strong></legend>-->
        
       
      	<ul class="first">
        <li> <label>Student ID 	: <?php echo ((isset($pgmEnroll->username) && !empty($pgmEnroll->username)) ? $pgmEnroll->username : '') ?></label></li>
        
        <li> <label>Centre Name : <?php echo ((isset($pgmEnroll->centerName) && !empty($pgmEnroll->centerName)) ? $pgmEnroll->centerName : '') ?></label> </li>
        </ul>
        <ul class="second">
    
    
      
        <li> <label>Date of joining : <?php echo ((isset($pgmEnroll->enrollment_date) && !empty($pgmEnroll->enrollment_date) && $pgmEnroll->enrollment_date !='0000-00-00 00:00:00') ? date('d-M-Y',strtotime($pgmEnroll->enrollment_date)) : '') ?></label>	</li>
        <li> <label>Program fee : $ <?php echo ((isset($pgmEnroll->Total_fee) && !empty($pgmEnroll->Total_fee)) ? $pgmEnroll->Total_fee : '') ?></label></li>
       
         
        </ul>
     </fieldset>
     
     <fieldset class="w100 paymentDetail">
        <legend><strong>Payment Detail</strong></legend>
      <h2></h2>
	  
	   <div class="paymentTable">
			
			 <?php if( isset($paymentList) && !empty($paymentList)){?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0" class="tabelView">
            <thead> 
              <tr>
                <th width="98">  Amount Paid</th>
                <th width="150"> Payment Type</th>
                <th width="119">Payment MOde</th>
               
                 <th width="85"> Paid on</th>
                 <th width="195"> Check /Transaction No.</th>
                
                  <th width="65"> Status </th> 
                  <th width="195"> Remarks</th>
              </tr>
			</thead> 
			<tbody> 
			 <?php  //foreach($paymentList as $pay){ ?>
                <tr class="record">
                <td><?php echo $paymentList->amount?></td>
				<td> <?php echo $paymentList->payment_option?>  </td>
				<td> <?php echo $paymentList->payment_mode?> Payment  </td>
                <td><?php echo date('d-M-Y',strtotime($paymentList->paid_on))?> </td>
				<td><?php echo $paymentList->check_no ?></td>
				<td><?php echo $paymentList->paymentStatus?></td>
				<td><?php echo $paymentList->comments?></td></tr>
			 <?php //} ?>
				<!--<tr class="altRows">
                <td>200</td>
				<td> Partial  </td>
				<td> Paypal Payment  </td>
                <td>24-Dec-2015 </td><td></td><td>Transaction Failed</td><td>-</td></tr>-->
				
           
            </tbody>
          </table> 
		  <?php  }else{ ?>
      <div class="warning">Not yet paid</div>
		  <?php } ?>	  
          </fieldset>
        
           <fieldset class="w100 examDetail">
        <legend><strong>Exam  Detail</strong></legend>
			<?php if( isset($examTaken) && !empty($examTaken)){ ?>
                        <div class="paymentTable"> 
          <table width="100%" cellspacing="0" cellpadding="0" border="0" class="exam_tabelView">
            <thead> 
              <tr>
				<th> Exam Date</th>
				<th> Course</th>
				<th> Marks Obtained</th>
				<th> Result</th> 
				<th> Grade</th>
              </tr>
            </thead> 
			<tbody>   
				<?php foreach($examTaken as $exam){?>
				<tr class="">
					<td><?php echo date('d-M-Y',strtotime($exam->exam_startdate)); ?></td>
					<td><?php echo $exam->course_code ?></td>
					<td> <?php echo $exam->score ?>  </td>
					<td> <?php echo $exam->result ?>  </td>
					<td><?php echo $exam->grade ?> </td>
				</tr>  
				<?php } ?>
            </tbody>
          </table>
          </div>
			<?php }else { ?>
              <div class="warning">No Exam Taken</div>    
			<?php } ?>
         </fieldset>
              <fieldset class="w100 courseDetail">
        <legend>Course Completetion Status</legend>
		 <?php //if( isset($paymentList) && !empty($paymentList)){?>
                <ul>
      <li class="CCstatus">
        <label>Graduated :
        <?php echo ((isset($paymentList->graduation_status) && !empty($paymentList->graduation_status)) ? $paymentList->graduation_status : '-'); ?>  
		</label>
        </li>
           </ul>
            <ul>
      <li class="CC-Comments"><label>Comments : 
      <?php echo ((isset($paymentList->graduation_status_comments) && !empty($paymentList->graduation_status_comments)) ? $paymentList->graduation_status_comments : '-'); ?> 
       </label>
      </li></ul>
    
      <ul class="graduate">
      <li>
        <label>Graduation Date :
           <?php echo ((isset($paymentList->completion_date) && !empty($paymentList->completion_date)) ? date('d-M-Y',strtotime($paymentList->completion_date)) : '-'); ?>  
         </label>  
        </li>
           </ul>
           <?php //} ?>
      </fieldset>
    </div>
     </div>
     </div>
      
      <ul> <li class="button"><a class="backBtn" href="<?php echo base_url()?>dance/center/students">Back</a>        </li> </ul>
      </div>
      
    </div>
	
	<script type="text/javascript" src="<?php echo base_url() ?>assets/home/js/jquery.min.js"></script>
	<script type="text/javascript" language="javascript">
   
    $(document).ready(function() {
							   
 /* Menu Onload Start*/	 
	var tabID = location.search.substring(1); 
	
	
		$('#'+1).addClass('activebtn');
		$(".content"+1).show();
			$(".content"+2).hide();
				$(".content"+3).hide();	$(".content"+4).hide();
	
	
	
	/* Menu Onload End */

      $("#navigation ul li").click(function(){
    $('#lblPageTitle').text($(this).text());
	var currentid=(this.id);
	for (var i=1;i<=10;i++)
	{
		if (currentid==i)
		{
        $(".content"+i).slideDown(500);
			
				$('#'+i).addClass('activebtn');
	
		}
		else
		{
				$(".content"+i).slideUp(500);
		
					$('#'+i).removeClass('activebtn');
				
    	}
	
	}
	});


	$(document).ready(function(){
		$('.pgmpayroll').on('change',function(){
			var pgm = $(this).val();
			var userId = "<?php echo $user_id ?>";
			if( pgm !=''){
				$.ajax({
					url : "<?php echo base_url().'dance/student/ajaxPayroll' ?>",
					type:"POST",
					data:{"program_id":pgm,'user_id':userId},
					dataType:"json",
					success: function(data) {
						
						
						//console.log(data.dateofjoining);
						/*$('.pgmDetail').find('.first li:nth-child(1) label').html('Student ID : '+data.username);
						$('.pgmDetail').find('.first li:nth-child(2) label').html('Centre Name :'+ data.centerName);
						
						$('.pgmDetail').find('.second li:nth-child(1) label').html('Date of joining : '+data.enrollment_date);
						$('.pgmDetail').find('.second li:nth-child(2) label').html('Program fee :  $ '+data.Total_fee);
						
						$('.tabelView tr.record td:nth-child(1)').html(data.amount)
						$('.tabelView tr.record td:nth-child(2)').html(data.payment_option)
						$('.tabelView tr.record td:nth-child(3)').html(data.payment_mode)
						$('.tabelView tr.record td:nth-child(4)').html(data.paid_on)
						$('.tabelView tr.record td:nth-child(5)').html(data.check_no)
						$('.tabelView tr.record td:nth-child(6)').html(data.paymentStatus)
						$('.tabelView tr.record td:nth-child(7)').html(data.comments)
						
						$('.courseDetail').find('ul li.CCstatus').html('Graduated :'+data.graduation_status);
						$('.courseDetail').find('ul li.CC-Comments').html('Comments :'+data.graduation_status_comments);
						
						$('.courseDetail').find('.graduate li:nth-child(1) label').html('Graduation Date : '+data.completion_date);
						$('.courseDetail').find('.graduate li:nth-child(2) label').html('Grade :  '+data.grade);*/
						
						var payroll = data.payroll;
						var exam = data.exam
						if( payroll != false){
							
							var tableData = '';
							for(var k=0;k<payroll.length;k++){
								$('.pgmDetail').find('.first li:nth-child(1) label').html('Student ID : '+payroll[k].username);
								$('.pgmDetail').find('.first li:nth-child(2) label').html('Centre Name :'+ payroll[k].centerName);
								
								$('.pgmDetail').find('.second li:nth-child(1) label').html('Date of joining : '+payroll[k].enrollment_date);
								$('.pgmDetail').find('.second li:nth-child(2) label').html('Program fee :  $ '+payroll[k].Total_fee);
								$('.tabelView tr.normal').hide(); 
								 
								/*$('.tabelView tr.record td:nth-child(1)').html(data[k].amount)
								$('.tabelView tr.record td:nth-child(2)').html(data[k].payment_option)
								$('.tabelView tr.record td:nth-child(3)').html(data[k].payment_mode)
								$('.tabelView tr.record td:nth-child(4)').html(data[k].paid_on)
								$('.tabelView tr.record td:nth-child(5)').html(data[k].check_no)
								$('.tabelView tr.record td:nth-child(6)').html(data[k].paymentStatus)
								$('.tabelView tr.record td:nth-child(7)').html(data[k].comments)*/
								tableData += "<tr><td>"+payroll[k].amount+"</td><td>"+payroll[k].payment_option+"</td><td>"+payroll[k].payment_mode+"</td><td>"+payroll[k].paid_on+"</td><td>"+payroll[k].check_no+"</td><td>"+payroll[k].paymentStatus+"</td><td>"+payroll[k].comments+"</td><tr>";
								
								$('.courseDetail').find('ul li.CCstatus').html('Graduated :'+payroll[k].graduation_status);
								$('.courseDetail').find('ul li.CC-Comments').html('Comments :'+payroll[k].graduation_status_comments);
								
								$('.courseDetail').find('.graduate li:nth-child(1) label').html('Graduation Date : '+payroll[k].completion_date);
								$('.courseDetail').find('.graduate li:nth-child(2) label').html('Grade :  '+payroll[k].grade);
							}
							$('.tabelView tbody').html(tableData);
							
						}if( exam != false){
							var examtableData = '';
							for(var k=0;k<exam.length;k++){
								examtableData += "<tr><td>"+exam[k].exam_startdate+"</td><td>"+exam[k].course_code+"</td><td>"+exam[k].score+"</td><td>"+exam[k].result+"</td><td>"+exam[k].grade+"</td><tr>";
							}
							$('.exam_tabelView tbody').html(examtableData);
						}
						
					}
				});
			}
		});
	});
	
	
   });   </script>
