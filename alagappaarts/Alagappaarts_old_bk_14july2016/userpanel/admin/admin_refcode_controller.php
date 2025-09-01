<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$refcode=$_REQUEST['refcode'];
$loginmaster=new loginmaster();
$refcode_check=$loginmaster->refcode_check($refcode);
echo $refcode_check[0]['countid']; exit;
?>