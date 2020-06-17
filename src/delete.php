<?php
header("content-type:text/html;charset=utf8");

$path = "../img/normal/medium";

$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$sqlPATH = "SELECT * FROM travelimage WHERE ImageID=".$_GET['ImageID'];
$queryPATH = mysqli_query($conn,$sqlPATH);
$resultPATH = $conn -> query($sqlPATH);
$rowPATH = $resultPATH->fetch_assoc();

$file = $rowPATH['PATH'];

if(file_exists($path)){
    echo'yes';
    $res=unlink($path.'/'.$file);
    if($res){
        echo'成功删除文件';
        $sqlDelete = "DELETE FROM `travelimage` WHERE ImageID=".$_GET['ImageID'];
        $queryDelete = mysqli_query($conn,$sqlDelete);
        echo'成功删除数据库';
        header('location:photo.php');
    }else{
        echo'删除文件失败<a href="photo.php">点击重试</a>';
    }
}else{
    echo'没有找到文件目录<a href="photo.php">点击重试</a>';
}
?>