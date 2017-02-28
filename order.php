<?php
include'common.php';

    if(empty($_SESSION['home']))
    {
        header("location:index.php");
        exit;

    }
	
	

	if(empty($_SESSION['home'])) 
	{

		$_SESSION['url'] = 'order.php';

		
		echo '请登陆';
		echo '<meta http-equiv="refresh" content="2;url=login.php">';
		exit;
	}

?>

<div class="main">

	<table  class="table table-striped table-hover">

		<tr>

            <th>商品ID</th>
            <th>商品图片</th>
            <th>商品名称</th>
            <th>商品价格</th>
            <th>购买数量</th>
            <th>小计</th>
            <th>操作</th>

        </tr>

        <?php $total=0;?>
            
        <?php if(!empty($_SESSION['cart'])):?>
       	<?php foreach ($_SESSION['cart'] as $key => $val) :?>

        <tr>
            <td><?php echo $key ?></td>

            <td><img src="<?php echo getImgUrl('uploads',$val['iname'],150)?>"/></td>

            <td><?php echo $val['gname']?></td>
            <td><?php echo $val['price']?></td>
            <td>
            	<a  class="btn btn-default btn-sm glyphicon glyphicon-menu-down" href="docart.php?a=minus&gid=<?php echo $key ?>"></a>
                <?php echo $val['qty'] ?>
                 <a  class="btn btn-default btn-sm glyphicon glyphicon-menu-up" href="docart.php?a=plus&gid=<?php echo $key ?>"></a>
            </td>

            <td>
            	<?php echo '&yen;'.number_format($val['qty']*$val['price'],2) ?>
            </td>

            <td>
            	<a href="docart.php?a=del&gid=<?php echo $key ?>">删除</a>
            </td>
        </tr>

         <?php $total += $val['price'] * $val['qty'];?>

    	<?php endforeach;?>
    	<?php endif;?>
        
		
	</table>

	<form class="form-horizontal" action="doorder.php" method="post">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">收货地址:</label>
		    <div class="col-sm-4">
		      <input type="text"  name="address" class="form-control" id="inputEmail3" placeholder="输入地址" required>
		    </div>
		  </div>

		 
		 <br/>
		  <div class="form-group ">
		    <div class="col-sm-offset-4 col-sm-20">
		      <button type="submit" class="btn btn-info">提交订单</button>
		    </div>
		  </div>
	</form>
</div>
 <?php include './footer.php';?>