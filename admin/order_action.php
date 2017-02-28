<?php
	include'../common.php';


	$a=$_GET['a'];

	switch ($a) {
		
		case 'is_shou':
		$id=$_GET['id'];

		 	$is_shou=$_GET['is_shou']?0:1;

		    $sql="update ".PRE."order set `is_shou`='$is_shou' where `id`='$id'";

			execute($sql);

			header("location:".$_SERVER['HTTP_REFERER']);

			break;

		case 'is_que':
		
			$id=$_GET['id'];

			
			$sql="update ".PRE."order set `is_shou`='3' where `id`='$id'";

			execute($sql);
			
			header("location:".$_SERVER['HTTP_REFERER']);
			break;

		/*case 'weishou':
			$sql="update ".PRE."order set `is_shou`='3' where `id`='$id'";

			execute($sql);
			
			header("location:".$_SERVER['HTTP_REFERER']);
			break;*/
		
		
	}