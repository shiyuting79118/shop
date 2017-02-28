  
  <?php
	include'common.php';
    if(empty($_SESSION['home']))
    {
        header("location:index.php");
        exit;

    }
    

	$a=$_GET['a'];
	switch ($a)
	{
		case 'del':

          
            // 接收id
            $id = $_GET['id'];
           /* $sql="select `is_shou` from "PRE"order where `id`='$id'";
            $result=query($sql);
            if($result==3)
        	{*/

            $sql = "delete from ".PRE."order where `id`='$id'";

            if( execute($sql) ){
                echo '删除成功！';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
            }else{
                echo '删除失败！';
                echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
            }
            break;
        /*}*/
    }