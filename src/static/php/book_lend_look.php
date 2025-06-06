<?php

// 指定文件路径
$filePath = 'file.txt';

// 读取文件内容
$fileContent = file_get_contents($filePath);

// 解析文件内容，假设内容格式为 "Name: $name\nPassword: $password\n"
$matches = [];
preg_match('/Name: (.+)\nPassword: (.+)\nuid: (.+)/', $fileContent, $matches);

//    if (count($matches) == 3) {
$phone = $matches[1];
$password = $matches[2];
$uid = $matches[3];

$db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
$db->query("set names 'utf8'");

$sql = "select ISBN,bname,username,lend_time,dateline,static from user_message as um,book_time as bt,book as b where bt.uid='$uid' and bt.bid=b.bid and bt.uid=um.uid and phone='$phone' and password='$password' order by time_id";

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
$strSQL = "select ISBN,bname,username,lend_time,dateline,static from user_message as um,book_time as bt,book as b where bt.uid='$uid' and bt.bid=b.bid and bt.uid=um.uid and phone='$phone' and password='$password' order by time_id limit $start, $pagesize";
$result = $db->query($strSQL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>借阅管理</title>
    <!--    <link href="../css/person.css" type="text/css" rel="stylesheet">-->
    <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>
<hr>
<hr>
<div class="container"style="font-size: larger;margin-right: 150px">
    <form method="post" action="">
        <table class="table table-bordered table-striped table-hover">
            <tr style="background-color: #FFD026">
                <td>序号</td>
                <td>ISBN</td>
                <td>书籍名称</td>
                <td>借阅人</td>
                <td>借阅时间</td>
                <td>归还截止日期</td>
                <td>状态</td>
<!--                <td>续借</td>-->
            </tr>
            <?php
            $i=0;
            while ($obj= $result->fetch_object()) {
                $i++;
//                $dateline = new DateTime($obj->lend_time);
//                $dateline->add(new DateInterval('P30D'));

                ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?= $obj->ISBN ?></td>
                    <td><?= $obj->bname ?></td>
                    <td><?= $obj->username ?></td>
                    <td><?= $obj->lend_time ?></td>
                    <td><?= $obj->dateline?></td>
                    <?php
                    if ($obj->static==1){
                    ?>
                        <td>已归还</td>
                    <?php
                    }else{
                        ?>
                        <td>未归还</td>
                    <?php
                    }
                    ?>
<!--                    <td><a href="keep_lend.php?id=--><?php //echo $obj->dateline?><!--"><input type="button" class="btn"value="续借" style="background-color: #FFD026"></a></td>-->
<!--                    <td><a href="keep_lend_look.php"><input type="button"class=""value="续借"></a></td>-->
                </tr>
                <?php
            }
            ?>
        </table>
        <p style="text-align: center">
            <a href="book_lend_look.php?page=<?= $page - 1 ?>"
               target="_self"><input type="button"value="前一页"class="btn"></a>
            <input type="text" name="page" size="1"
                   value="<?= $page ?>"/>
            <a href="book_lend_look.php?page=<?= $page + 1 ?>"
               target="_self"><input type="button" value="后一页"class="btn"></a>
        </p>
    </form>
</div>
</body>
</html>


