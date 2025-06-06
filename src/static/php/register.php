<?php
//注册php
if (isset($_POST['name']) && isset($_POST['psw'])) {

    $name = $_POST['name'];
    $psw = $_POST['psw'];
//    $current_time = date('Y-m-d H:i:s');//或者now();

    $db = new mysqli('127.0.0.1', 'root', 'root', 'book_share_system');
    $db->query("set names 'utf8'");

    $sql = "insert into user(phone,password) values ('$name','$psw')";

    $result = $db->query($sql);

    header('location:../message.html');

//    header('location:../login.html');
} else {
    echo "<script language='javascript'>alert('账号密码不能为空！');
    history.back();//回答之前页面，且保留数据
    </script>";//解决弹不出问题
    exit;
    ?>
<!--    <div>-->
<!--        <script>-->
<!--            window.onload = function () {-->
<!--                alert("不能为空！");-->
<!--            }-->
<!--        </script>-->
<!--    </div>-->
    <?php
    header('location:../register.html');
}
?>