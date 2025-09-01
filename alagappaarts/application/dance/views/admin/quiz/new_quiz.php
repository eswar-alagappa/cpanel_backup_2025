<script type="text/javascript" src="<?php echo base_url();?>/js/basic.js"></script>

<?php 
if(isset($resultstatus) && !empty($resultstatus) && $resultstatus){ echo "<div class='alert alert-success'>".$resultstatus."</div>"; }
 ?> 
<form method="post" action="<?php echo site_url('dance/admin/quiz/add_new');?>">

<div class="row" style="margin-top:10px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if($title){ echo $title; } ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
										
										 <div class="form-group">
                                            <label>Course</label>
		                                         <select name="course_id" id='course_id'>
												<option value="">Select Course :</option>
												<?php if( isset($course) && !empty($course)){foreach($course as $value){ ?>
												<option value="<?php echo $value->course_id; ?>" <?php echo ((isset($post_set['course_id']) && !empty($post_set['course_id']) && $post_set['course_id']==$value->course_id) ? 'selected' : ''); ?>> <?php echo $value->course_code; ?></option>
												<?php }} ?></select>
											<?php echo form_error('course_id'); ?>
                                         </div>
										 
                                        <div class="form-group">
                                            <label>Quiz Name</label>
		                                         <input type='text' value="<?php echo ((isset($post_set['quiz_name']) && !empty($post_set['quiz_name'])) ? $post_set['quiz_name'] : '');?>" class="form-control"  name='quiz_name' >
												<?php echo form_error('quiz_name'); ?>
                                         </div>

	                                       <div class="form-group">
                                            <label>Quiz Description</label>
		                                      <textarea name="description"  placeholder=""><?php echo ((isset($post_set['description']) && !empty($post_set['description'])) ? $post_set['description'] : '');?></textarea> 
											  <?php echo form_error('description'); ?>
                                         </div>

	                                       <div class="form-group">
                                            <label>Quiz Duration in Minutes</label>
		                                        <input type='text' name='quiz_time_duration' value="<?php echo ((isset($post_set['quiz_time_duration']) && !empty($post_set['quiz_time_duration'])) ? $post_set['quiz_time_duration'] : '');?>" class="form-control" > 
												<?php echo form_error('quiz_time_duration'); ?>
                                         </div>

	                                       <div class="form-group">
                                            <label>Start Time ( YYYY/MM/DD HH:MM:SS  )</label>
		                                          <input type='text' id="start_datepicker" name='test_start_time' value="<?php echo ((isset($post_set['test_start_time']) && !empty($post_set['test_start_time'])) ? $post_set['test_start_time'] : '')  ?>" class="form-control" > 
												<?php echo form_error('test_start_time'); ?>
                                         </div>

		                                       <div class="form-group">
                                            <label>End Time ( eg. 2014/10/31 23:59:59 )</label>
		                                          <input type='text' id="end_datepicker" value="<?php echo ((isset($post_set['test_end_time']) && !empty($post_set['test_end_time'])) ? $post_set['test_end_time'] : '')  ?>" 
												  name='test_end_time'  class="form-control" >  
												  <?php echo form_error('test_end_time'); ?>
                                         </div>

										 
	                                       <div class="form-group">
                                            <label>Percentage required to pass</label>
		                                        <select name="pass_percentage"  class="form-control">
												<option value="">Select</option>
												<?php for($i = 0;$i <= 100;$i++){ ?>
													<option value="<?php echo $i;  ?>" <?php echo ((isset($post_set['pass_percentage']) && !empty($post_set['pass_percentage']) && $post_set['pass_percentage']==$i) ? 'selected' : ''); ?>><?php echo $i;  ?>%</option>
												<?php } ?>
											</select>
											 <?php echo form_error('pass_percentage'); ?>
                                         </div>

										 
	                                      <!-- <div class="form-group">
                                            <label>Assign to Groups</label>
		                                          <?php
													$group_counter = 1; 
													foreach($groups as $key => $group){ ?>
														<?php echo $group['group_name']; ?><input type="checkbox" name="assigned_groups[]" value="<?php echo $group['gid']; ?>"> &nbsp;&nbsp;
													<?php if($group_counter%5 == 0){ echo "</br>"; } $group_counter++; }  ?>
                                         </div>-->

										 
	                                       <!--<div class="form-group">
                                            <label>Test type </label>
		                                       <input type='radio' name='test_type' value='0'  checked='checked'    >  Free
													<input type="hidden" name="test_charges" value="0"> 
                                         </div>-->

										 
	                                       <!--<div class="form-group">
                                            <label>Allow to View Answer </label> &nbsp;&nbsp;
		                                          		<input type='radio' name='view_answer' value='1' >Yes &nbsp;&nbsp;&nbsp;
														<input type='radio' name='view_answer' value='0' >No  
                                         </div>-->

									  <div class="form-group">
                                            <label>Maximum Attempts </label>
		                                          <select name="max_attemp"  class="form-control">
												<?php for($i = 1;$i <= 1000;$i++){ ?>
													<option value="<?php echo $i;  ?>" <?php echo ((isset($post_set['max_attemp']) && !empty($post_set['max_attemp']) && $post_set['max_attemp']==$i) ? 'selected' : ''); ?>><?php echo $i;  ?></option>
												<?php } ?>
												</select>
											<?php echo form_error('max_attemp'); ?>
                                         </div>
	                                       <!--<div class="form-group">
                                            <label>Quiz Type </label>
		                                         <select name="qiz_type" class="form-control">
													<option value="0">Exam</option>
													<option value="1">Practice</option>
												
											</select>  
                                         </div>-->
										 
	                                       <div class="form-group">
                                            <label>Correct answer score</label>
		                                          <input type='text' name='correct_answer_score' value="<?php echo ((isset($post_set['correct_answer_score']) && !empty($post_set['correct_answer_score'])) ? $post_set['correct_answer_score'] : 1);?>"    class="form-control" > 
												  <?php echo form_error('correct_answer_score'); ?>
                                         </div>
	                                       <div class="form-group">
                                            <label>Incorrect answer score</label>
		                                          <input type='text' name='incorrect_answer_score' value="<?php echo ((isset($post_set['incorrect_answer_score']) && !empty($post_set['incorrect_answer_score'])) ? $post_set['incorrect_answer_score'] : 0);?>"    class="form-control" >
												  <?php echo form_error('incorrect_answer_score'); ?>
                                         </div>
	                                       <!--<div class="form-group">
                                            <label>Accessible to IPs (comma separated)</label>
		                                          <input type='text' name='ip_address' value=""   class="form-control" >

                                         </div>-->
	                                   
