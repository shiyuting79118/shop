<?php 
	include'header.php';

  
	//接收页码
    // 如果有页码传递过来，就是你传递的页码，如果没有，默认第1夜
    $page = empty($_GET['page'])?1:(int)$_GET['page'];

    // 确定每页显示数
    $num = 13;

    
    // 得到表中的总记录数
    // count(*) 计算全表的记录数  count(id) 不为null的数据条数
    $sql = "select count(*) as total from ".PRE."comment";       
    $comment_list = mysql_query($sql);
    $rows = mysql_fetch_assoc($comment_list);
    $total = $rows['total'];   
   

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


     $sql = "select `id`,`comment`,`ordernum`,`is_ping` from ".PRE."comment limit $offset,$num";

    $comment_list = query($sql);

   
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
		<h3>评论列表</h3>
		<table  class="table table-striped table-hover ">
		    <tr align="center">
		        <td>id</td>
		        <td>评论</td>
		        <td>订单号</td>
                <td>是否好评</td>
		        <td>操作</td>

		    </tr>

		    <?php if(!empty($comment_list)):?>
		    <?php foreach($comment_list as $val):?>

		    <tr align="center">
		       	<td><?php echo $val['id']  ?></td>
		        <td><?php echo $val['comment']  ?></td>
		        <td><?php echo $val['ordernum']  ?></td>
		        <td>
		        	<?php

		        		switch ($val['is_ping']) {
		        			case '2':
		        				echo '好评';
		        			break;
		        			
		        			case '1':
		        				echo '中评';
		        			break;

		        			case '0':
		        				echo '差评';
		        			break;
		        		}
		        	?>
		        </td>
		        <td>
		        	<a>删除</a>
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