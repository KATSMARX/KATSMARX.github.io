<?php
session_start();
$_SESSION['AID'] = "";
header('refresh:0;url=../index.php');
session_unset();
?>