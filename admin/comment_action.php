<?php 
	include'../common.php';
    
    $id=$_GET['id'];

	$a=$_GET['a'];

    $comment=$_POST['comment'];

	switch ($a) 
	{
        case 'ping':


            if($comment==''){
                echo'请填写评论';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
                exit;
            }

            $ordernumber=$_GET['ordernumber'];

            $is_ping=$_POST['ping'];

            $comment=$_POST['comment'];

            $sql="insert into ".PRE."comment (`comment`,`ordernum`,`is_ping`) values('$comment','$ordernumber','$is_ping')";

            echo $ordernumber=$_GET['ordernumber'];

            if( execute($sql) ){
                echo '评论成功！';
                echo '<meta http-equiv="refresh" content="2;url=../comment.php?ordernumber='.$ordernumber.'" />';
            }else{
                echo '评论失败！';
                echo '<meta http-equiv="refresh" content="2;url=../comment.php?ordernumber='.$ordernumber.'" />';
            }
            break;
    }