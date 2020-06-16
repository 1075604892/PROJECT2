<?php
session_start();
header("content-type:text/html;charset=utf8");

unset($_SESSION['hot']);   
header('location:../index.php');
?>