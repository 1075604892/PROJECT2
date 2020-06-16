<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>登录-云驿图片站</title>
    <link rel="stylesheet" type="text/css" href="css/log.css">
</head>

<body class="logandresign">

<div class="log">
    <section>
        <form action="check.php" method="POST">
            <table>
                <td>
                    <h1>登录</h1>
                    <img src="..\img\head.png">
                    <br>
                    <p>用户名</p>
                    <input type="text" name="username" require>
                    <p>密码</p>
                    <input type="password" name="password" require>
                    <br>
                    <a href="resign.php">没有账号？点击注册</a>
                    <br>
                    <input type="submit" class="bigbutton" value="登录">
                </td>
            </table>
        </form>
    </section>
</div>

<p class="footer">虚空备案号：19302016001</p>
</body>
</html>