<?php
    $sid = $_POST['sid'];
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    $sql = "delete from book where bk_id=?";
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$sid);
    $pre->execute();
    echo $pre->rowCount();
?>