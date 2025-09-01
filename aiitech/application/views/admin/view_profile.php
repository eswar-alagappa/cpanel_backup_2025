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
                action="<?php echo site_url('/')?>admin/viewprofile/edit" onsubmit='return checkSubmit();'>

                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" /> 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <label>
                                    <?php echo $first_name . ' ' . $last_name; ?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Role 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <label>
                                    <?php echo $login_rolename; ?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <label>
                                    <?php echo $email_id; ?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Photo 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <label>
                                    <?php 
                                        if ($image_url != '') {
                                            $image = base_url() . '/uploads/' . $image_url;
                                            echo '<img src="' . $image . '" width="100px" height="50px"> </img>';
                                       }
                                    ?>
                            </label>
                        </div>
                    </div>



                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Edit</button>
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
    var id = Number($('#id').val());
    var roll_num = $('#roll_num').val();
    if (roll_num.length < 1) {
        $('.roll_num').text('Roll Num is required').show();
        //return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>
