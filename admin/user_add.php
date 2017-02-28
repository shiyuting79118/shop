<?php include"header.php";?>


<div class="content">
    <div class="talign">
		<form action="user_action.php?a=add" method="post">
		<h3>添加用户</h3>
			<div class="form_list">
				<div class="form_list_title">用户名：</div>
				<div class="form_list_content"><input class="form-control" type="text" name="name" placeholder="请输入用户名"/></div>
			</div>
			 <div class="form_list">
                <div class="form_list_title">Email：</div>
                <div class="form_list_content"><input class="form-control" type="email" name="mail" placeholder="请输入邮箱"/></div>
            </div>

              <div class="form_list">
                 
                <div class="radio">
                    <label >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：</label>
                      <label>
                        <input type="radio" name="sex" id="optionsRadios1" value="sex" checked>
                       男
                      </label>
                  
                      <label>
                        <input type="radio" name="sex" id="optionsRadios2" value="sex">
                       女
                      </label>
                </div> 
              </div>

            <div class="form_list">
                <div class="form_list_title">密码：</div>
                <div class="form_list_content"><input class="form-control" type="password" name="pwd" placeholder="请输入密码"/></div>
            </div>

            <div class="form_list">
                <div class="form_list_title">重复密码：</div>
                <div class="form_list_content"><input class="form-control" type="password" name="repwd" placeholder="请再次输入密码"/></div>
            </div>


             <div class="form_list">
                 
                <div class="radio">
                    <label >用户类型：</label>
                      <label>
                        <input type="radio" name="user_type" id="optionsRadios1" value="0" checked>
                       普通用户
                      </label>
                  
                      <label>
                        <input type="radio" name="user_type" id="optionsRadios2" value="1">
                       管理员
                      </label>
                </div> 
              </div>

			 <div class="form_list">
                <div class="form_list_title"></div>
                <div class="form_list_content">
                    <input class="btn btn-primary" type="submit" value="点击添加"/>
                </div>
            </div>
		</form>
	</div>	
</div>

<?php include "footer.php"; ?>