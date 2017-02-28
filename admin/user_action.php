<?php
	include'../common.php';

	$a=$_GET['a'];
	switch ($a) {
		

		case 'disabled_user':
		//禁谁id

		$id=$_GET['id'];

		$sql="update ".PRE."user set `disabled`='1' where `id`='$id'";

		if(execute($sql))
		{
			echo '禁用成功';
            echo '<meta http-equiv="refresh" content="3; url=user_index.php"/>';

		}else{

			 echo '禁用失败';
             echo '<meta http-equiv="refresh" content="3; url=user_index.php"/>';
		}

		break;

		case 'undisabled_user':
		//放行id

		$id=$_GET['id'];

		$sql="update ".PRE."user set `disabled`='0' where `id`='$id'";

		if(execute($sql))
		{
			echo '放行成功';
            echo '<meta http-equiv="refresh" content="2; url=user_index.php"/>';

		}else{

			 echo '放行失败';
             echo '<meta http-equiv="refresh" content="2; url=user_index.php"/>';
		}

		break;


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
            $mail=$_POST['mail'];
            $pwd=md5($_POST['pwd']);
            $repwd=md5($_POST['repwd']);
            $sex=$_POST['sex'];
            $user_type=$_POST['user_type'];

            if( $pwd!=$repwd ){

            	echo '两次密码不一样';
              echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
              exit;

            }else{

           		$sql="insert into ".PRE."user (`name`,`pwd`,`mail`,`sex`,`user_type`) values('$name','$pwd','$mail','$sex','$user_type')";

           	}

           	if(execute($sql))
           	{
           		  echo '添加用户成功';
                echo '<meta http-equiv="refresh" content="2;url=user_index.php" />';
                exit;
           	}else{

           		error('用户添加失败');
           	}
           

          
           break;
       }



       case 'edit':
       {
        

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
            $id = $_POST['id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $pwd= md5($_POST['pwd']);
            $phone= $_POST['phone'];
            $mail= $_POST['mail'];
            $addr= $_POST['addr'];
            
            

           $sql=" update ".PRE."user set `name`='$name',`sex`='$sex',`phone`='$phone',`mail`='$mail',`addr`='$addr', `pwd`='$pwd' where `id`='$id' ";

            if( $id = execute( $sql ) ){
                
                echo '修改成功';
                echo '<meta http-equiv="refresh" content="2;url=index.php" />';

            }else{
                echo '修改失败';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
            }


            break;
        }

         case 'del':
 
            // 接收id
            $id = $_GET['id'];

            $sql = "delete from ".PRE."user where `id`='$id'";

            if( execute($sql) ){
                echo '删除成功！';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
            }else{
                echo '删除失败！';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
            }
            break;
    }



	
?>