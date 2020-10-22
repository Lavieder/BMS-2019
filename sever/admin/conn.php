<?php
    //此文件只负责连接和打开数据库
    try{
        $conn = new pdo('mysql:host=127.0.0.1;dbname=db_bms;','root','tang1999');
    }catch(Exception $e){
        //这里填写程序一旦出错，该怎么做
        //使用die()语句，终止程序继续运行
        die('服务器故障，请联系管理员！');
    }
    //$conn = new mysqli($host, $uid, $pwd, $db);
    //第三方前端开发插件，能提高开发效率
    //1.jQuery       --->     js    jQuery.com
    //2.Bootstrap    --->     css   Bootcss.com
    //3.Popper.js
?>