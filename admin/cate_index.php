<?php 
	include'header.php';

    


	 // 判断用户是在本点击超链接查看子类？ $pid = $_GET['pid']    还是第一次来访问分类首页？  pid=0
	$pid=empty($_GET['pid'])?0:$_GET['pid'];


	$sql="select `id`,`name`,`pid`,`path` from ".PRE."categroy where `pid`='$pid'";

	$cate_list=query($sql);

	//接收页码
    // 如果有页码传递过来，就是你传递的页码，如果没有，默认第1页
    $page = empty($_GET['page'])?1:(int)$_GET['page'];

    // 确定每页显示数
    $num = 15;

    
    // 得到表中的总记录数
    // count(*) 计算全表的记录数  count(id) 不为null的数据条数
    $sql = "select count(*) as total from ".PRE."categroy";       
    $cate_list = mysql_query($sql);
    $rows = mysql_fetch_assoc($cate_list);
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


     $sql = "select `id`,`name`,`pid`,`path` from ".PRE."categroy where `pid`='$pid' limit $offset,$num";

    $cate_list = query($sql);

   
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
		<h3>分类列表</h3>
		<table  class="table table-striped table-hover ">
		    <tr align="center">
		        <td>id</td>
		        <td>name</td>
		        <td>pid</td>
		        <td>path</td>
		        <td>操作</td>
		    </tr>

		    <?php if(!empty($cate_list)):?>
		    <?php foreach($cate_list as $val):?>

		    <tr align="center">
		       	<td><?php echo $val['id']  ?></td>
		        <td><?php echo $val['name']  ?></td>

		        <td>
		        <?php 
		        $sql="select `name` from ".PRE."category where id='$val[pid]'"; /*查看id的父类的名字*/
		        $cate_name=query($sql);
		        $cate_name=$cate_name[0]['name'];

		        echo !empty($cate_name)?$cate_name:'-';/*如果父类名字不为空就显示父类名称，如果为空就显示-  表示自己为父类*/
		        ?>
		        </td>

		         <td><?php echo $val['path'] ?></td>

		        <td>
		        		<a href="cate_add.php?path=<?php echo $val['path']?>&pid=<?php echo $val['id']?>">添加分类</a>
		        		&nbsp;
		        		<a href="cate_index.php?pid=<?php echo $val['id']?>">查看</a>
		        		&nbsp;
						<a href="cate_edit.php?pid=<?php echo $val['id']?>" title="编辑" >编辑</a>
						&nbsp;
			        	<a title="删除" >删除</a>
			        	&nbsp;
			        	
		        </td>
		    </tr>
			<?php endforeach;?>
			<?php endif;?>
	    </table>

	<div class="fenye">
	 <?php echo $links; ?>
	</div>
	</div>
</div>

<?php include 'footer.php' ?>