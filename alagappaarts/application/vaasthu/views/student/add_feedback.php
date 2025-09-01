<div class="topNav">
      <ul>
      <li><a href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Feedback </li>
        
       
      </ul>
</div>
<form action="<?php echo base_url().'dance/student/add_feedback'?>" method="post" id="frmSendAnnouncement">
    <div class="contentOuter">
      
      <h2>Send Feedback</h2>
      <div class="sendFeedback">
      <ul>
      <li><label> Subject  : </label> <input type="text" value="<?php echo (isset($post_set['txtSubject']) && !empty($post_set['txtSubject']) ? $post_set['txtSubject'] : '');?>" name="txtSubject"> <?php echo form_error('txtSubject'); ?></li>        
      <li><label> Comments   :  </label><textarea rows="" cols="" name="txtMessage"><?php echo (isset($post_set['txtMessage']) && !empty($post_set['txtMessage']) ? $post_set['txtMessage'] : '');?></textarea><?php echo form_error('txtMessage'); ?></li>
      <li class="btn"><input type="submit" class="saveBtn" value="Send" name="submit">
		<div style=" bottom: 6px;display: inline-flex;position: relative;text-align: center;">
		<a style="padd" href="<?php echo base_url().'dance/student/feedback'?>" class="cancelBtn"><span style="float:none;position:relative;top:8px;">Cancel</span></a>
		</div>
	   <!--<input type="reset" class="cancelBtn" value="Cancel" name="btnSend"></a>-->
       <!--<a href="student_feedback_listing.php" class="cancelBtn">Cancel</a>-->
        </li>
      </ul>
      </div>
      <div>
        
</div>
           
    </div>
    </form>