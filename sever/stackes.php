<?php
    // 此页面提供“类别”数据服务 
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS','root','tang1999');
    $sql = 'select * from stackRoom';
    $rs = $db->query($sql);
    echo json_encode($rs->fetchAll());
?>