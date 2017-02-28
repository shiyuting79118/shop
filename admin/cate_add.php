<?php include"header.php";


    // 判断是添加一级类别呢？还是添加子分类？
    // 说明用户是要添加子类别
    if(!empty($_GET['pid']))
    {
        $pid=$_GET['pid'];   /*接收新分类的pid*/
        $path=$_GET['path'].$pid.','; /*拼接新分类的path*/
    }
    else // 说明是添加一级类别
    {
        $pid=0;
        $path=0;
    }
    
    ?>


	<div class="content">
        <div class="falign">
		<form action="cate_action.php?a=add" method="post">

            <h3>添加分类</h3>
			<div class="form_list">
				<div class="form_list_title"><h4>分类名称：</h4></div>
				<div class="form_list_content"><input class="form-control" type="text" name="name" placeholder="请输入分类名称"/></div>
			</div>

			<input type="hidden" name="pid" value="<?php echo $pid;?>" />
            <input type="hidden" name="path" value="<?php echo $path;?>" />

            <br/>
            <br/>
    
            <input class="btn btn-primary" type="submit"  calss="addbtn"value="确认添加"/>

		</form>
        </div>
	</div>	

<?php include "footer.php"; ?>