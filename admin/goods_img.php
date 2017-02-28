<?php 
	include'header.php';

	// 接收商品id
	 $gid=$_GET['gid'];

 	// 查询出当前商品下的所有图片
	 $sql = "select `id`,`name`,`is_face` from ".PRE."img where `goods_id`='$gid'";

	 $img_list=query($sql);
	


 	// 查询一下是谁的图片
	 $sql="select `name` from ".PRE."goods where `id`='$gid'";
	 $goods_name=query($sql);
	 $goods_name=$goods_name[0]['name'];
	 
	 ?>




<div class="content">
	<div class="talign">
		<h3><?php echo $goods_name?>的图片</h3>
		<table  class="table table-striped table-hover ">
		    <tr align="center">
		        <td>编号</td>
		        <td>图片</td>
		        <td>封面</td>
		        <td>操作</td>  
		    </tr>

		    <?php if(!empty($img_list)):?>
		    <?php foreach($img_list as $val):?>

 			<tr align="center">
		        <td><?php echo $val['id'] ?></td>

		        <td><img src="<?php echo getImgUrl('uploads',$val['name'],50) ?>"/></td>

		        <td><?php echo $val['is_face']?'<span class="glyphicon glyphicon-ok"></span>':'<sapn class="glyphicon glyphicon-remove" ></span>'?></td>


		        <td>
					 <a  href="goods_action.php?a=face&gid=<?php echo $gid ?>&img_id=<?php echo $val['id'] ?>">设为封面&nbsp;</a>

					<a   href="goods_action.php?a=del_img&img_id=<?php echo $val['id'] ?>">删除图片&nbsp;</a>				        		
		        </td>  
		    </tr>
		    
			<?php endforeach;?>
			<?php endif;?>
	    </table>    
	</div>

		<a href="goods_img_add.php?gid=<?php echo $gid?>"><div class="btn btn-primary addimg" >添加图片</div></a>

</div>

<?php include 'footer.php' ?>