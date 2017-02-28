<?php
    include 'header.php';
    if(empty($_SESSION['home']))
    {
        header("location:index.php");
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

        <?php $total=0;  
            
        ?>
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
        
		
	</table>
	
    <div class="fright">    
    <?php if(!empty($_SESSION['cart'])):?>
			
		<a href="order.php" class="btn btn-danger">&yen;<?php echo number_format($total,2)?>&nbsp;去结算</a>
    <?php  endif;?>
        <a href="index.php" class="btn btn-primary">继续购物</a>


	</div>

    <div class="fclear"></div>

</div>



<?php include 'footer.php'; ?>