<?php

	include '../common.php';
  

	$a=$_GET['a'];

	switch ($a) 
	{
		case 'add':
		{
            // 判断表单的完整性
            foreach( $_POST as $val )
            {
                if( $val == '' )
                {
                    echo '请完善表单';
                    echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
                    exit;
                }
            }

            $name=trim($_POST['name']);
            $pid=$_POST['pid'];
            $path=$_POST['path'];


           $sql="insert into ".PRE."categroy (`name`,`pid`,`path`) values('$name','$pid','$path')";
           

           if(execute($sql))
           {

           	success('分类添加成功','cate_index.php');        
           }
           else
           {
           	error('分类添加失败');
           }

           break;

		}


    case 'edit':
    {
            // 判断表单的完整性
            foreach( $_POST as $val )
            {
                if( $val == '' )
                {
                    echo '请完善表单';
                    echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
                    exit;
                }
            }

            $name=trim($_POST['name']);
            $pid=$_POST['pid'];
            $path=$_POST['path'];


           $sql="update  ".PRE."categroy set(`name`='$name',`pid`=$pid,`path`='$path')";
           

           if(execute($sql))
           {

            success('修改成功','cate_index.php');        
           }
           else
           {
            error('修改失败');
           }

           break;

    }


	}
?>