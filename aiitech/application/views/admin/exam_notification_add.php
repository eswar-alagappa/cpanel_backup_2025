<?php include "header.php"; ?>
   
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
                echo 'Exam notification Add';
            } else {
                echo 'Exam notification Edit';
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
                action="<?php echo site_url('/')?>admin/examnotification/save" onsubmit='return checkSubmit();'>

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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Apply Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="apply_date" name="apply_date" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $apply_date; ?>" readonly/>
                            <small class="error-msg apply_date"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Late date to Apply  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last_date" name="last_date" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $last_date; ?>" readonly/>
                            <small class="error-msg last_date"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="fees" name="fees" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $fees; ?>"/>
                            <small class="error-msg fees"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Penalty <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="penalty" name="penalty" required="required"  
                            class="form-control col-md-7 col-xs-12" value="<?php echo $penalty; ?>"/>
                            <small class="error-msg penalty"></small>
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
    $("#last_date").datepicker({ 
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: (new Date).getFullYear()+':'+((new Date).getFullYear() + 1),
    });

    $("#apply_date").datepicker({ 
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: (new Date).getFullYear()+':'+((new Date).getFullYear() + 1),
    });

});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var id = Number($('#id').val());
    var name = $('#name').val();
    if (name.length < 1) {
        $('.name').text('Name is required').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>
