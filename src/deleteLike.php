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

$sql1 = "DELETE FROM `travelimagefavor`  WHERE (UID= '".$row['UID']."') AND (ImageID = '".$ImageID."')";
$query1 = mysqli_query($conn,$sql1);
$result1 = $conn->query($sql1);

$jump = $_SESSION['like'];
if($jump == "1"){
    header('location:like.php');
}else if($jump == "0"){
    header("location:introduction.php?ImageID=".$ImageID);
}
?>