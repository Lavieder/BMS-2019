<?php
    session_start();
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];
    $name = $_POST{'name'};
    $sex_value = $_POST['sex'];
    if($sex_value == '男'){
        $sex_value = 1;
    }else if($sex_value == '女'){
        $sex_value = 0;
    }
    $age = $_POST['age'];
    $class = $_POST['class'];
    $tel = $_POST['tel'];
    if(empty($id) || empty($pwd) || empty($name)){
        die("<script>alert('用户名、密码和姓名不能为空！');history.back();</script>");
    }
    if(empty($age) || empty($tel)){
        die("<script>alert('年龄和电话不能为空！');history.back();</script>");
    }

    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    
    $sql = "update reader set rd_pwd=?,rd_name=?,rd_sex=?,rd_age=?,rd_class=?,rd_tel=? where rd_id=?";
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$pwd);
    $pre->bindParam(2,$name);
    $pre->bindParam(3,$sex_value);
    $pre->bindParam(4,$age);
    $pre->bindParam(5,$class);
    $pre->bindParam(6,$tel);
    $pre->bindParam(7,$id);
    $row = $pre->execute();
    if($row){
        die("<script>alert('修改成功');location.href='infor.php';</script>");
    }else{
        die("<script>alert('修改失败');history.back();</script>");
    }
?>