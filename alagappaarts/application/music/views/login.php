<div class="musicInnerContentOuter">
	<div class="musicInnerContent">

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
			padding:0px !important;
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
		.apaaContent ul{
			padding:0px;
		}
		<!--.loginForm {
			padding:12px 0 13px 30px;
		}-->
		
		</style>
		<div class="musicInnerContentRight">
			<div class="musicInnerBanner">Student login</div>
			
					
					<div class="musicApaaform">  
						<div class="registerFormOuter">

							<div class="apaaContent">

							 
								  <div class="loginBg">

								  <p>Enter your Username and Password to login</p>
										
										
										<span style="color:#088904;text-align:center;"><?php if ($this->session->flashdata('SucMessage')!='') { ?>
												<div class="alert alert-success alert-dismissable">
													<?php echo $this->session->flashdata('SucMessage') ;   ?>
												</div>
										<?php } ?>
										</span>
			
									  <div class="loginForm" style="<?php echo ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='login') ? 'display:block' : ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='forgetpass') ? 'display:none': '')); ?>"  >

									  <form action="<?php echo base_url().'music/registration'?>" method="post" id="frmLogin">
									  
									  <ul><li>

									  <input type="text" name="txtUsername" placeholder="Username" value="<?php echo (isset($post_set['txtUsername']) && !empty($post_set['txtUsername']) ? $post_set['txtUsername'] : '');?>">  <?php echo form_error('txtUsername'); ?> </li>

									  <li>

									  <input type="password" name="txtPassword" placeholder="Password" value="<?php echo (isset($post_set['txtPassword']) && !empty($post_set['txtPassword']) ? $post_set['txtPassword'] : '');?>" >
										<?php echo form_error('txtPassword'); ?>
									  </li>
										<input type="hidden" name="type" value="login"> 
									  <input type="submit" value="login" class="registerBtn" name="btnLogin">

									  </ul>
									  </form>

									  </div>
									  
									  
										
										<div class="loginForm forgetpassword_form" style="<?php echo ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='forgetpass') ? 'display:block' : ((isset($post_set['type']) && !empty($post_set['type']) && trim($post_set['type'])=='login') ? 'display:none': 'display:none')); ?>" >
											   <form action="<?php echo base_url().'music/forgetpassword'?>" method="post" id="frmLogin">
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
			
			
		</div>

	</div>
</div>