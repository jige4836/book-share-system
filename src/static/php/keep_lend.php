<?php
//echo 'lend';
$dateline = $_GET['id'];

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

$temp=$dateline;

$dateline = new DateTime($dateline);

$dateline->add(new DateInterval('P30D'));//增加30天的时间
$dateline=$dateline->format('Y-m-d H:i:s');
$update = "update book_time set dateline='$dateline' where uid='$uid'and dateline='$temp'";

$db->query($update);

echo "<script language='javascript'>alert('续借成功！');
//    history.back();//回到之前页面，且保留数据
    </script>";//解决弹不出问题
//exit;
include ('keep_lend_look.php');
//include ('keep_lend_look.php');

?>
<script>
    //console.log('<?php //=$bid?>//');
</script>