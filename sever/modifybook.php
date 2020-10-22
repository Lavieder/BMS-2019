<?php
    $id = $_POST['aid'];
    $name = $_POST['aname'];
    $writer = $_POST['awriter'];
    $publish = $_POST['apublish'];
    $pubDate = $_POST['apubDate'];
    $price = $_POST['aprice'];
    $date = $_POST['ainDate'];
    $count = $_POST['acount'];
    $lid = $_POST['stack'];
    include 'admin/conn.php';
    $sql = "update book set bk_name=?,bk_writer=?,bk_publish=?, bk_pubDate=?, bk_price=?,bk_inDate=?,bk_count=?,srm_no=? 
            where bk_id=?";
    $pre = $conn->prepare($sql);
    $pre->bindParam(1,$name);
    $pre->bindParam(2,$writer);
    $pre->bindParam(3,$publish);
    $pre->bindParam(4,$pubDate);
    $pre->bindParam(5,$price);
    $pre->bindParam(6,$date);
    $pre->bindParam(7,$count);
    $pre->bindParam(8,$lid);
    $pre->bindParam(9,$id);
    if($pre->execute()){
        die("<script>confirm('修改成功');location.href='book.php';</script>");
    }else{
        die("<script>confirm('修改失败');history.back();</script>");
    }
?>