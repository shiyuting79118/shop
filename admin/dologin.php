<?php
	include '../common.php';
    
	$name=$_POST['name'];
	$pwd=md5($_POST['pwd']);

	$sql="select `id`,`name`,`user_type` from ".PRE."user where `name`='$name' and `pwd`='$pwd'";

	$user=query($sql);

	$user=$user[0];


	echo "<pre>";
        print_r($user);
    echo "</pre>";

    if(empty($user['user_type'])||$user['user_type']!=1){

    	 error('权限不足,不能进入后台');
    }

    if(!empty($user))
    {

    	$_SESSION['admin']=$user;

     success('登录成功', 'index.php');
    }else{
        error('登录失败');
    }

?>