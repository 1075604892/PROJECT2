<!DOCTYPE html>
<html>
<head>
<title>详情页-云驿图片站</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/introduction.css">
</head>
<body class="introduce">
<ul class="nav">
    <li><a href="..\index.php">首页</a></li>
    <li><a href="browser.php">浏览页</a></li>
    <li><a href="search.php">搜索页</a></li>
    <?php 
    session_start();
    if(empty($_SESSION['user'])){
        echo <<<EOF
        <div class="dropdown">    
        <a href="log.php" class="dropbtn">
            <img src="..\img\head.png" width="22" height="22">
            登录</a>
EOF;

    }else{ 
        echo '<div class="dropdown">';    
        echo '<a href="" class="dropbtn"><img src="..\img\head.png" width="22" height="22">欢迎回来，'.$_SESSION['user'].'</a>';  
        echo '<div class="dropdown-content">';  
        echo '<a href="upload.php"><img src="..\img\icon\shangchuan.png" width="25" height="25">上传</a>';  
        echo '<a href="photo.php"><img src="..\img\icon\tupian.png" width="25" height="25">我的图片</a>';  
        echo '<a href="like.php"><img src="..\img\icon\shoucang.png" width="25" height="25">我的收藏</a>';  
        echo ' <a href="logout.php"><img src="..\img\icon\denglu-copy.png" width="25" height="25">登出</a>';  
        echo '</div>';  

    }
    ?>
    </div>
</ul>

<?php
header("content-type:text/html;charset=utf8");
$ImageID  = $_GET["ImageID"];

$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$sql="SELECT * From travelimage WHERE ImageID = '$ImageID'";
$query=mysqli_query($conn,$sql);
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql1="SELECT * From travelimagefavor WHERE ImageID = '$ImageID'";
$query1=mysqli_query($conn,$sql1);
$total_records = mysqli_num_rows($query1);

echo '<table cellpadding="30px" cellspacing="30px">';
echo '<tr>';
echo '<td class="center" rowspan="2">';

if(empty($row['PATH'])){
    echo '<img src="../img/normal/medium/none.png"></td>';
}else{
    echo '<img src="../img/normal/medium/'.$row['PATH'].'"></td>';
}
echo '<td class="center">';
echo '<p>已收藏人数：'.$total_records.'</p>';

if(!empty($_SESSION['user'])){
$name = $_SESSION['user'];
$sqlUser="SELECT * From traveluser WHERE UserName='$name'";
$queryUser=mysqli_query($conn,$sqlUser);
$resultUser = $conn->query($sqlUser);
$rowUser = $resultUser->fetch_assoc();


$sqlWetherLike = "SELECT * From travelimagefavor WHERE (ImageID = '$ImageID')AND (UID= '".$rowUser['UID']."')";
$queryWetherLike = mysqli_query($conn,$sqlWetherLike);
$resultWetherLike = $conn->query($sqlWetherLike);
if($resultWetherLike->num_rows > 0){
    $_SESSION['like'] = "0";
    echo '<a href="deleteLike.php?ImageID='.$ImageID.'">';
    echo '<button class="circlebtn">';
    echo '<img src="..\img\icon\dislike.png" width="30px" height="30px"></button>';
    echo '</a>';
    echo '<p>取消收藏</p>';
}else{
    echo '<a href="addLike.php?ImageID='.$ImageID.'">';
    echo '<button class="circlebtn">';
    echo '<img src="..\img\icon\shoucang.png" width="30px" height="30px"></button>';
    echo '</a>';
    echo '<p>收藏</p>';
}
}else{
    echo '<a href="log.php">';
    echo '<button class="circlebtn">';
    echo '<img src="..\img\icon\shoucang.png" width="30px" height="30px"></button>';
    echo '</a>';
    echo '<p>你还未登录,先去登录吧！</p>';
}




echo '</td>';
echo '<td class="left">';
echo '<p>';
echo '图片标题：'.$row['Title'].'';
echo '<br>';

$sql2="SELECT * FROM traveluser WHERE UID = '".$row['UID']."'";
$query2=mysqli_query($conn,$sql2);
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

echo '拍摄者：';
echo $row2['UserName'];
echo '<br>';
echo '主题：'.$row['Content'].'';
echo '<br>';

$sql3="SELECT * FROM geocountries_regions WHERE ISO = '".$row['Country_RegionCodeISO']."'";
$query3=mysqli_query($conn,$sql3);
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();

echo '拍摄国家：';
echo $row3['Country_RegionName'];
echo '<br>';

$sql4="SELECT * FROM geocities WHERE GeoNameID = '".$row['CityCode']."'";
$query4=mysqli_query($conn,$sql4);
$result4 = $conn->query($sql4);
$row4 = $result4->fetch_assoc();

echo '拍摄城市：';

if(empty($row4['AsciiName'])){
    echo "未知";
}else{
    echo $row4['AsciiName'];
}
echo '</p>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2">';
echo '图片简介：';
if($row['Description'] == NULL){
    echo "无";
}else{
    echo $row['Description'];
}
echo '</td>';
echo '</tr>';
echo '</table>';
echo '<p>虚空备案号：19302016001</p>';
?>


</body>
</html>