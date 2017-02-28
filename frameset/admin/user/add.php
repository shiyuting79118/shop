<!DOCTYPE html>
<html>
     <head>
         <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>index</title>
    </head>
    <body>
        <h3>用户管理</h3>
        <ul>
            <li><a href="index.php">用户首页</a></li>
            <li><a href="add.php">添加用户</a></li>
        </ul>

        <div style="width:600px; margin:30px auto">

            <form action="action.php?a=add" method="post" >
                name:
                <input type="text" name="name" /><br/><br/>
                sex:
                <input type="radio" name="sex" value="1" checked />男
                <input type="radio" name="sex" value="0" />女<br/><br/>
                age:
                <input type="text" name="age" /><br/><br/>
                province:
                <select name="province">
                    <option value="">请选择...</option>
                    <option value="上海">上海</option>
                    <option value="江苏">江苏</option>
                    <option value="安徽">安徽</option>
                    <option value="江西">江西</option>
                    <option value="浙江">浙江</option>
                    <option value="四川">四川</option>
                    <option value="贵州">贵州</option>
                    <option value="山西">山西</option>
                    <option value="山东">山东</option>
                    <option value="河南">河南</option>
                    <option value="福建">福建</option>
                </select><br/><br/>
                
                <input type="submit" value="点击添加" />
            </form>

        </div>
</html>
