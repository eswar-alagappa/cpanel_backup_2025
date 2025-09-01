<script type="text/javascript" src="<?php echo base_url();?>js/basic.js"></script>

<?php 
if(isset($resultstatus) && !empty($resultstatus) && $resultstatus){ echo "<div class='alert alert-success'>".$resultstatus."</div>"; }
 ?> 


<div class="row" style="margin-top:10px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if($title){ echo $title; } ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <form method="post" action="<?php echo site_url('dance/admin/qbank/add_new/4');?>">
                                        
										
										<div class="form-group">
                                            <label>Course</label>
		                                         <select name="course_id" id='course_id'>
												<option value="">Select Course :</option>
												<?php if( isset($course) && !empty($course)){foreach($course as $value){ ?>
												<option value="<?php echo $value->course_id; ?>" <?php echo ((isset($post_set['course_id']) && $post_set['course_id']==$value->course_id) ? 'selected' : '')?>> <?php echo $value->course_code; ?></option>
												<?php }} ?></select>
											<?php echo form_error('course_id'); ?>
                                         </div>
										
										<div class="form-group">
                                            <label>Question Type</label>
		                                        <select class="form-control"  name="qus_type" OnChange="get_ques_type(this.value)">
												<option value="0"> Multiple Choice -single answers</option>
												<!--<option value="1" > Multiple Choice -multiple answers</option>-->
												<option value="2"  >Fill in the Blank</option>
												<!--<option value="3"  >Short Answer</option>-->
												<option value="4" selected >Essay</option>
												<option value="5" >Matching</option>
												</select>
											<?php echo form_error('qus_type'); ?>
                                         </div>
										<input type="hidden" name="cid" value="1">
                                        <!--<div class="form-group">
                                            <label>Select Category</label>
											<select class="form-control"  name="cid">
											<?php foreach($category as $value){ ?>
											<option value="<?php echo $value->cid; ?>"><?php echo $value->category_name; ?></option>
											<?php } ?></select>
										 </div>



                                        <div class="form-group">
                                            <label>Select Difficulty Level</label>
                                         <select class="form-control" name="did">
										<?php foreach($difficult_level as $value){ ?>
										<option value="<?php echo $value->did; ?>"><?php echo $value->level_name; ?></option>
										<?php } ?></select> 

                                         </div>-->
										 
                                        <div class="form-group">
                                            <label>Question</label>
                                            <textarea name="question"><?php echo ((isset($post_set['question']) && !empty($post_set['question'])) ? $post_set['question'] : '') ?></textarea> 
                                            <?php echo form_error('question'); ?>
										 </div>



                                        <div class="form-group">
                                            <label>Description (Optional)</label>
                                            <textarea name="description"><?php echo ((isset($post_set['description']) && !empty($post_set['description'])) ? $post_set['description'] : '') ?></textarea> 
											<?php echo form_error('description'); ?>
                                            <!--<p class="help-block">
                                            	Describe how question can be solved. <br>
												User can see description after submitting quiz in view answer section.
                                            </p>-->
										 </div>
 

<div class="form-group">

<input type="submit" name="submit" value="Submit"  class="btn btn-default">  
</div>




								</form>

								</div>
							</div>
						</div>
					</div>
				</div>
</div>



















<script type="text/javascript">
			
tinyMCE.init({
	
    mode : "textareas",
		theme : "advanced",
		relative_urls:false,
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
