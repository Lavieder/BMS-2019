<?php
    session_start();
    //开启会话后，可以使用会话机制。判断来访者的身份
    if(!isset($_SESSION['admin'])){
        die("<script>alert('非法用户！');location.href='../../login.html';</script>");
    }
?>