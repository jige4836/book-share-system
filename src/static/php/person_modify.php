<?php
// 指定文件路径
$filePath = 'file.txt';

// 读取文件内容
$fileContent = file_get_contents($filePath);

// 检查是否成功读取文件
//if ($fileContent !== false) {
// 解析文件内容，假设内容格式为 "Name: $name\nPassword: $password\n"
$matches = [];
preg_match('/Name: (.+)\nPassword: (.+)/', $fileContent, $matches);

//    if (count($matches) == 3) {
$name = $matches[1];
$password = $matches[2];

// 在这里使用$name和$password进行其他操作
//        echo "Name: $name<br>";
//        echo "Password: $password<br>";
//    } else {
//        echo '文件格式不正确';
//    }
//} else {
//    echo '读取文件时出现错误';
//}
$db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
$db->query("set names 'utf8'");

$sql = "select * from user_message where password='$password' and phone='$name'";

$result = $db->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <link href="../css/person_modify.css" type="text/css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>

<div class="container" id="show">
    <div class="rg_layout">
        <div class="rg_left">
            <p>个人信息编辑</p>
            <p>PERSON MESSAGE
                MODIFY</p>
        </div>

        <div class="rg_center">
            <div class="rg_form">
                <!--定义表单 form-->
                <form action="person_modify_ok.php" method="post">
                    <table>
                        <?php
                        $obj = $result->fetch_object();

                        ?>
                        <tr>
                            <td class="td_left">用户名:</td>
                            <td class="td_right"><input type="text"id="username" name="username" value="<?= $obj->username ?>"></td>
                            <!--                            <td><input type="submit"value="编辑"class="btn"id="username"></td>-->
                        </tr>
                        <tr>
                            <td class="td_left">手机号:</td>
                            <!--                            <td class="td_right">--><?php //= $obj->phone ?><!--</td>-->
                            <td class="td_right">
<!--                                <input type="text" value="" id="tel" name="tel">-->
                                <?= $obj->phone ?>
                            </td>
                            <!--                            <td><input type="submit"value="编辑"class="btn"id="phone"></td>-->
                        </tr>
                        <tr>
                            <td class="td_left">性别:</td>
                            <?php
                            if ($obj->gender == 1) {
                                ?>
                                <td class="td_right"><input type="text"id="gender" name="gender" value="男"></td>
                                <?php
                            } else {
                                ?>
                                <td class="td_right"><input type="text"id="gender" name="gender" value="女"></td>
                                <?php
                            }
                            ?>
                            <!--                            <td><input type="submit"value="编辑"class="btn" id="gender"></td>-->
                        </tr>
                        <tr>
                            <td class="td_left">出生日期:</td>
                            <td class="td_right"><input type="date"id="birthday" name="birthday" value="<?= $obj->birthday ?>"></td>
                        </tr>
                        <tr>
                            <td class="td_left">积分:</td>
                            <td class="td_right">
<!--                                <input type="text"id="credit"value="">-->
                                <?= $obj->credit ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" id="btn_sub" value="提交"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="rg_right">
            <p>不想修改了?<a href="person.php">个人信息</a></p>
        </div>
    </div>
</div>
</body>
</html>