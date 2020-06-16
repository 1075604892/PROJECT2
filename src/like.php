<!DOCTYPE html>
<html>
<head>
<title>我的收藏-云驿图片站</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/like.css">
</head>
<body class="list">
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
        echo '<a href="like.php" class = "active"><img src="..\img\icon\shoucang.png" width="25" height="25">我的收藏</a>';  
        echo ' <a href="logout.php"><img src="..\img\icon\denglu-copy.png" width="25" height="25">登出</a>';  
        echo '</div>';  

    }
    ?>
    </div>
</ul>

<p class="simline">我的收藏</p>

<?php
header("content-type:text/html;charset=utf8");
$_SESSION['like'] = "1";
$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$name = $_SESSION['user'];
$sql="SELECT * From traveluser WHERE UserName='$name'";
$query=mysqli_query($conn,$sql);
$result = $conn->query($sql);
if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $num_rec_per_page=10;   // 每页显示数量
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
    $start_from = ($page-1) * $num_rec_per_page;
    $sql1="SELECT * From travelimagefavor WHERE UID= '".$row['UID']."'LIMIT $start_from, $num_rec_per_page ";
    $query1=mysqli_query($conn,$sql1);
    $result1 = $conn->query($sql1);
    if($result1->num_rows > 0){
        while($row1 = $result1->fetch_assoc()){
            $sql2="SELECT * From travelimage WHERE ImageID = '".$row1['ImageID']."' ";
            $query2=mysqli_query($conn,$sql2);
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            echo'<table cellspacing="20px">';
            echo'<tr>';
            echo'<td width= "25px">';
            echo'<a href="introduction.php?ImageID='.$row2['ImageID'].'"><img src="../img/square/square-medium/'.$row2["PATH"].'"></a>';
            echo'<td class="shortcontent">';
            echo'<p class="smalltitle">标题：'.$row2["Title"].'</p>';
            if($row2["Description"] === NULL){
                echo'<p class="smallcontent">图片简介：无</p>';
            }else{
                echo'<p class="smallcontent">图片简介：'.$row2["Description"].'</p>';
            }
            echo'<a href="deleteLike.php?ImageID='.$row2['ImageID'].'"><button class="circlebtn" title="取消收藏"><img src="..\img\icon\dislike.png" width="30px" height="30px"></button></a>';
            echo'</td>';
            echo'</tr>';
            echo'</table>';
        }
    }else{
        echo "你还没有收藏任何照片哦";
    }
}else{
    echo "加载账号数据失败";
}

$sql3 = "SELECT * FROM travelimagefavor WHERE UID= '".$row['UID']."'";
$rs_result = mysqli_query($conn,$sql3); //查询数据
$total_records = mysqli_num_rows($rs_result);// 统计总共的记录条数
$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数
if($total_pages > 5){
    $total_pages = 5;
}

if($result1->num_rows > 0){
echo "<div  class='change'>";
if($page != 1){
echo "<a href='like.php?page=".($page - 1)."'>".'上一页'."</a> "; // 上一页
}
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='like.php?page=".$i."'>".$i."</a> "; 
}; 
if($page != $total_pages){
echo "<a href='like.php?page=".($page + 1)."'>".'下一页'."</a> "; // 下一页
echo "</div>";
}
}
?>

<p class="footer">虚空备案号：19302016001</p>
</body>
</html>