<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,body{
            height: 100%;
            overflow: hidden;
        }
        .box{
            position: relative;
            left: 415px;
            top: 77px;
        }
        .content{
            width: 250px;
        }
        .box a{
            text-decoration: none;
            display: block;
            height: 226px;
            width: 223px;
            color: rgb(46, 52, 70);
            text-align: center;
            transition: all .1s linear;
        }
        .box a:hover{
            transform: translateY(-2px);
            box-shadow: 2px 0 5px #ccc;
        }
        .con1{
            margin: 50px 0 0 50px;
           
        }
        .con2{
            margin: 50px 0 0 150px;
            position: absolute;
            top: -50px;
            left: 350px;
        }
        .content img{
            width: 200px;
            height: 180px;
        }
        .content span{
            padding-left: 10px;
        }
        .bx h2{
            width: 450px;
            text-align: center;
            position: relative;
            left: 600px;
            top: 44px;
        }
    </style>
</head>
<body>
    <div class="bx">
        <h2>
            读者 欢迎您！离开时别忘记安全退出哦~
        </h2>
        <div class="box">
            <div class="con1 content">
                <a href="rdbook.php">
                    <img class="img1" src="../../img/book.jpg">
                    <span class="span1">图书查询</span>
                </a>
            </div>
            <div class="con2 content">
                <a href="rdborrow.php">
                    <img class="img4" src="../../img/borrow1.jpg">
                    <span class="span4">借阅管理</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>