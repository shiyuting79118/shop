<?php
    // 包含公共文件后，就连接好了数据库，包含了函数库，设置好了字符集，设置好了时区
    include 'common.php';  

    // 分页条件形成中...

    // 接收搜索的用户名
    if( !empty( $_GET['name'] ) ){
        $name = $_GET['name'];              // 接收搜索的用户名
        $con[] = "name like '%$name%'";     // 拼接成sql中的where条件的表达式
        $url[] = "name=$name";              // 拼接成url中的参数字符串
    }

    // 接收搜索条件：性别
    if( $_GET['sex'] != '' ){
        $sex = $_GET['sex'];
        $con[] = "`sex`='$sex'";
        $url[] = "sex=$sex";
    }


    // 处理一下where条件和url传递的参数
    if( count( $con ) > 0 ){                // 元素个数大于零，说明用户搜索了
        $where = 'where '.implode(' and ', $con);
        $url = '&'. implode('&', $url);
    }else{
        $where = '';      
        $url = '';
    }

    // 1.接收页码
    $page = empty($_GET['page'])?1:(int)$_GET['page'];

    // 2.确定每页显示数
    $num = 10;

    // 3.获取总数 
    $sql = "select count(*) as total from user $where";
    $list = query($sql);
    $total = $list[0]['total'];

    // 4.计算总页数
    $amount = ceil($total/$num);

    // 限制页码范围
    $page = max($page,1);
    $page = min($page,$amount);

    // 5.计算偏移量
    $offset = ($page-1)*$num;


    $sql = "select `id`,`name`,`sex`,`age`,`province` from user $where order by `id` desc limit $offset,$num";

    $user_list = query($sql);


    // 产生数字链接
    $num_links = '';

    for( $i=1; $i<=$amount; $i++ ){
        if( $page == $i ){
            $num_links .= '<a style="color:red" href="index.php?page='.$i.$url.'">['.$i.']</a>';
        }else{
            $num_links .= '<a href="index.php?page='.$i.$url.'">['.$i.']</a>';
        }
    }

    // 链接字符串
    $links = <<<aaa
    $num_links

    <form style="display:inline-block">
        <input type="text" name="page"  style="width:30px;text-align:center;" />
        <input type="submit" value="Go!"  />
    </form>
aaa;

?>
<!DOCTYPE html>
<html>
     <head>
         <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>index</title>
    </head>
    <body>
        <h3>用户管理</h3>
        <ul>
            <li><a href="index.php">用户首页</a></li>
            <li><a href="add.php">添加用户</a></li>
        </ul>


        <form style="width:800px; margin:10px auto">

            用户名:
            <input type="text" name="name" /><br/>

            性别:
            <input type="radio" name="sex" value="1" />男
            <input type="radio" name="sex" value="0" />女<br/>

            <input type="submit" value="Search" />
        </form>

        <table border="1" align="center" width="800">
            <tr>
                <td>id</td>
                <td>name</td>
                <td>sex</td>
                <td>age</td>
                <td>province</td>
                <td>操作</td>
            </tr>

            <?php if(!empty($user_list)): ?>
            <?php foreach($user_list as $val): ?>
            <tr>
                <td><?php echo $val['id'] ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['sex']?'男':'女'; ?></td>
                <td><?php echo $val['age'] ?></td>
                <td><?php echo $val['province'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $val['id'] ?>">编辑</a>
                    <a href="action.php?a=del&id=<?php echo $val['id']  ?>" onclick="return confirm('确定删除&nbsp;&nbsp;<?php echo $val['name'] ?>？')">删除</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>

        </table>
        <div style="width:800px;margin:10px auto;">
            <?php echo $links; ?>
        </div>
    </body>
    <?php mysql_close(); ?>
</html>
