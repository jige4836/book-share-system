<?php
// 指定文件路径
$filePath = 'file.txt';

// 读取文件内容
$fileContent = file_get_contents($filePath);

// 解析文件内容，假设内容格式为 "Name: $name\nPassword: $password\n"
$matches = [];
preg_match('/Name: (.+)\nPassword: (.+)\nuid: (.+)/', $fileContent, $matches);

$phone = $matches[1];
$psw = $matches[2];
$uid = $matches[3];

if ($_POST['last'] != $psw) {
    echo "<script language='javascript'>alert('旧密码错误！');
    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
    exit;
} else {

    $db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
    $db->query("set names 'utf8'");

//更新一下文件中密码的内容
    $psw = $_POST['new'];

//$select = "select * from user_message where uid='$uid' and phone='$phone'";

    $data = "Name: $phone\nPassword: $psw\nuid: $uid\n";

// 指定文件路径
    $filePath = 'file.txt';

// 将数据写入文件
    file_put_contents($filePath, $data);

//修改user_message表密码
    $update = "update user_message set password='$psw'where phone='$phone'";

    $db->query($update);

//修改user表密码
    $update = "update user set password='$psw' where phone='$phone'";

    $db->query($update);

    echo "<script language='javascript'>alert('密码修改成功！');
//    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
//    exit;

    include ('alter_password.php');
}
?>