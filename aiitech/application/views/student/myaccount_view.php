<?php include "header.php"; ?>
   
<?php
$id = isset($id) ? $id : 0;
$error = isset($error) ? $error : '';

foreach ($arrField as $key => $value) {
    if ($value != 'id') {
        $$value = isset($$value) ? $$value : '';
    }
}       
$course_id = 0;

if (isset($details)) {
    $row = $details[0];
    foreach ($arrField as $key => $value) {
        $$value = $row[$value];
    }       
    $date_of_birth = date('d/m/Y', strtotime($date_of_birth));
}   
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3> My Account
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
                action="<?php echo site_url('/')?>admin/dashboard" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 
                    <input type="hidden" id="image_url" name="image_url" value="<?php echo $image_url; ?>" /> 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Roll Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $roll_num; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Gender
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                echo $gender;
                            ?>                                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $first_name;?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $last_name; ?>
                        </div>
                    </div>


                    <?php if ($image_url != '') { 
                        $image_name = base_url() . '/uploads/' . $image_url;
                    ?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Photo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="<?php echo $image_name; ?>" width="50px" height="50px"> </img>';
                        </div>
                    </div>

                    <?php } ?>



                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Martial Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $martial_status; ?>                                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father or spouse name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $father_name;?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $email_id; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $date_of_birth; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $phone; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $address; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pincode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $pincode; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $city; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">State <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $state; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $country; ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Course
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                if (isset($courseList[$course_id])){
                                    echo $courseList[$course_id];
                                }
                            ?>                                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Semester
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                if (isset($semesterList[$semester])){
                                    echo $semesterList[$semester];
                                }
                            ?>                                        
                            <small class="error-msg semester_id"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">University <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                if (isset($universityList[$university])){
                                    echo $universityList[$university];
                                }
                            ?>                                        
                            <small class="error-msg university"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Medium <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                if (isset($mediumList[$medium])){
                                    echo $mediumList[$medium];
                                }
                            ?>                                        
                            <small class="error-msg medium"></small>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fees <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo $fees; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Duration <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $duration; ?>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a href="<?php echo site_url('/');?>admin/dashboard" class="btn btn-primary">Back</a>
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
    $("#date_of_birth").datepicker({ 
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1945:'+(new Date).getFullYear(),
    });

    $("#course_id").change(function(){
        updateFees();
    });

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
    var email_id = $('#email_id').val();
    if (email_id.length < 3 || !isEmailValid(email_id)) {
        $('.email_id').text('Valid email is required').show().focus();
        return false;
    }
    var course_id = $('#course_id').val();
    if (course_id < 1) {
        $('.course_id').text('Course is required').show();
        return false;
    }
    var fees = Number($('#fees').val());
    if (fees < 1) {
        $('.fees').text('Fees is required').show();
        return false;
    }
   return true;
}

function updateFees(){
    var site_url = "<?php echo site_url('/'); ?>"
    var url = site_url + 'admin/api/getFeesDurationByCourseSemester';

    var course_id = Number($("#course_id").val());
    
    var data = {};
    data.course_id = course_id;

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: 'json',
    })
    .done(function(msg) {
        $('#fees').val('0.00');
        $('#duration').val('0.0');
        if (msg.status){
            $('#fees').val(msg.fees);
            $('#duration').val(msg.duration);
        }
    });
}

</script>

<?php include "footer.php"; ?>
