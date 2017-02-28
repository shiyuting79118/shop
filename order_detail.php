<?php

	include'header.php';
	if(empty($_SESSION['home']))
    {
        header("location:index.php");
        exit;

    }


	$orderid=$_GET['id'];

	$sql="select `id`,`orderid`,`goods_id`,`address`,`num` from ".PRE."order_info where `orderid`='$orderid'";

	$order_list=query($sql);
	

?>


<div class="main">

	<table class="table table-striped table-hover">
		<!-- <tr align="center"> -->
		<tr class="bziti">
			<td><b>ID</b></td>
			<td><b>订单号</b></td>
			<td><b>商品</b></td>
			<td><b>地址</b></td>
			<td><b>数量</b></td>
			<td><b>收货</b></td>

		
		</tr>
	<?php if(!empty($order_list)):?>
	<?php foreach ($order_list as $val):?>

		<tr align="center">
			<td><?php echo $val['id'] ?></td>
			<td><?php echo $val['orderid']?></td>
			<td><?php echo $val['goods_id']?></td>
			
			<td><?php echo $val['address']?></td>
			
			<td><?php echo $val['num'] ?></td>
			
		</tr>

		
	<?php endforeach;?>
	<?php endif;?>
		
	</table>


</div>


<?php

	include 'footer.php'
?>