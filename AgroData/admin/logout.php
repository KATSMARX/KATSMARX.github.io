<?php
session_start();
$_SESSION['AdminID'] = "";
header('refresh:0;url=../index.php');
session_unset();
?>