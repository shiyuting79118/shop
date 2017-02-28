<?php
    // 设置好了字符集
    header("content-type:text/html;charset=utf-8");     

    error_reporting(E_ALL ^ E_NOTICE);

    // 设置好时区
    date_default_timezone_set('PRC');

    // 导入数据库配置文件
    include 'config.php';

    // 导入函数库
    include 'function.php';

    // 连接数据库
    $link = mysql_connect(HOST, USER, PWD);

    if(mysql_errno()){
        exit(mysql_error());
    }

    mysql_set_charset(CHAR);

    mysql_select_db(DB);
