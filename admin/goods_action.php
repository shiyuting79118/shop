<?php 
	include'../common.php';
    
	$a=$_GET['a'];
	switch ($a) 
	{
        case 'up':
        /*获得商品的id*/
            $gid=$_GET['gid'];

            $bian=$_GET['bian'];

            switch($bian)
            {
                case 'status':
                
                /*获得相反的商品状态*/
                    $status=$_GET['status']?0:1;

                /*sql语句*/

                    $sql = "update ".PRE."goods set `status`='$status' where `id`='$gid'";

                    execute($sql);


                   header("location:".$_SERVER['HTTP_REFERER']);

                break;

                case 'is_hot':

                    $is_hot=$_GET['is_hot']?0:1;

                    echo $sql = "update ".PRE."goods set `is_hot`='$is_hot' where `id`='$gid'";

                    execute($sql);

                    header("location:".$_SERVER['HTTP_REFERER']);

                    break;

                case 'is_best':

                    $is_best=$_GET['is_best']?0:1;

                    echo $sql = "update ".PRE."goods set `is_best`='$is_best' where `id`='$gid'";

                    execute($sql);

                    header("location:".$_SERVER['HTTP_REFERER']);

                    break;


                case 'is_new':

                    $is_new=$_GET['is_new']?0:1;

                    echo $sql = "update ".PRE."goods set `is_new`='$is_new' where `id`='$gid'";

                    execute($sql);

                    header("location:".$_SERVER['HTTP_REFERER']);

                    break;
                }

        break;




		case 'add':


          // 1. 表单的完整判断
        foreach( $_POST as $val )
            {
                if( $val == '' )
                {
                    echo '请完善表单';
                    echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
                    exit;
                }
            }


             // 2. 先上传图片成功
       $filename=upload('file',PATH.'uploads/');
      
        if(!$filename)
        {
        	error('文件上传失败');

        }

        // 3. 缩放图片成功  150*150  250*250   80*80  50*50
        // 如果图片缩放失败，到这里添加商品就失败了，删除缩放成功的图片，删除上传成功的图片

		// 拼接上传成功的图片路径

        $filepath=getImgPath(PATH.'uploads/',$filename);

        



        // 缩放

        if(!zoom($filepath,250,250)||!zoom($filepath,400,400)||!zoom($filepath,150,150)||!zoom($filepath,80,80)||!zoom($filepath,50,50))
        {

        	// 删除缩放成功的图片
            @unlink(dirname($filepath).'400_'.basename($filename));
        	@unlink(dirname($filepath).'250_'.basename($filename));
        	@unlink(dirname($filepath).'150_'.basename($filename));
        	@unlink(dirname($filepath).'80_'.basename($filename));
        	@unlink(dirname($filepath).'50_'.basename($filename));
        	// 删除原图片

        	@unlink($filepath);

        	error('图片缩放失败');

        }
        	
        /*4.图片上传成功，商品信息写入商品表
        如果写入成功，拿到商品ID
        如果写入失败，到这里添加商品就失败了，删除缩放成功的图片和上传成功的图片*/


        //接收商品信息
        $name=$_POST['name'];
        $cate_id=$_POST['cate_id'];
        $price=$_POST['price'];
        $store=$_POST['store'];
        $describe=$_POST['describe'];
        $add_time=time();

        /* $sql = "insert into ".PRE."goods (`name`,`cate_id`,`price`,`store`,`describe`,`add_time`) values('$name','$cate_id','$price','$store', '$describe', '$add_time')";*/

        $sql="insert into ".PRE."goods (`name`,`cate_id`,`price`,`store`,`describe`,`add_time`)values ('$name','$cate_id','$price','$store','$describe','$add_time')";
    
    	$goods_id=execute($sql);

    	//没有自增id，说明商品信息写入失败
    	if(!$goods_id)
    	{
            @unlink(dirname($filename).'/400_'.basename($filepath));
    		@unlink(dirname($filename).'/250_'.basename($filepath));
    		@unlink(dirname($filename).'/150_'.basename($filepath));
    		@unlink(dirname($filename).'/80_'.basename($filepath));
    		@unlink(dirname($filename).'50_'.basename($filepath));

    		@unlink($filepath);

    		error('写入商品信息失败');
    	}

    	/*5.将商品id和上传成功后的图片名，写入图片表
    	失败了，删除所以和商品相关的图片，删除商品信息，整个商品添加失败


    	将商品id和图片名写入图片表
    	*/
    	/*$sql = "insert into ".PRE."img (`name`,`goods_id`,`is_face`) values('$filename','$goods_id','1')";*/
    	 $sql = "insert into ".PRE."img (`name`,`goods_id`,`is_face`) values('$filename','$goods_id','1')";

            if( execute($sql) ){
                success('商品添加成功', 'goods_index.php');
            }else{

                // 删除写入商品表的信息
                execute("delete from ".PRE."goods where id='$goods_id'");

                // 删除所有图片 
                // 删除缩放成功的图片
                @unlink(dirname($filepath).'/400_'.basename($fileapth));
                @unlink(dirname($filepath).'/250_'.basename($fileapth));
                @unlink(dirname($filepath).'/150_'.basename($fileapth));
                @unlink(dirname($filepath).'/80_'.basename($fileapth));
                @unlink(dirname($filepath).'/50_'.basename($fileapth));
                // 删除原图片
                @unlink($filepath);

                error('商品添加失败');
            }

        break;

        case 'del':

                $gid=$_GET['gid'];

                $sql="select `name` from ".PRE."img where `goods_id`='$gid'";

                $img_list = query($sql);

                // 1.查询出所有图片名，将所有图片删掉
                 foreach( $img_list as $val )
                {
                   $filepath=PATH.getImgPath('uploads',$val['name']);
                   $img_path_50=dirname($filepath).'/50_'.basename($filepath);
                   $img_path_80=dirname($filepath).'/80_'.basename($filepath);
                   $img_path_150=dirname($filepath).'/150_'.basename($filepath);
                   $img_path_250=dirname($filepath).'/250_'.basename($filepath);
                   $img_path_250=dirname($filepath).'/400_'.basename($filepath);
                    
                // 1.1 循环图片数组，依次将图片删除
                    @unlink($filepath);
                    @unlink($img_path_50);
                    @unlink($img_path_80);
                    @unlink($img_path_150);
                    @unlink($img_path_250);
                    @unlink($img_path_400);
                }


                // 2.将所有的图片记录删掉 

                $sql="delete from ".PRE."goods where `id`='$gid'";

                execute($sql);

                success('删除成功','goods_index.php');

                break;

        break;


        case 'face':

            $gid=$_GET['gid'];   // 商品id
            $img_id=$_GET['img_id'];// 图片id  他想当封面 他要请商品老大哥，把其他图片全部变成不是封面

            // 将所有图片，全部变成 不是封面 is_face = 0
            echo $sql="update ".PRE."img set `is_face`='0' where `goods_id`='$gid'";
            execute($sql);
            // 将当前图片的is_face = 1

            $sql="update ".PRE."img set `is_face`='1' where `id`=$img_id ";
            execute($sql);

            header("location:".$_SERVER['HTTP_REFERER']);

            break;


        case 'del_img':

            // 接收图片id
            $img_id=$_GET['img_id'];

            // 把图片名查询出来
            // 把商品id查询出来  回goods_img.php的时候，要带回去
         
            echo $sql="select `name`,`goods_id` from ".PRE."img where `id`='$img_id'";

            $img_list=query($sql);

            $filename=$img_list[0]['name'];// 图片名
            $gid=$img_list[0]['goods_id']; // 商品id


             // 根据图片名，拼接图片的完整路径
            $filepath = PATH.getImgPath('uploads', $filename);   // 原图路径
            $img_path_50 = dirname($filepath).'/50_'.basename($filepath);   // 50*50    
            $img_path_80 = dirname($filepath).'/80_'.basename($filepath);   // 80*80
            $img_path_150 = dirname($filepath).'/150_'.basename($filepath); // 150*150
            $img_path_250 = dirname($filepath).'/250_'.basename($filepath); // 250*250
            $img_path_400 = dirname($filepath).'/250_'.basename($filepath); // 250*250


            // 删除图片 50 80 150 250 原图
            
            if( !@unlink($filepath) || !@unlink($img_path_50) || !@unlink($img_path_80) || !@unlink($img_path_150) || !@unlink($img_path_250)|| !@unlink($img_path_400) )
            {
                error('图片删除失败');
            }
             
            // 图片删除成功之后 ，我们就要删除图片表中的记录
            $sql="delete from ".PRE."img where `id`='$img_id'";

             if( execute( $sql ) ){
                success('图片删除成功', 'goods_img.php?gid='.$gid);
            }else{
                error('图片删除失败', 'goods_img.php?gid='.$gid);
            }


            break;


        case 'add_img':
           
            // 文件上传

            $filename=upload('file',PATH.'uploads/');
            echo $filename;

             if( !$filename ){
                /*error('文件上传失败');*/
            }

            // 图片缩放
            // 获取图片路径
            $filepath = getImgPath(PATH.'uploads/', $filename);


            if(
                !zoom($filepath, 400,400)
                ||
                !zoom($filepath, 250,250)
                ||
                !zoom($filepath, 150,150)
                ||
                !zoom($filepath, 80,80)
                ||
                !zoom($filepath, 50,50)
                
            ){
                // 删除缩放成功的图片
                @unlink(dirname($filepath).'/400_'.basename($fileapth));
                @unlink(dirname($filepath).'/250_'.basename($fileapth));
                @unlink(dirname($filepath).'/150_'.basename($fileapth));
                @unlink(dirname($filepath).'/80_'.basename($fileapth));
                @unlink(dirname($filepath).'/50_'.basename($fileapth));
                // 删除原图片
                @unlink($filepath);

                error('图片缩放失败');
            }


            // 将图片信息写入图片表
            // 接收商品id
            $gid=$_GET['gid'];

            $sql = "insert into ".PRE."img (`name`, `goods_id`, `is_face`) values('$filename','$gid','0')";

            if(execute($sql)){
                success('图片添加成功', 'goods_img.php?gid='.$gid); //跳回图片首页的时候，一定要带回商品id
            }else{

                 // 删除缩放成功的图片
                @unlink(dirname($filepath).'/400_'.basename($fileapth));
                @unlink(dirname($filepath).'/250_'.basename($fileapth));
                @unlink(dirname($filepath).'/150_'.basename($fileapth));
                @unlink(dirname($filepath).'/80_'.basename($fileapth));
                @unlink(dirname($filepath).'/50_'.basename($fileapth));
                // 删除原图片
                @unlink($filepath);
                error('图片添加失败');
            }


            break;



        case 'edit':

          $gid=$_GET['id'];
          $img_id=$_GET['img_id'];
          
          // 1. 表单的完整判断
        foreach( $_POST as $val )
            {
                if( $val == '' )
                {
                    echo '请完善表单';
                    echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['HTTP_REFERER'].'" />';
                    exit;
                }
            }


             // 2. 先上传图片成功
       $filename=upload('file',PATH.'uploads/');
      
        if(!$filename)
        {
            error('文件上传失败');

        }

        // 3. 缩放图片成功  150*150  250*250   80*80  50*50
        // 如果图片缩放失败，到这里添加商品就失败了，删除缩放成功的图片，删除上传成功的图片

        // 拼接上传成功的图片路径

        $filepath=getImgPath(PATH.'uploads/',$filename);


        // 缩放

        if(!zoom($filepath,250,250)||!zoom($filepath,400,400)||!zoom($filepath,150,150)||!zoom($filepath,80,80)||!zoom($filepath,50,50))
        {

            // 删除缩放成功的图片
            @unlink(dirname($filepath).'400_'.basename($filename));
            @unlink(dirname($filepath).'250_'.basename($filename));
            @unlink(dirname($filepath).'150_'.basename($filename));
            @unlink(dirname($filepath).'80_'.basename($filename));
            @unlink(dirname($filepath).'50_'.basename($filename));
            // 删除原图片

            @unlink($filepath);

            error('图片缩放失败');

        }
            
        /*4.图片上传成功，商品信息写入商品表
        如果写入成功，拿到商品ID
        如果写入失败，到这里添加商品就失败了，删除缩放成功的图片和上传成功的图片*/


        //接收商品信息
        $name=$_POST['name'];
        $cate_id=$_POST['cate_id'];
        $price=$_POST['price'];
        $store=$_POST['store'];
        $describe=$_POST['describe'];
        $add_time=time();

        /* $sql = "insert into ".PRE."goods (`name`,`cate_id`,`price`,`store`,`describe`,`add_time`) values('$name','$cate_id','$price','$store', '$describe', '$add_time')";*/

         echo $sql="update ".PRE."goods set `name`='$name',`cate_id`='$cate_id',`price`='$price',`store`='$store',`describe`='$describe',`add_time`='$add_time' where `id`='$gid' ";
    
        $goods_id=execute($sql);

        //没有自增id，说明商品信息写入失败
        if(!$goods_id)
        {
            @unlink(dirname($filename).'/400_'.basename($filepath));
            @unlink(dirname($filename).'/250_'.basename($filepath));
            @unlink(dirname($filename).'/150_'.basename($filepath));
            @unlink(dirname($filename).'/80_'.basename($filepath));
            @unlink(dirname($filename).'/50_'.basename($filepath));

            @unlink($filepath);

            // error('写入商品信息失败');
            exit;
        }

        /*5.将商品id和上传成功后的图片名，写入图片表
        失败了，删除所以和商品相关的图片，删除商品信息，整个商品添加失败


        将商品id和图片名写入图片表
        */
        /*$sql = "insert into ".PRE."img (`name`,`goods_id`,`is_face`) values('$filename','$goods_id','1')";*/
         $sql = "update ".PRE."img set `name`='$filename',`is_face`='1' where `goods_id`='$gid' ";

            if( execute($sql) ){
                success('商品修改成功', 'goods_index.php');
            }else{
                // 删除写入商品表的信息
                execute("delete from ".PRE."goods where id='$goods_id'");

                // 删除所有图片 
                // 删除缩放成功的图片
                @unlink(dirname($filepath).'/400_'.basename($fileapth));
                @unlink(dirname($filepath).'/250_'.basename($fileapth));
                @unlink(dirname($filepath).'/150_'.basename($fileapth));
                @unlink(dirname($filepath).'/80_'.basename($fileapth));
                @unlink(dirname($filepath).'/50_'.basename($fileapth));
                // 删除原图片
                @unlink($filepath);

               /* error('商品修改失败');*/
               exit;
            }

        break;
}

