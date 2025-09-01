<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/alagappaarts.png" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo ((isset($SiteTitle) && !empty($SiteTitle)) ? $SiteTitle : 'Alagappaarts - Admin');?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url();?>assets/admin/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
	
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
									
									
									<?php if ($this->session->flashdata('SucMessage')!='') { ?>
										  <div class="alert alert-success alert-dismissable">
												<i class="fa fa-check"></i>
												<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
												<b>Alert!</b>
												<?php echo $this->session->flashdata('SucMessage') ;   ?>
											</div>
									<?php } ?>
	
        <div id="wrapper">
            <div id="login" class="animate form" style="<?php echo ((isset($_POST['login']) && !empty($_POST['login']) && $_POST['login']) ? '' : ((isset($_POST['register']) && !empty($_POST['register']) && $_POST['register']) ? 'display:none' : '')); ?>" >
                <section class="login_content">
                    <form id="myLoginForm" name="myLoginForm" method="POST" action="<?php echo base_url(); ?>vaasthu/admin/login#tologin">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo ((isset($post_set) && !empty($post_set['username'])) ? $post_set['username'] : ''); ?>"/>
							<span class="red-c appdob"><?php echo form_error('username'); ?></span>
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo ((isset($post_set) && !empty($post_set['password'])) ? $post_set['password'] : ''); ?>"/>
							<span class="red-c appdob"><?php echo form_error('password'); ?></span>
                        </div>
                        <div>
                            <!--<a class="btn btn-default submit" href="index.html">Log in</a>-->
							<input type="submit" class="btn btn-default submit"  value="Log in" name="login">	
                            <!--<a class="reset_pass" href="#">Lost your password?</a>-->
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <!--<p class="change_link">New to site?
                                <a href="<?php echo base_url().'vaasthu/admin/login#toregister';?>" class="to_register"> Create Account </a>
                            </p>-->
                            <div class="clearfix"></div>
                            <br />
                            <div>
                              

                                <p>©<?php echo date('Y')?> All Rights Reserved. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form" style="<?php echo ((isset($_POST['register']) && !empty($_POST['register']) && $_POST['register']) ? '' : ((isset($_POST['login']) && !empty($_POST['login']) && $_POST['login']) ? 'display:none' : '')); ?>" >
                
				<section class="login_content">
                    <form id="myRegisterForm" name="myRegisterForm" method="POST" action="<?php echo base_url(); ?>vaasthu/admin/login/register#toregister">
                        <h1>Create Account</h1>
						<!--<div>
                            <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="<?php //echo ((isset($post_set) && $post_set['firstname']) ? $post_set['firstname'] : ''); ?>" />
							<span class="red-c appdob"><?php echo form_error('firstname'); ?></span>
                        </div>-->
                        <div>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo ((isset($post_set) && !empty($post_set['username'])) ? $post_set['username'] : ''); ?>" />
							<span class="red-c appdob"><?php echo form_error('username'); ?></span>
                        </div>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Email"  value="<?php echo ((isset($post_set) && !empty($post_set['email'])) ? $post_set['email'] : ''); ?>"/>
							<span class="red-c appdob"><?php echo form_error('email'); ?></span>
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password"  value="<?php echo ((isset($post_set) && !empty($post_set['password'])) ? $post_set['password'] : ''); ?>"/>
							<span class="red-c appdob"><?php echo form_error('password'); ?></span>
                        </div>
						 <div>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo ((isset($post_set) && !empty($post_set['confirm_password'])) ? $post_set['confirm_password'] : ''); ?>" />
							<span class="red-c appdob"><?php echo form_error('confirm_password'); ?></span>
                        </div>
                        <div>
                            <!--<a class="btn btn-default submit" href="index.html">Submit</a>-->
							<input type="submit" class="btn btn-default submit"  value="Create" name="register">	
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="<?php echo base_url().'vaasthu/admin/login#tologin'; ?>" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                
                                <p>©<?php echo date('Y')?> All Rights Reserved. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>