<!DOCTYPE html>
<html>
     <head>
         <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>index</title>
    </head>
    <!-- 
    过去，搭建后台界面，使用的是html框架 
    frameset 
    将浏览器窗口分割成多个窗口，在每个窗口中可以加载不同的页面，显示不同的内容
    frameset 标签不能与body标签共存
        rows  横向分割窗口
        cols  纵向分割窗口

    一个窗口要对应一个frame标签，frame是单标签
    -->
    <frameset rows="100,*">
        <frame src="http://www.baidu.com" />
        <frameset cols="20%,*">
            <frame src="http://www.qq.com" />
            <frame src="http://www.sina.com.cn"/>
        </frameset>
    </frameset>
</html>
