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
if( isset($resultstatus) && !empty($resultstatus) && $resultstatus){ echo "<div class='alert alert-success'>".$resultstatus."</div>"; }
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
                                
								<form method="post" action="<?php echo site_url('music/admin/qbank/edit_question/'.$result['0']['qid']).'/2';?>">
										
										<div class="form-group">
                                            <label>Course</label>
		                                         <select name="course_id" id='course_id'>
												<option value="0">Select Course :</option>
												<?php if( isset($course) && !empty($course)){foreach($course as $value){ ?>
												<option value="<?php echo $value->course_id; ?>" <?php echo ((isset($result[0]['course_id']) && !empty($result[0]['course_id']) && $result[0]['course_id'] == $value->course_id) ? 'selected' : '') ?> > <?php echo $value->course_code; ?></option>
												<?php }} ?></select>
											<?php echo form_error('course_id'); ?>
                                         </div>
										 <input type="hidden" name="qus_type" value="<?php echo $result[0]['q_type']; ?>">
										<input type="hidden" name="cid" value="1">
										<!--<div class="form-group">
                                            <label>Question Type</label>
		                                        <select class="form-control"  name="qus_type" OnChange="get_ques_type(this.value)">
												<option value="0"> Multiple Choice -single answers</option>
												<option value="1" > Multiple Choice -multiple answers</option>
												<option value="2" selected >Fill in the Blank</option>
												<option value="3">Short Answer</option>
												<option value="4">Essay</option>
												<option value="5">Matching</option>
												</select>

                                         </div>-->

                                        <!--<div class="form-group">
                                            <label>Select Category</label>
											<select class="form-control"  name="cid">
											<?php foreach($category as $value){ ?>
											<option value="<?php echo $value->cid; ?>" <?php if($result['0']['cid'] == $value->cid){ echo "selected"; }?>  ><?php echo $value->category_name; ?></option>
											<?php } ?></select>
										 </div>



                                        <div class="form-group">
                                            <label>Select Difficulty Level</label>
                                         <select class="form-control" name="did">
										<?php foreach($difficult_level as $value){ ?>
										<option value="<?php echo $value->did; ?>" <?php if($result['0']['did'] == $value->did){ echo "selected"; }?>  ><?php echo $value->level_name; ?></option>
										<?php } ?></select> 

                                         </div>-->
                                        <div class="form-group">
                                            <label>Question</label>
                                            <textarea name="question"><?php echo $result['0']['question'];?></textarea> 
											<?php echo form_error('question'); ?>
                                            <!--<p class="help-block"> 
                                            Use 5 underscores ( _ ) to replace it with fillups (input field) during quiz<br><br>
Eg. Two + _____ = Four
</p>-->
										 </div>


                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description"><?php echo $result['0']['description'];?></textarea> 
											<?php echo form_error('description'); ?>
                                            <!--<p class="help-block">
                                            	Describe how question can be solved. <br>
												User can see description after submitting quiz in view answer section.
                                            </p>-->
										 </div>
<div class="form-group"><label>Answer</label>

<?php
foreach($result['1'] as $okey => $option_value){
?>
 
<input type="hidden" value="<?php echo $option_value['oid'];?>" name="oids[]"> 

<input class="form-control"  type="text" name="option[]"  value="<?php echo $option_value['option_value'];?>" placeholder="Answer"> 
<!--<p class="help-block">User input will be matched with it. Not case sensitive</p>-->
<?php echo form_error('option[]'); ?>
<?php
} 
?>



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
	
    mode : "textareas1",
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
