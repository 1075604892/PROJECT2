<!DOCTYPE html>
<html>
<head>
<title>首页-云驿图片站</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="src/css/home.css">
</head>
<body>
<ul class="nav">
    <li><a class="active" href="">首页</a></li>
    <li><a href="src/browser.php">浏览页</a></li>
    <li><a href="src/search.php">搜索页</a></li>
    <?php 
    session_start();
    if(empty($_SESSION['user'])){
        echo <<<EOF
        <div class="dropdown">    
        <a href="src\log.php" class="dropbtn">
            <img src="img\head.png" width="22" height="22">
            登录</a>
EOF;

    }else{ 
        echo '<div class="dropdown">';    
        echo '<a href="" class="dropbtn"><img src="img\head.png" width="22" height="22">欢迎回来，'.$_SESSION['user'].'</a>';  
        echo '<div class="dropdown-content">';  
        echo '<a href="src\upload.php"><img src="img\icon\shangchuan.png" width="25" height="25">上传</a>';  
        echo '<a href="src\photo.php"><img src="img\icon\tupian.png" width="25" height="25">我的图片</a>';  
        echo '<a href="src\like.php"><img src="img\icon\shoucang.png" width="25" height="25">我的收藏</a>';  
        echo ' <a href="src\logout.php"><img src="img\icon\denglu-copy.png" width="25" height="25">登出</a>';  
        echo '</div>';  

    }
    ?>
    </div>
</ul>

<div class="header">
    <img src="img\header.jpg" width="100%">
</div>



<?php
header("content-type:text/html;charset=utf8");

$servername ="localhost";
$db_username="projectuser";
$db_password="123456";
$db_name="photos";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

if(empty($_SESSION['hot'])){
    //输出热门图片
    echo'<li class="line">热门图片展示</li>';
    $sql0 = "SELECT *, COUNT(*) FROM travelimagefavor GROUP BY ImageID ORDER BY COUNT(*) DESC LIMIT 6";
    $query0 = mysqli_query($conn,$sql0);
    $result0 = $conn -> query($sql0);
    echo'<div class="showimages">';
    echo'<table border="1" cellspacing="50px">';
    echo'<tr>';
    for($i = 0;$i<3;$i++){
        $row0 = $result0->fetch_assoc();
        
        $sql = "SELECT * FROM travelimage WHERE ImageID = ".$row0['ImageID'];
        $query = mysqli_query($conn,$sql);
        $result = $conn -> query($sql);
        $row = $result->fetch_assoc();

        echo'<td valign="top" align="center" class="tdimage">';
       
        if(empty($row['PATH'])){
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img title="'.$row['Description'].'" src="img/square/square-medium/none.png">';
            echo'</a>';
        }else{
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img title="'.$row['Description'].'" src="img/square/square-medium/'.$row['PATH'].'">';
            echo'</a>';
        }
        
        echo'<p class="title">'.$row['Title'].'</p>';
        if(empty($row['Description'])){
            echo'<p class="content">暂无简介';
        }else{
            echo'<p class="content">'.$row['Description'];
        }
        echo'</p>';
        echo'</td>';
    }
    echo'</tr>';
    echo'<tr>';
    for($i = 0;$i<3;$i++){
        $row0 = $result0->fetch_assoc();
        
        $sql = "SELECT * FROM travelimage WHERE ImageID = ".$row0['ImageID'];
        $query = mysqli_query($conn,$sql);
        $result = $conn -> query($sql);
        $row = $result->fetch_assoc();
        
        echo'<td valign="top" align="center" class="tdimage">';
       
        if(empty($row['PATH'])){
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img title="'.$row['Description'].'" src="img/square/square-medium/none.png">';
            echo'</a>';
        }else{
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img title="'.$row['Description'].'" src="img/square/square-medium/'.$row['PATH'].'">';
            echo'</a>';
        }
        
        echo'<p class="title">'.$row['Title'].'</p>';
        if(empty($row['Description'])){
            echo'<p class="content">暂无简介';
        }else{
            echo'<p class="content">'.$row['Description'];
        }
        echo'</p>';
        echo'</td>';
    }
    echo'</tr>';

    echo'</table>';
    echo'</div>';
}else{
    //输出随机图片
    echo'<li class="line">随便看看(<a href= "src/chageHot.php">点此查看热门图片</a>)</li>';
    $sql = "SELECT * FROM travelimage ORDER BY rand() LIMIT 6";
    $query = mysqli_query($conn,$sql);
    $result = $conn -> query($sql);
    echo'<div class="showimages">';
    echo'<table border="1" cellspacing="50px">';
    echo'<tr>';
    for($i = 0;$i<3;$i++){
        $row = $result->fetch_assoc();
        echo'<td valign="top" align="center" class="tdimage">';
       
        if(empty($row['PATH'])){
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img title="'.$row['Description'].'" src="img/square/square-medium/none.png">';
            echo'</a>';
        }else{
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img width="150px" height="150px" title="'.$row['Description'].'" src="img/normal/medium/'.$row['PATH'].'">';
            echo'</a>';
        }
        
        echo'<p class="title">'.$row['Title'].'</p>';
        if(empty($row['Description'])){
            echo'<p class="content">暂无简介';
        }else{
            echo'<p class="content">'.$row['Description'];
        }
        echo'</p>';
        echo'</td>';
    }
    echo'</tr>';
    echo'<tr>';
    for($i = 0;$i<3;$i++){
        $row = $result->fetch_assoc();
        echo'<td valign="top" align="center" class="tdimage">';
       
        if(empty($row['PATH'])){
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img title="'.$row['Description'].'" src="img/square/square-medium/none.png">';
            echo'</a>';
        }else{
            echo'<a href="src/introduction.php?ImageID='.$row['ImageID'].'">';
            echo'<img width="150px" height="150px" title="'.$row['Description'].'" src="img/normal/medium/'.$row['PATH'].'">';
            echo'</a>';
        }
        
        echo'<p class="title">'.$row['Title'].'</p>';
        if(empty($row['Description'])){
            echo'<p class="content">暂无简介';
        }else{
            echo'<p class="content">'.$row['Description'];
        }
        echo'</p>';
        echo'</td>';
    }
    echo'</tr>';

    echo'</table>';
    echo'</div>';
}


?>

<div class="auxi">
    <?php
    if(empty($_SESSION['hot'])){
        echo '<a href = "src/refresh.php"><button title="刷新" class="circlebtn"><img src="img\icon\shuaxin.png" width="25" height="25"></button></a>';
    }else{
        echo '<button id="refresh" title="刷新" class="circlebtn"><img src="img\icon\shuaxin.png" width="25" height="25"></button>';
        echo '<script>refresh.onclick = function(){setTimeout("window.location.reload()", 1);}</script>';//页面刷新
    }
    ?>
    <button id="backtotop" class="circlebtn" title="回到顶部">
        <img src="img\icon\huidaodingbu.png" width="25" height="25">
    </button>
    <script>
    backtotop.onclick = function(){
    document.body.scrollTop = document.documentElement.scrollTop = 0;
}

    </script>
</div>

<p class="footer">虚空备案号：19302016001</p>
</body>
</html>