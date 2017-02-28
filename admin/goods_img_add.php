<?php 
	include"header.php";

	 // 接收商品id
	$gid=$_GET['gid'];
?>


<div class="reg_contents">
        <div class="falign">
		<form action="goods_action.php?a=add_img" method="post" enctype="multipart/form-data">

            <!-- <div calss="">添加分类</div> -->
            <h3>添加图片</h3>

            <br/>
			
			<input type="hidden" name="gid" value="<?php echo $gid;?>" />

           	<div class="form_list">
				<div class="form_list_title">上传图片：</div>

				<div class="form_list_content">
					<input class="btn btn-default" type="file" name="file"/>
				</div>
			</div>

            <br/>
            <br/>
    
            <input class="btn btn-primary" type="submit"  calss="addbtn" value="确认添加"/>

		</form>
        </div>
	</div>	

<?php include "footer.php"; ?>