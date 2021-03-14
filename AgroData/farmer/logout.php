<?php
session_start();
$_SESSION['FID'] = "";
header('refresh:0;url=../index.php');
session_unset();
?>