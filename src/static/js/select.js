

//文本框的事件绑定：
window.onload = function () {
    document.getElementById("btn").addEventListener("click", SubmitForm);//注册按钮点击事件
}

//提交事件
function SubmitForm() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {//xhr.readystate==4
            //获取空白div的id，把获得的内容文本放入其中
            document.getElementById("show").innerHTML = xhr.responseText;
        }
    };
    //得到表单对象
    var form = document.getElementById("form");
    //得到表单数据
    var data = new FormData(form);
    //访问 PHP 选项
    xhr.open("POST", `../php/select.php`, true);
    //发送数据
    xhr.send(data);
}