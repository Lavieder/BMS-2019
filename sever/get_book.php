<?php
    include 'admin/conn.php';
    $bid = $_GET['bid'];
    $sql = "select * from book where bk_id=?";
    $pre = $conn->prepare($sql);
    $pre->bindParam(1,$bid);
    $pre->execute();
    echo json_encode($pre->fetch());
?>