<!--<?php 
		if($this->config->item('webcam_plugin') == false){
		?><input type="hidden" name="camera_req" value="0"> <?php
		}
		?>
	  
<?php
if($this->config->item('webcam_plugin')){
?> <div class="form-group">
                                            <label>
 Capture Photo </label>
		<input type='radio' name='camera_req' value='1' >Yes
		<input type='radio' name='camera_req' value='0' >No 
	    </div>
<?php
}
?>-->
										 
								
								</div>
							</div>
						</div>
					</div>
				</div>
</div>


 
  <div class="formbox" style="max-width:800px;">
<!--
Add questions
<br><br>
<div class="category_box" id="qautobtn" style='background:#2f72b7;color:#ffffff;height:25px;' onClick="changetabqselection('qauto','qman','1');">
<a class="tooltip" href="javascript:changetabqselection('qauto','qman','1');" id="qautobtna" style="color:#ffffff;opacity:1;">Automatically <span>
 <img class="callout" src="<?php echo base_url();?>images/callout_black.gif" /> <strong> System select questions randomly</strong><br />You just need to define category, level and number of questions you want in the quiz. </span></a></div>
<div class="category_box"  id="qmanbtn" onClick="changetabqselection('qman','qauto','0');" style="height:25px;" ><a class="tooltip" href="javascript:changetabqselection('qman','qauto','0');" id="qmanbtna" style="color:#212121;opacity:1;">Manually <span> <img class="callout" src="<?php echo base_url();?>images/callout_black.gif" /> <strong> Select questions manually</strong><br />You have to select questions one by one from question bank. </span></a></div>
<div style="clear:both;"></div>
<br><br>
<div id="qauto" style="display:none;visibility:hidden;">  
	<select name="cid" id='cid'>
	<option value="0">Select Category:</option>
	<?php foreach($category as $value){ ?>
	<option value="<?php echo $value->cid; ?>"> <?php echo $value->category_name; ?></option>
	<?php } ?></select>   
 <select name="did" id='did'>
<option value="0">Select Difficult Level:</option>
	<?php foreach($difficult_level as $value){ ?>
<option value="<?php echo $value->did; ?>"> <?php echo $value->level_name; ?></option>
<?php } ?></select><br>  No. of Ques. to add in test <span id="no_of_question">
 
	</span>
 
</div>
<div id="qman" >
<h1> Click on 'Submit Quiz' button and you will go to question selection module.</h1>
</div>
<br>
<table id="formdata">
<tr>
<td valign="top"></td>
<td valign="top">-->
<input type="hidden" value="0" name="qselect" id="qselect">
 
 <input type="submit" value="Submit" name="submit_quiz" class="btn btn-default"> 
<!--</td></tr>
</table>-->
</div>

</form>






</div>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
 
$(document).ready(function () { 
 $( "#start_datepicker,#end_datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	   
	   dateFormat: 'yy-mm-dd',
    });
});
	
			tinyMCE.init({
	
    mode : "textareas",
		theme : "advanced",
		relative_urls:"false",
	 plugins: "jbimages",
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
 
	
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "jbimages,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		
		
	});
 
</script>
