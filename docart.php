<?php
	
	include'common.php';

	$a=$_GET['a'];

	//接收商品id

	$gid=$_GET['gid'];
	
    

	switch ($a) {
		case 'del':
			unset($_SESSION['cart'][$gid]);
			break;
		
		case 'plus':
			$_SESSION['cart'][$gid]['qty']++;
			break;

		/*if($_SESSION['cart'][$gid]['qty']>=库存){

			$_SESSION['cart'][$gid]['qty']=库存;
		}*/

		case 'minus':

			$_SESSION['cart'][$gid]['qty']--;

			if($_SESSION['cart'][$gid]['qty']<=1){
				$_SESSION['cart'][$gid]['qty']=1;
			}

			break;

		case 'add':

			$qty=$_GET['qty'];
			//将商品id 和购买数量放到SESSION['cart']
			/*$_SESSION['cart'][$gid]=$qty;*/


			//判断用户是不是重复购买

			if( array_key_exists($gid, $_SESSION['cart']) ){  //说明是不是重复购买

				//不用查询数据库，而是当次购买的数量和上次购买的数量相加即可

				$_SESSION['cart'][$gid]['qty']+=$qty;


			}else{// 说明是第一次购买

				// 将商品的相关信息查询出来，放到SESSION 中

				echo $sql=" select g.name gname, i.name iname, g.price
                    from ".PRE."goods g, ".PRE."img i
                    where i.goods_id=g.id and i.is_face=1 and g.id='$gid'
                    ";

                $goods=query($sql);

                $goods=$goods[0];

                $goods['qty']=$qty;//将购买数量放入goods数组中

                $_SESSION['cart'][$gid]=$goods;
			}

			break;
	
	}


	header('location:show_cart.php');

	echo "<pre>";
        print_r($_SESSION);
    echo "</pre>";

?>