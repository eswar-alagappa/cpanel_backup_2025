<div class="topNav">
      <ul>
      <li><a href="<?php echo base_url();?>music/student/index">dashboard</a></li>
        <li class="last"> &nbsp; Feedback </li>
        
       
      </ul>
</div>
<div class="contentOuter">
      <h2>Feedback View</h2>
      <div class="sendFeedback">
      <ul><li>
        <label>Date			: </label>
		<span><?php echo date('d-M-Y',strtotime($selectedVal->mailed_on)) ?></span> </li> 
         <li>
        <label>Subject : </label>
		<span><?php echo $selectedVal->subject ?></span> </li> 
       
        <li>
        <label>Comments  : </label>
        <span><?php echo $selectedVal->message ?></span>
        </li>
        
        <li>
        <label>Feedback	Reply	: </label>
        <span><?php echo $selectedVal->reply ?></span>
        </li>
        <li class="btn">
          <a href="<?php echo base_url().'music/student/feedback'?>"><input type="submit" class="saveBtn" value="Back" name=""></a>
        </li>
      
      </ul>
      </div>
      <div>
        
</div>
           
    </div>