<?php

	header("content-type:text/html;charset=utf-8");

	error_reporting(E_ALL^E_NOTICE);

	session_start();

	date_default_timezone_get('PRC');


	// 写两个常量 一个是前台目录的url  一个是前台目录的path
    // img src=url   a href=url   link href=url
    define('URL', 'http://localhost/project/');


     // include path;     opendir(path)  move_uploaded_file(tmp_name, path) 
    define('PATH', dirname(str_replace('\\','/',__FILE__)).'/');

	include'config.php';
	include'function.php';

	 $link=mysql_connect(HOST,USER,PWD);

	if(mysql_errno())
	{
		exit(mysql_error());

	}

	mysql_set_charset(CHAR);

	mysql_select_db(DB);


	
?>

