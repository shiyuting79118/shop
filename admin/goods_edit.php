<?php  
	include"header.php";

	$sql="select `id`,`name`,concat(path,id,',') as bpath from ".PRE."categroy order by bpath";/*concat作用是把path和id拼接用,拼接起来*/
	$cate_list=query($sql);/*这一块是放在下拉框里的，查询出来的是分类*/


	$gid=$_GET['gid'];	
?>



<div class="content">
	<div class="talign">
	<div class="falign">
		<form action="goods_action.php?a=edit&id=<?php echo  $gid?>" method="post" enctype="multipart/form-data">
		<h3>编辑商品</h3>	
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

			<div class="form_list">
				<div class="form_list_title">上传图片：</div>

				<div class="form_list_content">
					<input class="btn btn-default" type="file" name="file"/>
				</div>
			</div>


			 <div class="form_list">
                <div class="form_list_title">商品价格：</div>
                <div class="form_list_content"><input class="form-control" type="text" name="price" placeholder="请输入价格"/></div>
            </div>

            <div class="form_list">
                <div class="form_list_title">商品数量：</div>
                <div class="form_list_content"><input class="form-control" type="text" name="store" placeholder="请输入数量"/></div>
            </div>

            <div class="form_list">
                <div class="form_list_title">商品描述：</div>
                <div class="form_list_content">
                <textarea class="form-control" cols="60" rows="5" name="describe"></textarea>
                </div>
            </div>
            <br/><br/><br/><br/><br/>

			 
			 <div class="form_list">
                <div class="form_list_title"></div>
                <div class="form_list_content">
                    <input class="btn btn-primary" type="submit" value="确认更改"/>
                </div>
            </div>
		</form>
	</div>
</div>	

