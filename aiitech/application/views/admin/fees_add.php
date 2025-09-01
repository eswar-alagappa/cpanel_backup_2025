<?php include "header.php"; ?>
   
<?php
$id = isset($id) ? $id : 0;
$error = isset($error) ? $error : '';

$course_id = isset($course_id) ? $course_id : 0;
$semester_id = isset($semester_id) ? $semester_id : 0;
$fee_type_id = isset($fee_type_id) ? $fee_type_id : 0;
$fees = isset($fees) ? $fees : 0;

if (isset($details)) {
    $row = $details[0];
    $course_id = $row['course_id'];
    $semester_id = $row['semester_id'];
    $fee_type_id = $row['fee_type_id'];
    $fees = $row['fees'];
}   
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3>
            <?php 
            if ($id==0) {
                echo 'Fees Structure Add';
            } else {
                echo 'Fees Structure Edit';
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
                <form id="form1" name="form1" data-parsley-validate class="form-horizontal form-label-left"
                method="post" 
                enctype = "multipart/form-data"
                action="<?php echo site_url('/')?>admin/fees/save" onsubmit='return checkSubmit();'>

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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='fee_type_id'; $val=$fee_type_id; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $feetypeList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg fee_type_id"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="fees" name="fees" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $fees; ?>"/>
                            <small class="error-msg received_amount"></small>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="<?php echo site_url('/');?>admin/payment" class="btn btn-primary">Back</a>
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
    $("#date").datepicker({ dateFormat: 'dd/mm/yy' });
});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var id = Number($('#id').val());
    var roll_num = $('#date').val();
    if (date.length < 1) {
        $('.date').text('Date is required').show();
        return false;
    }
    var received_amount = Number($('#received_amount').val());
    if (received_amount < 1) {
        $('.received_amount').text('Amount is required').show();
        return false;
    }
    var student_id = Number($('#student_id').val());
    if (student_id < 1) {
        $('.student_id').text('Student is required').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>
