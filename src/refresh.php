<?php
session_start();
header("content-type:text/html;charset=utf8");

$_SESSION['hot'] = "1";

header('location:../index.php');
?>