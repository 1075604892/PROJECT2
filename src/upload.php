<!DOCTYPE html>
<html>
<head>
<title>浏览页-云驿图片站</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/browser.css">
</head>
<body>
<ul class="nav">
    <li><a href="..\index.php">首页</a></li>
    <li><a class="active" href="">浏览页</a></li>
    <li><a href="search.php">搜索页</a></li>
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



<p class="footer">虚空备案号：19302016001</p>
</body>
</html>