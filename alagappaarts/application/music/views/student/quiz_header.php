<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.music_js/1.4.2/respond.min.js"></script>
    <![endif]-->


<title><?php if($title){ echo $title; } ?></title>

<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen"/>


<script type="text/javascript" src="<?php echo base_url();?>editor/tiny_mce.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>music_js/jquery.js"></script>

 

<script type="text/javascript" src="<?php echo base_url();?>/music_js/online_basic.js?rd=<?php echo time();?>"></script>
 <style>
 
 .logoImg {
    background: rgba(0, 0, 0, 0) url("<?php echo base_url();?>music_assets/home/images/sprite-bg.png") no-repeat scroll 0 0;
    height: 60px;
    width: 140px;
}
 </style>
 <body>