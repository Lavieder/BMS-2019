<?php
    $adid = $_POST['adid'];
    $adname = $_POST['adname'];
    if(empty($adid) || empty($adname)){
        die("<script>alert('数据不能为空！');history.back();</script>");
    }
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    $sql = "insert into stackRoom set srm_no=?,srm_name=?";
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$adid);
    $pre->bindParam(2,$adname);
    if($pre->execute()){
        die("<script>alert('添加成功');location.href='stack.php';</script>");
    }else{
        die("<script>alert('添加失败');history.back();</script>");
    }
?>