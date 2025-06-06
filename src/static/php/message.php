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

$db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
$db->query("set names 'utf8'");

$username = $_POST['username'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];

//if ($gender == '男') {
//    $gender = 1;
//} else {
//    $gender = 2;
//}

$insert = "insert into user_message (uid, username, phone, password, gender, birthday)values ('$uid','$username','$phone','$gender','$birthday')";

$db->query($insert);

header('location:../login.html');

?>