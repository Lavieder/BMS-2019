<?php
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    $bid = $_POST['bid'];
    $sql = "select * from stackRoom where srm_no=?";
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$bid);
    $pre->execute();
    echo json_encode($pre->fetch());
?>