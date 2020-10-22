<?php
    session_start();
    try{
        $conn = new pdo('mysql:host=127.0.0.1;dbname=db_bms;','root','tang1999');
    }catch(Exception $e){
        die('服务器故障，请联系管理员！');
    }
    //1.接受用户输入的数据
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];
    $yzm = $_POST['vcode'];
    $rad = $_POST['rad'];
    //2.检查用户输入的数据格式是否合法
    if(empty($id) || empty($pwd)){
        die("<script>alert('账号和密码错误！');location.href='../../index.html';</script>");
    } 
    if(empty($yzm)){
        die("<script>alert('验证码不能为空');history.back();</script>");
    }
    if($yzm != $_SESSION['vcode'] ){
        die("<script>alert('验证码输入错误！');history.back();</script>");
    }
    $id = isset($id) ? trim($id) : '';
    $pwd = isset($pwd) ? trim($pwd) : '';
    if($rad == 1){// 当选中管理员单选按钮就跳转至管理员界面   
        //检查用户输入的数据是否与服务器里的数据一样
        $sql = "select * from admin where ad_id=? and ad_pwd=?";
        $pre = $conn->prepare($sql);
        $pre->bindParam(1 ,$id);
        $pre->bindParam(2 ,$pwd);
        $row = $pre->execute();
        //取回查询的结果
        if($pre->fetch()){
            $_SESSION['logined']=1;
            $_SESSION['admin']=$id;
            //开启会话后，可以使用会话机制。判断来访者的身份
            if(!isset($_SESSION['admin'])){
                die("<script>alert('非法用户！');location.href='../../index.html';</script>");
            }
            header('location:admin.php');
            die;
        }else{
            die("<script>confirm('登录失败！');location.href='../../index.html';</script>");
        }
    }else if($rad == 0){
        $sql1 = "select * from reader where rd_id=? and rd_pwd=?";
        $pre1 = $conn->prepare($sql1);
        $pre1->bindParam(1 ,$id);
        $pre1->bindParam(2 ,$pwd);
        $pre1->execute();
        if($pre1->fetch()){
            $_SESSION['reader']=$id;
            if(!isset($_SESSION['reader'])){
                die("<script>alert('非法用户！');location.href='../../index.html';</script>");
            }
            header('location:../reader/reader.php');
            die;
        }else{
            die("<script>confirm('登录失败！');location.href='../../index.html';</script>");
        }
    }
?>