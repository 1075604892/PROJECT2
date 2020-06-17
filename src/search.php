<!DOCTYPE html>
<html>
<head>
<title>搜索页-云驿图片站</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/search.css">
</head>
<body>
<ul class="nav">
    <li><a href="..\index.php">首页</a></li>
    <li><a href="browser.php">浏览页</a></li>
    <li><a class="active" href="search.php">搜索页</a></li>
    <?php
    header("content-type:text/html;charset=utf8"); 
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

<form  action="checkKeyword.php" method="POST">
    <table class="searchpane">
        <tr>
            <td><input type="radio" name="search" value="srhtitle">搜索标题</td>
        </tr>
        <tr>
            <td><input type="name" name="title"></td>
        </tr>
        <tr>
            <td><input type="radio" name="search" value="srhcontent">搜索内容</td>
        </tr>
        <tr>
            <td><textarea name="content" rows="6"></textarea></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="搜索" class="bigbutton"">
            </td>
        </tr>
    </table>
</form>

<p class="line">搜索结果</p>

<?php

$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$result;
$sql0;
if(!empty($_GET['title'])||!empty($_GET['content'])){
    $num_rec_per_page=10;   // 每页显示数量
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
    $start_from = ($page-1) * $num_rec_per_page;
    if(!empty($_GET['title'])){
        //搜索标题
        $sql = "SELECT * FROM travelimage WHERE Title LIKE '%" .$_GET['title']."%' LIMIT $start_from, $num_rec_per_page";
        $sql0 = "SELECT * FROM travelimage WHERE Title LIKE '%" .$_GET['title']."%'";
        $query = mysqli_query($conn,$sql);
        $result = $conn -> query($sql);
    }else if(!empty($_GET['content'])){
        //搜索描述
        $sql = "SELECT * FROM travelimage WHERE Description LIKE '%" .$_GET['content']."%' LIMIT $start_from, $num_rec_per_page";
        $sql0 = "SELECT * FROM travelimage WHERE Description LIKE '%" .$_GET['content']."%'";
        $query = mysqli_query($conn,$sql);
        $result = $conn -> query($sql);
    }
    echo '<div class= "list">';
    while($row = $result->fetch_assoc()){
        echo'<table cellspacing="20px">';
        echo'<tr>';
        echo'<td width= "25px">';
        echo'<a href="introduction.php?ImageID='.$row['ImageID'].'"><img width="150px" height="150px" src="../img/normal/medium/'.$row["PATH"].'"></a>';
        echo'<td class="shortcontent">';
        echo'<p class="smalltitle">标题：'.$row["Title"].'</p>';
        if($row["Description"] === NULL){
            echo'<p class="smallcontent">图片简介：无</p>';
        }else{
            echo'<p class="smallcontent">图片简介：'.$row["Description"].'</p>';
        }
        echo'</td>';
        echo'</tr>';
        echo'</table>';
    }
    echo '</div>';

$rs_result = mysqli_query($conn,$sql0); //查询数据
$total_records = mysqli_num_rows($rs_result);// 统计总共的记录条数
$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数
if($total_pages > 5){
    $total_pages = 5;
}

if($result->num_rows > 0){
    echo "<div  class='change'>";
    if($page != 1){
        if(!empty($_GET["title"])){
        echo "<a href='search.php?page=".($page - 1)."&title=".$_GET["title"]."'>".'上一页'."</a> "; }else if(!empty($_GET["content"])){
            echo "<a href='search.php?page=".($page - 1)."&content=".$_GET["content"]."'>".'上一页'."</a> ";
        }// 上一页
    }
    for ($i=1; $i<=$total_pages; $i++) { 
        if(!empty($_GET["title"])){       
        echo "<a href='search.php?page=".$i."&title=".$_GET["title"]."'>".$i."</a> "; }else if(!empty($_GET["content"])){
            echo "<a href='search.php?page=".$i."&content=".$_GET["content"]."'>".$i."</a> "; 
        }
    }; 
    if($page != $total_pages){
        if(!empty($_GET["title"])){
        echo "<a href='search.php?page=".($page + 1)."&title=".$_GET["title"]."'>".'下一页'."</a> "; }else if(!empty($_GET["content"])){
            echo "<a href='search.php?page=".($page + 1)."&content=".$_GET["content"]."'>".'下一页'."</a> "; 
        }// 下一页
    echo "</div>";
    }
    }

}
?>

<p class="footer">虚空备案号：19302016001</p>
</body>
</html>