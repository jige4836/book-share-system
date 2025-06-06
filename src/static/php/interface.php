<?php
//echo '这里是主界面';

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

$sql = "select * from book,booktype where book.bt_id=booktype.bt_id order by book.bt_id asc,bid asc";//先按分类排，再按序号排

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
$strSQL = "select * from book,booktype where book.bt_id=booktype.bt_id order by book.bt_id asc,bid asc limit $start, $pagesize";
$result = $db->query($strSQL);

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>主界面</title>
        <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <style>
            body {
                /*background-image: url("../img/jiemian3.jpg");*/
                /*background-color: yellow;*/
                background-repeat: no-repeat;
                background-size: 100%;
                /*背景不重复*/
            }

            /*表格框架*/
            table {
                /*width: 80%;*/
                /*border-collapse: collapse;*/
                /*margin: auto;*/
                background-color: rgba(255, 255, 255, 0.1); /* 设置表格的背景颜色和透明度 */
            }

            /*table, td, th {*/
            /*    border: 2px solid black;*/
            /*    margin: auto;*/
            /*    !*padding: 5px;*!*/
            /*    text-align: center;*/
            /*}*/

            /*输入框*/
            /*#select {*/
            /*    width: 300px;*/
            /*    height: 35px;*/
            /*}*/

            /*查询按钮*/
            /*#sel, #add {*/
            /*    width: 50px;*/
            /*    height: 35px;*/
            /*    font-size: 18px;*/
            /*    position: relative;*/
            /*}*/

            /*img {*/
            /*    padding-left: 45px;*/
            /*    padding-right: 45px;*/
            /*}*/

            /*div{*/
            /*    margin-right: 10px;*/
            /*    padding-right: 10px;*/
            /*}*/
        </style>
        <script src="../js/jQuery.js"></script>
        <script src="../js/interface.js"></script>
        <!--        <script>-->
        <!--            $(document).ready(function () {//加载完成后执行的函数，以确保DOM元素都已经加载完毕。-->
        <!--                $('tr:even').css("background", "greenyellow");-->
        <!--                $("tr:first-child").css({-->
        <!--                    'color': 'red',-->
        <!--                    'font-weight': 'bolder',-->
        <!--                    'background-color': 'yellow'-->
        <!--                });-->
        <!--            });-->
        <!--        </script>-->
    </head>
    <body>
    <!--    <div>-->
    <!--        <form action="../select.html" method="">-->
    <!--            <p>-->
    <!--                <input type="submit" id="sel" value="查询">-->
    <!--            </p>-->
    <!--        </form>-->
    <!--        <p><a href="../add.html"><input type="submit" id="add" value="添加"></a>-->
    <!--        </p>-->
    <!--    </div>-->
    <div class="container" style="font-size: larger;margin-right: 150px">
        <hr>
        <!--轮播图-->
        <!--        <marquee class="">-->
        <!--            <p>-->
        <!--                <img src="../img/1.jpg" width="250px" height="250">-->
        <!--                <img src="../img/2.jpg" width="250px" height="250">-->
        <!--                <img src="../img/3.jpg" width="250px" height="250">-->
        <!--                <img src="../img/4.jpg" width="250px" height="250">-->
        <!--                <img src="../img/5.jpg" width="250px" height="250">-->
        <!--                <img src="../img/6.jpg" width="250px" height="250">-->
        <!--            </p>-->
        <!--        </marquee>-->

        <hr>
        <form action="delete.php" method="post">
            <table class="table table-striped table-bordered">
                <!--                <tr style="color: red;font-weight: bolder;background: yellow">-->
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
                                                                                    name="btn_return"></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <!--            <p style="margin-left:200px;position: fixed;bottom: 1px">-->
            <!--                <a href="../login.html">返回登录界面</a>-->
                            <input type="submit" value="确认删除" id="delete" name="delete">
            <!--            </p>-->
            <p style="text-align: center">
                <!--                <a href="interface.php?page=--><?php //= $_GET['page'] ?><!--"-->
                <!--                   target="_self"><input type="submit" value="翻到">-->
                <!--                <input type="text" name="page" size="2"-->
                <!--                       value="--><?php //= $page ?><!--"/></a>-->
                <a href="interface.php?page=<?= $page - 1 ?>"
                   target="_self"><input type="button" value="前一页" class="btn"></a>
                <input type="text" name="page" size="1"
                       value="<?= $page ?>"/>
                <a href="interface.php?page=<?= $page + 1 ?>"
                   target="_self"><input type="button" value="后一页" class="btn"></a>
            </p>
        </form>
    </div>
    </body>
    </html>
<?php
?>