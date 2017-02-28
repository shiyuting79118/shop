<?php
    include 'common.php';

    // 编辑谁  id
    $id = $_GET['id'];

    // 写SQL将用户信息查询出来
    $sql = "select `name`,`sex`,`age`,`province` from `user` where `id`='$id'";

    $user_info = query($sql);
    // 去掉0下标
    $user_info = $user_info[0];

    echo "<pre>";
        print_r($user_info);
    echo "</pre>";
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

        <div style="width:600px; margin:30px auto">

            <form action="action.php?a=edit" method="post" >

                <!-- 使用隐藏域，把id传递到action.php的 edit这个case中 -->
                <input type="hidden" name="id" value="<?php echo $id ?>" />

                name:
                <input type="text" name="name" value="<?php echo $user_info['name'] ?>" /><br/><br/>

                sex:
                <input type="radio" name="sex" value="1" <?php echo $user_info['sex']?'checked':''; ?> />男
                <input type="radio" name="sex" value="0" <?php echo $user_info['sex']?'':'checked'; ?>/>女<br/><br/>

                age:
                <input type="text" name="age" value="<?php echo $user_info['age'] ?>" /><br/><br/>

                province:
                <select name="province">
                    <option value="">请选择...</option>
                    <option value="上海" <?php echo $user_info['province'] == '上海'?'selected':''; ?>>上海</option>
                    <option value="江苏" <?php echo $user_info['province'] == '江苏'?'selected':''; ?>>江苏</option>
                    <option value="安徽" <?php echo $user_info['province'] == '安徽'?'selected':''; ?>>安徽</option>
                    <option value="江西" <?php echo $user_info['province'] == '江西'?'selected':''; ?>>江西</option>
                    <option value="浙江" <?php echo $user_info['province'] == '浙江'?'selected':''; ?>>浙江</option>
                    <option value="四川" <?php echo $user_info['province'] == '四川'?'selected':''; ?>>四川</option>
                    <option value="贵州" <?php echo $user_info['province'] == '贵州'?'selected':''; ?>>贵州</option>
                    <option value="山西" <?php echo $user_info['province'] == '山西'?'selected':''; ?>>山西</option>
                    <option value="山东" <?php echo $user_info['province'] == '山东'?'selected':''; ?>>山东</option>
                    <option value="河南" <?php echo $user_info['province'] == '河南'?'selected':''; ?>>河南</option>
                    <option value="福建" <?php echo $user_info['province'] == '福建'?'selected':''; ?>>福建</option>
                </select><br/><br/>
                
                <input type="submit" value="保存" />
            </form>

        </div>
</html>
