<?php include "header.php"; 


	//接收商品id
	$gid=$_GET['gid'];

	 $sql="
		select g.id,g.name gname,g.price,g.describe,i.name iname 
        from ".PRE."goods g, ".PRE."img i
        where i.goods_id=g.id and g.cate_id=$gid and i.is_face=1 and g.status=1
        ";


	$goods_list=query($sql);
	


?>
<div class="main">

		<?php if(empty($goods_list)):?>
			<div class="coming">
			<div class="jumbotron ">
			  <h1>coming soon!</h1>
			  <p>产品即将上架，请耐心等待哦^_^</p>
			  <p><a class="btn btn-primary btn-lg" href="index.php" role="button">Learn more</a></p>
			</div>
			</div>

		<?php endif;?>
	
		<?php if(!empty($goods_list)):?>
		<?php  foreach($goods_list as $val):?>

		<div class="item_list fleft" >

			<?php $url=getImgUrl('uploads',$val['iname'],150 ); ?>

			<div>
			 	<a href="detail.php?gid=<?php echo $val['id']?>" ><img src="<?php echo $url ?>" class="img-rounded"/></a>
			</div>

			<div class="ziti">&yen:<?php echo $val['price'] ?></div>
		
			<div>
				<a href="detail.php?gid=<?php echo $val['id']?>"><?php echo $val['gname'] ?></a>			
			</div>

			<div ><?php echo $val['describe'] ?></div>

		</div>

	

		<?php endforeach;?>
		<?php endif;?>


		 
	
</div>


		
	<div class="fclear"></div>




<?php include "footer.php"; ?>
