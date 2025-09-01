
    <div class="topNav">
      <ul>
      <li><a href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Exam Results </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2>Exam Results</h2>
    
      <div class="contentInner">
 
			<?php if( isset($examScore) && !empty($examScore)){?>
      <table cellspacing="0" cellpadding="0" border="0" class="w700">
            <tbody>
              <tr>
                <th>Course </th>
                 <th>Regulation </th>
                <th>Exam Date </th>
                <th> Mark Obtained</th>
                <th> Result</th>
                <th> Grade</th>
              </tr>
               <?php foreach($examScore as $mark){?>
				<tr class="">
				<td><?php echo $mark->course_code ?></td>
				<td><?php echo ((isset($mark->regulation_id) && array_key_exists($mark->regulation_id,$regulationList)) ? $regulationList[$mark->regulation_id] : ''); ?> </td>
				<td><?php echo date('d-M-Y',strtotime($mark->exam_startdate)); ?></td>
				<td> <?php echo $mark->aeScore ?>  </td>
				<td> <?php echo $mark->aeResult ?>  </td>
				<td><?php echo $mark->aeGrade ?> </td>
				</tr> 
			   <?php } ?>
                </tbody>
          </table>
			<?php }else{ ?>
				<div class="warning">Exam Result not yet Published.</div>        
			<?php } ?>
  
      
                     </div>
            
         
    </div>
  