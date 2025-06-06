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

//$sql = "select uid from user_message where phone='$phone'and password='$password'";
//
//$result = $db->query($sql);
//
//$obj = $result->fetch_object();
//$uid = $obj->uid;

//$dateline = new DateTime();

//$dateline->add(new DateInterval('P30D'));//增加30天的时间

$select = "select * from book_time where uid='$uid'and bid='$bid' and borrow_time is null";

$result = $db->query($select);

if ($result->num_rows == 0) {//如果没有借过，或借过但已归还，则添加借阅记录

    $dateline = new DateTime('now');
    $dateline->add(new DateInterval('P30D'));
    $dateline=$dateline->format('Y-m-d H:i:s');
//    记录借阅时间
    $insert = "insert into book_time(uid, bid, lend_time,dateline) values ('$uid', '$bid', now(),'$dateline')";

    $db->query($insert);

//    book表所对应的书数量要减少一本
    $update = "update book set number=number-1 where bid='$bid'";

    $db->query($update);

    echo "<script language='javascript'>alert('借阅成功！');
    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
    exit;
//    include('interface.php');
} else if ($result->num_rows == 1) {//借过且没还就弹出提示，并直接返回
    echo "<script language='javascript'>alert('你已借阅过该书籍，请勿重复借阅！');
    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
    exit;
//    include('interface.php');
}
?>
