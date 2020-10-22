<?php
    //本页面只负责读者注册
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];
    $name = $_POST['name'];
    $sex_value = $_POST['sex'];
    $age = $_POST['age'];
    $class = $_POST['class'];
    $tel = $_POST['tel'];
    if(empty($id) || empty($pwd) || empty($name)){
        die("<script>alert('用户名、密码和姓名不能为空！');history.back();</script>");
    }
    if(empty($age) || empty($tel)){
        die("<script>alert('年龄和电话不能为空！');history.back();</script>");
    }

    // 连接数据库
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    $sql = 'insert into reader set rd_id=?,rd_pwd=?,rd_name=?,rd_sex=?,rd_age=?,rd_class=?,rd_tel=?';
    // $sql = 'select * from reader';
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$id);
    $pre->bindParam(2,$pwd);
    $pre->bindParam(3,$name);
    $pre->bindParam(4,$sex_value);
    $pre->bindParam(5,$age);
    $pre->bindParam(6,$class);
    $pre->bindParam(7,$tel);
    if(empty($sel) || empty($class)){
        $sel = null;
        $class = null;
    }
    $row = $pre->execute();
    // print_r ($pre->fetchAll());
    if($row){
        die("<script>alert('注册成功！');location.href='../index.html';</script>");
    }else{
        die("<script>alert('注册失败！请重新注册');location.href='join.html';</script>");
    };
?>