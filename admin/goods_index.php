<?php  
	include'header.php';

	 $sql="select `id`,`name`,`cate_id`,`price`,`store`,`add_time`, `status` ,`is_hot`,`is_best`,`is_new`,`describe` from ".PRE."goods";

	$goods_list=query($sql);

	  // 判断用户是在本点击超链接查看子类？ $pid = $_GET['pid']    还是第一次来访问分类首页？  pid=0
	$pid=empty($_GET['pid'])?0:$_GET['pid'];


	$sql="select `id`,`name`,`pid`,`path` from ".PRE."goods where `pid`='$pid'";

	$goods_list=query($sql);

	//接收页码
    // 如果有页码传递过来，就是你传递的页码，如果没有，默认第1夜
    $page = empty($_GET['page'])?1:(int)$_GET['page'];

    // 确定每页显示数
    $num = 15;

    
    // 得到表中的总记录数
    // count(*) 计算全表的记录数  count(id) 不为null的数据条数
    $sql = "select count(*) as total from ".PRE."goods";       
    $goods_list = mysql_query($sql);
    $rows = mysql_fetch_assoc($goods_list);
    $total = $rows['total'];                // 总记录数
   

    // 总面数 = 总记录数 / 每页显示数
    $amount = ceil( $total / $num );
    $amount;

    // 限制页码范围
    if( $page>$amount ){        // 不能超出最大页数,如果超出，就让你变成最大页
        $page = $amount;
    }

    if( $page < 1 ){
        $page = 1;
    }

    $page;
    // 叫做偏移量
    // 偏移量 = (当前页码-1) x 每页显示数
    $offset = ($page - 1) * $num;
 

    // 上一页 下一页
    $prev = $page-1;    // 上一页
    $next = $page+1;    // 下一页


     $sql = "select `id`,`name`,`cate_id`,`price`,`store`,`add_time`, `status` ,`is_hot`,`is_best`,`is_new`,`describe` from ".PRE."goods limit $offset,$num";

    $goods_list = query($sql);

   
    // 处理一下url
    $current_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];

    // 循环产生数字链接
    $num_links = '';        // 声明空字符串

    $start = $page-3<1?1:$page-3;
    $end = $page+3>$amount?$amount:$page+3;

    if( $start>1 ){
        $num_links .= '...';
    }

    for( $i=$start; $i<=$end; $i++  ){
        // 判断是不是当前页，如果是的话，让当前页的数字链接变成红色
        if( $page == $i ){
            $num_links .= '<a class="current_page" href="'. $current_url .'?page='.$i.'">['.$i.']</a>';
            continue;
        }
        $num_links .= '<a href="'.$current_url.'?page='.$i.'">['.$i.']</a>';
    }
    
    if( $end < $amount ){
        $num_links .= '...';
    }

    // 产生链接的字符串
    $links = <<<aaa
            共{$amount}页, 第{$page}页,
            <a href="{$current_url}?page=1">首页</a>
            <a href="{$current_url}?page={$prev}">上一页</a>
            $num_links
            <a href="{$current_url}?page={$next}">下一页</a>
            <a href="{$current_url}?page={$amount}">尾页</a>
aaa;

?>

<div class="content">
	<div class="talign">
		<h3>商品列表</h3>
		<table  class="table table-striped table-hover ">
		    <tr align="center">
		        <td>id</td>
		        <td>商品</td>
		        <td>分类</td>
		        <td>价格</td>
		        <td>图片</td>
		        <td>库存</td>
		        <td>上架时间</td>
		        <td>上架</td>
				<td>热销</td>
		        <td>精品</td>
		        <td>新品</td>
		        <td>操作</td>
		    </tr>

		    <?php if(!empty($goods_list)):?>
		    <?php foreach($goods_list as $val):?>

		    <?php
		    	$cate_id=$val['cate_id'];
		    	$sql = "select `name` from ".PRE."categroy where `id`='$cate_id'";
		    	$cate_name=query($sql);
		    	$cate_name=$cate_name[0]['name'];


		    	$goods_id=$val['id'];
		    	$sql = "select `name` from ".PRE."img where `goods_id`='$goods_id' and `is_face`='1'";
		    	$img_name=query($sql);
		    	$img_name=$img_name[0]['name'];
		    	$url=getImgUrl('uploads',$img_name,50);
		    ?>


		    <tr align="center">
		       	<td><?php echo $val['id']  ?></td>
		        <td><?php echo $val['name']  ?></td>
		        <td><?php echo $cate_name  ?></td> 
		        <td><?php echo $val['price']  ?></td>
		        <td><img src="<?php echo $url ?>"/></td>
		        <td><?php echo $val['store']  ?></td>
		        <td><?php echo date('y/m/d',$val['add_time'])  ?></td>

		         <td>
		         	<a href="goods_action.php?a=up&gid=<?php echo $val['id']?>&bian=status&status=<?php echo $val['status']?>">
		        		<?php echo $val['status']? '<span class="glyphicon glyphicon-ok"></span>':'<sapn class="glyphicon glyphicon-remove" ></span>';?>
		        	</a>
		        </td>

		        

		         <td>
		         	<a href="goods_action.php?a=up&gid=<?php echo $val['id']?>&bian=is_hot&is_hot=<?php echo $val['is_hot']?>">
		        		<?php echo $val['is_hot']? '<span class="glyphicon glyphicon-ok"></span>':'<sapn class="glyphicon glyphicon-remove" ></span>';?>
		        	</a>
		        </td>
 

		        <td>
		        	<a href="goods_action.php?a=up&gid=<?php echo $val['id']?>&bian=is_best&is_best=<?php echo $val['is_best']?>">
		        		<?php echo $val['is_best']? '<span class="glyphicon glyphicon-ok"></span>':'<sapn class="glyphicon glyphicon-remove" ></span>';?>
		        	</a>
		        </td>


		         <td>
		         	<a href="goods_action.php?a=up&gid=<?php echo $val['id']?>&bian=is_new&is_new=<?php echo $val['is_new']?>">
		        		<?php echo $val['is_new']? '<span class="glyphicon glyphicon-ok"></span>':'<sapn class="glyphicon glyphicon-remove" ></span>';?>
		        	</a>
		        </td>


		        <td>
						<a title="编辑" href="goods_edit.php?a=edit&img_id=<?php echo $val['id']?>&gid=<?php echo $val['id']?>" >编辑</a>
						&nbsp;
			        	<a onclick="return confirm('删除？')"title="删除" href="goods_action.php?a=del&gid=<?php echo $val['id'] ?>">删除</a>
			        	&nbsp;
			        	<a href="goods_img.php?gid=<?php echo $val['id']?>">图片管理</a>
			        	
		        </td>
		    </tr>
			<?php endforeach;?>
			<?php endif;?>
	    </table>
	    <div class="fenye">
	 		<?php echo $links; ?>
	 	</div>
	</div>
	<?php mysql_close() ?>
</div>

<?php include 'footer.php' ?>