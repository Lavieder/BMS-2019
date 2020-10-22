<?php
    $navTitle = "<span class='breadcrumb-item active'>个人信息</span>";
    include "../admin/header.php";
    session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改个人信息</title>
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1490317_57d3erin3sp.css">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        html{
            height: 100%;
        }
        body{
            width: 100%;
            background: url(../../img/bg-image.png) center center;
            font-family: "Arial","Tahoma","Helvetica","Microsoft YaHei","黑体","宋体",sans-serif;
        }
        .content{
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40%;
            height: 550px;
        }
        .reg{
            width: 85%;
            height: 500px;
        }
        .reg form{
            position: relative;
            width: 350px;
        }
        .reg form .iconfont{
            position: absolute;
            top: 17%;
            right: 4%;
            font-size: 1.3rem;
            cursor: pointer;
        }
        .content input,
        .content select{
            display: block;
            width: 350px;
            height: 60px;
            border: none;
            border-bottom: 1px solid rgb(56, 73, 104);
            outline: none;
            color: #202c42;
            font-size: 18px;
            background-color: transparent;
            padding-top: 20px;
        }
        .content select{
            height: 60px;
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
        }
        .content select option{
            color: #121822;
        }
        input::-webkit-input-placeholder,
        select::-webkit-select-placeholder{
            color: #202c42;
            font-size: 16px;
        }
        input::-webkit-autofill{
            background-color: transparent;
        }
        .tit{
            font-size: 2rem;
            margin-left: -50px;
        }
        .content .btn{
            display: block;
            margin-top: 30px;
            width: 350px;
            height: 48px;
            font-size: 17px;
            text-align: center;
            outline: none;
            border: solid 1px transparent;
            border-radius: 30px;
            color: #ffffff;
            background-color: #495466;
            cursor: pointer;
            transition: all .1s linear;
        }
        
        .content .btn:hover{
            transform: translateY(-2px); 
        }
    </style>
    <script>
        $(function(){
            var flag = 0;
            $("#iconfont").click(function(){
                if(flag == 0){
                    $("#pwd").attr("type", "password");
                    $("#iconfont").attr("class","iconfont iconeye-close");
                    flag = 1;
                }else{
                    $("#pwd").attr("type", "text");
                    $("#iconfont").attr("class","iconfont iconyanjing1");
                    flag = 0;
                }
            });
        });
        function modify(bid){
        $.get('get_updin.php',{"bid":bid},function(data){
                $('[name=id]').val(data.rd_id);
                $('[name=pwd]').val(data.rd_pwd);
                $('[name=name]').val(data.rd_name);
                $('[name=sex]').val(data.bk_sex);
                $('[name=age]').val(data.bk_age);
                $('[name=class]').val(data.bk_class);
                $('[name=tel]').val(data.bk_tel);
            },'json');
        }
    </script>
</head>
<body>
    <div class="content">
        <div class="reg">
                <p class="tit">这里可以修改你的个人信息</p>
                <?php
                    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
                    $sql = "select * from reader where rd_id='".$_SESSION['reader']."'";
                    $pre = $db->query($sql);
                    $pre->execute(); 
                    $row = $pre->fetch();
                ?>
                <form id="updin" action="updinfor.php" method="POST" autocomplete="off">
                    <input type="text" name="id" id="id" class="onlyNumAlpha" placeholder="用户名" value="<?=$row['rd_id']?>" readonly>
                    <i id="iconfont" class="iconfont iconeye-close"></i>
                    <input type="password" name="pwd" id="pwd" class="onlyNumAlpha" placeholder="密码" value="<?=$row['rd_pwd']?>" required>
                    <input type="text" name="name" id="name" placeholder="姓名" value="<?=$row['rd_name']?>" required>
                    <select name="sex" id="sex" placeholder="性别" value="<?=$row['rd_sex']?>" >
                        <option value="1">男</option>
                        <option value="0">女</option>
                    </select>
                    <input type="text" name="age" id="age" placeholder="年龄" class="onlyNum" value="<?=$row['rd_age']?>" required >
                    <input type="text" name="class" id="class" placeholder="班级" value="<?=$row['rd_class']?>">
                    <input type="text" name="tel" id="tel" placeholder="电话" value="<?=$row['rd_tel']?>" class="onlyNum" required>
                    <button type="submit" class="btn">SUBMIT</button>
                </form>
            </div>
        </div>
    <?php
        include "../admin/footer.php";
    ?>