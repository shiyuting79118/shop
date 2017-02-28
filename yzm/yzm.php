<?php
    header("content-type:text/html;charset=utf-8");
    session_start();
    /**
    * 验证码函数
    * @param int $width     宽
    * @param int $height    高
    * @param int $leng      字符个数
    * @param string $type   图片类型
    * @param int $char_type 字符类型  1数字 2 小写字母 3 大写字母 4 数字字母  5 Chinese 
    * @return 没有返回值    成功的显示一个验证码图片
     **/

    function yzm( $width=100, $height=40, $leng=4,  $char_type=1, $type='jpeg' ){
        // 1. 创建画布
        $img = imagecreatetruecolor($width, $height);

        // 3. 填充背景
        imagefill($img, 0,0, lightColor($img) );

        // 4. 画图吧，兄弟！
        // 4.1 画干扰点
        for( $i=0; $i<50; $i++ ){
            $x = mt_rand(0, $width);
            $y = mt_rand(0, $height);

            imagesetpixel($img, $x, $y, darkColor($img) );
        }

        // 4.2 画干扰线
        for( $i=0; $i<3; $i++ ){
            $s_x = mt_rand(0, $width);
            $s_y = mt_rand(0, $height);
            
            $e_x = mt_rand(0, $width);
            $e_y = mt_rand(0, $height);

            imageline($img, $s_x,$s_y, $e_x, $e_y, darkColor($img) );
            
        }


        // 写字
        // 产生字符

        $str = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $char = '一地在要工上是中国同我和有的人主产不为这民了发以经截曹式节芭基菜革七划或功昌蝇肿丰欠揍';


        switch($char_type){
            case 1:
                //echo '数字';
                $s_index = 0;
                $e_index = 9;
                break;

            case 2:
                //echo '小写';
                $s_index = 10;
                $e_index = 35;
                break;

            case 3:
                //echo '大写';
                $s_index = 36;
                $e_index = 61;
                break;

            case 4:
                //echo '数字字母';
                $s_index = 0;
                $e_index = 61;
                break;

            case 5:
                //echo '中文';
                // 所用的字符串要变成中文
                $str = $char;   // 将中文交给变量$str
                $s_index = 0;
                $e_index = 40;
                break;
        }

        // 下面，通过循环$leng次,拿出对应的字符, mb_substr()
        // echo mb_substr($char, 0, 4, 'utf-8');

        $string = '';

        for( $i=0; $i<$leng; $i++){
            // 循环一次拿一个字符
            $string .= mb_substr($str, mt_rand($s_index, $e_index), 1, 'utf-8');
        }


        // 要将产生好的字符，写入session，不久的将来，我们会用到
        $_SESSION['vcode'] = $string;

        // 写字吧，朋友
        $w = $width/$leng;
        for($i=0; $i<$leng; $i++){

            $x = $i*$w+5;
            $y = mt_rand(10,$height);

            imagettftext(
                $img, 
                15,             // 字体大小
                mt_rand(-30,30), // 角度
                $x, $y,          // 字写在哪个坐标
                darkColor($img), // 颜色
                mt_rand(1,3).'.ttf',    // 随机使用字体库
                mb_substr($string, $i, 1, 'utf-8')   // 每次截取一个字符
            );  
        }

        
        // 5. 输出图片
        $header = 'content-type:image/'.$type;
        $out_func_name = 'image'.$type;             // imagejpeg  imagegif imagepng

        if( function_exists( $out_func_name )){
            header($header);
            $out_func_name($img);   // 针对不同图片类型，调用不同的图片输出函数, 阿拉使用了变量函数技术
        }
        

        // 6. 关闭资源
        imagedestroy($img);
    }


    // 写两个专业分配颜色的函数
    // 深色
    function darkColor( $img ){
        return imagecolorallocate($img, mt_rand(0,120),mt_rand(0,120),mt_rand(0,120) );
    }

    // 浅色 
    function lightColor( $img ){
        return imagecolorallocate($img, mt_rand(130, 255),mt_rand(130, 255),mt_rand(130, 255) );
    }

    yzm(100, 40, 4, 4,'png');
