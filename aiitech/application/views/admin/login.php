<?php include "header.php"; ?>

			<div id="page-wrapper" class="sign-in-wrapper">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span>Sign In</span> </p>
						</div>
						<div class="signin">
							<form>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="text" class="user" value="Yourname" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email address:';}" id="username" name="username" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" class="lock" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password:';}" id="password" name="password" />
								</div>
								<div class="clearfix"> </div>
							</div>
        					<small class="error-msg error"></small>
							<input type="button" value="Login" id="login" name="login">

        					<br/>
							<div class="signin-rit">
								<span class="checkbox1">
									 <label class="checkbox">
									 	<a href="<?php echo site_url('/');?>admin/forgetpassword" >Forgot Password </a>
									 </label>
								</span>
								<div class="clearfix"> </div>
							</div>

						</form>	 
						</div>
					</div>
			</div>

<script>
$(document).ready(function(){
    $(document).keypress(function(e) {
        if(e.which == 13) {
            $("#login").trigger('click');
        }
    });    

    $("#login").click(function(e){
        $('.error').text('').hide();
        var site_url = "<?php echo site_url('/');?>"; 
        var url = site_url + 'admin/login/checkValidLogin';
        var data = {};
        username = $('#username').val();
        password = $('#password').val();
        data.username = username;
        data.password = password;
        $.ajax({
          type: "POST",
          url: url,
          data: data,
          dataType: 'json',
        })
        .done(function(msg) {
            if (msg.status){
            	var url = site_url + 'student/dashboard';
            	if (msg.role == 3) {
            		url = site_url + 'student/dashboard';
            	}
            	if (msg.role == 1) {
            		url = site_url + 'admin/dashboard';
                }
            	document.location.href = url;
            } else {
              $('.error').text(msg.result).show().focus();
            }
        });
    });
});
</script>

<?php include "footer.php"; ?>