<?php
    require 'adminCheck.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员页面</title>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1490317_t69keu6x4l9.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <base target="frmMain">
    <style>
        .menu li.menubg>.a{
            background: #6e7ca3;
            border-left: 4px solid #2b2746;
            color: #ffffff;
        }
        .menu li.menubg>.a:hover{
            background: #2e3446;
        }
    </style>
</head>
<body>
    <div id="cantainer">
        <div id="top">This Is Your Interface
            <span id="time">00:00:00</span>
        </div>
        <div id="main">
            <div id="left">
                <p id="p">MAIN</p>
                <ul class="menu">
                    <li class="home li">
                        <a href="../home.php" class="a">
                            <i class="iconfont">&#xe606;</i>首页
                        </a>
                    </li>
                    <li class="book li" >
                        <a href="../book.php" class="a">
                            <i class="iconfont">&#xe608;</i>图书管理
                        </a>
                    </li>
                    <li class="stack li">
                        <a href="../stack.php" class="a">
                            <i class="iconfont">&#xe66a;</i>书库管理
                        </a>
                    </li>
                    <li class="staff li">
                        <a href="../reader.php" class="a">
                            <i class="iconfont">&#xe600;</i>读者管理
                        </a>
                    </li>
                    <li class="borrow li">
                        <a href="../borrow.php" class="a">
                            <i class="iconfont">&#xe66e;</i>借阅管理
                        </a>
                    </li>
                    <li class="exit li">
                        <a href="Exit.php" target="_top" class="a">
                            <i class="iconfont">&#xeb85;</i>安全退出
                        </a>
                    </li>
                </ul>
            </div>
            <div id="right">
                <iframe src="../home.php" class="ifram" frameborder="0" width="100%" height="100%" scrolling="auto" name="frmMain"></iframe>
            </div> 
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $(".menu li").click(function () {
            $(this).addClass("menubg").siblings().removeClass("menubg");
        });
        setInterval(function(){
            var now = new Date();
            var y = now.getFullYear(),
                m = now.getMonth() + 1,
                r = now.getDate(),
                d = now.getDay(),
                week = ['星期天','星期一','星期二','星期三','星期四','星期五','星期六'],
                h = now.getHours(),
                mi = now.getMinutes(),
                s = now.getSeconds();
                if(m < 10)  m = "0" + m;
                if(r < 10)  r = "0" + r;
                if(h < 10)  h = "0" + h;
                if(mi < 10)  mi = "0" + mi;
                if(s < 10)  s = "0" + s;
            $("#time").html(
                    y + "年" + m + "月" + r + "日" + h + ":" + mi + ":" + s+ "    " + week[d]
            );
        },1000);
    })
</script>
</html>