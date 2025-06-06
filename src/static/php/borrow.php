<?php
//echo 'lend';
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


$select = "select * from book_time where uid='$uid'and bid='$bid'and borrow_time is null";

$result = $db->query($select);

if ($result->num_rows == 1) {
//  把归还时间设置未当前时间，把状态改为“已归还”
    $update = "update book_time set borrow_time=now(),static=1 where uid='$uid'and bid='$bid'and borrow_time is null";

    $db->query($update);

    //    book表所对应的书数量要增加一本
    $update = "update book set number=number+1 where bid='$bid'";

    $db->query($update);

    echo "<script language='javascript'>alert('归还成功！');
    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
    exit;
//    include('interface.php');
//    include ('book_borrow_look.php');
} else {
    echo "<script language='javascript'>alert('你已经归还了，没必要再归还！');
    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
    exit;
//    include('interface.php');
//    include ('book_borrow_look.php');
}
?>
