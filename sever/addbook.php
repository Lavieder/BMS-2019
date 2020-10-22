<?php
    $id = $_POST['id'];
    $name = $_POST['name'];
    $writer = $_POST['writer'];
    $publish = $_POST['publish'];
    $pubDate = $_POST['pubDate'];
    $price = $_POST['price'];
    $inDate = date('Y-m-d H:i:s');
    $count = $_POST['count'];
    $stack = $_POST['stack'];

    // 插入图书
    $db = new pdo('mysql:host=localhost;dbname=db_BMS;','root','tang1999');
    // 检查数据库图书的数量
    $sql = "select count(*) cnt from book where bk_id=?";
    $rs = $db->prepare($sql);
    $rs->bindParam(1,$id);
    $rs->execute();
    $row = $rs->fetchAll();
    //检查是否有图书库存，没有就新增，有则修改图书总数数量
    if($row['cnt'] == 0){
        $sql = "insert into book set bk_id=?,bk_name=?,bk_writer=?,bk_publish=?,bk_pubDate=?,bk_price=?,bk_inDate=?,bk_count=?,srm_no=?";
        $pre = $db->prepare($sql);
        $pre->bindParam(1,$id);
        $pre->bindParam(2,$name);
        $pre->bindParam(3,$writer);
        $pre->bindParam(4,$publish);
        $pre->bindParam(5,$pubDate);
        $pre->bindParam(6,$price);
        $pre->bindParam(7,$inDate);
        $pre->bindParam(8,$count);
        $pre->bindParam(9,$stack);
    }else{
        $sql = "update book set bk_count=bk_count+?";
        $pre = $db->prepare($sql);
        $pre->bindParam(1,$count);
    }
    if($pre->execute()){
        die("<script>confirm('添加成功');location.href='book.php';</script>");
    }else{
        die("<script>alert('添加失败');history.back();</script>");
    }
    
?>