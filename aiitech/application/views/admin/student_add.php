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
                    <input type="hidden" id="image_url" name="image_url" value="<?php echo $image_url; ?>" /> 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Roll Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="roll_num" name="roll_num" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $roll_num; ?>"/>
                            <small class="error-msg roll_num"></small>
                        </div>
                    </div>

                    <?php if ($id ==0 ){ ?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email_id" name="email_id" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $email_id; ?>"/>
                            <small class="error-msg email_id"></small>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" name="password" required="required"  
                            class="form-control col-md-7 col-xs-12" value=""/>
                            <small class="error-msg password"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Confirm Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="confirm_password" name="confirm_password" required="required"  
                            class="form-control col-md-7 col-xs-12" value=""/>
                            <small class="error-msg confirm_password"></small>
                        </div>
                    </div>

                    <?php } else { ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email_id" name="email_id" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $email_id; ?>" readonly />
                            <small class="error-msg email_id"></small>
                        </div>
                    </div>
                    <?php }   ?>



                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Gender
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='gender'; $val=$gender; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $genderList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                                echo $image_url;
                            ?>                                        
                            <small class="error-msg gender"></small>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Photo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="image_url" name="image_url"  
                            class="form-control col-md-7 col-xs-12" >
                            <small class="error-msg image_url"></small>
                        </div>
                    </div>

                    <?php if ($image_url != '') { 
                        $image_name = base_url() . '/uploads/' . $image_url;
                    ?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Selected Image
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
                            <?php 
                                $id='martial_status'; $val=$martial_status; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $martialStatusList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg gender"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father or spouse name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="father_name" name="father_name"   
                            class="form-control col-md-7 col-xs-12" value="<?php echo $father_name; ?>"/>
                            <small class="error-msg father_name"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="date_of_birth" name="date_of_birth" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $date_of_birth; ?>" readonly/>
                            <small class="error-msg date_of_birth"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" id="phone" name="phone" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $phone; ?>"/>
                            <small class="error-msg phone"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="address" name="address" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $address; ?>"/>
                            <small class="error-msg address"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Residential Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="residential_address" name="residential_address" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $residential_address; ?>"/>
                            <small class="error-msg residential_address"></small>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pincode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="pincode" name="pincode" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $pincode; ?>"/>
                            <small class="error-msg pincode"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="city" name="city" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $city; ?>"/>
                            <small class="error-msg city"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">State <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="state" name="state" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $state; ?>"/>
                            <small class="error-msg state"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="country" name="country" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $country; ?>"/>
                            <small class="error-msg country"></small>
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

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Semester Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='semester'; $val=$semester; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $semesterList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg semester_id"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Semester Joining
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='semester_joining_id'; $val=$semester_joining_id; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $semesterNumList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg semester_id"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">University <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='university'; $val=$university; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $universityList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg university"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Medium <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='medium'; $val=$medium; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $mediumList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg medium"></small>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fees <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="fees" name="fees" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $fees; ?>" readonly />
                            <small class="error-msg fees"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Duration <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="duration" name="duration" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $duration; ?>" readonly />
                            <small class="error-msg duration"></small>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="<?php echo site_url('/');?>admin/student" class="btn btn-primary">Back</a>
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
    if (id == 0) {
        var email_id = $('#email_id').val();
        if (email_id.length < 3 || !isEmailValid(email_id)) {
            $('.email_id').text('Valid email is required').show().focus();
            return false;
        }
        var password = $('#password').val();
        if (password.length < 8 ) {
            $('.password').text('Password minimum 8 character is required').show().focus();
            return false;
        }
        var confirm_password = $('#confirm_password').val();
        if (confirm_password != password ) {
            $('.confirm_password').text('Confirm password does not match').show().focus();
            return false;
        }
    }
    var first_name = $('#first_name').val();
    if (first_name.length < 1) {
        $('.first_name').text('First name is required').show().focus();
        return false;
    }
    var last_name = $('#last_name').val();
    if (last_name.length < 1) {
        $('.code').text('Last name is required').show().focus();
        return false;
    }
    var course_id = $('#course_id').val();
    if (course_id < 1) {
        $('.course_id').text('Course is required').show().focus();
        return false;
    }
    var fees = Number($('#fees').val());
    if (fees < 1) {
        $('.fees').text('Fees is required').show().focus();
        return false;
    }
   return true;
}

function updateFees(){
    var site_url = "<?php echo site_url('/'); ?>"
    var url = site_url + 'admin/api/getFeesDurationByCourseSemester';

    var course_id = Number($("#course_id").val());
    var semester_id = Number($("#semester_id").val());
    
    
    var data = {};
    data.course_id = course_id;
    data.semester_id = semester_id;

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
