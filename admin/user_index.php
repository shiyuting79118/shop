<?php 
	include'header.php';

	$sql="select `id`,`name`,`sex`,`mail`,`reg_time`,`disabled`, `user_type` from ".PRE."user";

	$user_list=query($sql);

	//接收页码
    // 如果有页码传递过来，就是你传递的页码，如果没有，默认第1夜
    $page = empty($_GET['page'])?1:(int)$_GET['page'];

    // 确定每页显示数
    $num = 15;

    
    // 得到表中的总记录数
    // count(*) 计算全表的记录数  count(id) 不为null的数据条数
    $sql = "select count(*) as total from ".PRE."user";       
    $user_list = mysql_query($sql);
    $rows = mysql_fetch_assoc($user_list);
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


     $sql = "select `id`,`name`,`sex`,`mail`,`reg_time`,`disabled`, `user_type` from ".PRE."user limit $offset,$num";

    $user_list = query($sql);

   
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
		<h3>用户列表</h3>
		<table  class="table table-striped table-hover ">
		    <tr align="center">
		        <th>id</th>
		        <th>姓名</th>
		        <th>性别</th>
		        <th>邮箱</th>
		        <th>注册时间</th>
		        <th>用户类型</th>
		        <th>禁用类型</th>
		        <th>操作</th>
		    </tr>

		    <?php if(!empty($user_list)):?>
		    <?php foreach($user_list as $val):?>

		    <tr>
		       	<td><?php echo $val['id']  ?></td>
		        <td><?php echo $val['name']  ?></td>
		        <td><?php echo $val['sex']?'男':'女'; ?></td>
		        <td><?php echo empty($val['mail'])?'-':$val['mail']; ?></td>
		        <td><?php echo date('Y-m-d H:i:s', $val['reg_time']) ?></td>
		        <td><?php echo $val['user_type'] ?'<sapn style="color:red";>管理员</span>':'普通会员'; ?></td>
		        <td><?php echo $val['disabled']?'禁用':'放行'; ?></td>
		        <td>

		        	<?php if( $val['user_type'] == 1 ):?><!-- 管理员显示这里的操作代码  -->
			        	<a onclick="return false" title="编辑" ><span class="glyphicon glyphicon-pencil"></span></a>
			        	<a onclick="return false" title="删除" ><span class="glyphicon glyphicon-trash"></span></a>
			        	<a onclick="return false" title="禁用" ><span class="glyphicon glyphicon-ban-circle"></span></a>
			        	<a onclick="return false" title="放行" href="./user_action.php?a=undisabled_user&id=<?php echo $val['id'] ?>"><span class="glyphicon glyphicon-ok-circle"></span></a>


			        <?php else:?>
						<a title="编辑" href="./user_edit.php?id=<?php echo $val['id'] ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
			        	<a title="删除" onclick="return confirm('确定删除&nbsp;&nbsp;<?php echo $val['name'] ?>？')"href="./user_action.php?a=del&id=<?php echo $val['id'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
			        	<a title="禁用" href="./user_action.php?a=disabled_user&id=<?php echo $val['id'] ?>"><span class="glyphicon glyphicon-ban-circle"></span></a>

			        	<a title="放行" href="./user_action.php?a=undisabled_user&id=<?php echo $val['id'] ?>"><span class="glyphicon glyphicon-ok-circle"></span></a>




		        	<?php endif;?>

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