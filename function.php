<?php
    
    /**
     * 专业查询三十年
     **/

    function query( $sql ){

        $result = mysql_query($sql);

        if( $result && mysql_num_rows( $result ) > 0 ){

            $list = array();        //声明一个空数组，将每条记录放到这个空数组中

            while( $row = mysql_fetch_assoc( $result ) ){
                $list[] = $row;
            }

            return $list;
        }
        // 能执行到这里，说明查询失败
        return false;

    }

    function execute( $sql ){

        $result = mysql_query($sql);

        // 说明用户在执行添加
        if( $result && mysql_insert_id() > 0 )
        {
            return mysql_insert_id();       // 执行添加成功，返回自增id
        }

        // 执行编辑或删除
        if( $result && mysql_affected_rows() > 0 )
        {
            return true;
        }

        // 执行失败
    return false;
    }

    function error ($message="操作错误",$url='',$time=3)
    {
    	if($url=='') 
        {
            $url=$_SERVER['HTTP_REFERER'];
        }

    	   echo $message;

    	   echo'<meta http-equiv="refresh" content="'.$time.';url='.$url.'"/>';

    	exit;
        }

    function success($message="操作错误",$url='',$time=3)
    {
        if($url=='')
        {
            $url=$_SERVER['HTTP_REFERER'];
        }
    	echo $message;
    	echo'<meta http-equiv="refresh" content="'.$time.';url='.$url.'"/>';
    	exit;


    }



    /**
     * 函数库
     **/

    /**
     * 文件上传
     * @param string    $name       文件上传域中的name属性值 
     * @param string    $dir        指定保存路径
     * @param int       $allow_size 允许上传的文件最大大小
     * @param array     $allow_type 允许上传的文件类型
     * @return string   $filename   返回上传成功的文件名
     * @author monan1116@163.com
     **/
    function upload($name='file', $dir='./uploads/', $allow_size=5242880, $allow_type=array('image')){


        // 判断错误
        if( $_FILES[$name]['error'] > 0 ){
            return false;
        }

        // 限制文件上传的大小
        if( $_FILES[$name]['size'] > $allow_size ){
            return false;
        }

        // 判断文件类型是否允许上传
        // 获取上传文件的主类型
        $arr = explode('/', $_FILES[$name]['type']);
        list($main_type, $sub_type) = $arr;

        // 如果上传的文件类型，不在我们允许的数组中
        if( !in_array($main_type, $allow_type) ){
            return false;
        }

        // 获取原图片的后缀，用于新上传成功后的文件名的后缀
        $ext = strrchr($_FILES[$name]['name'],'.');

        // 产生新的文件名
        $filename = date('Ymd').md5(uniqid()).$ext;

        // 图片是不是要放到指定的目录中去啊？
        $dir = rtrim($dir,'/').'/'.date('Y/m/d/');


        // 看看存放上传成功的文件 的目录是否存在？不存在则创建
        if( !file_exists($dir) ){
            mkdir( $dir, 0777, true );  // 递归创建目录
        }

        // 拼接完整的文件路径
        $file_path = rtrim($dir,'/').'/'.$filename;

        // is_uploaded_file()  判断上传文件是不是http post 提交的文件
        // move_uploade_file() 移动http post 上传成功的文件

        if( !is_uploaded_file( $_FILES[$name]['tmp_name'] ) ){
            return false;
            // exit('你的文件不是走的合法程序!');
        }

        if( !move_uploaded_file($_FILES[$name]['tmp_name'], $file_path) ){
            return false;
            // exit('文件上传失败');
        }

        // 函数执行成功，说明文件上传成功，
        // 将当次上传的图片名返回到调用处，未来，会把这个图片名存入数据库
        return $filename;
    }


     /**
     * 缩放
     * @param string $path 操作的图片的路径
     * @param int $width   缩放后的图片宽度
     * @param int $height   缩放后的图片高度
     **/
    function zoom($path, $width=200, $height=200){

        // 获取图片信息
        $arr = getimagesize($path);

        // 将宽高赋值给变量
        list($src_w, $src_h) = $arr;

        // 实现等比缩放
        if( $src_w > $src_h ){

            $height = $width/$src_w * $src_h;   // 重新确定缩放后的高度
            $pre = $width.'_';  
                            // 新的图片名的前缀
        }else{
            
            $width = $height/$src_h * $src_w;   // 重新确定缩放后的宽度
            $pre = $height.'_';                  // 新的图片名的前缀
        }



        // 获取图片的mime类型
        $type = $arr['mime'];
        $type = ltrim(strrchr($type, '/'),'/');     // png  jpeg  gif
        
        // 拼接打开背景的函数
        $create_func = 'imagecreatefrom'.$type;     // 打开图片资源的函数  imagecreatefromgif
        $save_func = 'image'.$type;                 // 保存图片的函数 imagepng imagejpeg  imagegif

        // 创建画布
        $src = $create_func($path);                 // 大图图片资源
        $dst = imagecreatetruecolor($width, $height);   // 小图资源

        // 一步搞定缩放
        imagecopyresampled( $dst, $src, 0,0, 0,0, $width, $height, $src_w, $src_h);

        // 保存小图片
        // 图片从哪里来，就回哪里去，并且加上相应缩放的尺寸前缀 100_ff1.jpg  200_ff1.jpg

        // 新图片中及路径
        $save_path = dirname($path).'/'.$pre.basename($path);

        $res = $save_func($dst, $save_path);

        // 关闭两个图片资源
        imagedestroy($src);
        imagedestroy($dst);

        return $res;        // 告诉函数外部，成功还是失败
    }


    /**
    * 处理上传成功后的图片路径的函数
    * @param string $dir 存放目录的路径 
    * @param stirng $filename 文件名
    * return 图片的完整路径 
     **/
    function getImgPath($dir, $filename){

        $year = substr($filename, 0, 4); // 截取年份
        $month = substr($filename, 4, 2); // 截取月份
        $day = substr($filename, 6, 2); // 截取号数

        // 拼接图片的完整路径
        $filepath = rtrim($dir,'/').'/'.$year.'/'.$month.'/'.$day.'/'.$filename;

        return $filepath;
    }


    /*返回图片URL
    $dir 文件上传存放的目录
    $img_name图片名
    $size 调用哪个尺寸的图片，如果为空字符串，刚使用原图
    return 返回拼接好的相应尺寸的图片的URL*/
    function getImgUrl($dir,$img_name,$size='')
    {

        if($size=='')
        {
            $size='';
        }
        else
        {
            $size=$size.'_';
        }

        $url=URL.$dir.'/';
        $url.=substr($img_name, 0,4).'/';
        $url.=substr($img_name, 4,2).'/';
        $url.=substr($img_name, 6,2).'/';
        $url.=$size.$img_name;

        return $url;

    }

    


