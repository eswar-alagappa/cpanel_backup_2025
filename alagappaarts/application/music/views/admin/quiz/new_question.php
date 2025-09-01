<style>
textarea{
	width:100%;
	height:120px;
}
.option{
	height:50px;
}
td{
	padding:5px;
}
.space-4{
	    margin: 0px 0px 15%;
}

</style>

<script type="text/javascript" src="<?php echo base_url();?>/music_js/basic.js"></script>

<?php 
if( isset($resultstatus) && !empty($resultstatus)&& $resultstatus){ echo "<div class='alert alert-success'>".$resultstatus."</div>"; }
 ?> 

<div class="row" style="margin-top:10px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if($title){ echo $title; } ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   <form method="post" action="<?php echo site_url('music/admin/qbank/add_new');?>">
										
										
										<div class="form-group">
                                            <label>Course</label>
		                                         <select name="course_id" id='course_id'>
												<option value="">Select Course :</option>
												<?php if( isset($course) && !empty($course)){foreach($course as $value){ ?>
												<option value="<?php echo $value->course_id; ?>" <?php echo ((isset($post_set['course_id']) && $post_set['course_id']==$value->course_id) ? 'selected' : '')?>> <?php echo $value->course_code; ?></option>
												<?php }} ?></select>
											<?php echo form_error('course_id'); ?>
                                         </div>
										 
										 <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Question Type</label>
		                                        <select class="form-control"  name="qus_type" OnChange="get_ques_type(this.value)">
												<option value="0"> Multiple Choice -single answers</option>
												<!--<option value="1"> Multiple Choice -multiple answers</option>-->
												<option value="2">Fill in the Blank</option>
												<!--<option value="3">Short Answer</option>-->
												<option value="4">Essay</option>
												<option value="5">Matching</option>
												<option value="6">True / False</option>
												</select>
											<?php echo form_error('qus_type'); ?>
                                         </div>
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

										<div class="space-4"></div>
 
                                        <div class="form-group">
                                            <label>Question</label>
                                            <textarea name="question"><?php echo ((isset($post_set['question']) && !empty($post_set['question'])) ? $post_set['question'] : '') ?></textarea> 
											<?php echo form_error('question'); ?>
										 </div>
							



                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description"><?php echo ((isset($post_set['description']) && !empty($post_set['description'])) ? $post_set['description'] : '') ?></textarea>
											<?php echo form_error('description'); ?>											
                                            <!--<p class="help-block">
                                            	Describe how question can be solved. <br>
												User can see description after submitting quiz in view answer section.
                                            </p>-->
										 </div>




                                        <div class="form-group">

<table><tr><td valign="top">Options</td><td valign="top">
</td></tr>
<tr><td valign="top">1) &nbsp;&nbsp; <input type="radio" id="radiobtn" value="0" name="score" <?php echo (( isset($post_set['score']) && $post_set['score']==0) ? 'checked' : ''); ?> ></td><td valign="top">
<textarea class="option" name="option[]"><?php echo ((isset($post_set['option']) && !empty($post_set['option'][0]) && $post_set['score']==0) ? $post_set['option'][0] : ''); ?></textarea> </td></tr>
<tr><td valign="top">2) &nbsp;&nbsp; <input type="radio" id="radiobtn" value="1" <?php echo (( isset($post_set['score']) && $post_set['score']==1) ? 'checked' : ''); ?> name="score"></td><td valign="top">
<textarea class="option"  name="option[]"><?php echo ((isset($post_set['option']) && !empty($post_set['option'][1]) && $post_set['score']==1) ? $post_set['option'][1] : ''); ?></textarea> </td></tr>
<tr><td valign="top">3) &nbsp;&nbsp; <input type="radio" id="radiobtn" value="2" <?php echo (( isset($post_set['score']) && $post_set['score']==2) ? 'checked' : ''); ?> name="score"></td><td valign="top">
<textarea class="option"  name="option[]"><?php echo ((isset($post_set['option']) && !empty($post_set['option'][2]) && $post_set['score']==2) ? $post_set['option'][2] : ''); ?></textarea> </td></tr>
<input type="hidden" name="addition_row" value="<?php echo ((isset($post_set['addition_row']) && !empty($post_set['addition_row'])) ? $post_set['addition_row'] : $this->input->post('add')); ?>">
<?php 
if( (isset($post_set['addition_row']) && !empty($post_set['addition_row'])) || $this->input->post('add')){ 
$postAdd = $this->input->post('add');
$add = ( (isset($post_set['addition_row']) && !empty($post_set['addition_row'])) ? $post_set['addition_row'] : 
		( (isset($postAdd) && !empty($postAdd)) ? $postAdd : '')); 
for($j=1; $j<= $add; $j++){ 
?>
<tr><td valign="top"><?php echo $op.")"; ?> &nbsp;&nbsp; <input type="radio" id="radiobtn" value="<?php echo $op-1; ?>" <?php echo (( isset($post_set['score']) && $post_set['score']==($op-1)) ? 'checked' : ''); ?> name="score"></td><td valign="top"><textarea class="option"  name="option[]"><?php echo ((isset($post_set['option']) && !empty($post_set['option'][($op-1)]) && ($op-1)== $post_set['score'] ) ? $post_set['option'][($op-1)] : ''); ?></textarea>  </td></tr>
<?php
$op++;
}
}
?>
<tr><td colspan="2"><?php echo form_error('score'); ?></td></tr>
<tr><td valign="top"></td><td valign="top"><br>
<input type="submit" name="submit" value="Submit"  class="btn btn-default"> </td></tr>
</table>

 										 </div>





										 </form>
								</div>
							</div>
						</div>
					</div>
				</div>
</div>





<div id="content" class="testd"><br>

<div class="formbox">

<form method="post" action="<?php echo site_url('music/admin/qbank/add_new');?>">
<label>Add more options </label>
<div><select name="add" class="form-control" style="width:100px;float:left;">
<?php for($x=1; $x <= 100; $x++ ){ ?>
<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
<?php } ?></select>&nbsp;&nbsp;
<input type="submit" value="Add"   class="form-control" style="width:100px;float:left;margin-left:10px">
</div></form>


<div style="clear:both;"></div>
</div>

</div>

<script type="text/javascript">
		tinyMCE.init({
	
    mode : "textareas1",
		theme : "advanced",
		relative_urls:false,
	 plugins: "jbimages",
	 width : 200,
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
 
	
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "jbimages,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		
		
	});

</script>
