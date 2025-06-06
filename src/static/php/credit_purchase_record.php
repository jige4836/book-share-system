<?php
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

$sql = "select book.bid,ISBN,bname,author,number,username,buy.credit,buy_time from buy,book,user_message where buy.uid=user_message.uid and book.bid=buy.bid and buy.uid='$uid' order by book.bt_id asc,book.bid asc";//先按分类排，再按序号排

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
$strSQL = "select book.bid,ISBN,bname,author,number,username,buy.credit,buy_time from buy,book,user_message where buy.uid=user_message.uid and book.bid=buy.bid and buy.uid='$uid' order by book.bt_id asc,book.bid asc limit $start, $pagesize";
$result = $db->query($strSQL);

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>购物车</title>
        <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <style>
            body {
                background-repeat: no-repeat;
                background-size: 100%;
                /*背景不重复*/
            }

            /*表格框架*/
            table {
                background-color: rgba(255, 255, 255, 0.1); /* 设置表格的背景颜色和透明度 */
            }

        </style>
        <script src="../js/jQuery.js"></script>
        <script src="../js/interface.js"></script>
    </head>
    <body>

    <div class="container"style="font-size: larger;margin-right: 150px">
        <hr>
        <hr>
        <form action="delete.php" method="post">
            <table class="table table-striped table-bordered">
                <!--                <tr style="color: red;font-weight: bolder;background: yellow">-->
                <tr style="background-color: #FFD026">
                    <!--                    <td>删除</td>-->
                    <td>序号</td>
                    <td>ISBN</td>
                    <td>书名</td>
                    <td>作者</td>
                    <td>数量</td>
<!--                    <td>类型</td>-->
                    <td>购买人</td>
                    <td>花费积分</td>
                    <td>购买时间</td>
<!--                    <td>加入购物车</td>-->
<!--                    <td>购买</td>-->
                </tr>
                <?php
                $i = 0;
                while ($obj = $result->fetch_object()) {
                    $i++;
                    ?>
                    <tr>
                        <!--                        <td><input type="checkbox" name="bid[]" value="--><?php //= $obj->bid ?><!--"></td>-->
                        <td><?= $i + $start ?></td>
                        <td><?= $obj->ISBN ?></td>
                        <td><?= $obj->bname ?></td>
                        <td><?=$obj->author?></td>
                        <!--                        <td>--><?php //= $obj->number ?><!--</td>-->
                        <td>1</td>
<!--                        <td>--><?php //= $obj->bt_name ?><!--</td>-->
                        <td><?=$obj->username?></td>
                        <td><?=$obj->credit?></td>
                        <td><?=$obj->buy_time?></td>
<!--                        <td><a href="credit_cancel_shopping.php?id=--><?php //echo $obj->bid;?><!--"><input type="button" value="移出购物车"class="btn" name=""style="background-color: #FFD026"></a></td>-->
<!--                        <td><a href="credit_buy.php?id=--><?php //echo $obj->bid;?><!--"><input type="button" value="购买" class="btn" name=""style="background-color: #FFD026"></a></td>-->
                    </tr>
                    <?php
                }
                ?>
            </table>

            <p style="text-align: center">
                <!--                <a href="interface.php?page=--><?php //= $_GET['page'] ?><!--"-->
                <!--                   target="_self"><input type="submit" value="翻到">-->
                <!--                <input type="text" name="page" size="2"-->
                <!--                       value="--><?php //= $page ?><!--"/></a>-->
                <a href="credit_shopping_cart.php?page=<?= $page - 1 ?>"
                   target="_self"><input type="button"value="前一页"class="btn"></a>
                <input type="text" name="page" size="1"
                       value="<?= $page ?>"/>
                <a href="credit_shopping_cart.php?page=<?= $page + 1 ?>"
                   target="_self"><input type="button" value="后一页"class="btn"></a>
            </p>
        </form>
    </div>
    </body>
    </html>
<?php
?>