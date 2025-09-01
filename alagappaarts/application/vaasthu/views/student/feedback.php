<div class="topNav">
      <ul>
      <li><a href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Feedback </li>
        
       
      </ul>
</div>
<div class="contentOuter">
	<h2><span>Feedback</span>

	<span class="feedbackbtn"><a href="<?php echo base_url().'dance/student/add_feedback'?>" class="submitBtn">Send Feedback</a><img width="7" height="24" src="../../assets/home/images/add-right-bg.png"></span> 
	</h2>
	
	<div class="contentInner">
		 <?php if( isset($selectedList) && !empty($selectedList)){ ?>
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th> Date	 </th>
                <th>Subject</th>
				<th>Message</th>
                <th width="95"> Actions</th>
              </tr>
             <?php foreach($selectedList as $feed){ ?>
				  <tr class="">
				 <td><?php echo date('d-M-Y',strtotime($feed->mailed_on)) ?> </td>
                <td> <?php echo $feed->subject; ?>  </td>
				<td> <?php echo $feed->message ?>  </td>
				<td><a href="<?php echo base_url().'dance/student/feedback_view/'.$feed->feedback_id?>"><img width="20" height="18" title="View" src="../../assets/home/images/view-btn.png"></a>	 </td>
			  
              </tr>  
			 <?php } ?>			  
            </tbody>
          </table>
			 <?php  }else{ ?>
		  <div class="warning">No Results Found</div>
		  <?php } ?>
        </div>
		
	<!--<div class="warning">No Results Found</div>   -->
</div>
