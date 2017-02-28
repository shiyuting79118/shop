<?php
	include'header.php';


	$id=$_SESSION['admin']['id'];

	$sql="select `id`,`ordernumber`,`userid`,`is_shou`,`if_fu`,`addtime` from ".PRE."order " ;

	/*$p_list=query($sql);

	foreach ($p_list as $key => $val) {
		$p_list[$key]['userid']=$_SESSION['admin']['name'];//遍历数组改名字
	}*/

	


	//接收页码
    // 如果有页码传递过来，就是你传递的页码，如果没有，默认第1夜
    $page = empty($_GET['page'])?1:(int)$_GET['page'];

    // 确定每页显示数
    $num = 10;

    
    // 得到表中的总记录数
    // count(*) 计算全表的记录数  count(id) 不为null的数据条数
    $sql = "select count(*) as total from ".PRE."order";       
    $p_list = mysql_query($sql);
    $rows = mysql_fetch_assoc($p_list);
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


     $sql = "select `id`,`ordernumber`,`userid`,`is_shou`,`if_fu`,`addtime` from ".PRE."order limit $offset,$num";

    $p_list = query($sql);


   
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

	/*echo'<pre>';


	print_r($_SESSION);

	echo '</pre>';*/

	

?>


<div class="content">
	<div class="talign">
		<h3>订单列表</h3>
	<table class="table table-striped table-hover">
		<!-- <tr align="center"> -->
		<tr class="bziti">
			<td><b>ID</b></td>
			<td><b>订单号</b></td>
			<td><b>用户名</b></td>
			<td><b>状态</b></td>
			<td><b>付款</b></td>
			<td><b>添加时间</b></td>
			<td><b>订单详情</b></td>
		</tr>
	<?php if(!empty($p_list)):?>
	<?php foreach($p_list as $val):?>

		<tr align="center">
			<td><?php echo $val['id'] ?></td>
			<td><?php echo $val['ordernumber']?></td>
			<td>
			<?php 
				$uid = $val['userid'];
				$username = query("select name from ".PRE."user where `id`='$uid'");
				echo $username[0]['name'];
			?>  <!-- 得到用id 去用户表里查名字 -->
			</td>
			<td>
			<!-- <div class="dropdown">
				  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				    未发货
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				    <li><a href="order_action.php?a=fa&id=<?php echo $val['id']?>">已发货</a></li>
				    <li><a href="order_action.php?a=shou&id=<?php echo $val['id']?>">已收货</a></li>
				    <li><a href="order_action.php?a=weishou&id=<?php echo $val['id']?>">未收货</a></li>
				  </ul>
			</div> -->

				<!-- <form> -->
			<!-- 	<select class="form-control" >
					  <option><a href="order_action.php?a=fa&id=<?php echo $val['id']?>">未发货</a></option>
					  <option><a href="order_action.php?a=fa&id=<?php echo $val['id']?>">已发货</a></option>
					  <option><a href="order_action.php?a=shou&id=<?php echo $val['id']?>">已收货</a></option>
					  <option><a href="order_action.php?a=weishou&id=<?php echo $val['id']?>">未收货</a></option>
				</select> -->
			<!-- 	</form> -->


					<a href="order_action.php?a=is_shou&id=<?php echo $val['id']?>&is_shou=<?php echo $val['is_shou']?>">
					    <?php
							switch ($val['is_shou']) {
								case '0':
									echo '未发货';
									break;
								
								case '1':
									echo '已发货';
									break;

								case '2':
									echo '未收货';
									break;


								case '3':
									echo '已收货';
									break;
								}

						?>
		        	</a>

			</td>
			<td><?php echo $val['if_fu']? '已付款':'未付款';?></td>
			<td><?php echo date('Y-m-d',$val['addtime'])?></td>
			
	
			<td><a href="order_detail.php?id=<?php echo $val['id']?>">详情</a></td>
		</tr>

		
	<?php endforeach;?>
	<?php endif;?>	
	</table>
	<div class="fenye">
	 <?php echo $links; ?>
	 </div>
	</div>
</div>


 <?php mysql_close() ?>

 <?php include './footer.php';?>