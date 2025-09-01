<div class="vaasthuInnerContent">

 <?php $this->load->view('left_banner'); ?>
 <script>
	$(document).ready(function(){
		$('.forget_password').on('click',function(){
			$('.loginForm').hide();
			$('.forgetpassword_form').show();
			$(this).hide();
			$('.login').show()
		});
		$('.login').on('click',function(){
			$('.loginForm').show();
			$('.forgetpassword_form').hide();
			$(this).hide();
			$('.forget_password').show()
		});
	});
 </script>
<style>
.loginBg ul li p{
	padding:0px;
	color:#f00;
}
.login_buttons{
	width:300px;
	float:left;
	position:relative;
	bottom:20px;
}
.login_buttons input{
	float:left;
}
.registerBtn1 {
    border: medium none;
    color: #600505;
	text-decoration:none;
    cursor: pointer;
    display: block;
    font-size: 12px;
    font-weight: bold;
    height: 31px;
	position:relative;
	left:35px;
    padding: 0;
    text-transform: uppercase;
}
.loginForm {
	padding:12px 0 13px 30px;
}
</style>
<div class="vaasthuInnerContentRight">
<div class="vaasthuBanner">
<h2><span>Registration</span></h2>
</div>
<div class="apaaContent">
<div class="centerregisterBtn"><a href="<?php echo base_url().'vaasthu/student/registration' ?>"><img width="249" height="101" src="../assets/home/images/student-btn.png"></a></div>

<div class="centerregisterBtn"><a href="<?php echo base_url().'vaasthu/center/registration' ?>"><img width="249" height="101" src="../assets/home/images/center-btn.png"></a></div>

  <div class="loginBg">

  <p>Enter your Username and Password to login</p>

  <span style="color:#088904;text-align:center;"><?php if ($this->session->flashdata('SucMessage')!='') { ?>
		<div class="alert alert-success alert-dismissable">
			<?php echo $this->session->flashdata('SucMessage') ;   ?>
		</div>
<?php } ?></span>
			<?php
				//echo '<pre>';print_r($post_set);
			?>
  <div class="loginForm" style="<?php echo ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='login') ? 'display:block' : ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='forgetpass') ? 'display:none': '')); ?>"  >

  <form action="<?php echo base_url().'vaasthu/registration'?>" method="post" id="frmLogin">

  <ul class="login_form">
  
  <li>

  <!--<label>Username :</label>-->

  <input type="text" name="txtUsername" placeholder="Username" value="<?php echo (isset($post_set['txtUsername']) && !empty($post_set['txtUsername']) ? $post_set['txtUsername'] : '');?>">
  <?php echo form_error('txtUsername'); ?>
  </li>

  <li>

   <!--<label>Password :</label>-->

  <input type="password" name="txtPassword" placeholder="Password" value="<?php echo (isset($post_set['txtPassword']) && !empty($post_set['txtPassword']) ? $post_set['txtPassword'] : '');?>" >
<?php echo form_error('txtPassword'); ?>
  </li>
  <input type="hidden" name="type" value="login"> 
  <input type="submit" value="login" class="registerBtn" name="btnLogin">
  
   </ul>
   </form>
   
    </div>
   
   <div class="loginForm forgetpassword_form" style="<?php echo ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='forgetpass') ? 'display:block' : ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='login') ? 'display:none': 'display:none')); ?>" >
	   <form action="<?php echo base_url().'vaasthu/forgetpassword'?>" method="post" id="frmLogin">
		   <ul>
				<li>
					<!--<label>Email :</label>-->
					<input type="text" name="email" placeholder="Email" value="<?php echo (isset($post_set['email']) && !empty($post_set['email']) ? $post_set['email'] : '');?>">
					<?php echo form_error('email'); ?>
				</li>
				<li>
					<!--<label>Email :</label>-->
					<input type="text" name="username" placeholder="Username" value="<?php echo (isset($post_set['username']) && !empty($post_set['username']) ? $post_set['username'] : '');?>">
					<?php echo form_error('username'); ?>
				</li>
				<input type="hidden" name="type" value="forgetpass"> 
			<input type="submit" value="Submit" class="registerBtn" name="btnForgetpassword">
		   </ul>
	   </form>
   </div>
   

  
 
  


 
 <div class="login_buttons">
 <a href="javascript:;" class="registerBtn1 login" style="<?php echo ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='forgetpass') ? 'display:block' : ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='login') ? 'display:none': 'display:none')); ?>" >Login</a>
 <a href="javascript:;" class="registerBtn1 forget_password" style="<?php echo ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='login') ? 'display:block' : ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='forgetpass') ? 'display:none': '')); ?>" >Forget Password</a>
</div>


 

  </div>

</div>
</div>

</div>