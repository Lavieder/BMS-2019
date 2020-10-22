<?php
    session_start();
    $rdid = $_POST['rdid'];
    $bkid = $_POST['bkid'];
    $date = date('Y-m-d H:i:s');
    $count = 1;
    $rad = $_POST['rad'];
    $adid = $_SESSION['admin'];
    // if(empty($rdid) || empty($bkid)){
    //     die("<script>confirm('读者编号和图书编号不能为空！');history.back();</script>");
    // }
    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
    if($rad == 1){
        $sql = "insert into borrow set rd_id=?,bk_id=?,bow_date=?,bow_count=?,ad_id=?";
    }else if($rad == 0){
        $sql = "insert into giveback set rd_id=?,bk_id=?,re_date=?,re_count=?,ad_id=?";
    }
    $pre = $db->prepare($sql);
    $pre->bindParam(1,$rdid);
    $pre->bindParam(2,$bkid);
    $pre->bindParam(3,$date);
    $pre->bindParam(4,$count);
    $pre->bindParam(5,$adid);
    if($pre->execute()){
        die("<script>confirm('借阅成功');location.href='borrow.php';</script>");
    }else{
        die("<script>confirm('失败');location.href='borrow.php'</script>");
    }
?>