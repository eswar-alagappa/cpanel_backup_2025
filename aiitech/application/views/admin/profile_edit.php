<?php include "header.php"; ?>
   
<?php
$id = isset($id) ? $id : 0;
$error = isset($error) ? $error : '';

$first_name = isset($first_name) ? $first_name : '';
$last_name = isset($last_name) ? $last_name : '';
$image_url = isset($image_url) ? $image_url : '';
$email_id = isset($email_id) ? $email_id : '';
if (isset($details)) {
    $row = $details[0];
    $id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $image_url = $row['image_url'];
    $email_id = $row['email_id'];
}   
?>


<div id="page-wrapper">

<div class="page-title">
    <div class="title_left">
        <h3> View Profile
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
                action="<?php echo site_url('/')?>admin/viewprofile/save" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 
                    <input type="hidden" id="image_url" name="image_url" value="<?php echo $image_url; ?>" /> 

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
                            <input type="file" id="image" name="image" <?php echo $image_url=='' ? ' required="required" ' : '' ?> 
                            class="form-control col-md-7 col-xs-12" >
                            <small class="">Please select png/jp file</small>
                            <br/>
                            <small class="error-msg image"></small>
                        </div>
                    </div>
                    

                    <?php if ($image_url != '') { 
                        $image_name = base_url() . '/uploads/' . $image_url;
                    ?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Selected Photo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <img src="<?php echo $image_name; ?>" width="50px" height="50px"> </img>';
                        </div>
                    </div>

                    <?php } ?>



                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="<?php echo site_url('/admin/viewprofile/display/') . '/' . md5($id) ;?>" class="btn btn-primary">Back</a>
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
    var first_name = $('#first_name').val();
    if (first_name.length < 1) {
        $('.first_name').text('First name is required').show();
        return false;
    }
    var last_name = $('#last_name').val();
    if (first_name.length < 1) {
        $('.last_name').text('Last name is required').show();
        return false;
    }
    var image = $('#image').val();
    if (image.length > 0) {
        if (image.indexOf('.png') > 0 || image.indexOf('.jpg') > 0 || image.indexOf('.gif') > 0){
        } else {
            $('.image').text('png/jpg/gif file photo is required').show();
            return false;
        }
    }

   return true;
}

</script>

<?php include "footer.php"; ?>
