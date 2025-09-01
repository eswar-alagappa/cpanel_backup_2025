
    <div class="topNav">
      <ul>
      <li><a href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Schedule </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2>Schedule</h2>
    
      <div class="contentInner">
     
     <?php if( isset($exam_schedule) && !empty($exam_schedule)) {  ?>   
         <p>Your Exam dates are scheduled. You can write the online exam at any time  on the allowed period.</p>
      <table cellspacing="0" cellpadding="0" border="0" class="w700">
            <tbody>
              <tr>
                <th>Course </th>
                <th> From</th>
                <th> Till</th>
              </tr>
              <?php foreach($exam_schedule as $exam){ ?>
				  <tr class="">
                <td><?php echo $exam->course_code ?></td>
                 <td> <?php echo date('d-M-Y',strtotime($exam->exam_date_starttime)); ?>  </td>
                <td><?php echo date('d-M-Y',strtotime($exam->exam_date_endtime)) ?> </td>            </tr>
			  <?php } ?>
				</tbody>
          </table>
          <div class="paginationContent">
       
        <div class="paginationLeft">Shows 1-1 of 1 </div>
        <div class="pagination"><ul></ul></div>
      </div>
     
	 <?php  }else{ ?>
           <div class="warning">Exam Schedule not yet Assigned.</div>        
	 <?php } ?>
         </div>
            
         
    </div>
