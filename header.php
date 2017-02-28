<?php include './common.php';

	//查询出所有的一级类别，显示在导航上
	$sql=" select `id`,`name` from ".PRE."categroy where `pid`='0' ";
	
	$cate_list=query($sql);

	if(!empty($_SESSION['url'])){

		unset($_SESSION['url']);
		exit;
	}
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="textt/html;charset=utf-8">
	<title>首页</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">

	<!-- jQuery文件。务必在bootstrap.min.js 之前引入-->
	<script src="./js/jquery.js"></script>
	<!-- <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script> -->

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="./bootstrap/js/bootstrap.min.js"></script>

	<!-- 导入自己的css文件-->

	 <link rel="stylesheet" href="./css/index.css" />

</head>
<body>
<div class="header">
	<div class="welcom">
		<?php if(empty($_SESSION['home']) ):?>
			<ul class="short_cut ">
				<li class="pull-left">hi,请<a href="login.php">【登录】</a></li>
				<li class="pull-left"><a href="reg.php">【免费注册】</a></li>
				
				
			</ul>
		<?php else:?>

			 欢迎<span class="showname"><b><?php echo $_SESSION['home']['name'] ?> </b>用户登录此页面</span>

			 	<sapn class="mycart">

			 	<a href="personal.php">
			 	<button class="btn btn-default btn-sm glyphicon glyphicon-apple " type="button">
 					我的订单</button>
 				</a>
 				
				<button class="btn btn-default btn-sm glyphicon glyphicon-star " type="button">
 					<a >我的收藏夹</a>
				</button>

				<a href="show_cart.php">
				<button class="btn btn-default btn-sm glyphicon glyphicon-shopping-cart" type="button">
					<?php 
						$qty = 0;
						if(!empty($_SESSION['cart'])){
							foreach($_SESSION['cart'] as $val){
								$qty += $val['qty'];
							}
						}
						
					?>

 					我的购物车<span class="badge"><?php echo $qty; ?></span>
				</button></a>
				</sapn>
			
				
			 <a href="logout.php"><span class="pull-right" >[退出]</span></a>
		<?php endif;?>
	</div>

	<div class="navlist">
		<ul class="nav nav-tabs">
	  		<li role="presentation" class="active"><a href="index.php"><img src="./images/logo.png"></a></li>

			  	<?php if(!empty($cate_list)): ?>
			  	<?php foreach($cate_list as $val):?>

	  		<li role="presentation"><a href="goods_list.php?gid=<?php echo $val['id'] ?>"><?php echo $val['name'] ;?></a></li>

	  		<!-- 	<li role="presentation"><a href="#">ipad</a></li>
	  		<li role="presentation"><a href="#">iphone</a></li> -->
			  	<?php endforeach;?>
			  	<?php endif;?>
		</ul>
	</div>
	</div>


