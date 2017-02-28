<?php

	include'common.php';

	if(empty($_SESSION['home']))
    {
        header("location:index.php");
        exit;

    }

	//判断有没有地址 
	if(empty($_POST['address']))
	{

		echo'请填写地址';
		echo"<meta http-equiv='refresh' content='3;url=order.php'>";
		exit;
	}
	$address=$_POST['address'];

	//准备往订单表中写入一条数据 

	$ordernumber='MZ'.date('Ymd',time()).rand(0,9999);
	$user_id=$_SESSION['home']['id'];
	$addtime=time();


	$sql = "INSERT INTO `".PRE."order`(`ordernumber`,`userid`,`addtime`)values('$ordernumber',$user_id,$addtime)"; 
	$id= execute($sql);


	//遍历购物车，拿到商品的id和数量

	foreach($_SESSION['cart'] as $key => $value)
	{
		$goods_id=$key;
		$num=$value['qty'];

		echo $sql="insert into ".PRE."order_info (`orderid`,`goods_id`,`address`,`num`) values('$id','$goods_id','$address','$num')";

		execute($sql);
	}


	unset($_SESSION['cart']);

     /* 个人中心里面的我的订单页面 */
    header("Location:personal.php");



?>