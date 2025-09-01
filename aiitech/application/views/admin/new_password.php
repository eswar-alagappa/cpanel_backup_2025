<?php include "header.php"; ?>

<?php
$error = isset($error) ? $error : '';
$status = isset($status) ? $status : '';
?>
            <div id="page-wrapper" class="sign-in-wrapper">
                    <div class="sign-in-form">
                        <div class="sign-in-form-top">
                            <p><span>Set New Password</span> </p>
                        </div>
                        <?php if ($error != '') { ?>
                        <div class="">
                            <p><span><?php echo $error; ?></span> </p>
                        </div>
                        <?php } ?>

                        <?php if ($status != '') { ?>
                        <div class="">
                            <p><span style="color: green;"><?php echo $status; ?></span> </p>
                        </div>
                        <?php } ?>

                        <div class="signin">
                        <form name="form1" id="form1" 
                            method="post" 
                            onsubmit='return checkSubmit();'
                            action="<?php echo site_url('/');?>admin/forgetpassword/setpassword">

                            <input type="hidden" id="id_md5" name="id_md5" value="<?php echo $id_md5; ?>" /> 

                            <div class="log-input">
                                <div class="log-input-left">
                                   <input type="password" class="user" value="" id="new_password" name="new_password" autocomplete="off" />
                                <br/>
                                <small class="error-msg new_password"></small>
                                </div>
                                <div class="clearfix"> </div>
                            </div>

                            <div class="log-input">
                                <div class="log-input-left">
                                   <input type="password" class="user" value="" id="confirm_password" name="confirm_password" />
                                </div>
                                <br/>
                                <small class="error-msg confirm_password"></small>
                                <div class="clearfix"> </div>
                            </div>

                            <input type="submit" value="Submit" id="butSend" name="butSend">
                            <br/>
                            <a href="<?php echo site_url('/');?>admin/login" class="btn btn-primary">Login</a>

                        </form>  
                        </div>
                    </div>
            </div>

<script>
$(document).ready(function(){
});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var new_password = $('#new_password').val();
    if (new_password.length < 8) {
        $('.new_password').text('Valid password is required min 8 character').show();
        return false;
    }
    var confirm_password = $('#confirm_password').val();
    if (new_password.length < 1) {
        $('.confirm_password').text('Please enter the confirm password.').show();
        return false;
    }
    if (new_password != confirm_password) {
        $('.confirm_password').text('Password does not match.').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>

