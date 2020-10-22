<?php
    $id = $_POST['updid'];
    $name = $_POST['updname'];
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    $sql = "update stackRoom set srm_name=? where srm_no=?";
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$name);
    $pre->bindParam(2,$id);
    // $pre->execute();
    
    if($pre->execute()){
        header('Location:stack.php');
    }
    else{
        die("<script>cofirm('修改失败');</sctipt>");
    }
?>