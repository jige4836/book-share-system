


<?php


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册界面</title>
    <link href="../css/register.css" type="text/css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <style>

    </style>
</head>
<body>

<div class="rg_layout">
    <div class="rg_left">
        <p>修改密码</p>
        <p>MODIFY PASSWORD</p>
    </div>
    <div class="rg_center">
        <div class="rg_form">
            <div style="padding-top: 100px">
                <!--定义表单 form-->
                <form action="alter_psw_ok.php" method="post">
                    <table>
                        <tr>
                            <td class="td_left"><label for="name">旧密码:</label></td>
                            <td class="td_right"><input type="text" name="last" id="last"
                                                        placeholder="请输入旧密码"></td>
                        </tr>
                        <tr>
                            <td class="td_left"><label for="psw">新密码:</label></td>
                            <td class="td_right"><input type="text" name="new" id="new"
                                                        placeholder="请输入新密码"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" id="btn_sub" value="提交"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div class="rg_right">
<!--        <p>已有账号?<a href="login.html">立即登录</a></p>-->
    </div>
</div>
</body>
</html>

