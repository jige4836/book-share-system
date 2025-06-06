<?php
$db = new mysqli("127.0.0.1", "root", "root", "book_share_system");
$db->query("set names 'utf8'");

$snoArr = $_POST['bid'];//获取用户选择的 sno 数组

$stmt = $db->prepare("DELETE FROM book WHERE bid = ?");

if ($stmt === false) {
    die("数据库准备失败: " . $db->error);
}

$affectedRows = 0;

for ($i = 0; $i < count($snoArr); $i++) {
    $sno = $snoArr[$i];
    $stmt->bind_param("s", $sno);
    $stmt->execute();
    $affectedRows += $stmt->affected_rows;
}

if ($affectedRows > 0) {
//    echo "删除成功";
//    foreach ($snoArr as $sno) {
//        echo "<p>删除了学号为 $sno 的学生</p>";
//    }
    ?>
    <script>
        window.onload=function () {
            alert("删除成功");
            // console.log("删除成功");
        }
    </script>
<?php
} else {
//    echo "sql执行成功，但是没有删除到数据";
}

$stmt->close();
include('interface.php');//包含学生表格列表输出
?>

