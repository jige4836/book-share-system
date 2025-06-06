<?php
header("Content-type: text/html; charset=utf-8");

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

$sel = $_GET['select'];

$db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
$db->query("set names 'utf8'");

$sql = "select * from book,booktype where book.bt_id=booktype.bt_id and bname like '%{$sel}%'";

$result = $db->query($sql);

// 每页显示的记录数
$pagesize = 10;

// 当前页数
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// 计算总记录数和总页数
$total = $result->fetch_row()[0];
$pages = ceil($total / $pagesize);

// 计算起始记录的位置
$start = ($page - 1) * $pagesize;

// 查询数据
$strSQL = "select * from book,booktype where book.bt_id=booktype.bt_id and bname like '%{$sel}%' order by book.bid limit $start, $pagesize";
$result = $db->query($strSQL);
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索</title>
    <link href="../css/select.css" type="text/css" rel="stylesheet">
    <!--    <script src="../js/select.js"></script>-->
    <script src="../js/jQuery.js"></script>
    <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<hr>
<hr>
<div>
    <form action="select2.php" id="form" method="get">
        <p style="text-align: center">
            <input type="text" id="select" name="select" class="" placeholder="请输入部分或全部书名">
            <input type="submit" id="btn" value="查询" class="btn" style="background-color: #FFD026;">
        </p>
    </form>
</div>
<br>
<br>
<hr>
<br>
<br>
<div class="container" style="font-size: larger;margin-right: 150px">
    <form action="delete.php" method="get">
        <table id="myT" class="table table-striped table-bordered table-hover">
            <tr style="background-color: #FFD026">
                <?php
                if ($phone == 'admin') {
                    ?>
                    <td>删除</td>
                    <?php
                }
                ?>
                <td>序号</td>
                <td>ISBN</td>
                <td>书名</td>
                <td>作者</td>
                <td>数量</td>
                <td>类型</td>
                <td>借阅</td>
                <td>归还</td>
            </tr>
            <?php
            $i = 0;
            while ($obj = $result->fetch_object()) {
                $i++;
                ?>
                <tr>
                    <?php
                    if ($phone == 'admin') {
                        ?>
                        <td><input type="checkbox" name="bid[]" value="<?= $obj->bid ?>"></td>
                        <?php
                    }
                    ?>
                    <td><?= $i + $start ?></td>
                    <td><?= $obj->ISBN ?></td>
                    <td><?= $obj->bname ?></td>
                    <td><?= $obj->author ?></td>
                    <td><?= $obj->number ?></td>
                    <td><?= $obj->bt_name ?></td>
                    <td><a href="lend.php?id=<?php echo $obj->bid; ?>"><input type="button" value="借阅"
                                                                              name="btn_borrow"></a></td>
                    <td><a href="borrow.php?id=<?php echo $obj->bid; ?>"><input type="button" value="归还"
                                                                                name="btn_return"></a></td>
                </tr>
                <?php
            }
            ?>
        </table>
<!--                <p style="margin-left:200px;position: fixed;bottom: 1px">-->
<!--                    <a href="interface.php">返回主界面</a>-->
                    <input type="submit" value="确认删除" id="delete" name="delete">
<!--                </p>-->
        <p style="text-align: center">
            <!--                        <input type="submit" value="翻到"/>-->
            <!--                        <input type="text" name="page" size="2"-->
            <!--                               value="--><?php //= $page ?><!--"/>-->
            <a href="select.php?page=<?= $page - 1 ?>&select=<?= $sel ?>"
               target="_self"><input type="button" value="前一页" class="btn"></a>
            <input type="text" name="page" size="1"
                   value="<?= $page ?>"/>
            <a href="select.php?page=<?= $page + 1 ?>&select=<?= $sel ?>"
               target="_self"><input type="button" value="后一页" class="btn"></a>
        </p>
    </form>
</div>
</body>
</html>
