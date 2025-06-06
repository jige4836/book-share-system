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

//$select = "select * from shopping where uid='$uid'and bid='$bid'";

//$result = $db->query($select);

//if ($result->num_rows==0){
//$insert = "insert into shopping(uid, bid, number)values ('$uid','$bid',1)";
//}
//$db->query($insert);

$delete = "delete from shopping where bid='$bid'and uid='$uid'";

$db->query($delete);

echo "<script language='javascript'>alert('已移出购物车！');
//    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
//    exit;

include ('credit_shopping_cart.php');
?>

