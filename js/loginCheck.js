//使用jQuery语法完成输入信息的校验
$('btnLogin').click(function () {
    if ($('#uid').val() == '') {
        alert('请输入账号');
        $('#uid').onfocus(); //获取焦点
        return false; //终止程序
    }
    if ($('#pwd').val() == '') {
        alert('密码不能为空！');
        $('#pwd').onfocus();
        return false;
    }
    if ($('#yzm').val() == '') {
        alert('验证码不能为空！');
        $('#yzm').focus();
        return false;
    }
});