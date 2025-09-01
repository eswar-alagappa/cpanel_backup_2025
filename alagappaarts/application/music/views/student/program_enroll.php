<div class="studentViewContent">
      <h2>Program Enrolled</h2>
      
      <div class="registrationForm">
      
<div class="registrationFormStudents">  <input value="" id="studentid" name="studentid" style="display:none">
   
    
      <div class="content2">
           
                
           
         
     
		<fieldset class="w100">
			<legend><strong>Program Enrolled</strong></legend>
			<label> Select Program   : </label>
			<select class="w250 pgmpayroll" id="selectProgram" name="selectProgram"> 
			<?php if( isset($programList) && !empty($programList)){ foreach($programList as $k=> $pgm){?>
			<option  value="<?php echo $pgm->program_id ?>-<?php echo $pgm->music_type ?>" selected="selected"><?php echo stripslashes ($pgm->name) ?></option>         
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
			
			 <?php ?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0" class="tabelView">
            
            <thead> 
              <tr>
                <th width="80">  Amount Paid</th>
                <th width="140"> Payment Type</th>
                <th width="120">Payment MOde</th>
               
                 <th width="110"> Paid on</th>
                 <th width="160"> Check /Transaction No.</th>
                
                  <th width="65"> Status </th> 
                  <th width="195"> Remarks</th>
              </tr>
			 </thead> 
			<tbody> 
			 <?php 
				if( isset($paymentList) && !empty($paymentList)){
				if( isset($paymentList) && !empty($paymentList) && count($paymentList)>0){  
				foreach($paymentList as $pay){ ?>
                <tr class="normal">
                <td><?php echo $pay->amount?></td>
				<td> <?php echo $pay->payment_option?>  </td>
				<td> <?php echo $pay->payment_mode?> Payment  </td>
                <td><?php echo date('d-M-Y',strtotime($pay->paid_on))?> </td>
				<td><?php echo $pay->check_no ?></td>
				<td><?php echo $pay->paymentStatus?></td>
				<td><?php echo $pay->comments?></td></tr>
			 <?php } } ?>
			 <tr class="record"></tr>
			<?php  }else{ ?>
				<!--<div class="warning">Not yet paid</div>-->
				<tr><td colspan="7" style="text-align:center"><b>Not yet paid</b></td></tr>
			<?php } ?>
            </tbody>
          </table> 
		  <?php  //}else{ ?>
		  <!--<div class="warning">Not yet paid</div>-->
		  <?php //} ?>
          </div>
           
          </fieldset>
        
           <fieldset class="w100 examDetail">
        <legend><strong>Exam  Detail</strong></legend>
        
           <!-- <div class="warning">No Exam taken</div>      -->
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
				<?php
				if( isset($examTaken) && !empty($examTaken)){
				if( isset($examTaken) && !empty($examTaken) && count($examTaken)>0 ){ ?>
				<?php foreach($examTaken as $exam){?>
				<tr class="">
					<td><?php echo ((isset($exam->exam_startdate) && !empty($exam->exam_startdate) && $exam->exam_startdate != '0000-00-00 00:00:00') ?  date('d-M-Y',strtotime($exam->exam_startdate)) : '-');//echo date('d-M-Y',strtotime($exam->exam_startdate)); ?></td>
					<td><?php echo $exam->course_code ?></td>
					<td> <?php echo $exam->score ?>  </td>
					<td> <?php echo $exam->result ?>  </td>
					<td><?php echo $exam->grade ?> </td>
				</tr>  
				<?php } }?>
				 <tr class="record"></tr>
				 <?php }else { ?>
					<!--<div class="warning">No Exam taken</div>      -->
					<tr><td colspan="7" style="text-align:center"><b>No Result Found</b></td></tr>
				<?php } ?>
            </tbody>
          </table>
          </div>
     
         </fieldset>
              <fieldset class="w100 courseDetail">
        <legend>Course Completetion Status</legend>
		 <?php if( isset($programList) && !empty($programList)){ $programList = array_reverse($programList);?>
                <ul>
      <li class="CCstatus">
        <label>Graduated :
      <?php echo ((isset($programList[0]->graduation_status) && !empty($programList[0]->graduation_status)) ? $programList[0]->graduation_status : '-'); ?>  
		</label>
        </li>
           </ul>
            <ul>
      <li class="CC-Comments"><label>Comments : 
      <?php echo ((isset($programList[0]->graduation_status_comments) && !empty($programList[0]->graduation_status_comments)) ? $programList[0]->graduation_status_comments : '-'); ?> 
       </label>
      </li></ul>
    
      <ul class="graduate">
      <li>
        <label>Graduation Date :
		 <?php echo ((isset($programList[0]->completion_date) && !empty($programList[0]->completion_date) && $programList[0]->completion_date !='0000-00-00 00:00:00') ? date('d-M-Y',strtotime($programList[0]->completion_date)) : '-'); ?>  
        </label>  
        </li>
        <li>
        <label>Grade:
          <?php echo ((isset($programList[0]->grade) && !empty($programList[0]->grade)) ? $programList[0]->grade : '-'); ?>  
         </label>  
        </li>
           </ul>
		 <?php } ?>
      </fieldset>
    </div>
     </div>
     </div>
      
    
      </div>
      
    </div>
	
	<script type="text/javascript">
	function CallAjax(pgm)
	{
			$.ajax({
					url : "<?php echo base_url().'music/student/ajaxPayroll' ?>",
					type:"POST",
					data:{"program_id":pgm[0],'music_type':pgm[1]},
					dataType:"json",
					success: function(data) {
						console.log(JSON.stringify(data));
						
						
						var payroll = data.payroll;
						var exam = data.exam
						if( payroll != false){
							
							var tableData = '';
							for(var k=0;k<payroll.length;k++){
								$('.pgmDetail').find('.first li:nth-child(1) label').html('Student ID : '+payroll[k].username);
								$('.pgmDetail').find('.first li:nth-child(2) label').html('Centre Name :'+ payroll[k].centerName);
								
								
								$('.pgmDetail').find('.second li:nth-child(2) label').html('Program fee :  $ '+payroll[k].Total_fee);
								$('.tabelView tr.normal').hide(); 
								 
								if( payroll[k].amount != null){
								tableData += "<tr><td>"+payroll[k].amount+"</td><td>"+payroll[k].payment_option+"</td><td>"+payroll[k].payment_mode+"</td><td>"+payroll[k].paid_on+"</td><td>"+payroll[k].check_no+"</td><td>"+payroll[k].paymentStatus+"</td><td>"+payroll[k].comments+"</td><tr>";
								}else{
									tableData += '<tr><td colspan="7" style="text-align:center"><b>Not yet paid</b></td></tr>';
								}
								
								$('.courseDetail').find('ul li.CCstatus').html('Graduated :'+payroll[k].graduation_status);
								$('.courseDetail').find('ul li.CC-Comments').html('Comments :'+payroll[k].graduation_status_comments);
								
								var newDate = '';
								if( payroll[k].completion_date !='0000-00-00 00:00:00'){
								var completionDate = payroll[k].completion_date.split(' ');
								var dateRepl = $.trim(completionDate[0].replace(/-/g, "/")); //alert(dateRepl)
								var d = new Date( $.trim(completionDate[0].replace(/-/g, "/")) );
								 newDate += $.trim(d.getDate())+'-'+ (d.getMonth()+1) +'-'+(d.getFullYear());//date1.toString('dd-MM-yyyy');
								 } 
								
								$('.courseDetail').find('.graduate li:nth-child(1) label').html('Graduation Date : '+newDate);
								$('.courseDetail').find('.graduate li:nth-child(2) label').html('Grade :  '+payroll[k].grade);
							}
							$('.tabelView tbody').html(tableData);
							
						}if( exam != false && exam !=null){
							var examtableData = '';
							for(var j=0;j<exam.length;j++){
								examtableData += "<tr><td>"+exam[j].exam_startdate+"</td><td>"+exam[j].course_code+"</td><td>"+exam[j].score+"</td><td>"+exam[j].result+"</td><td>"+exam[j].grade+"</td><tr>";
							} 							
						}else{
								examtableData += '<tr><td colspan="5" style="text-align:center"><b>No Result Found</b></td></tr>';
						}
						$('.exam_tabelView tbody').html(examtableData);
						
						
					}
				});
	}
	$(document).ready(function(){
	var pgm1 = $('.pgmpayroll').val().split('-');
        CallAjax(pgm1);
		$('.pgmpayroll').on('change',function(){
			var pgm = $(this).val().split('-');
			if( pgm !=''){
			CallAjax(pgm);
			}
		});
	});
	</script>