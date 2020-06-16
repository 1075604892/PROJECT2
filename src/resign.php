<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>注册-云驿图片站</title>
    <link rel="stylesheet" type="text/css" href="css\resign.css">
</head>

<body class="logandresign" id="skybackground">
<div class="resign">
    <section>
        <form action="checkResign.php" method="POST">
            <table>
                <td>
                    <h1>注册</h1>
                    <img src="..\img\head.png">
                    <br>
                    <p>用户名</p>
                    <input type="text" name="reusername" pattern="[A-Z | a-z | 0-9 |_]*" title="大小写字母、数字、下划线" required>
                    <br>
                    <p>用户邮箱</p>
                    <input type="text" name="reemail" pattern="[A-Z | a-z | 0-9 |_]*@[A-Z | a-z | 0-9 |_]*.[A-Z | a-z | 0-9 |_]*" title="xxxx@xxx.xx"" required>
                    <br>
                    <p>密码</p>
                    <input type="password" name="repassword" pattern="[ A-Z | a-z | 0-9 ]{8,}" title="大小写字母、数字、八位以上" required>
                    <br>
                    <p>确认密码</p>
                    <input type="password" name="sepassword" pattern="[ A-Z | a-z | 0-9 ]{8,}" title="大小写字母、数字、八位以上" required>
                    <br>
                    <input type="submit" class="bigbutton" value="注册">
                </td>
            </table>
        </form>
    </section>
</div>

<p class="footer">虚空备案号：19302016001</p>
</body>
</html>