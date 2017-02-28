<?php
    include 'common.php';

    $vcode = strtolower($_POST['vcode']);       // 接收用户输入的验证码并转为小写    
    $verify = strtolower($_SESSION['vcode']);   // 将session中存放的验证码赋值给变量并转为小写


    if( $vcode != $verify ){
        error('验证码错误');
    }

    // 直接使用用户输入的用户名和密码去查询数据库即可
    $name = $_POST['name'];
    $pwd = md5($_POST['pwd']);               // 一定要加上md5,因为数据库存放的密码是md5之后的
    
    $sql = "select `id`,`name` from " . PRE . "user where `name`='$name' and `pwd`='$pwd'";

    if( $row = query($sql) ){

        $row = $row[0];
        // 将用户的登录信息放到SESSION[home]中
        $_SESSION['home'] = $row;

        if( !empty($_SESSION['url']) ){

                $url = $_SESSION['url'];

        }else{
                $url = 'index.php';
        }

        success('登录成功', $url);

    }else{

        error('用户名或密码错误');
    }