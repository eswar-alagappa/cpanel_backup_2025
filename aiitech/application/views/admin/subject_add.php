<?php include "header.php"; ?>
   
<?php
$id = isset($id) ? $id : 0;
$name = isset($name) ? $name : '';
$code = isset($code) ? $code : '';
$course_id = isset($course_id) ? $course_id : 0;
$semester_id = isset($semester_id) ? $semester_id : 0;
$error = isset($error) ? $error : '';
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3>
            <?php 
            if ($id==0) {
                echo 'Subject Add';
            } else {
                echo 'Subject Edit';
            }
            ?>
        </h3>

        <b style="color: red">
        <?php 
            if ($error != '') {
                echo $error;
            }
        ?>
        </b>

    </div>
</div>


<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form id="frmCategory" name="frmCategory" data-parsley-validate class="form-horizontal form-label-left"
                method="post" 
                enctype = "multipart/form-data"
                action="<?php echo site_url('/')?>admin/subject/save" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Course
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='course_id'; $val=$course_id; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $courseList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg course_id"></small>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Semester
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='semester_id'; $val=$semester_id; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $semesterList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg semester_id"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subject Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $name; ?>"/>
                            <small class="error-msg name"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="code" name="code" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $code; ?>"/>
                            <small class="error-msg code"></small>
                        </div>
                    </div>



                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="<?php echo site_url('/');?>admin/subject" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!--body wrapper start-->
</div>

 <!--body wrapper end-->
</div>

       
<script>
$(document).ready(function(){
});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var id = Number($('#id').val());
    var name = $('#name').val();
    if (name.length < 1) {
        $('.name').text('Subject name is required').show();
        return false;
    }
    var code = $('#code').val();
    if (code.length < 1) {
        $('.code').text('Code is required').show();
        return false;
    }
    var course_id = Number($('#course_id').val());
    if (course_id < 1) {
        $('.course_id').text('Course is required').show();
        return false;
    }
    var semester_id = Number($('#semester_id').val());
    if (semester_id < 1) {
        $('.semester_id').text('Semester is required').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>
