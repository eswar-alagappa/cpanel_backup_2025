<?php include "header.php"; ?>

<?php
$error = isset($error) ? $error : '';
$status = isset($status) ? $status : '';
?>
            <div id="page-wrapper" class="sign-in-wrapper">
                    <div class="sign-in-form">
                        <div class="sign-in-form-top">
                            <p><span>Forget Password</span> </p>
                        </div>
                        <?php if ($error != '') { ?>
                        <div class="">
                            <p><span><?php echo $error; ?></span> </p>
                        </div>
                        <?php } ?>

                        <div class="signin">
                        <form name="form1" id="form1" 
                            method="post" 
                            onsubmit='return checkSubmit();'
                            action="<?php echo site_url('/');?>admin/forgetpassword/sendResetMail">
                            <div class="log-input">
                                <div class="log-input-left">
                                   <input type="text" class="user" value="Your email id" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email address:';}" id="email" name="email" />
                                </div>
                                <div class="clearfix"> </div>
                            </div>

                            <small class="error-msg email"></small>
                            <input type="submit" value="Send" id="butSend" name="butSend">
                            <br/>
                            <a href="<?php echo site_url('/');?>admin/login" class="btn btn-primary">Back</a>

                        </form>  
                        </div>
                    </div>
            </div>

<script>
$(document).ready(function(){
});

function checkSubmit(){
    $('.error-msg').text('').hide();
    var email = $('#email').val();
    if (email.length < 1) {
        $('.email').text('Valid email is required').show();
        return false;
    }
   return true;
}

</script>

<?php include "footer.php"; ?>

