<?php  
	include"header.php";
	

	$sql="select `id`,`name`,concat(path,id,',') as bpath from ".PRE."categroy order by bpath";/*concat作用是把path和id拼接用,拼接起来*/
	$cate_list=query($sql);/*这一块是放在下拉框里的，查询出来的是分类*/

	$pid=$_GET['pid'];

 	// 查询一下什么商品
	 $sql="select `name` from ".PRE."categroy where `id`='$pid'";
	 $goods_name=query($sql);
	 $goods_name=$goods_name[0]['name'];
?>



<div class="content">
	<div class="talign">
	<div class="falign">
		<form action="cate_action.php?a=edit" method="post" enctype="multipart/form-data">
		<h3>编辑<?php echo $goods_name?>产品</h3>
			<div class="form_list">
				<div class="form_list_title">商品名称：</div>
				<div class="form_list_content"><input class="form-control" type="text" name="name" placeholder="请输入商品名称"/></div>
			</div>

			<div class="form_list">
				<div class="form_list_title">商品分类：</div>
				<div class="form_list_content">
					<select class="form-control" name="cate_id">
					<option value="">请选择</option>

					<?php if(!empty($cate_list)):?>
					<?php foreach($cate_list as $val):?>

					<option value="<?php echo $val['id']?>"><?php echo str_repeat('&nbsp;&nbsp;',(substr_count($val['bpath'],',')-1)).$val['name']?></option>

					<?php endforeach;?>
					<?php endif;?>

					</select>
				</div>
			</div>

			
            <br/><br/>

			 
			 <div class="form_list">
                <div class="form_list_title"></div>
                <div class="form_list_content">
                    <input class="btn btn-primary" type="submit" value="点击更改"/>
                </div>
            </div>
		</form>
	</div>
</div>	

