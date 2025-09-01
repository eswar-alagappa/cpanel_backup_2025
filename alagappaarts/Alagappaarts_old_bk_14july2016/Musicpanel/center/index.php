<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$loginerror = $_GET['msg'];
if(isset($_REQUEST['btnLogin']))
{
		
		$arrlogindetails = array('username'=> $_REQUEST['txtUsername']  ,'password'=>md5($_REQUEST['txtPassword']));
		$oUserMaster = new loginmaster();
		$loginerror = $oUserMaster -> checkcenterlogin($arrlogindetails);
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>alagappaarts</title>
<link href="../web/css/style.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="../web/scripts/jquery.min.js"></script>
<script type="text/javascript" src="../web/scripts/jquery.validate.js"></script>
<script type="text/javascript" src="../web/validation/login.validate.js"></script>
</head>

<body>
<div class="loginPage">
<div class="wrapper">
<div class="loginHeader">
<div class="logo"><a href="#"><img src="../web/images/spacer.gif" width="1" height="1" class="logoImg" /></a></div>
</div>
<div class="loginContent">
<div class="loginFormOuter">
<div class="loginFormTitle">Center login</div>
<div class="loginForm ">
<?php  if($loginerror) {echo "<div class='adminError'>$loginerror</div>";} ?>
<div class="loginFormRightBg">

<form id="frmLogin"  method="post">
<label>User Name :</label>
<input name="txtUsername" type="text" />
<label>Password :</label>
<input name="txtPassword" type="password" />
<input name="btnLogin" value="login" type="submit" class="loginBtn" />
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="footerOuter">
<div class="footer">
<div class="footerLeft">© Alagappa Performing Arts Academy. </div>
<div class="footerRight"><a href="http://inqtechnologies.com/" target="_blank">Designed by InQ Technologies</a></div>
</div>
</div>
</body>
</html>
