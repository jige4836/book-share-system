<?php
//header("Content-type: text/html; charset=utf-8");

$ISBN = $_POST['isbn'];
$bname = $_POST['bname'];
$author = $_POST['author'];
$number = $_POST['number'];
$bt_id = $_POST['bt_id'];

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

$select = "select * from book where ISBN='$ISBN'";

$result = $db->query($select);

if ($result->num_rows > 0) {//如果书籍中已有这本书，就增加数量
    $update = "update book set number=number+'$number' where ISBN='$ISBN'";
    $db->query($update);
//可以直接获得bid并插入
    $obj = $result->fetch_object();
    $bid = $obj->bid;
    $insert = "insert into share(uid,bid,ISBN, bname, author, number, bt_id) values ('$uid','$bid','$ISBN','$bname','$author','$number','$bt_id')";

    $db->query($insert);

} else if ($result->num_rows == 0) {//没有，就增加一行
//    先添加在book
    $insert1 = "insert into book(ISBN, BNAME, AUTHOR, NUMBER, BT_ID) values ('$ISBN', '$bname', '$author', '$number', '$bt_id')";
    $db->query($insert1);
//在book中找bid
    $select = "select * from book where ISBN='$ISBN'";
    $result = $db->query($select);

    $obj = $result->fetch_object();
    $bid = $obj->bid;
//    最后再插入share
    $insert2 = "insert into share(uid,bid,ISBN, bname, author, number, bt_id) values ('$uid','$bid','$ISBN','$bname','$author','$number','$bt_id')";

    $db->query($insert2);
}

//分享书籍可以获得1积分，用于购买书籍
$update = "update user_message set credit=credit+1 where uid='$uid'";

$db->query($update);

//    header('location:../add.html');
echo "<script language='javascript'>alert('感谢你的分享！');
//    history.back();//回答之前页面，且保留数据
    </script>";//解决弹不出问题
//exit;
include('add_look.php');
?>


