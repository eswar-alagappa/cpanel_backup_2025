<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>images/alagappaarts.png" />
    <link href="<?php echo base_url();?>bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<title><?php if($title){ echo $title; } ?></title>
<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url();?>editor/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/basic.js?rd=<?php echo time();?>"></script>
 <style>
 
 .logoImg {
    background: rgba(0, 0, 0, 0) url("<?php echo base_url();?>assets/home/images/sprite-bg.png") no-repeat scroll 0 0;
    height: 60px;
    width: 140px;
}
.form-group p{
	color:#f00;
}
body{
	    width: 1170px;
}
 </style>
<?php 
 if($this->session->userdata('admin_logged_in'))
   {
   $logged_in=$this->session->userdata('admin_logged_in');
   ?>
   <div id="wrapper">

<?php  
if($this->uri->segment(3) != "access_test"){ 
?>
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
				  <a href=""><img class="logoImg" src="<?php echo base_url();?>assets/home/images/spacer.gif"></a>
                  <!--<a class="navbar-brand" href="http://savsoftquiz.com/" >
                  <img src="<?php echo base_url();?>logo/logo.png" style="height:36px;" title="Logo">
                  </a> -->
              </div>
              <div class="navbar-default sidebar" role="navigation" >
                  <div class="sidebar-nav navbar-collapse" aria-expanded="false" style="height: 1px;">
                      <ul class="nav in" id="side-menu">
                          
                         <!-- <li>
                              <a href="<?php echo site_url('home');?>"  ><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                          </li>

                          <?php 
                         if($logged_in['su']=="1"){ ?>
                         <li>
                         <a href="<?php echo site_url('user_data');?>" ><i class="fa fa-users fa-fw"></i> Users</a>
                         </li>
                         <?php
                         }
                         ?>-->
                          <?php 
                         //if($logged_in['su']=="1"){ ?>
                          <li>
                              <a href="<?php echo site_url('dance/admin/qbank/index');?>"  ><i class="fa fa-question fa-fw"></i> Question Bank</a>
                          </li>
                          <?php 
                        //}
                        ?>
                          <li>
                              <a href="<?php echo site_url('dance/admin/quiz/index');?>" ><i class="fa fa-check fa-fw"></i> Exam</a>
                          </li>
                          <li>
                          <?php 
                         if($logged_in=="1"){ ?>
                             <a href="<?php echo site_url('dance/admin/result/index');?>"  ><i class="fa fa-line-chart fa-fw"></i> Result</a>
                          <?php 
                        }else{
                          ?>
                            <a href="<?php echo site_url('dance/admin/result/user');?>"  ><i class="fa fa-line-chart fa-fw"></i> Result</a>
 
                          <?php 
                        }
                        ?>
                        </li>

                         <!--<li>
                         <a href="<?php echo site_url('liveclass');?>" ><i class="fa fa-desktop fa-fw"></i> Live Classroom</a>
                         </li>

                          <?php 
                         if($logged_in['su']=="1"){ ?>
                          <li>
                              <a href="<?php echo site_url('home/setting');?>"  ><i class="fa fa-cog fa-fw"></i> Setting</a>
                          </li>
                          <?php 
                        }
                        ?>-->
						<li>
                              <a href="<?php echo site_url('dance/admin/master/dashboard');?>"  ><i class="fa fa-cog fa-fw"></i> Back To Admin</a>
                          </li>
                      </ul>
                  </div>
              </div>
     </nav>
<?php 
}
?>
      <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
<?php 
}
?>