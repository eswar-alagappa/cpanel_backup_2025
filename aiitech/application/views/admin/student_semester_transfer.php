<?php include "header.php"; ?>
   
<?php
$from_semester_id = 0;
$to_semester_id = 0;
$error = isset($error) ? $error : '';
$saved_status = isset($saved_status) ? $saved_status : '';
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3>
            <?php 
                echo 'Student Semester Transfer';
            ?>
        </h3>

        <b style="color: red">
        <?php 
            if ($error != '') {
                echo $error;
            }
        ?>
        </b>

        <b style="color: green">
        <?php 
            if ($saved_status != '') {
                echo $saved_status;
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
                action="<?php echo site_url('/')?>admin/student_semester/transfer" onsubmit='return checkSubmit();'>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Semester From
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='from_semester_id'; $val=$from_semester_id; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $semesterNumList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg from_semester_id"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Semester To
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $id='to_semester_id'; $val=$to_semester_id; 
                                $id1 = 'id="'. $id.'" style= "width:100%;height:40px;"';
                                $arr = $semesterNumList;
                                echo form_dropdown($id, $arr, $val, $id1); 
                            ?>                                        
                            <small class="error-msg to_semester_id"></small>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Transfer</button>
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

});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var from_semester_id = Number($('#from_semester_id').val());
    var to_semester_id = Number($('#to_semester_id').val());

    if (from_semester_id < 1) {
        $('.from_semester_id').text('Select the semester').show();
        return false;
    }
    if (to_semester_id <= from_semester_id) {
        $('.to_semester_id').text('Select the valid semester').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>
