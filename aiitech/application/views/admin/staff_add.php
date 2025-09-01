<?php include "header.php"; ?>
   
<?php
$id = isset($id) ? $id : 0;
$error = isset($error) ? $error : '';

$first_name = isset($first_name) ? $first_name : '';
$last_name = isset($last_name) ? $last_name : '';
$email_id = isset($email_id) ? $email_id : '';
$phone = isset($phone) ? $phone : '';
$gender = isset($gender) ? $gender : '';
$martial_status = isset($martial_status) ? $martial_status : '';
$date_of_birth = isset($date_of_birth) ? $date_of_birth : '';
$date_of_joining = isset($date_of_joining) ? $date_of_joining : '';
$father_name = isset($father_name) ? $father_name : '';
$spouse_name = isset($spouse_name) ? $spouse_name : '';
$address = isset($address) ? $address : '';
$pincode = isset($pincode) ? $pincode : '';
$city = isset($city) ? $city : '';
$state = isset($state) ? $state : '';
$country = isset($country) ? $country : '';
$designation = isset($designation) ? $designation : '';
$subject_taken = isset($subject_taken) ? $subject_taken : '';
$department_handling = isset($department_handling) ? $department_handling : '';
$employeed_experience = isset($employeed_experience) ? $employeed_experience : '';
$qualification = isset($qualification) ? $qualification : '';
$community = isset($community) ? $community : '';
$nationality = isset($nationality) ? $nationality : '';
$residential_address = isset($residential_address) ? $residential_address : '';


if (isset($details)) {
    $row = $details[0];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email_id = $row['email_id'];
    $phone = $row['phone'];
    $gender = $row['gender'];
    $date_of_birth = date('d/m/Y', strtotime($row['date_of_birth']));
    $date_of_joining = date('d/m/Y', strtotime($row['date_of_joining']));
    $martial_status = $row['martial_status'];
    $father_name = $row['father_name'];
    $spouse_name = $row['spouse_name'];
    $address = $row['address'];
    $residential_address = $row['residential_address'];
    $pincode = $row['pincode'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];
    $designation = $row['designation'];
    $subject_taken = $row['subject_taken'];
    $department_handling = $row['department_handling'];
    $employeed_experience = $row['employeed_experience'];
    $qualification = $row['qualification'];
    $community = $row['community'];
    $nationality = $row['nationality'];
}   
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3>
            <?php 
            if ($id==0) {
                echo 'Staff Add';
            } else {
                echo 'Staff Edit';
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
                action="<?php echo site_url('/')?>admin/staff/save" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 

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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Gender
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='gender'; $val=$gender; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $genderList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg gender"></small>
                        </div>
                    </div>

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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father / Spouse name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="father_name" name="father_name" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $father_name; ?>"/>
                            <small class="error-msg father_name"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="email_id" name="email_id" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $email_id; ?>"/>
                            <small class="error-msg email_id"></small>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date of Joining <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="date_of_joining" name="date_of_joining" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $date_of_joining; ?>" readonly/>
                            <small class="error-msg date_of_joining"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" id="phone" name="phone" required="required"  maxlength="15" 
                            class="form-control col-md-7 col-xs-12" value="<?php echo $phone; ?>"/>
                            <small class="error-msg phone"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Permanent Address <span class="required">*</span>
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
                            <input type="number" id="pincode" name="pincode" required="required" maxlength="7"
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Designation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="designation" name="designation" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $designation; ?>"/>
                            <small class="error-msg designation"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Department handling <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="department_handling" name="department_handling" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $department_handling; ?>"/>
                            <small class="error-msg department_handling"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subject taken <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="subject_taken" name="subject_taken" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $subject_taken; ?>"/>
                            <small class="error-msg subject_taken"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employeed experience in years<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="employeed_experience" name="employeed_experience" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $employeed_experience; ?>"/>
                            <small class="error-msg employeed_experience"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Qualification <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="qualification" name="qualification" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $qualification; ?>"/>
                            <small class="error-msg qualification"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nationality <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="nationality" name="nationality" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $nationality; ?>"/>
                            <small class="error-msg nationality"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Community <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="community" name="community" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $community; ?>"/>
                            <small class="error-msg community"></small>
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
    $("#date_of_birth").datepicker({ 
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: '1945:'+(new Date).getFullYear(),
    });

    $("#date_of_joining").datepicker({ 
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: '1945:'+(new Date).getFullYear(),
    });
});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var id = Number($('#id').val());
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
    var email_id = $('#email_id').val();
    if (email_id.length < 3 || !isEmailValid(email_id)) {
        $('.email_id').text('Valid email is required').show().focus();
        return false;
    }
    var phone = $('#phone').val();
    if (phone.length < 1) {
        $('.phone').text('Phone number is required').show().focus();
        return false;
    }

    var date_of_birth = $('#date_of_birth').val();
    if (date_of_birth.length < 1) {
        $('.date_of_birth').text('Date of birth is required').show();
        return false;
    }
    var date_of_joining = $('#date_of_joining').val();
    if (date_of_joining.length < 1) {
        $('.date_of_joining').text('Date of joining is required').show();
        return false;
    }

    var father_name = $('#father_name').val();
    if (father_name.length < 1 ) {
        $('.father_name').text('Father / spouse name is required').show();
        return false;
    }

   return true;
}

</script>

<?php include "footer.php"; ?>
