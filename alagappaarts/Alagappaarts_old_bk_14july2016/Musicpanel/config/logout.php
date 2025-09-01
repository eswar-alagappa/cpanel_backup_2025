<?php
session_start();
unset($_SESSION);
session_unset(); 
header('location:index.php');
?>