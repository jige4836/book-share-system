<?php
// 指定文件路径
$filePath = 'file.txt';

// 读取文件内容
$fileContent = file_get_contents($filePath);

// 解析文件内容，假设内容格式为 "Name: $name\nPassword: $password\n"
$matches = [];
preg_match('/Name: (.+)\nPassword: (.+)\nuid: (.+)/', $fileContent, $matches);

$phone = $matches[1];
$password = $matches[2];
$uid = $matches[3];

$db = new mysqli("127.0.0.1", "root", "root", "book_share_system");
$db->query("set names 'utf8'");

$bid = $_GET['id'];

$delete = "delete from share where bid='$bid'and uid='$uid'";

$db->query($delete);

//之前分享的积分要扣回来
$update = "update user_message set credit=credit-1 where uid='$uid'";

$db->query($update);

//在book中找bid
$select = "select ISBN from share where bid='$bid'and uid='$uid'";
$result = $db->query($select);

$obj = $result->fetch_object();
$ISBN = $obj->ISBN;

$update2 = "update book set number=number-1 where ISBN='$ISBN'";

$db->query($update2);

echo "<script language='javascript'>alert('取消成功！');
//    history.back();//回答之前页面，且保留数据
    </script>";//解决弹不出问题
//exit;

include('add_manage_share.php');//包含学生表格列表输出
?>

