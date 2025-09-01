<?php include "header.php"; ?>
   
<?php
$id = isset($id) ? $id : 0;
$error = isset($error) ? $error : '';

$roll_num = isset($roll_num) ? $roll_num : '';
$first_name = isset($first_name) ? $first_name : '';
$last_name = isset($last_name) ? $last_name : '';
$course_id = isset($course_id) ? $course_id : '';

if (isset($details)) {
    $row = $details[0];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $roll_num = $row['roll_num'];
    $course_id = $row['course_id'];
}   
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3>
            <?php 
            if ($id==0) {
                echo 'Student Add';
            } else {
                echo 'Student Edit';
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
                action="<?php echo site_url('/')?>admin/student/save" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Roll Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="roll_num" name="roll_num" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $roll_num; ?>"/>
                            <small class="error-msg roll_num"></small>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="first_name" name="first_name" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $first_name; ?>"/>
                            <small class="error-msg first_name"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last_name" name="last_name" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $last_name; ?>"/>
                            <small class="error-msg last_name"></small>
                        </div>
                    </div>

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

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="<?php echo site_url('/');?>admin/staff" class="btn btn-primary">Back</a>
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
    var roll_num = $('#roll_num').val();
    if (roll_num.length < 1) {
        $('.roll_num').text('Roll Num is required').show();
        return false;
    }
    var first_name = $('#first_name').val();
    if (first_name.length < 1) {
        $('.first_name').text('First name is required').show();
        return false;
    }
    var last_name = $('#last_name').val();
    if (last_name.length < 1) {
        $('.code').text('Last name is required').show();
        return false;
    }
    var course_id = $('#course_id').val();
    if (course_id < 1) {
        $('.course_id').text('Course is required').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>
