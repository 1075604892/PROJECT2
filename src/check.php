  
<?php
session_start();
header("content-type:text/html;charset=utf8");

$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$name=$_POST['username'];
$pass=$_POST['password'];

$sql="SELECT UserName,Pass From traveluser WHERE (UserName='$name')AND (Pass='$pass')";
$query=mysqli_query($conn,$sql);
$result = $conn->query($sql);
if ($result->num_rows > 0){
    $_SESSION['user'] = $name;
    header('location:..\index.php');
}else{
    exit('登录失败！ <a href="log.php">重新登录</a>或者<a href="..\index.php">回到主页</a>');
}
?>
