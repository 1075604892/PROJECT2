<?php
header("content-type:text/html;charset=utf8");
session_start();
$ImageID  = $_GET["ImageID"];

$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$name = $_SESSION['user'];
$sql="SELECT * From traveluser WHERE UserName='$name'";
$query=mysqli_query($conn,$sql);
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql1 = "INSERT INTO `travelimagefavor`(`UID`, `ImageID`) VALUES (".$row['UID'].",$ImageID)";
$query1 = mysqli_query($conn,$sql1);

header("location:introduction.php?ImageID=".$ImageID);
?>