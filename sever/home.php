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
        .con3{
            margin: 50px 0 0 150px;
            position: absolute;
            top: 216px;
            left: -100px;
        }
        .con4{
            margin: 50px 0 0 150px;
            position: absolute;
            top: 225px;
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
            width: 395px;
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
            尊敬的管理员，欢迎您驾临本系统(づ｡◕ᴗᴗ◕｡)づ
        </h2>
        <div class="box">
            <div class="con1 content">
                <a href="book.php">
                    <img class="img1" src="../img/book.jpg">
                    <span class="span1">图书查询</span>
                </a>
            </div>
            <div class="con2 content">
                <a href="borrow.php">
                    <img class="img4" src="../img/stack2.jpg">
                    <span class="span4">书库管理</span>
                </a>
            </div>
            <div class="con3 content">
                <a href="reader.php">
                    <img class="img1" src="../img/reader1.jpg">
                    <span class="span1">读者查询</span>
                </a>
            </div>
            <div class="con4 content">
                <a href="borrow.php">
                    <img class="img1" src="../img/borrow1.jpg">
                    <span class="span1">借阅查询</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>