<?php include "header.php"; ?>
<script type="text/javascript" src="<?php echo base_url('/');?>js/time/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/');?>js/time/jquery.timepicker.css" />
<script type="text/javascript" src="<?php echo base_url('/');?>js/time/lib/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/');?>js/time/lib/bootstrap-datepicker.css" />
<script type="text/javascript" src="<?php echo base_url('/');?>js/time/lib/site.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/');?>js/time/lib/site.css" />
   
<?php
$id = isset($id) ? $id : 0;
$error = isset($error) ? $error : '';

foreach ($arrField as $key => $value) {
    if ($value != 'id') {
        $$value = isset($$value) ? $$value : '';
    }
}       

if (isset($details)) {
    $row = $details[0];
    foreach ($arrField as $key => $value) {
        $$value = $row[$value];
    }       
}   


?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3>
            <?php 
            if ($id==0) {
                echo 'Exam venue Add';
            } else {
                echo 'Exam venue Edit';
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
                action="<?php echo site_url('/')?>admin/examvenue/save" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Graduate <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='graduate'; $val=$graduate; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $graduateList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg graduate"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Semester <span class="required">*</span>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Session Start <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="session_start" name="session_start" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $session_start; ?>" onkeydown="return false;" />
                            <small class="error-msg session_start"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Session End <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="session_end" name="session_end" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $session_end; ?>" 
                            onkeydown="return false;" />
                            <small class="error-msg session_end"></small>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Area <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="area" name="area" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $area; ?>"/>
                            <small class="error-msg area"></small>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pin <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="pin" name="pin" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $pin; ?>"/>
                            <small class="error-msg pin"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Landmark <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="landmark" name="landmark" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $landmark; ?>"/>
                            <small class="error-msg landmark"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Google Map <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="google_map" name="google_map" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $google_map; ?>"/>
                            <small class="error-msg google_map"></small>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="<?php echo site_url('/');?>admin/examnotification" class="btn btn-primary">Back</a>
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
    $("#session_start").timepicker({ 'scrollDefault': 'now' });
    $("#session_end").timepicker({ 'scrollDefault': 'now' });
});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var id = Number($('#id').val());
    var session_start = $('#session_start').val();
    if (session_start.length < 1) {
        $('.session_start').text('Session start time is required').show();
        return false;
    }
    var session_end = $('#session_end').val();
    if (session_end.length < 1) {
        $('.session_end').text('Session end time is required').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>
