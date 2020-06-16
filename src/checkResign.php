  
<?php
session_start();
header("content-type:text/html;charset=utf8");

$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$re_name=$_POST['reusername'];
$re_email=$_POST['reemail'];
$re_pass=$_POST['repassword'];
$se_pass=$_POST['sepassword'];

$sql="SELECT UserName,Email From traveluser WHERE (UserName='$re_name')OR (Email='$re_email')";
$query=mysqli_query($conn,$sql);
$result = $conn->query($sql);
if ($result->num_rows > 0){
    exit('注册失败！用户名或邮箱已存在！<a href = "resign.php">点此返回</a>');
}else if($re_pass != $se_pass){
    exit('注册失败！两次密码不相同<a href = "resign.php">点此返回</a>');
}else{
    $sql = "INSERT INTO traveluser (Email, UserName, Pass)
    VALUES ('$re_email', '$re_name', '$re_pass')";
 
    if ($conn->query($sql) === TRUE) {
        echo '注册成功！<a href = "log.php">点此登录</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>