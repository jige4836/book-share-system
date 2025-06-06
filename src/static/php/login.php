<?php
$phone = $_POST['name'];
$psw = $_POST['psw'];

// 构建要写入文件的字符串
//$data = "Name: $phone\nPassword: $psw\n";

// 指定文件路径
//$filePath = 'file.txt';

// 将数据写入文件
//file_put_contents($filePath, $data);

$db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
$db->query("set names 'utf8'");

$sql = "select * from user where phone='$phone'and password='$psw'";

$result = $db->query($sql);

$obj = $result->fetch_object();
$uid = $obj->uid;

$data = "Name: $phone\nPassword: $psw\nuid: $uid\n";

// 指定文件路径
$filePath = 'file.txt';

// 将数据写入文件
file_put_contents($filePath, $data);

if ($result->num_rows == 0) {//查不到

    echo "<script language='javascript'>alert('账号或密码错误');
    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
    exit;
    ?>
    <script>
    </script>
    <?php
//    sleep(1);
//    header("location:../login.html");
//    include ("../login.html");//样式会消失
//    die("查无此人");
} else if ($obj->phone=='admin') {
    header("location:../admin.html");
}else{
//    die();
    header("location:../index.html");
}
?>
