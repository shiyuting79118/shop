<?php 
	include '../common.php';

	if(empty($_SESSION['admin']))
	{
		header('location:login.php');
	}
?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<title>管理系统</title>
		<link rel="stylesheet" href="../css/admin.css"/>

		 <!-- 引入bootstrap文件 -->

        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <script src="../js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>


		<div class="h_content top">

			<div class="welcome">
			欢迎<?php echo $_SESSION['admin']['name']?>进入后台管理系统
			 <a onclick="return confirm('退出？')" href="logout.php" class="pull-right">【退出】</a>
			</div>

			<div class="navlist">
				<ul class="nav nav-tabs">
			  		<li role="presentation" class="active"><a href="index.php"><img src="../images/logo.png">&nbsp;APPLE MANAGE</a>
			  		</li>
			  		<li role="presentation"><a href="user_index.php">用户管理</a></li>
			  		<li role="presentation"><a href="cate_index.php">分类管理</a></li>
			  		<li role="presentation"><a href="goods_index.php">商品管理</a></li>
			  		<li role="presentation"><a href="order_index.php">订单管理</a></li>
			  		<li role="presentation"><a href="comment_index.php">评论管理</a></li>
			  		<!-- <li >
			  			<div class="search">
			            <form  action="<?php $current_url ?>" method="get">
			            	<div class="fleft ">
				                <input type="text" name="name" class="form-control input-sm"/>
				            </div>
				            <div class="fleft">
			                	<input type="submit" value="搜索" class="btn btn-default btn-sm"/>
			           		</div>
			            </form>

			            </div>
			        </li> -->  <!-- 搜索框，目前没有搜索功能  -->
      
				</ul>
			</div>
		</div>

		<div class="bottom ">
			<div class="menu">
				<div class="userman">
					<div class="list-group">
					  <a href="user_index.php" class="list-group-item active">
					    用户管理
					  </a>
					  <a href="user_index.php" class="list-group-item">用户列表</a>
					  <a href="user_add.php" class="list-group-item">添加用户</a> 
					</div>
				
					<div class="list-group">
					  <a href="cate_index.php" class="list-group-item active">
					    分类管理
					  </a>
					  <a href="cate_index.php" class="list-group-item">分类列表</a>
					  <a href="cate_add.php" class="list-group-item">添加一级分类</a> 
					</div>

			
					<div class="list-group">
					  <a href="goods_index.php" class="list-group-item active">
					    商品管理
					  </a>
					  <a href="goods_index.php" class="list-group-item">商品列表</a>
					  <a href="goods_add.php" class="list-group-item">添加商品</a> 
					</div>

					<div class="list-group">
					  <a href="order_index.php" class="list-group-item active">
					    订单管理
					  </a>
					  <a href="order_index.php" class="list-group-item">订单列表</a>
					</div>
					<div class="list-group">
					  <a href="comment_index.php" class="list-group-item active">
					    评论管理
					  </a>
					  <a href="comment_index.php" class="list-group-item">评论列表</a>
					</div>
				</div>
			</div>

