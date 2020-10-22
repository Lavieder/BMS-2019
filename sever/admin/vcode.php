<?php
    //本页面负责产生验证码
    session_start();
    //1.使用header设置输出什么格式的图片
    //header('content-type: image/png');
    //2.准备一个画布(真彩色)
    $image = imagecreatetruecolor(90,50);//(width,height)
    //4.创建背景颜色(默认黑色)
    $bg = imagecolorallocate($image,255,255,255);//255,255,255表示rgb(255,255,255) 白色
    //把背景色填充到画布
    imagefill($image,0,0,$bg);//0 -> x,0 -> y处表示颜色开始的值
    //6.随机产生一组字符
    $str = 'A1B2C3D4E5F6H7J8L9MPQR321STN';
    $text = '';
    for($i = 0;$i < 4;$i++){
        $t = substr($str,mt_rand(0,strlen($str)-1),1);
        $text .= $t;
        //设置文字的大小
        $fontsize = 50;
        //设置文字的位置
        $x = ($i * 25 / 4) + rand(5,10);
        $y = rand(10,20);
    }
    //B.把验证码写入会话(以便以后进行对比)
    //$_SESSION['xxx']在所有页面中可以使用，是超级全局变量
    $_SESSION['vcode'] = $text;
     //对验证码画干扰点
    for($i = 0;$i < 500;$i++){
        $p_color = imagecolorallocate($image,mt_rand(50,200),mt_rand(50,200),mt_rand(50,200));
        imagesetpixel($image,mt_rand(0,90),mt_rand(0,90),$p_color);
    } 
    //对验证码画干扰线
    for($i = 0;$i < 6;$i++){
        $line_color = imagecolorallocate($image,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
        imageline($image,mt_rand(0,85),mt_rand(0,85),mt_rand(0,85),mt_rand(0,85),$p_color);
    }
    
    //5.添加文字到验证码上
    //设置文字的颜色
    $text_color = imagecolorallocate($image,mt_rand(50,200), mt_rand(50,200), mt_rand(50,200));
    
    //添加文字
    imagestring($image,$fontsize,$x,$y,$text,$text_color);//10表示字体大小，x,y表示坐标，$text_color表示字体颜色
    //使用header设置输出什么格式的图片
    header("Content-type: image/png");
    //3.把图片显示到界面上
    imagepng($image);
?>