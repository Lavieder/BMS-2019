<?php
    $rdid = $_POST['rdid'];
    $rdpwd = $_POST['rdpwd'];
    $rdname = $_POST['rdname'];
    $rdsex = $_POST['rdsex'];
    if($rdsex == '男'){
        $rdsex = 1;
    }else if($rdsex == '女'){
        $rdsex = 0;
    }
    $rdage = $_POST['rdage'];
    $rdclass = $_POST['rdclass'];
    $rdtel = $_POST['rdtel'];
    if(empty($rdid) || empty($rdpwd) || empty($rdname) || empty($rdage) || empty($rdclass) || empty($rdtel)){
        die("<script>alert('数据不能为空！');history.back();</script>");
    }
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    $sql = 'insert into reader set rd_id=?,rd_pwd=?,rd_name=?,rd_sex=?,rd_age=?,rd_class=?,rd_tel=?';
    // $sql = 'select * from reader';
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$rdid);
    $pre->bindParam(2,$rdpwd);
    $pre->bindParam(3,$rdname);
    $pre->bindParam(4,$rdsex);
    $pre->bindParam(5,$rdage);
    $pre->bindParam(6,$rdclass);
    $pre->bindParam(7,$rdtel);
    if($pre->execute()){
        die("<script>alert('添加成功！');location.href='reader.php';</script>");
    }else{
        die("<script>alert('添加失败！请重新添加');history.back();</script>");
    };
?>