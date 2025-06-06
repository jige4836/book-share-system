<?php

$bid = $_GET['id'];

// 指定文件路径
$filePath = 'file.txt';

// 读取文件内容
$fileContent = file_get_contents($filePath);

// 检查是否成功读取文件
//if ($fileContent !== false) {
// 解析文件内容，假设内容格式为 "Name: $name\nPassword: $password\n"
$matches = [];
preg_match('/Name: (.+)\nPassword: (.+)\nuid: (.+)/', $fileContent, $matches);

//    if (count($matches) == 3) {
$phone = $matches[1];
$password = $matches[2];
$uid = $matches[3];

$db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
$db->query("set names 'utf8'");

//删除购物记录
$delete = "delete from shopping where bid='$bid'and uid='$uid'";

$db->query($delete);

//修改book表购买的书的数量
$update = "update book set number=number-1 where bid='$bid'";

$db->query($update);

//修改user_message表的积分
$update = "update user_message set credit=credit-1 where uid='$uid'";

$db->query($update);

//把书籍信息及花费积分等存入buy表
$insert="insert into buy (uid, bid, credit, buy_time) values ('$uid','$bid',1,now())";

$db->query($insert);

echo "<script language='javascript'>alert('购买成功！');
    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
//    exit;

//include ('credit_look.php');
?>