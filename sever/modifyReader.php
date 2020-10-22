<?php
    $id = $_POST['updid'];
    $name = $_POST['updname'];
    $sex = $_POST['updsex'];
    if($sex == '男'){
        $sex = 1;
    }else if($sex == '女'){
        $sex = 0;
    }
    $age = $_POST['updage'];
    $class = $_POST['updclass'];
    $tel = $_POST['updtel'];
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    $sql = "update reader set rd_name=?,rd_sex=?,rd_age=?, rd_class=?, rd_tel=? where rd_id=?";
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$name);
    $pre->bindParam(2,$sex);
    $pre->bindParam(3,$age);
    $pre->bindParam(4,$class);
    $pre->bindParam(5,$tel);
    $pre->bindParam(6,$id);
    if($pre->execute()){
    header('Location:reader.php');
    }
    else{
        echo '修改失败';
    }
?>