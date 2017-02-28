<?php
    include 'common.php';

    // 接收用户动作
    $a = $_GET['a'];

    switch( $a ){
        case 'add':
            echo "<pre>";
                print_r($_POST);
            echo "</pre>";

            // 判断表单的完整性
            foreach( $_POST as $val ){
                if( $val == '' ){
                    echo '请完善表单';
                    echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
                    exit;
                }
            }

            // 接收数据
            $name       = $_POST['name'];
            $sex        = $_POST['sex'];
            $age        = $_POST['age'];
            $province   = $_POST['province'];

            // 准备SQL
            $sql = "insert into `user` values(null, '$name','$sex','$age','$province')";

            if( $id = execute( $sql ) ){
                
                echo '添加成功,新用户id为:'.$id;
                echo '<meta http-equiv="refresh" content="2;url=index.php" />';

            }else{
                echo '添加失败';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
            }
            
            break;

        case 'edit':
            echo "<pre>";
                print_r($_POST);
            echo "</pre>";

            // 同样需要判断表单的完整性
             foreach( $_POST as $val ){
                if( $val == '' ){
                    echo '请完善表单';
                    echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
                    exit;
                }
            }

            // 接收用户数据
            // 接收数据
            $id         = $_POST['id'];
            $name       = $_POST['name'];
            $sex        = $_POST['sex'];
            $age        = $_POST['age'];
            $province   = $_POST['province'];
            
            $sql = "update `user` set `name`='$name', `sex`='$sex', `age`='$age', `province`='$province' where `id`='$id'";

            if( $id = execute( $sql ) ){
                
                echo '修改成功';
                echo '<meta http-equiv="refresh" content="2;url=index.php" />';

            }else{
                echo '修改失败';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
            }


            break;

        case 'del':
            echo "<pre>";
                print_r($_GET);
            echo "</pre>";

            // 接收id
            $id = $_GET['id'];

            $sql = "delete from user where `id`='$id'";

            if( execute($sql) ){
                echo '删除成功！';
                echo '<meta http-equiv="refresh" content="2;url=index.php" />';
            }else{
                echo '删除失败！';
                echo '<meta http-equiv="refresh" content="2;url=index.php" />';
            }
            break;
    }

