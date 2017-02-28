<?php include "header.php"; ?>

 
<div class="main">
    <div class="reg_content login_box">
        <form action="dologin.php" method="post">

            <div class="form_list">
                <div class="form_list_title">用户名：</div>
                <div class="form_list_content"><input class="form-control" type="text" name="name" placeholder="请输入用户名"/></div>
            </div>

            <div class="form_list">
                <div class="form_list_title">密码：</div>
                <div class="form_list_content"><input class="form-control" type="password" name="pwd" placeholder="请输入密码"/></div>
            </div>

            <div class="form_list">
                <div class="form_list_title">验证码：</div>
                <div class="form_list_content">
                    <input class="form-control" type="text" name="vcode" placeholder="请输入右边的验证码"/>
                    <img class="yzm" src="./yzm/yzm.php" onclick="this.src=this.src+'?i='+Math.random()" />
                </div>
            </div>

            <div class="form_list">
                <div class="form_list_title"></div>
                <div class="form_list_content">
                    <input class="btn btn-primary" type="submit" value="点击登录"/>
                </div>
            </div>

        </form>
    </div>
</div>
<?php include "footer.php"; ?>
