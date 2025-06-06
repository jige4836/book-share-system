<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <link href="../css/person_modify.css" type="text/css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>

<div class="container" id="show">
    <div class="rg_layout">
        <div class="rg_left">
            <p>分享书籍，让更多的人读书</p>
            <p>SHARE BOOK</p>
        </div>

        <div class="rg_center">
            <div class="rg_form">
                <!--定义表单 form-->
                <form action="add.php" method="post">
                    <table>
                        <tr>
                            <td class="td_left">ISBN:</td>
                            <td class="td_right"><input type="text" id="isbn" name="isbn" value=""></td>
                        </tr>
                        <tr>
                            <td class="td_left">书籍名称:</td>
                            <td class="td_right">
                                <input type="text" value="" id="bname" name="bname">
                            </td>
                        </tr>
                        <tr>
                            <td class="td_left">作者:</td>
                            <td class="td_right"><input type="text" id="author" name="author" value=""></td>
                        </tr>
                        <tr>
                            <td class="td_left">数量:</td>
                            <td class="td_right"><input type="text" id="number" name="number" value=""></td>
                        </tr>
                        <tr>
                            <td class="td_left">类型:</td>
                            <td class="td_right">
<!--                                <input type="text" id="type"name="type" value="">-->
                                <select id="bt_id"name="bt_id">
                                    <option value="1">文学类</option>
                                    <option value="2">人文社科类</option>
                                    <option value="3">自然科学类</option>
                                    <option value="4">技术科学类</option>
                                    <option value="5">艺术类</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" id="btn_sub" value="确定"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
<!--        <div class="rg_right">-->
<!--            <p>不想修改了?<a href="person.php">个人信息</a></p>-->
<!--        </div>-->
    </div>
</div>
</body>
</html>
