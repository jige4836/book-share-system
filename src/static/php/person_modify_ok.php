<?php
$username = $_POST['username'];
$gender = $_POST['gender'];
$birthday=$_POST['birthday'];

if ($gender=='男'){
    $gender=1;
}else{
    $gender=2;
}

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
$phone = $matches[1];
$password = $matches[2];

$db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
$db->query("set names 'utf8'");

$sql = "update user_message set username='$username',gender='$gender',birthday='$birthday' where phone='$phone'and password='$password'";

$result = $db->query($sql);

include ('person.php');
?>
