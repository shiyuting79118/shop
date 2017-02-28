<?php
	include'common.php';
    

//检测表单的完整性
foreach ($_POST as $key => $val) {
	if($val==''){
		error('请完善表单','',1);
    
	}
}

 	$vcode = strtolower($_POST['vcode']); //检测验证码

 	$verify = strtolower($_SESSION['vcode']);// 将session中存放的验证码赋值给变量并转为小写

 	if($vcode!=$verify)
 	{

 		error('验证码错误','');
 	}

 	$name = htmlspecialchars($_POST['name']);

    $pwd = md5($_POST['pwd']);

    $reg_time = time();//添加注册时间
    
 	$sql = "insert into ".PRE."user (`name`,`pwd`, `reg_time`) values('$name','$pwd','$reg_time')";

    echo $sql;

 	if ( $id = execute($sql)) {
 		//注册的时候，同时让登录
 		//需要把用户名和用户id放到SESSION['home']中去

 		$info['name'] = $_POST['name'];
        $info['id'] = $id; 

         $_SESSION['home'] = $info;

         success('注册成功', 'index.php');
         }else{
        error('注册失败');
    }

?>

<?php 

    if (empty($_SESSION['home']) )
    {

        header("location:index.php");
    }

?>